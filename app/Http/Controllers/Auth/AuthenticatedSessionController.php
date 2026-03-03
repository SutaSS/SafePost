<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        try {

            $request->authenticate();

            $request->session()->regenerate();

            $user = Auth::user();

            // Reset 2FA session setiap login
            session()->forget('2fa_verified');

            // Jika 2FA aktif → redirect ke verify page
            if ($user->two_factor_enabled) {
                return redirect()->route('2fa.verify.form');
            }

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return back()->with('error', 'Login gagal');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        session()->forget('2fa_verified');
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
