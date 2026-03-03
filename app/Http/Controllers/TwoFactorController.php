<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    public function show()
    {
        return view('auth.2fa-verify');
    }

    public function verify(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required'
            ]);

            $google2fa = new Google2FA();
            
            // Check the database column directly or accessor
            $secret = auth()->user()->google2fa_secret ?? auth()->user()->two_factor_secret;

            $valid = $google2fa->verifyKey($secret, $request->code);

            if ($valid) {
                session(['2fa_verified' => true]);
                return redirect()->intended('/dashboard');
            }

            return back()->with('error', 'Kode OTP salah');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan verifikasi');
        }
    }

    public function enable(Request $request)
    {
        $user = auth()->user();
        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();
        
        // Save to whichever column the migration created
        $user->google2fa_secret = $secret;
        $user->two_factor_secret = $secret;
        $user->save();
        
        // Generate QR code SVG
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );
        
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $svgResponse = $writer->writeString($qrCodeUrl);

        session()->flash('status', 'two-factor-authentication-enabled');
        session()->flash('two_factor_secret', $secret);
        session()->flash('two_factor_qr', $svgResponse);

        return back();
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();
        
        $secret = $user->google2fa_secret ?? $user->two_factor_secret;

        $valid = $google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            $user->two_factor_enabled = true;
            $user->{'2fa_enabled'} = true;
            $user->save();

            return back()->with('status', 'two-factor-authentication-confirmed');
        }

        return back()->withErrors(['code' => 'The provided two factor authentication code was invalid.'])->with('status', 'two-factor-authentication-enabled');
    }

    public function disable(Request $request)
    {
        $user = auth()->user();
        $user->two_factor_enabled = false;
        $user->{'2fa_enabled'} = false;
        $user->two_factor_secret = null;
        $user->google2fa_secret = null;
        $user->save();

        return back()->with('status', 'two-factor-authentication-disabled');
    }
}