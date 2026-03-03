@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Blog</h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Read articles from our community</p>
        </div>
        @auth
            <a href="{{ route('posts.create') }}" class="ig-btn text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition inline-block text-center">
                New Post
            </a>
        @endauth
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('posts.index') }}" class="relative">
        <svg class="absolute left-3.5 top-3 w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input
            type="text"
            name="search"
            placeholder="Search posts..."
            value="{{ request('search') }}"
            class="w-full pl-10 pr-4 py-2.5 border border-neutral-200 dark:border-neutral-800 rounded-xl bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white text-sm placeholder-neutral-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
        />
    </form>

    {{-- Posts --}}
    @if($posts->count())
        <div class="space-y-4">
            @foreach($posts as $post)
                @include('posts.partials.card', ['post' => $post])
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-10 text-center">
            <p class="text-sm text-neutral-400 dark:text-neutral-500">No posts found.</p>
        </div>
    @endif
</div>
@endsection