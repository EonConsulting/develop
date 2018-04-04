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
                 @if (session('msg'))
                    <div class="alert alert-success">
                        {{ session('msg')}}
                    </div>
                @endif
                <div class="dashboard-card shadow">

                    <div class="dashboard-card-heading">
                        Categories
                    </div>

                    <?php if(!empty($categories)):?>

                <table class="table">
                    <thead>
                        <th>Name</th><th>Tags</th><th>Actions</th>
                    </thead>
                    
                    <tbody id="category_table">
                        
                    </tbody>

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
                        <form>

                            <div class="form-group">
                                <label for="name">Category Name</label><br>
                                <input type="text" name="name" class="form-conrol" placeholder="Category Name" id="create_name">
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Tags (comma seperated)</label><br>
                                <input type="text" name="tags" class="form-conrol" placeholder="Tags" id="create_tags">
                            </div>
                            
                            

                            {{ csrf_field() }}
                        </form>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info create-btn" value="Create">
                        </div>
                        
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
                <form id="edit-cat-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                    <div class="modal-body cat-info">                          
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary save-btn"><i class="fa fa-save"></i><span> Save</span></button>
                    </div>
                
                </form>
            </div>

        </div>
    </div>     
        
@endsection

@section('custom-scripts')

    <script>
           
        $( document ).ready(function() {
            refreshTable();           
        });


        function refreshTable(){

            $.ajax({
                method: "GET",
                url: "{{ url('content/categories') }}/all",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        
                        //$json = data;

                        //console.log(data);
                        drawTable(data);
                    },
                    400: function () { //bad request

                    },
                    500: function () { //server kakked

                    }
                }
            }).error(function (data) {
                console.log("Get current Data AJAX Broke");
            });

            
        }


        function drawTable($data){

            $html = "";
            $.each($data, function(i) {

                //open row
                $html += "<tr>";
                
                //add name
                $html += "<td>" + $(this)[0].name + "</td>";
                
                //add tags
                $html += "<td>";
                $tags = $(this)[0]['tags'].split(",");
                $.each($tags, function(j){

                    $html += "<span class='label label-default'>" + $tags[j] + "</span><span> </span>";
                });
                $html += "</td>";

                //add actions
                $html += "<td>";
                $html += "<a href='#' class='btn btn-info btn-sm edit-btn' data-id='" + $(this)[0]['id'] + "'data-toggle='modal' data-target='#saveModal'>Edit</a>";
                $html += "<span> </span>";
                $html += "<a href='#' class='btn btn-danger btn-sm delete-btn' data-id='" + $(this)[0]['id'] + "'>Delete</a>";
                $html += "</td>";

                //close row
                $html += "</tr>";
            });

            $('#category_table').empty();
            $('#category_table').append( $html );

        }

        $(document).on( 'click', '.create-btn', function() {

            console.log("Create clicked");

            $data = {"name": $("#create_name").val(), "tags": $("#create_tags").val()};

            $.ajax({
                method: "POST",
                url: "{{ url('content/categories') }}",
                data: JSON.stringify($data),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        $("#create_name").val("");
                        $("#create_tags").val("");
                        refreshTable();
                    },
                    400: function () { //bad request

                    },
                    500: function () { //server kakked

                    }
                }
            }).error(function (data) {
                console.log("Edit AJAX Broke");
            });


        });
        
        $(document).on('click', '.edit-btn', function() {
            console.log("Edit clicked");
            var id = $(this).data("id"); //get category id from btn id attribute          
            console.log("Edit " + id);
            $.ajax({
                method: "GET",
                url: "{{ url('/content/categories/edit') }}/"+id,
                asyn: false,
                beforeSend: function () {
                    $('.cat-info').html("loading....");
                },
                success: function (data, textStatus, jqXHR) {
                    $(".cat-info").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    
                }
            });
        });
        
        $(document).on('submit', '#edit-cat-form', function(event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "{{ url('/content/categories/update') }}",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                beforeSend: function () {
                    $('.save-btn').html("Updating....");
                },
                success: function (data, textStatus, jqXHR) {
                        $('.save-btn').html("Save");
                        $('div.alert').delay(8000).slideUp(300);
                        if(data.success){
                        $(".cat-msg").html("<div class='alert alert-success'>\n\
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>\n\
                                            <strong>Success!</strong> "+data.success+"<a href='{{ url('/content/categories') }}'>View Categories List</a></div>");
                        }  
                        if(data.error){
                        $(".cat-msg").html("<div class='alert alert-danger'>\n\
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>\n\
                                            <strong>Warning!</strong> "+data.error+"</div>");
                        }       
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    
                }
            });
        });

        
        $(document).on('click', '.save-btn', function(){

            var id = $("#form-category-id").val();
            $data = {"name": $("#cat_name").val(), "tags": $("#cat_tags").val()};

            $.ajax({
                method: "PUT",
                url: "{{ url('content/categories/') }}/"+id,
                data: JSON.stringify($data),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        $('#saveModal').modal('hide');
                        refreshTable();
                    },
                    400: function () { //bad request

                    },
                    500: function () { //server kakked

                    }
                }
            }).error(function (data) {
                console.log("Edit AJAX Broke");
            });

        });

        $(document).on('click', '.delete-btn',function() {
            console.log("Delete clicked")            
            var id = $(this).data("id");  //get category id from btn id attribute
            console.log(id);
            if (confirm("Are you sure you want to delete this category?")) {
            window.location.href = "{{ url('/content/categories/delete')}}/" + id;
        }
        return false;            
        });

    </script>                  

@endsection
