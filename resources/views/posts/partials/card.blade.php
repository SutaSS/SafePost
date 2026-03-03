<article class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-4 sm:p-5 hover:border-neutral-300 dark:hover:border-neutral-700 transition">
    <div class="min-w-0">
        <h3>
            <a href="{{ route('posts.show', $post->slug) }}" class="text-base font-semibold text-neutral-900 dark:text-white hover:text-pink-600 dark:hover:text-pink-400 transition line-clamp-2">
                {{ $post->title }}
            </a>
        </h3>

        <div class="flex flex-wrap items-center gap-2 mt-2 text-xs text-neutral-400 dark:text-neutral-500">
            <span class="font-medium text-neutral-600 dark:text-neutral-400">{{ $post->user->name }}</span>
            <span>&middot;</span>
            <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->format('d M Y') }}</time>
            @if(isset($post->relevance))
                <span>&middot;</span>
                <span>{{ number_format($post->relevance, 2) }}</span>
            @endif
        </div>

        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2">
            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}
        </p>

        @if($post->categories->count() || $post->tags->count())
            <div class="flex flex-wrap gap-1.5 mt-3">
                @foreach($post->categories as $category)
                    <span class="text-xs bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-300 px-2 py-0.5 rounded-full font-medium">
                        {{ $category->name }}
                    </span>
                @endforeach
                @foreach($post->tags as $tag)
                    <span class="text-xs bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 px-2 py-0.5 rounded-full">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-3 pt-3 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
        <a href="{{ route('posts.show', $post->slug) }}" class="text-sm text-pink-600 dark:text-pink-400 hover:text-pink-700 font-semibold transition">
            Read more
        </a>
        @if(auth()->check() && auth()->user()->id === $post->user_id)
            <a href="{{ route('posts.edit', $post->id) }}" class="text-xs text-neutral-400 dark:text-neutral-500 hover:text-neutral-600 dark:hover:text-neutral-300 font-medium">
                Edit
            </a>
        @endif
    </div>
</article>