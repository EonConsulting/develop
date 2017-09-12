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
                            <button type="button" class="btn btn-info btn-sm edit-btn" id="<?php echo $category->id ?>" data-toggle="modal" data-target="#saveModal">
                                Edit
                            </button>
                            <a href="{{ url('content/categories/delete').'/'.$category->id }}" class="btn btn-danger btn-sm">Delete</a>
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

@section('exterior-content')
    <!-- Modal -->
    <div id="saveModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                
                <form action="">
                    <div class="modal-body">
                        
                        <input id="form-category-id" type="hidden" name="id" value="">

                        <div class="form-group">
                            <label for="description">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input form="save" name="tags" class="form-control" id="tags" placeholder="Tags">
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button id="btnsbmit" class="btn btn-primary"><i class="fa fa-save"></i><span> Save</span></button>
                    </div>
                </form>

            </div>

        </div>
    </div>     
        
@endsection

@section('custom-scripts')

    <script>


        $('.edit-btn').click(function() {

            console.log("Edit clicked")
            
            var id = $(this).attr('id'); //get category id from btn id attribute

            $("#form-category-id").val(id); //change hidden input value to id above
            
            $category = $.getJSON("{{ url('/get-categories/') }}/"+id, function(result){
                console.log('success');
            });

            /*var name = result['name'];
            var tags = result['tags'];*/

        });

    </script>           
                       

@endsection
