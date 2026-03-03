<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            $user = auth()->user();

            if (
                $user->two_factor_enabled &&
                !session()->has('2fa_verified')
            ) {
                return redirect()->route('2fa.verify.form');
            }
        }

        return $next($request);
    }
}
