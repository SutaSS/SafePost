<section>
    <header>
        <h2 class="text-base font-semibold text-neutral-900 dark:text-white">Two-Factor Authentication</h2>
        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Add additional security to your account using two-factor authentication.</p>
    </header>

    @if (session('status') == 'two-factor-authentication-confirmed' || auth()->user()->two_factor_enabled || auth()->user()->{'2fa_enabled'})
        <div class="mt-5">
            <h3 class="text-sm font-semibold text-green-600 dark:text-green-400 mb-3">
                You have enabled two-factor authentication.
            </h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-5">
                When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
            </p>
            <form method="post" action="{{ route('2fa.disable') }}">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition">
                    Disable 2FA
                </button>
            </form>
        </div>
    @elseif (session('status') == 'two-factor-authentication-enabled')
        <div class="mt-5">
            <h3 class="text-sm font-semibold text-neutral-900 dark:text-white mb-3">
                Finish enabling two-factor authentication.
            </h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-5">
                To finish enabling two-factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.
            </p>

            <div class="mt-4 mb-4 p-2 inline-block bg-white rounded-lg">
                {!! session('two_factor_qr') !!}
            </div>

            <div class="mt-4 mb-5 space-y-2">
                <p class="text-xs font-semibold text-neutral-900 dark:text-white mt-1">Setup Key: <span class="font-mono text-pink-600 dark:text-pink-400">{{ session('two_factor_secret') }}</span></p>
            </div>

            <form method="post" action="{{ route('2fa.confirm') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">Code</label>
                    <input id="code" name="code" type="text" inputmode="numeric" autofocus
                        class="w-full sm:w-1/2 px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-neutral-400" placeholder="000000" />
                    <x-input-error :messages="$errors->get('code')" class="mt-1" />
                </div>
                
                <div class="flex items-center gap-3">
                    <button type="submit" class="ig-btn text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition">
                        Confirm
                    </button>
                    <a href="{{ route('profile.edit') }}" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white">Cancel</a>
                </div>
            </form>
        </div>
    @else
        <div class="mt-5">
            <h3 class="text-sm font-semibold text-neutral-900 dark:text-white mb-3">
                You have not enabled two-factor authentication.
            </h3>
            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-5">
                When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
            </p>
            <form method="post" action="{{ route('2fa.enable') }}">
                @csrf
                <button type="submit" class="ig-btn text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition">
                    Enable 2FA
                </button>
            </form>
        </div>
    @endif
</section>
