<form method="POST" action="{{ route('comments.store', $hikyo->id) }}" enctype="multipart/form-data" class="mb-4">
    @csrf
    <div class="form-group">
        <label for="hikyo-first-content">内容</label>
        <textarea name="body" class="form-control" id="hikyo-first-content" rows="3"
            required></textarea>
    </div>
    <div class="form-group">
        <label for="comment-images">画像</label>
        <input type="file" class="form-control-file" id="comment-images" name="images[]" multiple>
    </div>
    <button type="submit" class="btn btn-primary">書き込む</button>
</form>
