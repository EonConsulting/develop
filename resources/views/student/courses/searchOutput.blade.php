{{--
  Created by PhpStorm.
  User: Dario.Alfredo
  Date: 8/23/2017
  Time: 10:27 AM
--}}
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container" style="margin-left:72px; margin-bottom: 20px">
                    <form class="search" action="{{ action('LTI\Courses\CourseLectureLTIController@search') }}">
                        <label for="search">Search</label> <span class=twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
                            <input class="typeahead" name="term"></span>
                            <a href="#" class="btn btn-primary" id="search" value="search">Search</a>
                    </form>
                </div>

                @foreach($finalOutput as $output)
                    <div class="course-card shadow">
                        <div class="">
                            <div class="caption">
                                <h1>{!! $output['title'] !!}</h1><br />
                                <p>{!! $output['description'] !!}</p>
                            </div>
                            <div class="btn-course-container"></div>
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
