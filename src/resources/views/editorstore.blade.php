@extends('ckeditorpluginv2::layouts.master')

@section('content')

    <link href="/vendor/appstore/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
    <script src="{{url('/js/ng.js')}}"></script>
    <style>
        .App-header {
            background-color: #0099e0;
            border-bottom: 1px solid #0099e0;
            box-shadow: 2px 2px 2px rgba(0,0,0,.07);
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 10px;
            padding:15px;
        }
        .App-header .form-control {border-radius: 0 !important; padding-right:15px; height:42px !important;border:none !important; margin-bottom:0 !important}
        .App-header select {border:none !important;}
        .App-header .form-group {margin-bottom:0 !important}
        .App-header .btn-install {    height: 42px !important;
            border-radius: 0 !important;
            line-height: 2.2 !important;
        }
    </style>

    <div class="domains">

        <div class="panel panel-default">

            <div id="app-container" class="container">
                {{--<div class="app-header">--}}
                {{--<form action="selectsearch" class="navbar-form navbar-left" method="get">--}}
                {{--<div class="input-group custom-search-form">--}}
                {{--<input type="text" class="form-control unisabdr" name="term" placeholder="Search for a Component">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button class="btn unisa-black-btn btn-sm" type="submit">--}}
                {{--<i class="fa fa-search"></i>--}}
                {{--</button>--}}
                {{--</span>--}}
                {{--</div>--}}
                {{--</form>--}}
                {{--</div>--}}

                <div class="row">
                    @if (session('error_message'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                {{ session('error_message') }}
                            </div>
                        </div>
                    @endif

                    @if (session('success_message'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->count() > 0)
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">

                    <div id="tools" ng-app="tools" ng-controller="ToolsListCtrl">
                        <header class="App-header">
                            <div class="form-group">
                                <h3 style="color:#fff !important;"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;Apps&nbsp;&nbsp;&nbsp;
                                </h3>
                            </div>
                            <div class="form-group">
                                <input placeholder="Search by name or type" class="form-control" type="text" id="query"
                                       ng-model="query"/>
                            </div>
                            <div class="form-group">
                                <select placeholder="Filter by Name" class="form-control" ng-model="orderList">
                                    <option value="name">Sort By Title</option>
                                    <option value="description">Sort By Type</option>
                                    <option value="">Oldest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" ng-model="CatList">
                                    <option value="">All Categories</option>
                                    <option value="">Community</option>
                                    <option value="">Content</option>
                                    <option value="">Math</option>
                                    <option value="">Media</option>
                                    <option value="">Open Access</option>
                                </select>
                            </div>

                        </header>
                        <p><span>Results: <% tools.length %></span></p>
                        <div ng-repeat="tool in tools | filter:query | orderBy: orderList">
                            <div class="app-item col-xs-3" id="app-listjs">
                                <div class="app-contents list">
                                    <div class="app-logo">
                                        <img src="<% tool.logo_url %>" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="app-details">
                                        <h4 class="title"><% tool.title %></h4>
                                        <p class="app-description"><%tool.description %></p>
                                        <div class="pull-bottom-left">
                                            <a data-context="<% tool.context_id %>"
                                               class="appitem btn unisa-orange-btn btn-sm" role="button"><i
                                                        class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Insert
                                                Tool</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="clearfix"></div>

            <script>
                {{--//Initialise Select 2 with Jquery--}}
                {{--$(document).ready(function (){--}}
                {{--var data = '{{ $tools }}';--}}
                {{--$.each( data, function( key, value ) {--}}
                {{--console.log('data');--}}
                {{--});--}}

                {{--//                    $('#search-box').select2({--}}
                {{--//                    data:sum--}}
                {{--//--}}
                {{--//                })--}}
                {{--});--}}
                //                $(document).ready(function (){
                //                    $('#search-box').select2({
                //                        ajax: {
                //                            url: '/selectsearch',
                //                            delay: 250,
                //                            processResults: function (data) {
                //                                return{
                //                                    results: data.title
                //                                }
                //                            }
                //                        }
                //                    });
                //
                //                })

            </script>

        </div> <!-- /row -->

    </div> <!-- /container -->
    </div>

@endsection

@section('custom-scripts')
    {{--<script>--}}
    {{--$(document).ready(function() {--}}
    {{--$(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function() { return $(this).height() + 20; })));--}}
    {{--</script>--}}

@endsection