@extends('ckeditorpluginv2::layouts.master')

@section('custom-styles')
    <link href="{{ url ('vendor/appstore/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
    <script src="{{url('/js/ng.js')}}"></script>

    <style>
        .thumbnail {
            position: relative;
            padding: 0px;
            margin-bottom: 20px;
            padding: 10px;
            min-height: 250px !important;
            max-height: 250px !important;
            overflow: hidden;
        }

        .tool-desc {
            font-size: 11px;
            color: #666;
            height: 50px;
            overflow: hidden
        }

        .tool-title {
            font-weight: bold;
            font-size: 13px;
        }

        .customcol {
            width: 20% !important;
        }

        .custom_form_style {
            width: 100% !important;
            max-width: 100% !important;
            display: inline-block;
            margin: 15px;
        }

        .thumbnail img {
            width: 100%;
            height: auto
        }

        .caption {
            position: relative;
        }

        .block {
            overflow: hidden;
            padding: 10px;
            margin-top: 10px;
            height: auto;
            background-color: #f9f9f9;
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
    <div class="container">

        {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}

        {{--<h1>App Store <a href="{{ route('eon.laravellti.install') }}" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></a></h1><br />--}}
        {{--<p>--}}
        {{--Welcome to the Appstore--}}
        {{--<br />--}}
        {{--</div>--}}
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
                        <h1><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;Apps&nbsp;&nbsp;&nbsp;
                        </h1>
                    </div>
                    <div class="form-group">
                        <input placeholder="Search by name or type" class="form-control" type="text" id="query"
                               ng-model="query"/>
                    </div>
                    <div class="form-group">
                        <select class="form-control" ng-model="orderList">
                            <option value="name">Sort By Title</option>
                            <option value="description">Sort By Type</option>
                            <option value="">Oldest</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" ng-model="categories">
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
                <div ng-repeat="tool in tools | filter:query | orderBy: orderList" class="app-item col-xs-18 customcol col-sm-6 col-md-3" id="app-listjs">
                    <div class="thumbnail">
                        <img ng-src="<% tool.logo_url %>" alt="" class="img img-responsive">
                        <div class="caption">
                            <h4 class="tool-title"><% tool.title %></h4>
                            <p class="tool-desc"><%tool.description %></p>
                        </div>
                        <div class="pull-bottom-left">
                            <p><a data-context="<% tool.context_id %>" class="appitem btn unisa-orange-btn btn-sm" role="button"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Insert Tool</a></p>
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