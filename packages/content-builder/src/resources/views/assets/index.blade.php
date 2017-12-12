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
        .results-entry {background: #FFF; padding: 10px; position: relative; overflow-y: auto; font-size: 18px; margin-bottom: 10px;}
        .results-entry-icon {float: left;}
        .results-entry-title {float: left; padding-left: 10px;}
        .results-entry-actions {float: right;}
        .results-entry-actions a {display: inline-block; width: 20px;}

        .preview-title {color: #FB711D; font-size: 20px; font-weight: 700; padding-bottom: 5px;}
        .preview-mime {color: #999; font-weight: 700; padding-bottom: 5px;}
        .preview-tags {padding-bottom: 5px;}
        .preview-description {}
        .preview-description-title {font-weight: 700;}
        .preview-description-body {}
        .preview-content {padding-top: 15px;}
        .preview-content-title {font-weight: 700;}
        .preview-content-body {padding: 10px; background: #FFF; margin-bottom: 15px;}

        .preview-media {padding-top: 15px;}
        .preview-media-title {font-weight: 700;}
        .preview-media-body {padding: 10px; background: #FFF; margin-bottom: 15px;}

        #preview-place-holder {
            text-align: center;
            padding-top: 50px;
            font-size: x-large;
            color: #999;
        }

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
            margin-top: -15px;
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

            overflow-y: auto;
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

            overflow-y: auto;
        }

        .search {
            margin: 15px 0 15px 0;

        }

        .pag {
            overflow-y: auto;
            text-align: center;
            margin: 0 15px 15px 15px;
        }

    </style>
@endsection

@section('content')

    <div class="flex-container" id="container">

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
                <div class="form-inline">

                    <div class="form-group">
                        <input type="text" id="searchterm" class="form-control" name="search" placeholder="Enter a search term">
                    </div>
                    
                    <button type="button" class="btn btn-primary" id="btnSearch">Search</button>
                    <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                </div>
                
            </div>


            <div class="results">
                <div class="pag">
                    @if($searchResults['fromPrev'] >= 0)
                    <a href="{!! url('/content') . '?from=' . $searchResults['fromPrev'] . '&size=' . $searchResults['size'] . '&searchterm=' . $searchResults['searchterm'] !!}" class="btn btn-default pull-left">Previous</a>
                    @else
                    <button class="btn btn-default disabled pull-left">Previous</button>
                    @endif

                    Showing 
                    <strong>{{ $searchResults['fromNext'] - ($searchResults['size'] - 1) }}</strong>
                        to 

                    
                    @if($searchResults['fromNext'] < $searchResults['total'])
                    <strong>{{ $searchResults['fromNext'] }}</strong>
                    @else
                    <strong>{{ $searchResults['total'] }}</strong>
                    @endif
                    
                    
                        of 

                    <strong>
                    {{ $searchResults['total'] }}
                    </strong>
                    
                        results

                    @if($searchResults['fromNext'] < $searchResults['total'])
                    <a href="{!! url('/content') . '?from=' . $searchResults['fromNext'] . '&size=' . $searchResults['size'] . '&searchterm=' . $searchResults['searchterm'] !!}" class="btn btn-default pull-right">Next</a>
                    @else   
                    <button class="btn btn-default disabled pull-right">Next</button>
                    @endif
                </div>

                <?php foreach($searchResults['results'] as $asset): ?>
                <div class="results-entry shadow">
                    <div class="results-entry-icon">
                        <i class="fa fa-image"></i>
                    </div>
                    <div class="results-entry-title">
                        <?php echo $asset['title']; ?>
                    </div>
                    <div class="results-entry-actions">
                        <a href="{{ route('assets.delete', $asset['id']) }}" class="deleteEntry" data-asset-id="<?php echo $asset['id']; ?>"><i class="fa fa-trash-o"></i></a>
                        <a href="#" class="editEntry" data-asset-id="<?php echo $asset['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="#" class="previewEntry" data-asset-id="<?php echo $asset['id']; ?>"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>


                <div class="pag">
                    @if($searchResults['fromPrev'] >= 0)
                    <a href="{!! url('/content/assets') . '?from=' . $searchResults['fromPrev'] . '&size=' . $searchResults['size'] . '&searchterm=' . $searchResults['searchterm'] !!}" class="btn btn-default pull-left">Previous</a>
                    @else
                    <button class="btn btn-default disabled pull-left">Previous</button>
                    @endif

                    Showing 
                    <strong>{{ $searchResults['fromNext'] - ($searchResults['size'] - 1) }}</strong>
                        to 

                    
                    @if($searchResults['fromNext'] < $searchResults['total'])
                    <strong>{{ $searchResults['fromNext'] }}</strong>
                    @else
                    <strong>{{ $searchResults['total'] }}</strong>
                    @endif
                    
                    
                        of 

                    <strong>
                    {{ $searchResults['total'] }}
                    </strong>
                    
                        results

                    @if($searchResults['fromNext'] < $searchResults['total'])
                    <a href="{!! url('/content/assets') . '?from=' . $searchResults['fromNext'] . '&size=' . $searchResults['size'] . '&searchterm=' . $searchResults['searchterm'] !!}" class="btn btn-default pull-right">Next</a>
                    @else   
                    <button class="btn btn-default disabled pull-right">Next</button>
                    @endif
                </div>

            </div>
        </div>

        <div class="preview flex-item">

            <div id="preview-place-holder">

                Select an item to preview.

            </div>

            <div class="preview-asset hidden" id="preview-asset">
                <h1>Preview</h1>

                <div class="preview-title" id="a-title">

                </div>

                <div class="preview-mime" >
                <span class="preview-mime-type" id="a-mime-type">

                </span>
                    <span> | </span>
                    <span class="preview-mime-category" id="a-category">

                </span>
                </div>

                <div class="preview-tags" id="a-tags">

                </div>

                <div class="preview-description">

                    <div class="preview-description-title">
                        Description
                    </div>

                    <div class="preview-description-body" id="a-description">

                    </div>

                </div>

                <div class="preview-content" id="a-content-holder">

                    <div class="preview-content-title">
                        Content
                    </div>
                    <div class="preview-content-body shadow" id="a-content">

                    </div>
                </div>

                <div class="preview-media" id="a-media-holder">

                    <div class="preview-media-title">
                        Media
                    </div>
                    <div class="preview-media-body shadow" id="a-media">

                    </div>
                </div>

            </div>

        </div>


    
    </div>

@endsection


@section('exterior-content')
        
@endsection


@section('custom-scripts')

    <script>

        $(document).ready(function() {
            resizeArea();

            $("#searchterm").keypress(function (e) {
                if (e.which === 13) {
                    var sValue = $(this).val();
                    if (sValue.length >= 3) {
                        window.location.href = "{!! url('/content/assets?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}" + sValue;
                    }
                }
            });

            $("#btnSearch").on("click", function () {
                console.log('Search Clicked');
                var sValue = $("#searchterm").val();
                if (sValue.length >= 3) {
                    window.location.href = "{!! url('/content/assets?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}" + sValue;
                }
            });

            $("#btnReset").on("click", function () {
                window.location.href = "{!! url('/content/assets?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}";
            });
        });

        function changePreview(asset){

            $("#a-title").html(asset['title']);


            //detect mime and build html----------------------------------------
            if (asset['mime_type'] !== null){
                $("#a-media").html(asset['html']);
                $("#a-media-holder").show();

            } else {
                $("#a-media-holder").hide();

            }

            $("#a-mime-type").html(asset['icon']);

            //build categories html--------------------------------------------

            $categories_str = 'Catgories: ';
            $num_cat = 0;

            /*$(".menu_collapse").each(function( index ) {
                $(this).removeClass("hidden", 1000);
            });*/

            $.each(asset['categories'], function(index, value){
                $num_cat++;
                if($num_cat > 1) {
                    $categories_str += ", ";
                }
                $categories_str +=  value['name'];
            });

            $("#a-category").html($categories_str);


            //build tags htm
            $tags = asset['tags'].split(",");
            $tags_str = '';
            $tags.forEach(function(item, index){
                $tags_str += "<span class='label label-default'>" + item + "</span> ";
            });

            $("#a-tags").html($tags_str);


            //simple
            $("#a-description").html(asset['description']);

            if(asset['content'] !== null){
                $("#a-content-holder").show();
                $("#a-content").html(asset['content']);
            } else {
                $("#a-content-holder").hide();
            }

            $("#preview-place-holder").hide();
            $("#preview-asset").removeClass("hidden");


        }

        
        $(document).on('click', '.previewEntry', function() {

            console.log("Preview clicked");
            var id = $(this).data("asset-id"); //get category id from btn id attribute
            console.log("Preview " + id);

            $.ajax({
                method: "GET",
                url: "{{ url('content/assets/') }}/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success

                        //var json = JSON.parse(data);

                        changePreview(data);

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

        $(window).resize(function(){
            resizeArea();
        });

        function resizeArea(){
            var areaHeight = $("#content-area").height();
            $("#container").height(areaHeight);
        }


    </script>                  

@endsection
