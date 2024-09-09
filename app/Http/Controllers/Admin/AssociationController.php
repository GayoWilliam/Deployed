<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssociatedAzure;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AssociationController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all()->sortBy('email');
        $azure_accounts = AssociatedAzure::where([
            ['azure_account', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($s = $request->search)) {
                        $query->orWhere('azure_account', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }
            ]
        ])->orderBy('azure_account', 'asc')->get();

        return view('admin.associations.index', compact(['azure_accounts', 'users']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'type.required' => 'The account type is required.',
        ]);

        AssociatedAzure::create([
            'account_type' => $request->type,
            'azure_account' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return to_route('admin.associations.index')->with('message', 'PowerBi account created successfully!');
    }

    public function destroy($id)
    {
        $azureAccount = AssociatedAzure::findOrFail($id);

        if ($azureAccount->users()->exists()) {
            return back()->with('error', 'Cannot delete this powerBi account because it is associated with users.');
        }

        $azureAccount->delete();
        return back()->with('message', 'PowerBi account deleted successfully!');
    }

    public function associateUser(Request $request, $association)
    {
        $request->validate([
            'user_email' => 'required|exists:users,id'
        ]);

        $userId = $request->user_email;
        $user = User::find($userId);
        $azureAccount = AssociatedAzure::find($association);

        if ($azureAccount && $user) {
            $user->azure_account_id = $azureAccount->id;
            $user->save();
            return redirect()->back()->with('success', 'User successfully associated with Azure account.');
        }

        return back()->with('error', 'Failed to associate user.');
    }

    public function disassociateUser($azureAccountId, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->azure_account_id == $azureAccountId) {
            $user->azure_account_id = null;
            $user->save();
            return back()->with('success', 'User disassociated successfully.');
        }

        return back()->with('error', 'Failed to disassociate the user.');
    }

}