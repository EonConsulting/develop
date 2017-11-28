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
                <div class="radio">
                    <input id="categories" name="category" type="radio" value="all" ng-model="orderList">
                    <label for="category">
                        All
                    </label>
                </div>
                @foreach($categories as $category)

                    <div class="radio">
                        <input id="radio{{ $category->id }}" name="category" type="radio" value="{{ $category->id }}" ng-model="orderList">
                        <label for="radio{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>

                @endforeach
            </div>  
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
                @isset($searchResults)
                @isset($searchResults['results'])

                <div class="flex-container">

                    <div class="flex-item">
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
                    </div>

                    <div class="flex-item">
                        @foreach($searchResults['results'] as $item)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="result-card shadow">
                                <div class="result-card-header">
                                    {{ $item['title'] }}
                                </div>
                                <div class="result-card-body">
                                    <div style="margin-bottom: 5px;">
                                        @foreach($item['tags'] as $tag => $count)
                                        <span class="label label-default">{{ $tag }}</span>
                                        @endforeach
                                    </div>

                                    {{ $item['description'] }}
                                </div>
                                <div class="result-card-footer">
                                    <a href="{{ url('content/view/'.$item['id']) }}" class="result-card-footer-leftbutton"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('content/update/'.$item['id']) }}" class="result-card-footer-leftbutton"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="result-card-footer-rightbutton"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>

                    <div class="flex-item">
                        <div class="pag">
                            @if($searchResults['fromPrev'] >= 0)
                            <a href="{!! url('/content') . '?from=' . $searchResults['fromPrev'] . '&size=' . $searchResults['size'] . '&searchterm=' . $searchResults['searchterm'] !!}" class="btn btn-default pull-left">Previous</a>
                            @else
                            <button class="btn btn-default disabled pull-left">Previous</button>
                            @endif

                            Showing 
                            <strong>{{ $searchResults['fromNext'] - $searchResults['size'] + 1 }}</strong>
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
                    </div>
                
                </div>

                @endisset
                @empty($searchResults['results'])
                <div>No results found</div>
                @endempty
                @endisset
            </div>

        </div>
    
    </div>
    
    
    

    
    
@endsection


@section('custom-scripts')
<script src="{{url('js/analytics/tincan.js')}}"></script>

<script>

$(document).ready(function () {
    // 2017-11-01 MH just temporarily commented this out
    // cause it was screwing up the DEMO - thanks a ton Dario you shit!
    // 
    // 2017-11-20 After wanting to hunt Dario down and shoot
    // him in the face with a paintball gun, MH fixed this........forever

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
                    id: "https://unisaonline.net/schema/1.0/content_search"
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


    // set the search term in the search bar on load
    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }

    var searchParam = GetURLParameter("searchterm");
    if (searchParam)
    {
        $("#searchterm").val(searchParam);
        // this ensures that we only log valid searches
        logXAPISearchEvent(searchParam);
    }

    $("#searchterm").keypress(function (e) {
        if (e.which === 13) {
            var sValue = $(this).val();
            if (sValue.length >= 3) {
                window.location.href = "{!! url('/content?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}" + sValue;
            }
        }
    });

    $("#btnSearch").on("click", function () {
        console.log('Search Clicked');
        var sValue = $("#searchterm").val();
        if (sValue.length >= 3) {
            window.location.href = "{!! url('/content?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}" + sValue;
        }
    });

    $("#btnReset").on("click", function () {
        window.location.href = "{!! url('/content?from=0&size=' . $searchResults['size'] . '&searchterm=') !!}";
    });
}); 

</script>

@endsection
