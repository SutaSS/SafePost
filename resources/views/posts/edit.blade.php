@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6 space-y-5">
        @csrf
        @method('PATCH')

        @include('posts.partials.form')

        <div class="flex flex-col sm:flex-row gap-3 pt-5 border-t border-neutral-200 dark:border-neutral-800">
            <button type="submit" class="flex-1 ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
                Update
            </button>
            <a href="{{ route('posts.show', $post->slug) }}" class="flex-1 bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 font-medium py-2.5 px-4 rounded-xl text-center transition text-sm">
                Cancel
            </a>
        </div>
    </form>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full sm:w-auto text-red-600 hover:text-red-700 dark:text-red-400 text-sm font-medium py-2.5 px-5 border border-red-200 dark:border-red-800 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition">
            Delete Post
        </button>
    </form>
</div>
@endsection