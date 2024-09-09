<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $associatedAccount = $user->azureAccount;

        if (!$associatedAccount) {
            return redirect()->back()->withErrors(['login' => 'No associated Azure account found.']);
        }

        $tenantId = config('services.azure.tenant_id');
        $clientId = config('services.azure.client_id');
        $clientSecret = config('services.azure.client_secret');
        $azureUsername = $associatedAccount->azure_account;
        $azurePassword = $associatedAccount->password;

        $response = Http::asForm()->post("https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token", [
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'https://analysis.windows.net/powerbi/api/.default',
            'username' => $azureUsername,
            'password' => $azurePassword,
        ]);

        if ($response->getStatusCode() == 200) {
            $tokens = $response->json();
            $azureAccessToken = $tokens['access_token'] ?? null;

            if ($azureAccessToken) {
                $request->session()->put('azure_access_token', $azureAccessToken);
                return redirect()->intended(route('dashboard', ['absolute' => false]));
            }
        }

        return redirect()->back()->withErrors(['login' => 'Authentication with Azure AD failed.']);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
