<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'SafePost') }} - Secure Blog Platform</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .ig-gradient { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #FD1D1D, #F77737, #FCAF45); }
        .ig-gradient-soft { background: linear-gradient(135deg, #833AB410, #C1358410, #E1306C10, #F7773710); }
        .ig-text { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #F77737); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .ig-btn { background: linear-gradient(135deg, #833AB4, #C13584, #E1306C, #FD1D1D); }
        .ig-btn:hover { background: linear-gradient(135deg, #6e2f99, #a52d70, #c4295d, #de1919); }
    </style>
</head>
<body class="bg-white dark:bg-neutral-950 min-h-screen flex flex-col antialiased">

    {{-- Nav --}}
    <nav class="max-w-5xl mx-auto w-full px-4 sm:px-6 py-4 flex items-center justify-between">
        <span class="text-xl font-bold ig-text tracking-tight">SafePost</span>

        <div class="flex items-center gap-4 text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium border border-neutral-200 dark:border-neutral-800 px-4 py-2 rounded-xl">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition font-medium">
                    Login
                </a>
                <a href="{{ route('register') }}" class="ig-btn text-white px-5 py-2 rounded-xl transition font-semibold shadow-sm">
                    Register
                </a>
            @endauth
        </div>
    </nav>

    {{-- Hero --}}
    <section class="flex-1 w-full max-w-5xl mx-auto px-4 sm:px-6 py-16 sm:py-24 flex flex-col justify-center">
        <div class="max-w-3xl">
            <h1 class="text-4xl sm:text-6xl font-extrabold text-neutral-900 dark:text-white leading-[1.15] tracking-tight">
                Write, share, and <br class="hidden sm:block" />
                <span class="ig-text">protect your content.</span>
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-neutral-500 dark:text-neutral-400 leading-relaxed max-w-2xl">
                SafePost is a secure blog platform with built-in SEO tools and two-factor authentication. Share your ideas with the world with confidence.
            </p>
            <div class="mt-10 flex flex-wrap items-center gap-4 border-l-2 border-pink-500 pl-6 bg-pink-50/50 dark:bg-pink-900/10 py-3 pr-3 rounded-r-2xl">
                <a href="{{ route('posts.index') }}" class="text-neutral-900 dark:text-white font-semibold hover:text-pink-600 dark:hover:text-pink-400 transition flex items-center gap-2">
                    Read Blog <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                @guest
                    <span class="text-neutral-300 dark:text-neutral-700 hidden sm:block">|</span>
                    <a href="{{ route('register') }}" class="text-neutral-600 dark:text-neutral-400 font-medium hover:text-neutral-900 dark:hover:text-white transition line-underline">
                        Create an account
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="border-t border-neutral-100 dark:border-neutral-900 w-full mt-auto">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-12">
                <div class="bg-neutral-50 dark:bg-neutral-900 p-6 rounded-3xl border border-neutral-100 dark:border-neutral-800 transition hover:shadow-md">
                    <div class="w-10 h-10 ig-gradient-soft rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-neutral-900 dark:text-white mb-2">Blog Platform</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">Create and manage posts with categories, tags, and full-text search.</p>
                </div>

                <div class="bg-neutral-50 dark:bg-neutral-900 p-6 rounded-3xl border border-neutral-100 dark:border-neutral-800 transition hover:shadow-md">
                    <div class="w-10 h-10 ig-gradient-soft rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-neutral-900 dark:text-white mb-2">SEO Optimized</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">Auto-generated meta tags, Open Graph, structured data, and sitemap.</p>
                </div>

                <div class="bg-neutral-50 dark:bg-neutral-900 p-6 rounded-3xl border border-neutral-100 dark:border-neutral-800 transition hover:shadow-md">
                    <div class="w-10 h-10 ig-gradient-soft rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-neutral-900 dark:text-white mb-2">2FA Security</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed">Two-factor authentication with Google Authenticator for secure access.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-neutral-100 dark:border-neutral-900 py-6 w-full bg-white dark:bg-neutral-950">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col justify-center items-center text-xs text-neutral-400 dark:text-neutral-500">
            &copy; {{ date('Y') }} SafePost. All rights reserved.
        </div>
    </footer>

</body>
</html>
