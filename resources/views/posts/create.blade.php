@extends('layouts.app')

@section('title', 'New Post')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6 space-y-5">
        @csrf

        @include('posts.partials.form')

        <div class="flex flex-col sm:flex-row gap-3 pt-5 border-t border-neutral-200 dark:border-neutral-800">
            <button type="submit" class="flex-1 ig-btn text-white font-semibold py-2.5 px-4 rounded-xl transition text-sm">
                Publish
            </button>
            <a href="{{ route('posts.index') }}" class="flex-1 bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 font-medium py-2.5 px-4 rounded-xl text-center transition text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection