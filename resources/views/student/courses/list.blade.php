@extends('layouts.app')
@section('custom-styles')
<style>

    .course-card {
        background: #FFF;
        width: 300px;
        float: left;
        margin-right: 20px;
        margin-bottom: 20px;
        padding: 15px;
        height: 280px;
        position: relative;
        overflow: hidden;
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


    /*
     *Type Ahead
     */

    .tt-menu {
        background: #FFF;
        padding: 10px;
    }

    .search-area {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .search-area label {
        font-weight: 300;
        font-size: 20px;
    }

    .search-input {
        position: relative;
        display: inline-block;
        height: 36px;
        width: 300px;
    }

    .twitter-typeahead {
        padding-top: 14px;
        width: 300px;
    }

    .typeahead {

    }

    .tt-input {

    }

    .tt-hint {

    }

</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="search-area">

                <form id="search-form">
                    <div class="search-input">
                        <input class="form-control" name="searchterm" id="searchterm">
                    </div>
                    <span style="position: relative;">
                        <button type="button" class="btn btn-primary" id="btnSearch">Search</button>
                        <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                    </span>
                </form>
            </div>

            <div>
                @if($errors->any())
                <h2>{{$errors->first()}}</h2><br />
                @endif
            </div>

            @isset($searchResults)
            @isset($searchResults['results'])
            @foreach($searchResults['results'] as $course)
            <div class="course-card shadow">
                <div class="">
                    <div class="caption">
                        <h1>{!! $course['title'] !!}</h1><br />
                        <p>{!! $course['description'] !!}</p>
                    </div>
                    <div class="btn-course-container">
                        <a href="{{ route('lti.courses.single', $course['id']) }}" class="btn-course btn-course-view" role="button">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset

            @empty($searchResults['results'])
            <div>No results found</div>
            @endempty
            @endisset
        </div>
    </div>
</div>

@endsection

@section('custom-scripts')

<script src="{{url('js/analytics/tincan.js')}}"></script>

<script>

$(document).ready(function () {
    // just temporarily commented this out
    // cause it was screwing up the DEMO - thanks a ton Dario you shit!

    function logEvents() {
        //Log search
        var tincan = new TinCan(
                {
                    recordStores: [
                        {
                            endpoint: "{!! url('analytics/log') !!}",
                            username: "{{ auth()->user()->name }}",
                            password: null,
                            allowFail: false
                        }
                    ]
                }
        );
        tincan.sendStatement(
                {
                    actor: {
                        mbox: "{{ auth()->user()->email }}"
                    },
                    verb: {
                        id: "http://activitystrea.ms/schema/1.0/search"
                    },
                    target: {
                        id: "{!! url('/lti/courses/search') !!}"
                    }
                }
        );
    }
    ;

    // set the search term in the search bar on load
    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }

    var searchParam = GetURLParameter("searchterm");
    if (searchParam)
    {
        $("#searchterm").val(searchParam);
    }

    $("#searchterm").keypress(function (e) {
        if (e.which === 13) {
            var sValue = $(this).val();
            if (sValue.length >= 3) {
                window.location.href = "{!! url('/lti/courses?from=0&size=10&searchterm=') !!}" + sValue;
            }
        }
    });

    $("#btnSearch").on("click", function () {
        var sValue = $("#searchterm").val();
        if (sValue.length >= 3) {
            window.location.href = "{!! url('/lti/courses?from=0&size=10&searchterm=') !!}" + sValue;
        }
    });

    $("#btnReset").on("click", function () {
        window.location.href = "{!! url('/lti/courses') !!}";
    });
});
</script>
@endsection
