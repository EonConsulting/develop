@extends('layouts.app')

@section('page-title')
    Categories
@endsection

@section('custom-styles')

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8">

                <div class="dashboard-card shadow">

                    <div class="dashboard-card-heading">
                        Categories
                    </div>

                    <?php if(!empty($categories)):?>

                <table class="table">
                    <thead>
                        <th>Name</th><th>Tags</th><th>Actions</th>
                    </thead>

                    <?php foreach($categories as $category):
                        $tags = explode(',',$category->tags)
                        ?>

                    <tr>
                        <td><?php echo $category->name; ?></td>
                        <td>
                            <?php foreach($tags as $tag): ?>
                            <span class="label label-default"><?php echo $tag ?></span>
                            <?php endforeach;?>
                        </td>
                        <td>
                            <a href="{{ route('eon.contentbuilder.categories.update') }}" class="btn btn-info btn-sm">Update</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>

                    </tr>
                
                    <?php endforeach; ?>

                </table>

                <?php else:?>

                <h3>No Categories</h3>

                <?php endif; ?>
                
                </div>

                
            </div>

            <div class="col-md-4">
            
                <div class="dashboard-card shadow">

                    <div class="dashboard-card-heading">
                        Create a New Category
                    </div>
                
                    <div class="container-fluid sp-top-15">
                    {{  Form::open( array('url' => action('\EONConsulting\ContentBuilder\Controllers\ContentBuilderCategories@index'), 'method'=>'post','id'=>'save') )  }}

                        <div class="form-group">
                            <label for="name">Category Name</label><br>
                            <input type="text" name="name" class="form-conrol" placeholder="Category Name">
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Tags (comma seperated)</label><br>
                            <input type="text" name="tags" class="form-conrol" placeholder="Tags">
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Create">
                        </div>

                        {{ csrf_field() }}
                    {{ Form::close() }}
                    
                    
                    </div>
                    
                </div>
            </div>
        
        </div>
    
    </div>

@endsection

@section('custom-scripts')
    
@endsection
