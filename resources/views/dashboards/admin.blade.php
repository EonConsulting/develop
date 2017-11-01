@extends('layouts.app')


@section('page-title')
Administrator Dashboard
@endsection


@section('custom-styles')

<style>

    .progress {
        height: 30px;
    }

    .progress-bar {
        padding-top: 4px;
        font-size: 14px;
        font-weight: 700;
    }

    .btn-cal-key {
        width: 100%;
        font-weight: 700;
    }

    .main-chart {
        border-width: 0px 1px 0px 0px;
        border-style: solid;
        border-color: #DBDBDB;
        background: #FFF;
        
    }

    .progress-charts {
        background: #F9F9F9;
    }
    
    .progress-charts h2 {
        text-align: center;
        font-size: 20px;
        font-weight: 300;
    }

    .progress-charts h3 {
        text-align: center;
        font-size: 16px;
        font-weight: 700;
    }

   /* .timeline {
        padding-right: 280px;
    }

    .timeline-key {
        width: 280px;
        float: right;
    }*/

</style>
@endsection


@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="beta-notice">
                Please note that this site is currently in development and is not complete. Certain features in this website are currently under construction, and they do not represent the final intended functionality. This site is available to allow you to have a look at progress, and to get an idea of where this site is headed.
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    System Analytics
                </div>

                <div class="row sp-top-15 sp-bot-15 basic-clearfix">
                    <!-- iframe src="{{ url("") }}/piwik" height="400" width="400" / -->
                    <iframe src="https://dev.unisaonline.net/piwik/" height="400" width="400" / -->
                </div>
            </div>
        </div>

    </div>
        
    @endsection

    @section('custom-scripts')
    <!-- lodash -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{url('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>


    @endsection
