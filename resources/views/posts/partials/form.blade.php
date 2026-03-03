{{-- Title --}}
<div>
    <label for="title" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">
        Title <span class="text-red-500">*</span>
    </label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ isset($post) ? $post->title : old('title') }}"
        class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-neutral-400"
        placeholder="Enter post title"
        required
    />
    @error('title')
        <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Content --}}
<div>
    <label for="content" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">
        Content <span class="text-red-500">*</span>
    </label>
    <textarea
        id="content"
        name="content"
        rows="10"
        class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent font-mono placeholder-neutral-400"
        placeholder="Write your content here..."
        required
    >{{ isset($post) ? $post->content : old('content') }}</textarea>
    @error('content')
        <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Categories --}}
<div>
    <label for="categories" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">
        Categories
    </label>
    <select name="categories[]" id="categories" multiple
        class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
        @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}"
                {{ isset($post) && $post->categories->contains($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-1.5">Hold Ctrl/Cmd to select multiple</p>
</div>

{{-- Tags --}}
<div>
    <label for="tags" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1.5">
        Tags
    </label>
    <select name="tags[]" id="tags" multiple
        class="w-full px-3.5 py-2.5 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
        @foreach(\App\Models\Tag::all() as $tag)
            <option value="{{ $tag->id }}"
                {{ isset($post) && $post->tags->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-1.5">Hold Ctrl/Cmd to select multiple</p>
</div>