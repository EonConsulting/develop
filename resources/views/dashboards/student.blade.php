@extends('layouts.app')


@section('page-title')
Student Dashboard
@endsection


@section('custom-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />

<style>

    .progress {
        height: 30px;
    }

    .progress-bar {
        padding-top: 4px;
        font-size: 14px;
        font-weight: 700;
    }

    .btn-cal-key {
        width: 100%;
        font-weight: 700;
    }

</style>
@endsection


@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="beta-notice">
                Please note that this site is currently in development and is not complete. Certain features in this website are currently under construction, and they do not represent the final intended functionality. This site is available to allow you to have a look at progress, and to get an idea of where this site is headed.
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Course Results
                </div>

                <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                    <div class="col-md-4">
                        <div class="container-fluid">
                            <h3>Filters</h3>
                            <label for="course-filter">Module</label>
                            <select class="form-control" id="course-filter">
                                <option value="FBN1501">FBN1501 - Business Numerical Skills A</option>
                                <option value="FBN1502">FBN1502 - Business Numerical Skills B</option>
                            </select>
                            <br>
                            <label for="assessment-filter">Assessment</label>
                            <select class="form-control" id="assessment-filter">
                                <option value="SA">Summative Assessment</option>
                                <option value="FA">Formative Assessment</option>
                            </select>
                            <br>
                            <label for="assessment-type-filter">Assessment Type</label>
                            <select class="form-control" id="assessment-type-filter">
                            </select>
                        </div>
                    </div> <!-- end col-md-4 -->

                    <div class="col-md-8">
                        <h3>Results</h3>
                        <div class="container-fluid" id="student-results-container" style="height: 300px;">
                            <canvas id="student-results"></canvas>
                        </div>
                    </div><!-- end col-md-8 -->

                </div>


            </div>
        </div>

    </div>
    
    <div class="row">

        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Course Progression
                </div>

                <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                    <div class="col-md-3">
                        <h3>Videos</h3>
                        <div class="container-fluid" id="video-progression-container" style="height: 300px;">
                            <canvas id="video-progression"></canvas>
                        </div>
                    </div> <!-- end col-md-4 -->

                    <div class="col-md-3">
                        <h3>E-Books</h3>
                        <div class="container-fluid" id="ebook-progression-container" style="height: 300px;">
                            <canvas id="ebook-progression"></canvas>
                        </div>
                    </div><!-- end col-md-8 -->
                    
                    <div class="col-md-3">
                        <h3>Articles</h3>
                        <div class="container-fluid" id="article-progression-container" style="height: 300px;">
                            <canvas id="article-progression"></canvas>
                        </div>
                    </div><!-- end col-md-8 -->
                    
                    <div class="col-md-3">
                        <h3>Study Guide</h3>
                        <div class="container-fluid" id="study-guide-progression-container" style="height: 300px;">
                            <canvas id="study-guide-progression"></canvas>
                        </div>
                    </div><!-- end col-md-8 -->

                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 sp-top-15 sp-bot-15 basic-clearfix">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

                <div class="dashboard-card-heading">
                    Timeline
                </div>

                <div class="row basic-clearfix sp-top-15 sp-bot-15">
                    <div class="container-fluid">
                        <div class="col-md-10">
                            <div id="student-timeline"></div>
                        </div>


                        <div class="col-md-2">
                            <h4>Timeline Key</h3>
                                <div>
                                    <p><div class="btn btn-success btn-cal-key">Formal Assessment</div></p>
                                    <p><div class="btn btn-warning btn-cal-key">Assignment</div></p>
                                    <p><div class="btn btn-danger btn-cal-key">Exam</div></p>
                                    <p><div class="btn btn-info btn-cal-key">Self Assessment</div></p>
                                    <p><div class="btn btn-primary btn-cal-key">Other</div></p>
                                </div>
                        </div>
                    </div>
                </div> <!--end row>


            </div> <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->

        <div class="clearfix"></div>

    </div>

    @endsection

    @section('custom-scripts')
    <!-- lodash -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{url('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <!-- Student timeline -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script type="text/javascript">
    //--------------------------
    //-STUDENT TIMELINE CODE--------
    //--------------------------
    $(document).ready(function () {
    $('#student-timeline').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        height: 500,
        defaultDate: '2018-08-12',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'FBN101 Test',
                start: '2018-08-01',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'New Student Welcome',
                start: '2018-08-07',
                end: '2018-08-10'
            },
            {
                id: 999,
                title: 'FBN102 Exam',
                start: '2018-08-09T16:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-08-16T16:00:00'
            },
            {
                title: 'Student Conference',
                start: '2018-08-11',
                end: '2018-08-13'
            },
            {
                title: 'Meeting',
                start: '2018-08-12T10:30:00',
                end: '2018-08-12T12:30:00',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'FBN101 Exam',
                start: '2018-08-12T12:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                title: 'FNB104 Test',
                start: '2018-08-12T14:30:00'
            },
            {
                title: 'FBN105 Test',
                start: '2018-08-12T17:30:00'
            },
            {
                title: 'FBN103 Exam',
                start: '2018-08-12T20:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                title: 'FBN102 Test',
                start: '2018-08-13T07:00:00',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'MyUnisa',
                url: 'http://unisa.ac.za/',
                start: '2018-08-28'
            }
        ]
    });
});
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //--------------------------
            //-STUDENT DATASET--------
            //--------------------------

            var courses = [
                {
                    "course_id": "FBN1501",
                    "description": "FBN1501 - Business Numerical Skills A"
                },
                {
                    "course_id": "FBN1502",
                    "description": "FBN1502 - Business Numerical Skills B"
                }
            ];

            var assessment_types = [
                {
                    "assessment_type_id": "SA-ALL",
                    "assessment": "SA",
                    "description": "ALL"
                },
                {
                    "assessment_type_id": "SA-MCQ",
                    "assessment": "SA",
                    "description": "MCQ"
                },
                {
                    "assessment_type_id": "SA-VEN",
                    "assessment": "SA",
                    "description": "Venue Based"
                },
                {
                    "assessment_type_id": "SA-POR",
                    "assessment": "SA",
                    "description": "Portfolio"
                },
                {
                    "assessment_type_id": "FA-ALL",
                    "assessment": "FA",
                    "description": "ALL"
                },
                {
                    "assessment_type_id": "FA-ASS1",
                    "assessment": "FA",
                    "description": "Assignment 1"
                },
                {
                    "assessment_type_id": "FA-ASS2",
                    "assessment": "FA",
                    "description": "Assignment 2"
                },
                {
                    "assessment_type_id": "FA-POR",
                    "assessment": "FA",
                    "description": "Portfolio"
                },
                {
                    "assessment_type_id": "FA-SA1",
                    "assessment": "FA",
                    "description": "Self-Assessment 1"
                },
                {
                    "assessment_type_id": "FA-SA2",
                    "assessment": "FA",
                    "description": "Self-Assessment 2"
                }
            ];

            var progression = [
                {
                    "course_id": "FBN1501",
                    "progress": {
                        "videos": {
                            "class_progress": [35],
                            "my_progress": [22],
                            "course_timeline": [32]
                        },
                        "ebooks": {
                            "class_progress": [45],
                            "my_progress": [52],
                            "course_timeline": [42]
                        },
                        "articles": {
                            "class_progress": [65],
                            "my_progress": [67],
                            "course_timeline": [60]
                        },
                        "study_guide": {
                            "class_progress": [44],
                            "my_progress": [55],
                            "course_timeline": [45]
                        }
                    }
                },
                {
                    "course_id": "FBN1502",
                    "progress": {
                        "videos": {
                            "class_progress": [22],
                            "my_progress": [32],
                            "course_timeline": [46]
                        },
                        "ebooks": {
                            "class_progress": [33],
                            "my_progress": [29],
                            "course_timeline": [45]
                        },
                        "articles": {
                            "class_progress": [51],
                            "my_progress": [39],
                            "course_timeline": [36]
                        },
                        "study_guide": {
                            "class_progress": [49],
                            "my_progress": [39],
                            "course_timeline": [51]
                        }
                    }
                }
            ];

            var results = [
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "labels": [],
                    "your_results": [55, 49, 65, 80, 56, 45, 0, 0, 0, 0, 0, 0],
                    "class_average": [52, 73, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [57, 49.67, 69.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "labels": [],
                    "your_results": [85, 59, 65, 60, 56, 45, 0, 0, 0, 0, 0, 0],
                    "class_average": [82, 63, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [87, 59.67, 59.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "labels": [],
                    "your_results": [0, 0, 0, 0, 0, 0, 71, 59, 76, 62, 63, 62],
                    "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 70],
                    "your_average": [0, 0, 0, 0, 0, 0, 58.75, 60.67, 60.80, 61, 61.08, 52.5]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "labels": [],
                    "your_results": [0, 0, 0, 0, 0, 0, 51, 59, 76, 62, 63, 62],
                    "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 70],
                    "your_average": [0, 0, 0, 0, 0, 0, 48.75, 60.67, 60.80, 61, 61.08, 72.1]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-MCQ",
                    "labels": ["MCQ1", "MCQ2", "MCQ3", "MCQ4", "MCQ5", "MCQ6"],
                    "your_results": [80, 56, 45, 51, 59, 76],
                    "class_average": [65, 59, 65, 60, 75, 58],
                    "your_average": [60, 76, 75, 71, 79, 76]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-MCQ",
                    "labels": ["MCQ7", "MCQ8", "MCQ9", "MCQ10", "MCQ11", "MCQ12"],
                    "your_results": [60, 62, 55, 71, 59, 76],
                    "class_average": [55, 61, 54, 50, 75, 58],
                    "your_average": [50, 72, 45, 71, 79, 76]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-VEN",
                    "labels": ["VEN1", "VEN2"],
                    "your_results": [59, 76],
                    "class_average": [75, 58],
                    "your_average": [79, 76]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-VEN",
                    "labels": ["VEN3", "VEN4"],
                    "your_results": [60, 62],
                    "class_average": [55, 61],
                    "your_average": [50, 72]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-POR",
                    "labels": ["POR1", "POR2", "POR3", "POR4"],
                    "your_results": [80, 56, 45, 51],
                    "class_average": [65, 59, 65, 60],
                    "your_average": [60, 76, 75, 71]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-POR",
                    "labels": ["POR5", "POR6", "POR7", "POR8"],
                    "your_results": [51, 50, 80, 64],
                    "class_average": [78, 65, 74, 52],
                    "your_average": [45, 71, 79, 76]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ASS1",
                    "labels": ["Result"],
                    "your_results": [80],
                    "class_average": [65],
                    "your_average": [60]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ASS1",
                    "labels": ["Result"],
                    "your_results": [58],
                    "class_average": [84],
                    "your_average": [72]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ASS2",
                    "labels": ["Result"],
                    "your_results": [60],
                    "class_average": [75],
                    "your_average": [60]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ASS2",
                    "labels": ["Result"],
                    "your_results": [79],
                    "class_average": [65],
                    "your_average": [72]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-POR",
                    "labels": ["Result"],
                    "your_results": [65],
                    "class_average": [73],
                    "your_average": [69]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-POR",
                    "labels": ["Result"],
                    "your_results": [73],
                    "class_average": [85],
                    "your_average": [72]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-SA1",
                    "labels": ["Result"],
                    "your_results": [55],
                    "class_average": [76],
                    "your_average": [61]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-SA1",
                    "labels": ["Result"],
                    "your_results": [63],
                    "class_average": [75],
                    "your_average": [65]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-SA2",
                    "labels": ["Result"],
                    "your_results": [65],
                    "class_average": [64],
                    "your_average": [69]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-SA2",
                    "labels": ["Result"],
                    "your_results": [61],
                    "class_average": [70],
                    "your_average": [85]
                }
            ];
            // bind some events so that we
            // can simulate remote data store
            // bind some events so that we
            // can simulate remote data store
            var selected_course;
            var selected_assessment;
            
            // event for change on metrics
            $("#assessment-filter").on("change", function () {
                var self = $(this);
                selected_assessment = self.val();
                updateAssessmentTypes(selected_assessment);

                // lodash methods for rendering graph
                var courses = _.filter(results, _.iteratee({'course_id': selected_course, 'assessment': selected_assessment}));
                renderResultsGraph(_.head(courses));

                // lodash methods for rendering progression
                var prog = _.filter(progression, _.iteratee({'course_id': selected_course}));
                renderVideoProgressionGraph(_.head(prog));
                renderEbookProgressionGraph(_.head(prog));
                renderArticleProgressionGraph(_.head(prog));
                renderStudyGuideProgressionGraph(_.head(prog));
            });
            
            $("#course-filter").on("change", function () {
                var self = $(this);
                selected_course = $(this).val();
                // trigger the assessment filter change event
                $("#assessment-filter").trigger("change");
            });
            // and lets just select the first record on page load
            $("#course-filter").trigger("change");

            // event for change on metric items
            $("#assessment-type-filter").on("change", function () {
                var self = $(this);
                // lodash methods for rendering graph
                var courses = _.filter(results, _.iteratee({'course_id': selected_course, 'assessment': selected_assessment, 'assessment_type_id': self.val()}));
                renderResultsGraph(_.head(courses));
            });

            function updateAssessmentTypes(a_type)
            {
                var select = $("#assessment-type-filter");
                select.empty();
                var items = _.filter(assessment_types, _.iteratee({'assessment': a_type}));
                $.each(items, function (idx, obj) {
                    var option = new Option(obj.description, obj.assessment_type_id);
                    select.append($(option));
                });
            }

            function renderResultsGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#student-results').remove();
                $('#student-results-container').append('<canvas id="student-results"><canvas>');
                
                // pull a switch-a-roo on the labels and axis count
                if (data && data.labels.length < 1)
                {
                    data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }

                var areaChartCanvas = $('#student-results').get(0).getContext('2d');

                var areaChartData = {
                    labels: data.labels,
                    datasets: [

                        {
                            label: 'Your Results',
                            backgroundColor: 'rgba(251, 114, 23, 1)',
                            borderWidth: 0,
                            data: data.your_results
                        },
                        {
                            label: 'Your Average',
                            backgroundColor: 'rgba(251, 158, 96, 1)',
                            borderWidth: 0,
                            data: data.your_average
                        },
                        {
                            label: 'Class Average',
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            borderWidth: 0,
                            data: data.class_average
                        }
                    ]
                };


                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 1,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,

                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "bar",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }

            function renderVideoProgressionGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#video-progression').remove();
                $('#video-progression-container').append('<canvas id="video-progression"><canvas>');
                
                // pull a switch-a-roo on the labels and axis count
                var labels = ['Progress'];
                var areaChartCanvas = $('#video-progression').get(0).getContext('2d');

                var areaChartData = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Class Progress',
                            backgroundColor: 'rgba(0, 192, 239, 1)',
                            //borderColor: 'rgba(0, 192, 239, 1)',
                            borderWidth: 0,
                            data: data.progress.videos.class_progress
                        },
                        {
                            label: 'My Progress',
                            backgroundColor: 'rgba(111, 215, 241, 1)',
                            //borderColor: 'rgba(221, 75, 57, 1)',
                            borderWidth: 0,
                            data: data.progress.videos.my_progress
                        },
                        {
                            label: 'Course Timeline',
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            //borderColor: 'rgba(0, 166, 90, 1)',
                            borderWidth: 0,
                            data: data.progress.videos.course_timeline
                        }
                    ]
                };


                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 1,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,

                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "bar",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }
            
            function renderEbookProgressionGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#ebook-progression').remove();
                $('#ebook-progression-container').append('<canvas id="ebook-progression"><canvas>');
                
                // pull a switch-a-roo on the labels and axis count
                var labels = ['Progress'];
                var areaChartCanvas = $('#ebook-progression').get(0).getContext('2d');

                var areaChartData = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Class Progress',
                            backgroundColor: 'rgba(221, 75, 57, 1)',
                            //borderColor: 'rgba(0, 192, 239, 1)',
                            borderWidth: 0,
                            data: data.progress.ebooks.class_progress
                        },
                        {
                            label: 'My Progress',
                            backgroundColor: 'rgba(226, 145, 135, 1)',
                            //borderColor: 'rgba(221, 75, 57, 1)',
                            borderWidth: 0,
                            data: data.progress.ebooks.my_progress
                        },
                        {
                            label: 'Course Timeline',
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            //borderColor: 'rgba(0, 166, 90, 1)',
                            borderWidth: 0,
                            data: data.progress.ebooks.course_timeline
                        }
                    ]
                };


                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 1,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,

                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "bar",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }
            
            function renderArticleProgressionGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#article-progression').remove();
                $('#article-progression-container').append('<canvas id="article-progression"><canvas>');
                
                // pull a switch-a-roo on the labels and axis count
                var labels = ['Progress'];
                var areaChartCanvas = $('#article-progression').get(0).getContext('2d');

                var areaChartData = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Class Progress',
                            backgroundColor: 'rgba(0, 166, 90, 1)',
                            //borderColor: 'rgba(0, 192, 239, 1)',
                            borderWidth: 0,
                            data: data.progress.articles.class_progress
                        },
                        {
                            label: 'My Progress',
                            backgroundColor: 'rgba(91, 211, 157, 1)',
                            //borderColor: 'rgba(221, 75, 57, 1)',
                            borderWidth: 0,
                            data: data.progress.articles.my_progress
                        },
                        {
                            label: 'Course Timeline',
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            //borderColor: 'rgba(0, 166, 90, 1)',
                            borderWidth: 0,
                            data: data.progress.articles.course_timeline
                        }
                    ]
                };


                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 1,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,

                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "bar",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }
            
            function renderStudyGuideProgressionGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#study-guide-progression').remove();
                $('#study-guide-progression-container').append('<canvas id="study-guide-progression"><canvas>');
                
                // pull a switch-a-roo on the labels and axis count
                var labels = ['Progress'];
                var areaChartCanvas = $('#study-guide-progression').get(0).getContext('2d');

                var areaChartData = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Class Progress',
                            backgroundColor: 'rgba(251, 114, 23, 1)',
                            //borderColor: 'rgba(0, 192, 239, 1)',
                            borderWidth: 0,
                            data: data.progress.study_guide.class_progress
                        },
                        {
                            label: 'My Progress',
                            backgroundColor: 'rgba(251, 158, 96, 1)',
                            //borderColor: 'rgba(221, 75, 57, 1)',
                            borderWidth: 0,
                            data: data.progress.study_guide.my_progress
                        },
                        {
                            label: 'Course Timeline',
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            //borderColor: 'rgba(0, 166, 90, 1)',
                            borderWidth: 0,
                            data: data.progress.study_guide.course_timeline
                        }
                    ]
                };


                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 1,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,

                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "bar",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }
        });
    </script>

    @endsection
