@extends('layouts.app')


@section('custom-styles')
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/materialize.min.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/economics.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/font-awesome.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/bootstrap-3.3.7.min.css"  media="screen,projection"/>--}}
    {{--<link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/custom.css"  media="screen,projection"/>--}}
    {{--@for($i = 0 ;$i < count($styles); $i++)--}}
    {{--<link type="text/css" rel="stylesheet" href="{{ $styles[$i] }}"/>--}}
    {{--@endfor--}}
    <link rel="stylesheet" href="{{url('/dist/js/jstree/themes/proton/style.min.css')}}" />


    {{--<link type="text/css" rel="stylesheet" href="/plugins/bootstrap-submenu/dist/css/bootstrap-submenu.min.css">--}}

    <style>
        @for($i = 0 ;$i < count($custom_styles); $i++)
            {{ $custom_styles[$i] }}
        @endfor
.dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .child:hover {display:block}

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
        iframe {
            width: 100%;
            height: 100%;
        }

        .dropdown-menu>li>a {
            white-space: normal !important;
        }
        ul li ul {
            display: none;
        }

        ol ol, ol ul, ul ol, ul ul {padding-left: 7px !important;}

        .breadcrumbs {
            list-style: none;
            overflow: hidden;
            margin: 10px;
            padding: 0px;

        }

        .breadcrumbs ul {

        }

        .breadcrumbs li {
            float: left;
        }

        .breadcrumbs li a {
            color: #fb7217;
            text-decoration: none;
            padding: 0px 5px 10px;
            position: relative;
            display: block;
            float: left;
        }

        .breadcrumbs li a:hover {
            color: #333;
        }

        .breadcrumbs li a::after {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            top: 50%;
            margin-top: -50px;
            left: 100%;
            z-index: 2;
        }

        .breadcrumbs li a::before {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            position: absolute;
            top: 50%;
            margin-top: -50px;
            margin-left: 1px;
            left: 100%;
            z-index: 1;
        }
        .breadcrumbs li:first-child a {
            padding-left: 10px;
        }


    </style>
@endsection

@section('menu')
    <div class="">
        <ul class="nav navbar-nav" data-submenu="true;">
                {!! $menu !!}
        </ul>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3">
                <ul class="nav navbar-nav" data-submenu="true;">
                        {!! $menu !!}
                </ul>
            </div>

            <div class="col-md-9">
                <!--breadcrumbs-->
                <ul class="breadcrumbs">

                    <li><a href="{{ route('lti.courses.single.lectures.item', [$course->id, $storyline_item->id])}}">Home</a> &raquo;</li>
                    {!! $catBreadcrumbs !!}
                    <li>&nbsp;&nbsp;{{ $storyline_item->name }}</li>

                </ul>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-3">
                {{--{!!  $nav !!}--}}
                <div id ="navigation">
                    <ul class="course-nav">
                        {!! $navigation !!}
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-9">
                <iframe src="{{'/'}}{{$storyline_item->file_url}}" width="100%" class="composite-embed" id="idIframe" frameBorder="0" style="height: 100%; min-height: 750px;" onload="resizeIframe(this)"></iframe>
                <a href="{{route('lti.courses.single.lectures.item', [$course->id, $previous])}}" class="subtopic-left subtopic-arrow"><i style="font-size: 24px;" class="fa fa-arrow-left"></i></a>
                <a href="{{route('lti.courses.single.lectures.item', [$course->id, $next])}}" class="subtopic-right subtopic-arrow pull-right"><i style="font-size: 24px;" class="fa fa-arrow-right"></i></a>

            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{url('/dist/js/jstree/jstree.min.js')}}"></script>
    {{--<script src='http://cdnjs.cloudflare.com/ajax/libs/velocity/0.2.1/jquery.velocity.min.js'></script>--}}
    {{--<script src="{{url('/js/mtree.js')}}"></script>--}}
    {{--<script>--}}
    {{--$(document).ready(function() {--}}
    {{--var mtree = $('ul.mtree');--}}
    {{--});--}}
    {{--</script>--}}

    {{--<script>--}}
    {{--$('.mtree > li a').click(function() {--}}
    {{--$(this).parent().find('ul').toggle();--}}
    {{--});--}}
    {{--</script>--}}
    <script>
        $(function() {
            $('#navigation').jstree({
                'core': {
                    'themes': {
                        'name': 'proton',
                        'responsive': true
                    }
                }
            });
        })
        jQuery("#navigation").on("click","li.jstree-node a",function(){
            document.location.href = this;
        });
        //Add A Class to Open First Item in Tree
        $('ul.course-nav li:first-child').addClass('jstree-open');
    </script>
    {{--@for($i = 0 ; $i < count($scripts); $i++)--}}
    {{--<script src="{{  $scripts[$i] }}"></script>--}}
    {{--@endfor--}}

    <?php $cs = ''; ?>
    @for($i = 0; $i < count($custom_scripts); $i++)
        <?php $cs .= $custom_scripts[$i]; ?>
    @endfor

    <script>

        window.onload = function() {
            {!! $cs !!}
            $('a.sidebar-toggle').trigger('click');
        };

        $('.dropdown').hover(function(){
            $('.dropdown-toggle', this).trigger('click');
        });

        $(document).on('load', '#idIframe', function() {
            resizeIframe(this);
        });

        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
//            var frames = $(obj).contents().find('iframe');
//            console.log('frames', frames);
//            for(var i = 0; i < frames.length; i++) {
//                console.log(frames[i]);
//                $(frames[i]).on('onload', function() {
//                    resizeIframe(this);
//                });
//            }
        }
        //        $('[data-submenu]').submenupicker();
    </script>
@endsection
