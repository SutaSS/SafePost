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

@endsection