<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Blog;
use App\Models\Course;
use App\Models\DigitalSolution;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class dashBoardController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        if($user->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE]))
        {
        $roles = Role::withCount('users')->whereNot("name","Super Admin")->get();
       $courses_active=Course::where("status","Active")->count();
       $courses_pending=Course::where("status","Pending")->count();
        $blogs=Blog::count();
        $ds_active=DigitalSolution::where("status","Active")->count();
        $partners=Partner::selectRaw("type, count(type) as amount")->groupBy("type")->get();
        // dd($roles);
        $users=User::count();
        return view('BackEnd.dashboard',compact('roles','courses_active','courses_pending','blogs','ds_active','partners','users'));
        }

        return redirect()->route("course.index");


    }
}
