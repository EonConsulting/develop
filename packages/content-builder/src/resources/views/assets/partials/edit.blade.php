    <div class="asset-form">
        <form action="{{ url('/content/assets') }}" method="post" enctype='multipart/form-data'>

            {{ csrf_field() }}

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ $asset->title }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Tags (comma seperated)</label>
                        <input class="form-control" type="text" name="tags" id="tags" value="{{ $asset->tags }}" required>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="2" name="description" value="{{ $asset->description }}" id="description" required></textarea>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Content Block</label>
                        <textarea id="ltieditorv2inst" class="ckeditor cktextarea" value="{{ $asset->content }}" name="content" data-toggle="popover" data-placement="left" data-content=""></textarea>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="assetFile">
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <label for="categories">Categories</label>
                </div>

                <div class="col-md-12">
                    <?php foreach($categories as $category): ?>
                    <div class="category_checkbox">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="categories[]" value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </div>
            </div>

        </form>
    </div>
