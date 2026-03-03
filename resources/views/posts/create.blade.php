@extends('layouts.app')

@section('content')

<h1>Create Post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    @include('posts.partials.form')

    <button class="btn btn-primary mt-3">Publish</button>
</form>

@endsection