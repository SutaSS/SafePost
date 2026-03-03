<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(str()->random(16))
                ]);
            } else {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }

            // Login user
            Auth::login($user);

            // Clear 2FA verified session
            session()->forget('2fa_verified');

            // Jika 2FA aktif, arahkan ke verify form
            if ($user->two_factor_enabled) {
                return redirect()->route('2fa.verify.form');
            }

            // Jika 2FA tidak aktif, mark sebagai verified
            session()->put('2fa_verified', true);
            return redirect()->route('dashboard');

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Login gagal: ' . $e->getMessage());
        }
    }
}