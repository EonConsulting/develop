@extends('layouts.lecturer')

@section('custom-styles')
    <link href="/vendor/appstore/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .thumbnail {
            position: relative;
            padding: 0px;
            margin-bottom: 20px;
            padding:10px;
        }

        .tool-desc {font-size:11px; color:#666; height:50px; overflow:hidden}
        .tool-title {font-weight:bold; font-size: 13px;}
        .customcol {width:20% !important;}
        .custom_form_style {
            width: 100% !important; max-width:100% !important;display: inline-block;
            margin:15px;}

        .thumbnail img {
            width: 100%;
            height: auto
        }

        .caption {
            position: relative;
        }

        .block { overflow: hidden; padding:10px; margin-top:10px; height:auto; background-color:#f9f9f9; }


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

        <div class="row">
            <div class="col-md-12">

                <h1>App Store <a href="{{ route('eon.laravellti.install') }}" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></a></h1><br />
                <p>
                    Welcome to the Appstore
                <br />
            </div>
            <form style="width:100%" action="#" method="get" class="custom_form_style ">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Tool Finder:">
                    <span class="input-group-btn btn-primary">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat btn-primary"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
        </div>

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

            <?php $count = 0; ?>
            @foreach($tools as $tool)
                <div class="col-xs-18 customcol col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{$tool['logo_url']}}" alt="" class="img img-responsive">
                        <div class="caption">
                            <h4 class="tool-title">{!! $tool['title'] !!}</h4>
                            <p class="tool-desc">{!! $tool['description'] !!}</p>
                        </div>
                        <div class="pull-bottom-left">
                            <p><a href="{{ route('eon.laravellti.appstore.launch', $tool['context_id']) }}" class="btn btn-success btn-xs" role="button">View</a> <a href="{{ route('eon.laravellti.delete', $tool['context_id']) }}" class="btn btn-danger btn-xs" role="button">Delete</a></p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="clearfix"></div>

        </div> <!-- /row -->

    </div> <!-- /container -->
@endsection

@section('custom-scripts')
    <script src="/vendor/appstore/js/jquery.min.js"></script>
    {{--<script src="/vendor/appstore/js/bootstrap.min.js"></script>--}}
    <script>

        $(document).ready(function() {
            $(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function() { return $(this).height() + 20; })));
        });

    </script>
@endsection