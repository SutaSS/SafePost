@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome --}}
    <div>
        <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Welcome, {{ Auth::user()->name }}</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Manage your blog posts and account.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5">
            <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ Auth::user()->posts()->count() }}</p>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 font-medium">Posts</p>
        </div>
        <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5">
            <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ App\Models\Comment::whereHas('post', function($q) { $q->where('user_id', Auth::id()); })->count() }}</p>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 font-medium">Comments</p>
        </div>
        <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 col-span-2 sm:col-span-1">
            <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ Auth::user()->two_factor_enabled ? 'On' : 'Off' }}</p>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1 font-medium">2FA Status</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('posts.create') }}" class="ig-btn text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
            New Post
        </a>
        <a href="{{ route('profile.edit') }}" class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-neutral-50 dark:hover:bg-neutral-800 transition">
            Edit Profile
        </a>
    </div>

    {{-- Recent Posts --}}
    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden">
        <div class="px-5 py-3.5 border-b border-neutral-200 dark:border-neutral-800">
            <h2 class="text-sm font-semibold text-neutral-900 dark:text-white">Recent Posts</h2>
        </div>

        @if(Auth::user()->posts()->count())
            <div class="divide-y divide-neutral-100 dark:divide-neutral-800">
                @foreach(Auth::user()->posts()->latest()->limit(5)->get() as $post)
                    <div class="px-5 py-3.5 flex items-center justify-between gap-3">
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-medium text-neutral-900 dark:text-white hover:text-pink-600 dark:hover:text-pink-400 truncate block transition">
                                {{ $post->title }}
                            </a>
                            <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-0.5">{{ $post->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0">
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-xs text-pink-600 dark:text-pink-400 hover:text-pink-700 font-medium">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 dark:text-red-400 hover:text-red-600 font-medium">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-5 py-10 text-center">
                <p class="text-sm text-neutral-400 dark:text-neutral-500">No posts yet.</p>
                <a href="{{ route('posts.create') }}" class="text-sm text-pink-600 dark:text-pink-400 hover:text-pink-700 mt-1 inline-block font-medium">Create your first post</a>
            </div>
        @endif
    </div>
</div>
@endsection
