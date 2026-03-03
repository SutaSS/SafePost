<div class="mb-3">
    <label>Title</label>
    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title', $post->title ?? '') }}">
</div>

<div class="mb-3">
    <label>Content</label>
    <textarea name="content"
              rows="6"
              class="form-control">{{ old('content', $post->content ?? '') }}</textarea>
</div>