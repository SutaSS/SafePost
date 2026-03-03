@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <article>
        {{-- Header --}}
        <header class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-white leading-tight">{{ $post->title }}</h1>

            <div class="flex flex-wrap items-center gap-2 mt-3 text-sm text-neutral-500 dark:text-neutral-400">
                <span class="font-semibold text-neutral-700 dark:text-neutral-300">{{ $post->user->name }}</span>
                <span>&middot;</span>
                <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->format('d M Y') }}</time>
            </div>
        </header>

        {{-- Categories & Tags --}}
        @if($post->categories->count() || $post->tags->count())
            <div class="flex flex-wrap gap-1.5 mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
                @foreach($post->categories as $category)
                    <span class="text-xs bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-300 px-2.5 py-1 rounded-full font-medium">
                        {{ $category->name }}
                    </span>
                @endforeach
                @foreach($post->tags as $tag)
                    <span class="text-xs bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 px-2.5 py-1 rounded-full">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Content --}}
        <div class="mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
            <div class="text-neutral-700 dark:text-neutral-300 leading-relaxed whitespace-pre-wrap text-sm sm:text-base">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        {{-- Actions --}}
        @if(auth()->check() && auth()->user()->id === $post->user_id)
            <div class="flex gap-3 mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
                <a href="{{ route('posts.edit', $post->id) }}" class="ig-btn text-white text-sm font-semibold px-5 py-2 rounded-xl transition">
                    Edit
                </a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 font-medium px-5 py-2 border border-red-200 dark:border-red-800 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </article>

    {{-- Comments --}}
    <section class="mt-8">
        <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">
            Comments ({{ $post->comments()->count() }})
        </h2>

        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-4 sm:p-5 mb-6">
                @csrf
                <label for="content" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Write a comment
                </label>
                <textarea
                    id="content"
                    name="content"
                    rows="3"
                    placeholder="Share your thoughts..."
                    class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-neutral-400"
                    required
                ></textarea>
                @error('content')
                    <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-3 ig-btn text-white text-sm font-semibold py-2 px-4 rounded-xl transition">
                    Post Comment
                </button>
            </form>
        @else
            <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 mb-6 text-center">
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    <a href="{{ route('login') }}" class="text-pink-600 dark:text-pink-400 font-semibold hover:text-pink-700">Sign in</a> to leave a comment
                </p>
            </div>
        @endauth

        {{-- Comments List --}}
        <div class="space-y-3">
            @forelse($post->comments()->latest()->paginate(10) as $comment)
                <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-sm font-semibold text-neutral-900 dark:text-white">{{ $comment->user->name }}</p>
                            <time datetime="{{ $comment->created_at->toIso8601String() }}" class="text-xs text-neutral-400 dark:text-neutral-500">
                                {{ $comment->created_at->diffForHumans() }}
                            </time>
                        </div>
                        @if(auth()->id() === $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 dark:text-red-400 hover:text-red-600 font-medium">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                    <p class="text-sm text-neutral-700 dark:text-neutral-300 whitespace-pre-wrap">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center py-8">No comments yet. Be the first to comment.</p>
            @endforelse
        </div>

        @if($post->comments()->count() > 10)
            <div class="mt-6">
                {{ $post->comments()->paginate(10)->links() }}
            </div>
        @endif
    </section>
</div>
@endsection