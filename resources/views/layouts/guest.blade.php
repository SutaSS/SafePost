<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SafePost') }}</title>

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
<body class="bg-white dark:bg-neutral-950 min-h-screen flex flex-col">
    <div class="flex-1 flex flex-col justify-center items-center px-4 py-8">
        <div class="mb-6">
            <a href="/" class="text-2xl font-bold ig-text tracking-tight">
                SafePost
            </a>
        </div>

        <div class="w-full max-w-sm">
            <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl shadow-sm p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>

    <footer class="py-5 text-center text-xs text-neutral-400 dark:text-neutral-600">
        &copy; {{ date('Y') }} SafePost. All rights reserved.
    </footer>
</body>
</html>
