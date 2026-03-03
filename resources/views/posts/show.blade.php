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

    <hr>
    <h4>Comments</h4>

    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..."></textarea>
            </div>
            <button class="btn btn-primary btn-sm">Kirim</button>
        </form>
    @endauth

    <hr>

    @foreach($post->comments()->latest()->paginate(5) as $comment)
        <div class="mb-3">
            <strong>{{ $comment->user->name }}</strong>
            <small class="text-muted">
                {{ $comment->created_at->diffForHumans() }}
            </small>

            <p>{{ $comment->content }}</p>

            @if(auth()->id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif
        </div>
    @endforeach

@endsection