@use('Artesaos\SEOTools\Facades\SEOTools')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOTools::generate() !!}

    <title>@yield('title', 'SafePost')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .ig-gradient { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #FD1D1D, #F77737, #FCAF45); }
        .ig-text { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #F77737); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .ig-btn { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #FD1D1D); }
        .ig-btn:hover { background: linear-gradient(135deg, #6e2f99, #a52d70, #c4295d, #de1919); }
    </style>
</head>
<body class="bg-neutral-50 dark:bg-neutral-950 min-h-screen flex flex-col" x-data="{ mobileMenu: false }">

{{-- Navigation --}}
<nav class="bg-white dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-800 sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-14">
            {{-- Brand --}}
            <a href="{{ route('posts.index') }}" class="text-lg font-bold ig-text tracking-tight shrink-0">
                SafePost
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden sm:flex items-center gap-6 text-sm">
                <a href="{{ route('posts.index') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                    Blog
                </a>

                @auth
                    <a href="{{ route('posts.create') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                        New Post
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                        Dashboard
                    </a>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-1.5 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                            {{ Auth::user()->name }}
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-xl shadow-lg py-1.5 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition">
                                Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="ig-btn text-white px-4 py-1.5 rounded-lg transition font-semibold text-sm">
                        Register
                    </a>
                @endauth
            </div>

            {{-- Mobile Hamburger --}}
            <button @click="mobileMenu = !mobileMenu" class="sm:hidden text-neutral-500 dark:text-neutral-400 p-1.5 -mr-1.5 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition">
                <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
         x-cloak class="sm:hidden border-t border-neutral-100 dark:border-neutral-800 bg-white dark:bg-neutral-900">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('posts.index') }}" class="block py-2.5 px-3 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition font-medium">Blog</a>

            @auth
                <a href="{{ route('posts.create') }}" class="block py-2.5 px-3 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition font-medium">New Post</a>
                <a href="{{ route('dashboard') }}" class="block py-2.5 px-3 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition font-medium">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="block py-2.5 px-3 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition font-medium">Profile</a>

                <div class="pt-2 mt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <p class="px-3 text-xs text-neutral-400 dark:text-neutral-500">{{ Auth::user()->email }}</p>
                    <form action="{{ route('logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2.5 px-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition font-medium">Log out</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block py-2.5 px-3 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 rounded-lg transition font-medium">Login</a>
                <a href="{{ route('register') }}" class="block py-2.5 px-3 text-sm text-pink-600 dark:text-pink-400 font-semibold">Register</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main class="flex-1 max-w-5xl mx-auto w-full px-4 sm:px-6 py-6 sm:py-8">
    @if(session('success'))
        <div class="mb-5 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-sm text-red-600 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

{{-- Footer --}}
<footer class="border-t border-neutral-200 dark:border-neutral-800 py-5">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center text-xs text-neutral-400 dark:text-neutral-600">
        &copy; {{ date('Y') }} SafePost. All rights reserved.
    </div>
</footer>

</body>
</html>