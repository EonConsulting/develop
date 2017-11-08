@extends('layouts.app')

@section('page-title')
    Assets
@endsection

@section('custom-styles')
    <link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />

    <style>
        .filters {width: 180px; padding-left: 15px; float: left;}
        .filters h1, .preview h1 {font-size: 20px; color: #c2c2c2;}

        .filterBtn {width: 100%; margin-bottom: 10px;}

        .preview {border-width: 0px 0px 0px 1px; padding-left: 15px; border-color: #c2c2c2; border-style: solid;}

        .search {padding: 0px 15px 0px 15px;}

        .results {padding: 0px 15px 0px 15px;}
        .results-entry {background: #FFF; padding: 10px; position: relative; overflow-y: auto; font-size: 18px;}
        .results-entry-icon {float: left;}
        .results-entry-title {float: left; padding-left: 10px;}
        .results-entry-actions {float: right;}
        .results-entry-actions a {display: inline-block; width: 20px;}

        .preview-title {color: #FB711D; font-size: 20px; font-weight: 700; padding-bottom: 5px;}
        .preview-meta {color: #999; font-weight: 700; padding-bottom: 5px;}
        .preview-tags {padding-bottom: 5px;}
        .preview-description {}
        .preview-description-title {font-weight: 700;}
        .preview-description-body {}

        .flex-container {
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-flex-wrap: nowrap;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-align-content: stretch;
            -ms-flex-line-pack: stretch;
            align-content: stretch;
            -webkit-align-items: flex-start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .flex-item:nth-child(1) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 0 0 auto;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            -webkit-align-self: stretch;
            -ms-flex-item-align: stretch;
            align-self: stretch;

            width: 180px;
        }

        .flex-item:nth-child(2) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 1 1 0;
            -ms-flex: 1 1 0;
            flex: 1 1 0;
            -webkit-align-self: stretch;
            -ms-flex-item-align: stretch;
            align-self: stretch;

            flex-basis: 1;
        }

        .flex-item:nth-child(3) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 1 1 0;
            -ms-flex: 1 1 0;
            flex: 1 1 0;
            -webkit-align-self: stretch;
            -ms-flex-item-align: stretch;
            align-self: stretch;
            padding-right: 15px;
            flex-basis: 1;
        }

    </style>
@endsection

@section('content')

    <div class="flex-container">

        <div class="filters flex-item">

            <h1>Filters</h1>

            <div class="form-group">
                <a href="#" class="filterBtn btn btn-default">My Assets</a>
                <a href="#" class="filterBtn btn btn-default">All Assets</a>
            </div>


            <h1>Category</h1>

            <div class="form-group">

                <div class="radio">
                    <input id="categories" name="category" type="radio" value="all" ng-model="orderList">
                    <label for="category">
                        All
                    </label>
                </div>
                <?php foreach($categories as $category): ?>

                    <div class="radio">
                        <input id="radio<?php echo $category->id; ?>" name="category" type="radio" value="<?php echo $category->id; ?>" ng-model="orderList">
                        <label for="radio<?php echo $category->id; ?>">
                            <?php echo $category->name; ?>
                        </label>
                    </div>

                <?php endforeach; ?>
            </div>  
        </div>
        

        <div class="assets flex-item">
            <div class="search">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" class="form-control" name="search" placeholder="Enter a search term">
                </div>
            </div>
            <div class="results">

                <div class="results-entry shadow">
                    <div class="results-entry-icon">
                        <i class="fa fa-image"></i>
                    </div>
                    <div class="results-entry-title">
                        Algebra - Quadtratic Function
                    </div>
                    <div class="results-entry-actions">
                        <a href="#" id="deleteEntry"><i class="fa fa-trash-o"></i></a>
                        <a href="#" id="editEntry"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="#" id="previewEntry"><i class="fa fa-eye"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="preview flex-item">
            <h1>Preview</h1>
            
            <div class="preview-title">
                Algebra - Quadtratic Function
            </div>
            
            <div class="preview-meta">
                <span class="preview-meta-type">
                    <i class="fa fa-image"></i> Image
                </span>
                <span> | </span>
                <span class="preview-meta-category">
                    Categories: Maths
                </span>
            </div>

            <div class="preview-tags">

                <span class="label label-default">algebra</span>
                <span class="label label-default">algebraic</span>
                <span class="label label-default">math</span>
                <span class="label label-default">maths</span>
                <span class="label label-default">quadratic</span>
                <span class="label label-default">quadratic equation</span>

            </div>

            <div class="preview-description">

                <div class="preview-description-title">
                Description
                </div>

                <div class="preview-description-body">
                The quadratic formula expresses the solution of the degree two equation ax2 + bx + c = 0, where a is not zero, in terms of its coefficients a, b and c.
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

                <div class="modal-body">
                    
                </div>

                <div class="modal-footer">
                    
                </div>
                
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
            $("#form-category-id").val(id); //change hidden input value to id above
            //$("#edit-form").attr("action", "{{ url('content/categories/update') }}/"+id)


            console.log("Edit " + id);

            $.ajax({
                method: "GET",
                url: "{{ url('content/categories/') }}/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success

                        var json = JSON.parse(data);

                        $("#cat_name").val(json["name"]);
                        $("#cat_tags").val(json["tags"]);

                    },
                    400: function () { //bad request

                    },
                    500: function () { //server kakked

                    }
                }
            }).error(function (data) {
                console.log("Delete AJAX Broke");
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
            var id = $(this).data("id")  //get category id from btn id attribute

            console.log(id);

            $.ajax({
                method: "DELETE",
                url: "{{ url('content/categories/') }}/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success

                        refreshTable();
                        
                    },
                    400: function () { //bad request

                    },
                    500: function () { //server kakked

                    }
                }
            }).error(function (data) {
                console.log("Delete AJAX Broke");
            });
        });


        //$(this).data("id") 

    </script>                  

@endsection
