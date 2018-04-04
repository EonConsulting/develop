@extends('layouts.app')


@section('page-title')
    Content Store
@endsection


@section('custom-styles')
<link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />

    <style>
        .filters {width: 180px; padding-left: 15px; float: left;}
        .filters h1 {font-size: 20px; color: #c2c2c2;}

        .results {margin-left: 180px;}

        .search {padding: 0px 30px 0px 30px;}

        .result-card{margin: 0px 0 15px 0px; background: #FFF; padding: 15px;}

        .result-card-header {font-size: 16px; height: 58px; overflow: hidden; font-weight: 700; color: #fb7217; margin: 0px -15px 0px -15px; padding: 0px 15px 5px 15px; border-width: 0px 0px 1px 0px; border-style: solid; border-color: #e6e6e6; }
        .result-card-body {height: 150px; overflow: hidden; margin: 15px 0px 15px 0px; font-size: 12px;}
        .result-card-footer {margin: 0px -15px -15px -15px; padding: 15px; background: #f8f8f8; font-size: 24px; border-width: 1px 0px 0px 0px; border-style: solid; border-color: #e6e6e6;}
        .result-card-footer a {color: gray;}
        .result-card-footer a {color: #606060;}

        .result-card-footer-leftbutton {padding: 0px 15px 0px 0px;}
        .result-card-footer-rightbutton {padding: 0px 0px 0px 15px; float: right;}

        .flex-container {
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-flex-wrap: nowrap;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-align-content: flex-start;
            -ms-flex-line-pack: start;
            align-content: flex-start;
            -webkit-align-items: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
        }

        .flex-item:nth-child(1) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 0 1 auto;
            -ms-flex: 0 1 auto;
            flex: 0 1 auto;
            -webkit-align-self: auto;
            -ms-flex-item-align: auto;
            align-self: auto;
        }

        .flex-item:nth-child(2) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 1 1 auto;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            -webkit-align-self: auto;
            -ms-flex-item-align: auto;
            align-self: auto;
        }

        .flex-item:nth-child(3) {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 0 1 auto;
            -ms-flex: 0 1 auto;
            flex: 0 1 auto;
            -webkit-align-self: auto;
            -ms-flex-item-align: auto;
            align-self: auto;
        }

        .pag {
            overflow-y: auto;
            text-align: center;
            margin: 0 15px 15px 15px;
        }

    </style>
    

@endsection


@section('content')
 
    <div>
        <div class="filters">
            <h1>Category</h1>

            <div class="form-group">
                @foreach($categories as $category)

                    <div class="checkbox">
                        <input id="radio{{ $category->id }}" class="cat-btn" name="categories" type="checkbox" value="{{ $category->name }}" ng-model="orderList">
                        <label for="radio{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>

                @endforeach
            </div> 
            <a href="#" id="clear-categories" class="btn btn-xs btn-default btn-clear">Clear</a>
        </div>
        
        <div class="results"> 
            <div class="search">
                <div class="form-inline">

                    <div class="form-group">
                        <input type="text" id="searchterm" class="form-control" name="search" placeholder="Enter a search term">
                    </div>
                    
                    <button type="button" class="btn btn-primary" id="btnSearch">Search</button>
                    <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                </div>
                
            </div>

            <div class="container-fluid sp-top-15">

                <div class="flex-container">

                    <div class="flex-item" id="pagination-top">
                        
                    </div>

                    <div class="flex-item" id="results">
                        No results
                    </div>

                    <div class="flex-item" id="pagination-bottom">

                    </div>
                
                </div>

            </div>

        </div>
    
    </div>
    
    
    

    {{ csrf_field() }}
    
@endsection


@section('custom-scripts')
<script src="{{url('js/analytics/tincan.js')}}"></script>

<script>

$from = 0;
$size = 12;

function search($actionUrl){

    $term = $("#searchterm").val();
    
    $categories = [];
    $.each($("input[name='categories']:checked"), function(){            
        $categories.push($(this).val());
    });

    $data = {
        'term': $term,
        'categories': $categories,
        'from': $from,
        'size': $size
    };

    console.log("search called");
    console.log($data);

    if( ! $actionUrl)
    {
        $actionUrl = "{{ url('/content/search') }}";
    }

    $.ajax({
        method: "POST",
        url: $actionUrl,
        data: JSON.stringify($data),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        statusCode: {
            200: function (data) { //success
                populateResults(data);
            },
            400: function () { //bad request

            },
            500: function () { //server kakked

            }
        }
    }).error(function (req, status, error) {
        //alert(error);
    });

}

function populateResults(data){

    $('#pagination-top').html(data.renderedPag);

    $('#results').html(data.renderedResults);

    $('#pagination-bottom').html(data.renderedPag);

}

$(document).ready(function () {

    search();

    $(document).on("click", ".btn-prev-page", function(e){
        e.preventDefault();
        search($(this).attr('href'));
    });

    $(document).on("click", ".btn-next-page", function(e){
        e.preventDefault();
        search($(this).attr('href'));
    });

    $(document).on("change", ".cat-btn", function(){
        $from = 0;
        search();
    });

    $(document).on("click", ".btn-clear", function(){
        $from = 0;
        $('.cat-btn').prop("checked", false);
        search();
    });

    $("#btnSearch").on("click", function () {
        $from = 0;
        search();
    });

    $("#btnReset").on("click", function () {
        $from = 0;
        $('.cat-btn').prop("checked", false);
        $("#searchterm").val("");
        search();
    });


    //------------------------------------------------------------------------------------------
    //------LOG xAPI Functions------------------------------------------------------------------
    //------------------------------------------------------------------------------------------
    function logXAPISearchEvent(searchParam) {
        //Log search
        var lrs;

        try {
            lrs = new TinCan.LRS(
                    {
                        endpoint: "{!! url('analytics/log') !!}",
                        username: "{{ auth()->user()->name }}",
                        password: null,
                        allowFail: false
                    }
            );
        } catch (ex) {
            console.log("Failed to setup LRS XAPI object: ", ex);
        }

        var statement = new TinCan.Statement(
            {
                actor: {
                    mbox: "{{ auth()->user()->email }}"
                },
                verb: {
                    id: "http://unisaonline.net/schema/1.0/content_search"
                },
                target: {
                    id: "{!! url('/content/search') !!}"
                },
                context: {
                    extensions: {
                        searchterm: searchParam
                    }
                }
            }
        );

        lrs.saveStatement(
            statement,
            {
                callback: function (err, xhr) {
                    if (err !== null) {
                        if (xhr !== null) {
                            console.log("Failed to save statement: " + xhr.responseText + " (" + xhr.status + ")");
                            // TODO: do something with error, didn't save statement
                            return;
                        }

                        console.log("Failed to save statement: " + err);
                        // TODO: do something with error, didn't save statement
                        return;
                    }

                    console.log("Statement saved");
                    // TOOO: do something with success (possibly ignore)
                }
            }
        );
    }

}); 

</script>

@endsection