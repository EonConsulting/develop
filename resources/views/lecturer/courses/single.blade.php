@extends('layouts.app')

@section('page-title')
    View Course
@endsection

@section('content')

    <div class="container-fluid" id="app">
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
                    <div class="panel-heading"><strong>Menu</strong></div>
                    <div class="list-group">
                        <a href="{{ route('storyline2.lecturer.edit', $course->id) }}" class="list-group-item">Storyline</a>
                        <a href="{{ route('storyline2.courses.single.notify', $course->id) }}" class="list-group-item">Notify Users</a>
                        <a href="{{ route('courses.single.content', $course->id) }}" class="list-group-item">Content</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('custom-scripts')
    <script src="{{url('/js/app.js')}}"></script>
    <script>
        $(document).ready(function($) {

        });
    </script>
@endsection
