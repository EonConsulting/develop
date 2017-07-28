@extends('layouts.app')


@section('custom-styles')

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
    <div id="app">
        <course-notify-users :courseid="{{ $course->id }}"></course-notify-users>
    </div>

@endsection


@section('custom-scripts')
    <script src="{{url('/js/app.js')}}"></script>
    <script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
@endsection
