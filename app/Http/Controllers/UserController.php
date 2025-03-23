<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Mail\EMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function login()
    {
        if (auth()->user()) {

            return redirect()->route("dashboard");
        }
        return view('BackEnd.Auth.login');
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.show', compact('user', 'roles', 'permissions'));
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()
            ->withErrors([
                'username' =>
                'The provided credentials do not match our records.',
            ])
            ->onlyInput('username');
    }

    public function logout()
    {
        // Session::flush();

        Auth::logout();
        return redirect('login');
    }
    public function index(Request $request)
    {
        $users = User::all();
        $users = User::query();
        if ($request->has('filter')) {
            $search = $request->get('search');
            // dd( $search );

            if (!empty($search)) {
                if (strpos($search, '@') !== false) {
                    $users = $users->where('email', $search);
                } else {
                    $names = explode(' ', $search);
                    if (sizeof($names) == 2) {
                        $users = $users->where(
                            'username',
                            'like',
                            '%' . $search . '%'
                        );
                    } else {
                        $users = $users
                            ->where('username', $search)
                            ->orWhere('email', 'like', '%' . $search . '%');
                    }
                }
            }
        }
        return view('users.index', ['users' => $users->paginate(10)]);
    }
    public function updateRoleAndPermission(User $user, Request $request)
    {
        if ($user->hasRole(Constants::SUPER_ADMIN_ROLE)) {
            return abort(403);
        }
        $data['permissions'] = null;
        $data = $request->validate([
            'role' => 'nullable',
            'input_permissions' => 'nullable',
        ]);
        $userRoles = $user->roles;
        foreach ($userRoles as $userRole) {
            $user->removeRole($userRole->name);
        }
        $user->assignRole($data['role']);

        $directPermissions = $user->getAllPermissions();
        foreach ($directPermissions as $key => $directPermission) {
            $user->revokePermissionTo($directPermission->name);
        }
        if (array_key_exists('input_permissions', $data)) {
            foreach ($data['input_permissions'] as $permission) {
                if ($permission == null) {
                    continue;
                }

                $permissionName = Permission::findById($permission)->name;
                if ($user->hasPermissionTo($permissionName) == false) {
                    $user->givePermissionTo($permissionName);
                }
            }
        }
        return redirect()
            ->back()
            ->with('success', 'User role and permission updated successfully');
    }

    public function register(Request $request)
    {
        // dd($request);
        $request['username'] = $request['usernamer'];
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'usernamer' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'password_confirmation' =>
            'required_with:password|same:password|min:8',
        ]);
        unset($validated['password_confirmation']);

        $validated['username'] = $validated['usernamer'];
        $validated['password'] = Hash::make($validated['password']);

        unset($validated['usernamer']);
        unset($validated['password_confirmation']);
        // dd($validated);
        $user = User::create($validated);
        $user->assignRole(Constants::USER_ROLE);
        return Redirect::route('home')->with(
            'success',
            'You Had Registered Successfully, please wait for activation'
        );
    }

    public function auth2api(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()
            ->withErrors([
                'login_error' =>
                'The provided credentials do not match our records.',
            ])
            ->onlyInput('username');
    }
    function profile(User $user)
    {
        // dd($user);

        return view("Users.profile", compact('user'));
    }
    function update(User $user, Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => "required|string"
        ]);
        // dd($user);
        $user = Auth::user();
        if ($request->hasFile('photo')) {
            $validated['profile'] = $request->file('photo')->store('Photos');
        }
        if ($user->update($validated))
            return redirect()->route("User.profile", ["User" => $user->id])->with("success", "updated");
        return back()->with("error", "Un able to Update");
    }
    function change_password(User $User)
    {

        return view("Users.change_password", compact('User'));
    }
    function change_password_store(User $User, Request $request)
    {
        $request->validate([
            "username" => "required|exists:users,username",
            "old_password" => "required",
            'password' => 'required|min:8',
            'password_confirmation' =>
            'required_with:password|same:password|min:8',
        ]);
        $user_pass = $User->password;

        if (Hash::check($request->old_password, $user_pass))
            if ($User->update(["password" => Hash::make($request->password)]))
                return redirect()->route("User.profile", ["User" => $User->id])->with("success", "Successfully Changed");
        return back()->with("error", "Un able to Change");
    }
    function  forget(){

        return view("Front.forgot");

    }
    function forgetpass(Request $request){
        $data=$request->validate(["email"=>"required|exists:users,email"]);
        $user=User::where("email",$data['email'])->first();
        // dd(route("user.forgetpass",['user'=>$user->id]));

        Mail::to($data['email'])->send(new EMail([
            'title' => 'Password reset',
            'body' => route("user.forgetpass",['user'=>$user->id]),
        ]));
        return redirect()->route("home")->with("success","Reset link had sent to your email, check you email.");

    }
    function  forgetpass_create(User $user){

    return view('Users.change_forgotpassword',compact('user'));

    }
    function change_forgottenpassword(User $user, Request $request){
        // dd($request);
        $data=$request->validate([
            'password' => 'required|min:8',
            'password_confirmation' =>'required_with:password|same:password|min:8',
        ]);

        if ($user->update(["password" => Hash::make($data['password'])]))
        {

            return redirect()->route("login")->with("success", "Successfully Changed");
        }
return back()->with("error", "Un able to Change");
    }
    function create()
    {
        $data = Role::select('name')->get();
        return view('Users.create',['roles'=>$data]);
    }
    function create_save(Request $request)
    {
        $data = $request->validate(['name'=>'required','email'=>'required',
        'username'=>'required','password'=>'required']);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->password=Hash::make($request->password);
       // $user->role=$request->role;
        if($user->save())
        {
            return redirect()->back()->with(['success'=>'user created successfully']);
        }else{
            return redirect()->back()->with(['error'=>'unable to create user!']);
        }
    }
}
