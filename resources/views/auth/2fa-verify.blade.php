<x-guest-layout>
    <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Two-factor verification</h2>
    <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-6">Enter the 6-digit code from your authenticator app.</p>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-sm text-red-600 dark:text-red-400">
            {{ $errors->first('code') ?? $errors->first() }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-sm text-red-600 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('2fa.verify') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="code" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">OTP Code</label>
            <input
                type="text"
                id="code"
                name="code"
                inputmode="numeric"
                placeholder="000000"
                maxlength="6"
                class="w-full px-4 py-3 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-center text-2xl tracking-[0.3em] font-mono focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                autofocus
                required
            />
            <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-2">Use Google Authenticator or Authy</p>
        </div>

        <button type="submit" class="w-full ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
            Verify
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-neutral-200 dark:border-neutral-700 text-center">
        <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-3">Can't access authenticator?</p>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-sm text-pink-600 dark:text-pink-400 hover:text-pink-700 font-semibold">
                Sign out
            </button>
        </form>
    </div>
</x-guest-layout>