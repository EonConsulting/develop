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
                    <form action="{{ action('LTI\Courses\CourseLectureLTIController@search') }}">





                        <span style="position: relative;">
                            <label for="search">Search</label>
                        </span>
                        <div class="search-input">
                            <input class="form-control typeahead" name="term">
                        </div>
                        <span style="position: relative;">
                            <a href="" class="btn btn-primary" id="search" value="search">Search</a>
                        </span>


                    </form>
                </div>


                <?php $count = 0; ?>
                @foreach($courses as $course)
                    <div class="course-card shadow">
                        <div class="">
                            <div class="caption">
                                <h1>{!! $course['title'] !!}</h1><br />
                                <p>{!! $course['description'] !!}</p>
                            </div>
                            <div class="btn-course-container">
                                <a href="{{ route('lti.courses.single', $course['id']) }}" class="btn-course btn-course-view" role="button">
                                    <span class="glyphicon glyphicon-blackboard"></span> View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')

    <script src="{{url('js/typeahead.bundle.js')}}"></script>

    {{--Typeahead--}}
    <script>
        $(document).ready(function() {
            $(".typeahead").typeahead({}).on("input", function(e) {
                var termChars = e.target.value;
                if(termChars.length === 3) {
                    var url = '/lti/courses/search/?from=0&size=10&term=' + termChars;
                    setTerm(url);
                }
            });

            function setTerm(url) {
                $("a").prop("href", url);
            }

            var courseSearch = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                rateLimitWait: 1200,
                remote: {
                    url: "{!! url('/lti/courses/search/?term=%QUERY') !!}",
                    prepare: function (query, settings) {
                        settings.url = settings.url.replace('%QUERY', query);
                        return settings;
                    }
                }
            });

            courseSearch.initialize();

            $('.typeahead').typeahead(null, {
                highlight: true,
                minLength: 3,
                name: 'term',
                source: courseSearch,
                display: "title",
                templates: {
                    empty: [
                        '<div class="noitems">',
                            'Nothing to show',
                         '</div>'
                    ].join('\n')/*,
                    pending: "",
                    suggestion: courses.title*/
                }
            });
        });
    </script>
@endsection
