<x-guest-layout>
    <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Forgot password</h2>
    <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-6">Enter your email and we'll send you a reset link.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-neutral-400" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <button type="submit" class="w-full ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
            Send reset link
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-neutral-500 dark:text-neutral-400">
        <a href="{{ route('login') }}" class="text-pink-600 dark:text-pink-400 hover:text-pink-700 font-semibold">Back to sign in</a>
    </p>
</x-guest-layout>
