<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        Role::findOrCreate($data['name']);
        return redirect()->route('role.index');
    }
    public function index()
    {
        $roles = Role::paginate(10);
        return view('role.index', compact('roles'));
    }
    public function create()
    {
        $role = null;
        return view('role.create', compact('role'));
    }
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('role.show', compact('role', 'permissions'));
    }
    public function permissionAssign(Role $role, Request $request)
    {
        $request->validate([
            'permissions' => 'nullable',
        ]);
        $permissionIds = [];
        foreach ($request->permissions ?? [] as $permission) {
            $role->givePermissionTo(Permission::findById($permission)->name);
            array_push($permissionIds, $permission);
        }
        $removePermissions = Permission::whereNotIn(
            'id',
            $permissionIds
        )->get();
        foreach ($removePermissions as $permission) {
            if ($role->hasPermissionTo($permission->name)) {
                $role->revokePermissionTo($permission->name);
            }
        }
        return redirect()
            ->back()
            ->with('success', 'Permission assigned successfully');
    }

    public function allPermissions()
    {
        $permissions = Permission::paginate(10);
        return view('permission.index', compact('permissions'));
    }
}
