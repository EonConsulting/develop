@extends('layouts.app')

@section('page-title')
    Create a Course
@endsection

@section('content')

<div id="app">
    <create-course></create-course>
</div>

@endsection

@section('custom-scripts')
    <script src="{{url('/js/app.js')}}"></script>
    <!--<script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>-->
@endsection
