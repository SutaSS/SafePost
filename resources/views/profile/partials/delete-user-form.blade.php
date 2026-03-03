<section>
    <header>
        <h2 class="text-base font-semibold text-neutral-900 dark:text-white">Delete Account</h2>
        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Once deleted, all your data will be permanently removed.</p>
    </header>

    <div class="mt-5">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition"
        >Delete Account</button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                All data will be permanently deleted. Please enter your password to confirm.
            </p>

            <div class="mt-4">
                <label for="password" class="sr-only">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="w-full sm:w-3/4 px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-neutral-400"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 text-sm font-semibold py-2.5 px-5 rounded-xl transition">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
