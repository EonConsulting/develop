@extends('layouts.lecturer')

@section('custom-styles')
    <link href="{{ url('/vendor/appstore/css/bootstrap.min.css') }}" rel="stylesheet" />

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

                <h1>{{ $context->title }} </h1><br />
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

            <div class="col-md-12" id="launch_window">
                <?php print($content); ?>
            </div>

            <div class="clearfix"></div>

        </div> <!-- /row -->

    </div> <!-- /container -->
@endsection

@section('custom-scripts')
    <script>
        location.href = "#";
        location.href = "#launch_window";
    </script>
@endsection