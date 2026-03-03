@extends('layouts.app')

@section('content')

<h1>{{ $post->title }}</h1>

<p class="text-muted">
    By {{ $post->user->name }} |
    {{ $post->created_at->format('d M Y') }}
</p>

<hr>

<div>
    {!! nl2br(e($post->content)) !!}
</div>

<hr>

<p>
    Categories:
    @foreach($post->categories as $category)
        <span class="badge bg-primary">{{ $category->name }}</span>
    @endforeach
</p>

<p>
    Tags:
    @foreach($post->tags as $tag)
        <span class="badge bg-secondary">{{ $tag->name }}</span>
    @endforeach
</p>

@endsection