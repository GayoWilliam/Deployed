<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::where([
            ['name', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($s = $request->search)) {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')->get();
                    }
                }
            ]
        ])->orderBy('name', 'asc')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);

        return to_route('admin.permissions.index')->with('message', 'Permission created successfully!');
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['permission_description' => 'required']);
        $permission->update($validated);

        return to_route('admin.permissions.index')->with('message', 'Permission updated successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message', 'Permission deleted successfully!');
    }
}
