<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
class TwoFactorController extends Controller
{


    public function enable()
    {
        try {
            $google2fa = new Google2FA();

            $secret = $google2fa->generateSecretKey();

            $user = Auth::user();
            $user->update([
                'google2fa_secret' => encrypt($secret),
                '2fa_enabled' => true
            ]);

            return back()->with('success', '2FA aktif');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengaktifkan 2FA');
        }
    }
}
