@extends('layouts.lti')

@section('site-title')
    Modules
@endsection

@section('custom-styles')
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/materialize.min.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/economics.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/font-awesome.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/bootstrap-3.3.7.min.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/custom.css"  media="screen,projection"/>--}}
    @for($i = 0 ;$i < count($styles); $i++)
        <link type="text/css" rel="stylesheet" href="{{ $styles[$i] }}"/>
    @endfor

    {{--<link type="text/css" rel="stylesheet" href="/plugins/bootstrap-submenu/dist/css/bootstrap-submenu.min.css">--}}

    <style>
        @for($i = 0 ;$i < count($custom_styles); $i++)
            {{ $custom_styles[$i] }}
        @endfor

        .dropdown-submenu{position:relative;}
        .dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
        .dropdown-submenu:hover>.dropdown-menu{display:block;}
        .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
        .dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
        .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
        .heading2 {font-family: "OpenSans";}
    </style>
@endsection

@section('menu')
    <div class="">
        <ul class="nav navbar-nav" data-submenu="true;">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                </a>
                {!! $menu !!}
            </li>
        </ul>
    </div>
@endsection

@section('body-class')

@endsection

@section('user-image')
    {{url('/dist/img/user3-128x128.jpg')}}
@endsection

@section('mini-logo-title')
    Modules
@endsection

@section('logo-title')
    Modules
@endsection

@section('page-title')
    Modules
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {!! $nav !!}
                <div class="clearfix"></div>
            </div>
            <div class="col-md-9">

            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    {{--<script src="/plugins/bootstrap-submenu/dist/js/bootstrap-submenu.min.js"></script>--}}
    @for($i = 0 ; $i < count($scripts); $i++)
        <script src="{{  $scripts[$i] }}"></script>
    @endfor

    <?php $cs = ''; ?>
    @for($i = 0; $i < count($custom_scripts); $i++)
        <?php $cs .= $custom_scripts[$i]; ?>
    @endfor

    <script>
        window.onload = function() {
            {!! $cs !!}
        };

        $('.dropdown').hover(function(){
            $('.dropdown-toggle', this).trigger('click');
        });

//        $('[data-submenu]').submenupicker();
    </script>
@endsection
