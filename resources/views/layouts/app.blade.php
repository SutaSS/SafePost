<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    {!! SEO::generate() !!}

    <title>@yield('title', 'ABC Blog')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('posts.index') }}">ABC Blog</a>
    </div>
</nav>

<div class="container mt-4">

    {{-- Alert Message --}}
    @include('components.alert')

    @yield('content')

</div>

</body>
</html>