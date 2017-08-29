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


        /*Styles for Typeahead*/
        html {
            overflow-y: scroll;
        }
        .container {
            margin: 0 auto;
            max-width: 750px;
            text-align: center;
        }
        .tt-dropdown-menu, .gist {
            text-align: left;
        }
        html {
            color: #333333;
            font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 18px;
            line-height: 1.2;
        }
        .title, .example-name {
            font-family: Prociono;
        }
        p {
            margin: 0 0 10px;
        }
        .title {
            font-size: 64px;
            margin: 20px 0 0;
        }
        .example {
            padding: 30px 0;
        }
        .example-name {
            font-size: 32px;
            margin: 20px 0;
        }
        .demo {
            margin: 50px 0;
            position: relative;
        }
        .typeahead, .tt-query, .tt-hint {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 30px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
        }
        .typeahead {
            background-color: #FFFFFF;
        }
        .typeahead:focus {
            border: 2px solid #0097CF;
        }
        .tt-query {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        }
        .tt-hint {
            color: #999999;
        }
        .tt-dropdown-menu {
            background-color: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-top: 12px;
            padding: 8px 0;
            width: 422px;
        }
        .tt-suggestion {
            font-size: 18px;
            line-height: 24px;
            padding: 3px 20px;
        }
        .tt-suggestion.tt-cursor {
            background-color: #0097CF;
            color: #FFFFFF;
        }
        .tt-suggestion p {
            margin: 0;
        }
        .gist {
            font-size: 14px;
        }
        .example-twitter-oss .tt-suggestion {
            padding: 8px 20px;
        }
        .example-twitter-oss .tt-suggestion + .tt-suggestion {
            border-top: 1px solid #CCCCCC;
        }
        .example-twitter-oss .repo-language {
            float: right;
            font-style: italic;
        }
        .example-twitter-oss .repo-name {
            font-weight: bold;
        }
        .example-twitter-oss .repo-description {
            font-size: 14px;
        }
        .example-sports .league-name {
            border-bottom: 1px solid #CCCCCC;
            margin: 0 20px 5px;
            padding: 3px 0;
        }
        .example-arabic .tt-dropdown-menu {
            text-align: right;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container" style="margin-left:72px; margin-bottom: 20px">
                    <form class="search" action="{{ action('LTI\Courses\CourseLectureLTIController@search') }}">
                        <label for="search">Search</label> <span class=twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
                            <input class="typeahead" name="term"></span>
                            <a href="" class="btn btn-primary" id="search" value="search">Search</a>
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
    <!-- jvectormap -->
    <script src="{{url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{url('plugins/chartjs/Chart.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{--<script src="{{url('dist/js/pages/dashboard2.js')}}"></script>--}}
    <script src="{{url('js/typeahead.bundle.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('dist/js/demo.js')}}"></script>

    {{--Typeahead--}}
    <script>
        $(document).ready(function() {
            $(".typeahead").typeahead({}).on("input", function(e) {
                var termChars = e.target.value;
                if(termChars.length === 3) {
                    var url = "/lti/courses/search/?from=0&size=10&term=" + termChars;
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
                    url: '/lti/courses/search/?term=%QUERY',
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