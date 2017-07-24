@extends('layouts.lecturer')

@section('site-title')
    Notify users about <strong>{{ $course->title }}</strong>
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('mini-logo-title')
    Unisa
@endsection

@section('logo-title')
    Unisa
@endsection

@section('page-title')
    Notify users about <strong>{{ $course->title }}</strong>
@endsection

@section('content')
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
    <course-notify-users :courseid="{{ $course->id }}"></course-notify-users>
@endsection

@section('app-js')
    <script src="{{url('/js/app.js')}}"></script>
@endsection

@section('custom-scripts')
    <script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
@endsection