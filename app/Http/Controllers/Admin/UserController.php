<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\AssociatedAzure;
use App\Models\DataFilter;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $azureAccounts = AssociatedAzure::all();
        $filters = DataFilter::all();
        $users = User::where([
            ['name', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($s = $request->search)) {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')
                            ->orWhere('email', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }
            ]
        ])->orderBy('name', 'asc')->with('azureAccount')->get();

        return view('admin.users.index', compact('users', 'roles', 'azureAccounts', 'filters'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'role.required' => 'The role is required.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role);

        event(new Registered($user));

        return back()->with('message', 'User created successfully!');
    }

    public function update(Request $request, User $user)
    {
        if($request->role){
            $validated_role = $request->validate([
                'role' => ['required'],
            ]);
            
            if ($user->hasRole($validated_role)) {
                return back()->with('message', 'Role exists');
            } else {
                $user->removeRole($user->role);
                $user->assignRole($validated_role);
                $user->update($validated_role);
            }
        }

        if($request->table_name){
            $validated_table = $request->validate([
                'table_name' => ['required'],
            ]);
            
            $user->update($validated_table);
        }

        if($request->column_name){
            $validated_column = $request->validate([
                'column_name' => ['required'],
            ]);
            
            $user->update($validated_column);
        }

        if($request->column_value){
            $validated_column_value = $request->validate([
                'column_value' => ['required'],
            ]);
            
            $user->update($validated_column_value);
        }

        return to_route('admin.users.index')->with('message', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('message', 'User deleted successfully!');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists');
        }
        $user->assignRole($request->role);

        return back()->with('message', 'Role assigned to user.');
    }
    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed from user!');
        }

        return back()->with('message', 'Role not assigned to user!');
    }

    public function associateAzureAccount(Request $request, User $user)
    {
        if (empty($request->input('azure_account_id'))) {
            $user->azure_account_id = null;
            $user->save();

            return back()->with('message', 'PowerBi account association removed successfully.');
        }

        $validatedData = $request->validate([
            'azure_account_id' => 'required|exists:associated_azure_accounts,id'
        ]);

        $user->azure_account_id = $validatedData['azure_account_id'];
        $user->save();

        return back()->with('message', 'PowerBi association updated successfully.');
    }
}
