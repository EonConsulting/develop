@extends('ckeditorpluginv2::layouts.master')

@section('custom-styles')
    <link href="{{ url ('/css/app.css')}}" rel="stylesheet"/>
    <link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
    <script src="{{url('/js/ng.js')}}"></script>

    <style>

    .cke_dialog_contents_body {margin: 0px; padding: 0px; background: #f1f1f1}

    .header {}

    .filters {width: 180px; float: left;}
    .filters h1 {font-size: 20px; color: #c2c2c2;}

    .applist {margin-left: 180px; padding: 0px 10px 0px 10px;}

    .install-button {width: 180px; float: left;}
    .btn-install {width: 100%; margin: 0px 10px 0px 10px;}

    .search-bar {padding: 0px 10px 0px 10px;}
    .search-bar input[type=text] {outline: none; border-radius: 0px; border-width: 0px 0px 1px 0px; border-color: #e6e6e6; border-style: solid;}
    .search-bar input[type=text]:focus {outline: none; border-color: #fb7217;}

    .form-control {box-shadow: none; transition: none;}
    .form-control:focus {box-shadow: none;}

    .app-entry {width: 200px; margin: 0px 20px 20px 0px; padding: 10px; background: #FFF; height: 300px; position:relative; border-style: solid; border-width: 1px; border-color: #e0e0e0;}

    .tool-desc {font-size: 11px; color: #666; overflow: hidden}

    .tool-title {font-weight: 700; font-size: 13px; color: #c2c2c2;}

    .custom_form_style {width: 100% !important; max-width: 100% !important; display: inline-block; margin: 15px;}

    .app-logo{height: 100px; position: relative; top: 50%; left: 50%;}

    .app-entry img {max-height: 100px; position: absolute; top: 50%; transform: translateY(-50%) translateX(-50%);}

    .btn-entry-container {margin: 0px -10px 0px -10px; background: #fcfcfc; position: absolute; bottom: 0; width: 100%; border-width: 1px 0px 0px 0px; border-style: solid; border-color: #e2e2e2;}

    .btn-entry {padding: 15px 0px 15px 15px; color: #7d7d7d; font-size: 20px;}

    .btn-entry-view {float: left;}

    .btn-entry-delete {padding: 15px 15px 15px 0px; float: right; color: #dd4b39;}

    .caption {position: relative;}

    .block {overflow: hidden; padding: 10px; margin-top: 10px; height: auto; background-color: #f9f9f9;}

    @media (min-width: 768px ) {
        .row {position: relative;}
        .pull-bottom-left {position: absolute; bottom: 0px; left: 10px;}
    }

        @media (min-width: 768px ) {
            .row {
                position: relative;
            }

            .pull-bottom-left {
                position: absolute;
                bottom: 0px;
                left: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

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
            <div class="col-md-12">
                <h3>Insert an App</h3>
            </div>
            <div id="tools" ng-app="tools" ng-controller="ToolsListCtrl">
                <div class="col-md-12">
                    <header class="header basic-clearfix">

                        <div class="row">
                            <div class="search-bar">
                                <div class="form-group">
                                    <input placeholder="Search by name or type" class="form-control" type="text" id="query" ng-model="query"/>
                                </div>
                            </div>

                        </div>
                    </header>
                </div>


                <div class="filters">
                    <h1>Sort</h1>
                    <div class="form-group">
                        <!--<select class="form-control" ng-model="orderList">
                            <option value="name">Sort By Title</option>
                            <option value="description">Sort By Type</option>
                            <option value="">Oldest</option>
                        </select>-->
                        <div class="radio">
                            <input id="radio1" name="sort" type="radio" value="name" ng-model="orderList">
                            <label for="radio1">
                                Sort by Title
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio2" name="sort" type="radio" value="description" ng-model="orderList">
                            <label for="radio2">
                                Sort By Type
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio3" name="sort" type="radio" value="oldest" ng-model="orderList">
                            <label for="radio3">
                                Oldest
                            </label>
                        </div>

                    </div>
                    <hr>

                    <h1>Categories</h1>
                    <div class="form-group">

                        <div class="radio">
                            <input id="radio4" name="category" type="radio" value="all" ng-model="category">
                            <label for="radio4">
                                All Categories
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio5" name="category" type="radio" value="community" ng-model="category">
                            <label for="radio5">
                                Community
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio6" name="category" type="radio" value="content" ng-model="category">
                            <label for="radio6">
                                Content
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio7" name="category" type="radio" value="math" ng-model="category">
                            <label for="radio7">
                                Math
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio8" name="category" type="radio" value="media" ng-model="category">
                            <label for="radio8">
                                Media
                            </label>
                        </div>

                        <div class="radio">
                            <input id="radio9" name="category" type="radio" value="open_access" ng-model="category">
                            <label for="radio9">
                                Open Access
                            </label>
                        </div>

                    </div>

                </div>



            <div class="applist">
                <p><span>Results: <% tools.length %></span></p>
                <div ng-repeat="tool in tools | filter:query | orderBy: orderList" class="app-entry shadow pull-left">
                    <div>
                        <div class="app-logo">
                            <img src="<% tool.logo_url %>" alt="" class="img img-responsive">
                        </div>
                        <div class="caption">
                            <h4 class="tool-title"><% tool.title %></h4>
                            <p class="tool-desc"><% tool.description %></p>
                        </div>
                        <div>
                            <div class="btn-entry-container basic-clearfix">
                                <a data-context="<% tool.context_id %>" class="appitem btn-entry btn-entry-view" role="button" title="Insert">
                                    <span class="glyphicon glyphicon-open"></span> Insert
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
            <div class="clearfix"></div>

        </div> <!-- /row -->

    </div> <!-- /container -->
@endsection

@section('custom-scripts')
    {{--<script src="/vendor/appstore/js/jquery.min.js"></script>--}}
    {{--<script src="/vendor/appstore/js/bootstrap.min.js"></script>--}}
    <script>

        $(document).ready(function () {
            $(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function () {
                return $(this).height() + 20;
            })));
        });

    </script>
@endsection
