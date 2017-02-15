@extends('layouts.app')

@section('custom-styles')
    <link href="/vendor/appstore/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .thumbnail {
            position: relative;
            padding: 0px;
            margin-bottom: 20px;
        }

        .thumbnail img {
            width: 100%;
            height: 156px;
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
                    Curabitur blandit tempus porttitor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue.
                </p>
                <p>
                    Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Maecenas faucibus mollis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
                </p>
                <br />
            </div>
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
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{!! (is_string($tool['icon']) && $tool['icon'] == '') ? 'http://placehold.it/500x300' : $tool['icon'] !!}" alt="" class="img">
                        <div class="caption">
                            <h4>{!! $tool['title'] !!}</h4>
                            <p>{!! $tool['description'] !!}</p>
                        </div>
                        <div class="pull-bottom-left">
                            <p><a href="{{ route('eon.laravellti.appstore.launch', $tool['context_id']) }}" class="btn btn-success btn-xs" role="button">View</a> <!-- <a href="#" class="btn btn-success btn-xs" role="button">Activate</a> --></p>
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