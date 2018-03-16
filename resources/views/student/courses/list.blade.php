@extends('layouts.app')
@section('custom-styles')
<style>

    .course-card {
        background: #FFF;
        max-width: 1120px;
        margin-bottom: 15px;
        padding: 10px;
    }

    .course-card h1 {
        display: block;
        font-size: 16px;
        color: #fb7217;

        border-color: #fb7217;
        border-style: solid;
        border-width: 0px 0px 1px 0px;

        margin-top: -10px;
        margin-bottom: 5px;
        margin-left: -10px;
        margin-right: -10px;

        padding: 10px;
    }

    .course-card p {
        font-size: 12px;
    }


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

                <form id="search-form" action="{{ route('lti.courses') }}" method="get">
                    <div class="search-input">
                        <input class="form-control" name="searchterm" id="searchterm">
                    </div>
                    <span style="position: relative;">
                        <button type="submit" class="btn btn-primary" id="btnSearch">Search</button>
                        <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                    </span>

                </form>
            </div>

            <div>
                @if($errors->any())
                <h2>{{$errors->first()}}</h2><br />
                @endif
            </div>

            @forelse($courses as $course)
                <div class="course-card shadow">
                    <div class="caption">
                        <h1>
                            {!! $course->title !!}

                            @if($course->has_sl)
                            <a href="{{ route('storyline2.student.single', $course->id) }}" class="pull-right" role="button" style="margin-right: 20px;">
                                <i class="fa fa-eye"></i> View
                            </a>
                            @endif
                        </h1>

                        <p>
                            @if($course->description !== null)
                                {{ $course->description }}
                            @else
                                <i>No description.</i>
                            @endif
                        </p>
                        <p>
                            @if($course->tags !== "" && $course->tags !== null)
                                @foreach(explode(',',$course->tags) as $tag)
                                    <span class="label label-default">{{ $tag }}</span>
                                @endforeach
                            @else
                                <i>No tags.</i>
                            @endif
                        </p>
                    </div>
                </div>

            @empty
                <div>No results found</div>
            @endforelse

            <div>
                {{ $paginate->links() }}
            </div>

        </div>
    </div>
</div>

@endsection

@section('custom-scripts')

<script src="{{url('js/analytics/tincan.js')}}"></script>

<script>

$(document).ready(function () {
    // 2017-11-01 MH just temporarily commented this out
    // cause it was screwing up the DEMO - thanks a ton Dario you shit!
    //
    // 2017-11-20 After wanting to hunt Dario down and shoot
    // him in the face with a paintball gun, MH fixed this........forever

    function logXAPISearchEvent(searchParam) {
        //Log search
        var lrs;

        try {
            lrs = new TinCan.LRS(
                    {
                        endpoint: "{!! url('analytics/log') !!}",
                        username: "{{ auth()->user()->name }}",
                        password: null,
                        allowFail: false
                    }
            );
        } catch (ex) {
            console.log("Failed to setup LRS XAPI object: ", ex);
        }

        var statement = new TinCan.Statement(
                {
                    actor: {
                        mbox: "{{ auth()->user()->email }}"
                    },
                    verb: {
                        id: "http://unisaonline.net/schema/1.0/search"
                    },
                    target: {
                        id: "{!! url('/lti/courses/search') !!}"
                    },
                    context: {
                        extensions: {
                            searchterm: searchParam
                        }
                    }
                }
        );

        lrs.saveStatement(
                statement,
                {
                    callback: function (err, xhr) {
                        if (err !== null) {
                            if (xhr !== null) {
                                console.log("Failed to save statement: " + xhr.responseText + " (" + xhr.status + ")");
                                // TODO: do something with error, didn't save statement
                                return;
                            }

                            console.log("Failed to save statement: " + err);
                            // TODO: do something with error, didn't save statement
                            return;
                        }

                        console.log("Statement saved");
                        // TOOO: do something with success (possibly ignore)
                    }
                }
        );
    }


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
        // this ensures that we only log valid searches
        logXAPISearchEvent(searchParam);
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

    $(document).on('click', '.print-pdf', function(e){
        e.preventDefault();
        var courseId = $(this).attr('id');
        var link = "{{ url("") }}/module/print/"+courseId;
        var win = window.open(link, '_blank','width=1000, height=700, left=14, top=14, scrollbars, resizable');
    });
});
</script>
@endsection
