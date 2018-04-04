    <p class="cat-msg"></p>
    <input id="form-category-id" type="hidden" name="id" value="">
    <div class="form-group">
        <label for="description">Name</label>
        <input name="name" type="text" class="form-control" id="cat_name" value="{{ $category->name}}">
        <input name="id" type="hidden" value="{{ $category->id}}">
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input name="tags" type="text" class="form-control" id="cat_tags" value="{{ $category->tags}}">
    </div>
