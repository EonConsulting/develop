@extends('layouts.lti')

@section('site-title')
    Profile
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('user-image')
    {{url('/dist/img/user3-128x128.jpg')}}
@endsection

@section('mini-logo-title')
    Profile
@endsection

@section('logo-title')
    Profile
@endsection

@section('page-title')
    Profile
@endsection

@section('content')
    @include('dual.profile', $data)
@endsection

@section('custom-scripts')
    <!-- jvectormap -->
    <script src="{{url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{url('plugins/chartjs/Chart.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('dist/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('dist/js/demo.js')}}"></script>
@endsection