<x-guest-layout>
    <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Verify email</h2>
    <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-6">Thanks for signing up! Please verify your email address by clicking the link we sent you.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-sm text-green-700 dark:text-green-300">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-neutral-500 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-300 underline">
                Log out
            </button>
        </form>
    </div>
</x-guest-layout>
