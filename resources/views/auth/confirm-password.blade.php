<x-guest-layout>
    <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Confirm password</h2>
    <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-6">This is a secure area. Please confirm your password to continue.</p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <button type="submit" class="w-full ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
            Confirm
        </button>
    </form>
</x-guest-layout>
