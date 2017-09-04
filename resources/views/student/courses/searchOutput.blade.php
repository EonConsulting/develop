{{--
  User: Dario.Alfredo
  Date: 8/23/2017
  Time: 10:27 AM
--}}
@extends('layouts.app')

@section('custom-styles')

    <style>
        .search-input {
            position: relative;
            display: inline-block;
            height: 36px;
            width: 300px;
        }

        .course-card {
            background: #FFF;
            width: 300px;
            float: left;
            margin-right: 20px;
            margin-bottom: 20px;
            padding: 15px;
            height: 280px;
            position: relative;
        }

        .course-card h1 {
            display: block;
            background: #fb7217;
            font-size: 18px;
            line-height: 24px;
            color: #FFF;
            margin-top: -15px;
            margin-bottom: 5px;
            margin-left: -15px;
            margin-right: -15px;
            padding: 15px;
            height: 80px;
        }

        .course-card p {
            font-size: 12px;
        }

        .btn-course-container {margin: 0px -15px 0px -15px; background: #fcfcfc; position: absolute; bottom: 0; width: 100%; border-width: 1px 0px 0px 0px; border-style: solid; border-color: #e2e2e2;}

        .btn-course {padding: 15px 0px 15px 15px; color: #7d7d7d; font-size: 20px;}

        .btn-course-view {float: left;}

        .btn-course-delete {padding: 15px 15px 15px 0px; float: right; color: #dd4b39;}
    </style>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid" style="margin-bottom: 20px">
                    <form class="search" action="{{ action('LTI\Courses\CourseLectureLTIController@search') }}">

                        <span>
                            <label style="font-weight: 300; font-size: 20px;" for="search">Search</label>
                        </span>
                        <span class="search-input">
                            <input class="form-control typeahead" name="term">
                        </span>
                        <span>
                            <a href="" class="btn btn-primary" id="search">Search</a>
                        </span>
                    </form>
                </div>

                @foreach($finalOutput as $output)
                    <div class="course-card shadow">
                        <div class="">
                            <div class="caption">
                                <h1>{!! $output['title'] !!}</h1><br />
                                <p>{!! $output['description'] !!}</p>
                            </div>
                            <div class="btn-course-container">
                                <a href="{{ route('lti.courses.single', $output['id']) }}" class="btn-course btn-course-view" role="button">
                                    <span class="glyphicon glyphicon-blackboard"></span> View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <ul class="pager">
                @if ($output['fromPrev'] >= 0)
                    <li><a id="p" href="{{ url('/lti/courses/search/?from='.$output['fromPrev'].'&size='.$output['size'].'&term='.$output['term']) }}">Previous</a></li>
                @endif

                @if ($output['fromNext'] < $output['total'])
                        <li><a id="n" href="{{ url('/lti/courses/search/?from='.$output['fromNext'].'&size='.$output['size'].'&term='.$output['term']) }}">Next</a></li>
                @endif

            </ul>
        </div>
    </div>
@endsection
