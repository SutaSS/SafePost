<div class="card mb-3">
    <div class="card-body">
        <h4>
            <a href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h4>

        <p class="text-muted">
            By {{ $post->user->name }} |
            {{ $post->created_at->format('d M Y') }}
        </p>

        <p>
            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
        </p>
        @if(isset($post->relevance))
            <small class="text-success">
                Score: {{ number_format($post->relevance, 2) }}
            </small>
        @endif
    </div>
</div>