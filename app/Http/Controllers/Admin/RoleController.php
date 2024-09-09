<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Role $role, Request $request)
    {
        $permissions = Permission::all()->sortBy('name');
        $roles = Role::where([
            ['name', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($s = $request->search)) {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')->get();
                    }
                }
            ]
        ])->orderBy('name', 'asc')->paginate(10);

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3', 'unique:roles'], 'role_description' => ['required'], 'permission' => ['required']]);
        $role = Role::create($validated);
        if (!empty($request->permission)) {
            $role->givePermissionTo($request->permission);
        }

        return to_route('admin.roles.index')->with('message', 'Role created successfully!');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => 'required', 'role_description' => 'required|min:3']);
        $role->update($validated);

        return to_route('admin.roles.index')->with('message', 'Role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message', 'Role deleted successfully!');
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked!');
        }
        return back()->with('message', 'Permission not assigned to role!');
    }
}
