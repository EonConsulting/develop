@extends('layouts.lecturer')

@section('site-title')
    Modules
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
    Modules
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $course->title }}</div>
                    <div class="panel-body">
                        {{ $course->description }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu</div>
                    <div class="list-group">
                        <a href="{{ route('courses.single.storyline', $course->id) }}" class="list-group-item">Storyline</a>
                        <a href="{{ route('courses.single.notify', $course->id) }}" class="list-group-item">Notify Users</a>
                        <a href="{{ route('courses.single.content', $course->id) }}" class="list-group-item">Content</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('app-js')
    <script src="{{url('/js/app.js')}}"></script>
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function($) {

        });
    </script>
@endsection