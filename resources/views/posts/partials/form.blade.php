<div class="mb-3">
    <label>Categories</label>
    <select name="categories[]" multiple class="form-control">
        @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}"
                {{ isset($post) && $post->categories->contains($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tags</label>
    <select name="tags[]" multiple class="form-control">
        @foreach(\App\Models\Tag::all() as $tag)
            <option value="{{ $tag->id }}"
                {{ isset($post) && $post->tags->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
</div>