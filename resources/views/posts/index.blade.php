@extends('layouts.app')

@section('title', 'Blog List')

@section('content')

<h1 class="mb-4">All Posts</h1>

<form method="GET" action="{{ route('posts.index') }}" class="mb-3">
    <input type="text" name="search" class="form-control"
           placeholder="Search..."
           value="{{ request('search') }}">
</form>

@foreach($posts as $post)
    @include('posts.partials.card', ['post' => $post])
@endforeach

{{ $posts->links() }}

@endsection