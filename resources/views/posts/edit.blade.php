@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<h1>Edit Post</h1>

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('posts.partials.form')

    <button type="submit" class="btn btn-primary mt-3">
        Update
    </button>

</form>

@endsection