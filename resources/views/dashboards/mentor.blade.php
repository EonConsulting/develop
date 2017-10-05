@extends('layouts.app')


@section('page-title')
Mentor Dashboard
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

    .main-chart {
        border-width: 0px 1px 0px 0px;
        border-style: solid;
        border-color: #DBDBDB;
        background: #FFF;

    }

    .progress-charts {
        background: #F9F9F9;
    }

    .progress-charts h2 {
        text-align: center;
        font-size: 20px;
        font-weight: 300;
    }

    .progress-charts h3 {
        text-align: center;
        font-size: 16px;
        font-weight: 700;
    }

    /* .timeline {
         padding-right: 280px;
     }
 
     .timeline-key {
         width: 280px;
         float: right;
     }*/

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
                            <label for="student-filter">Student</label>
                            <select class="form-control" id="student-filter">
                                <option value="ALL">ALL</option>
                                <option value="S1">1234 - Hlobisile Student</option>
                                <option value="S2">5678 - Student 2</option>
                                <option value="S3">5679 - Student 3</option>
                            </select>
                            <label for="assessment-filter">Assessment</label>
                            <select class="form-control" id="assessment-filter">
                                <option value="FA">Formative Assessment</option>
                                <option value="SA">Summative Assessment</option>
                            </select>
                            <label for="assessment-type-filter">Assessment Type</label>
                            <select class="form-control" id="assessment-type-filter">
                            </select>
                            <label for="student-trend-filter">Period</label>
                            <select class="form-control" id="student-trend-filter">
                                <option value="today">Today</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="3-month">3 Month</option>
                                <option value="6-month">6 Month</option>
                                <option value="year">Year</option>
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
                    Module Progression
                </div>

                <div class="basic-clearfix">

                    <div class="progress-charts basic-clearfix">

                        <div class="col-md-3 main-chart">
                            <h2>Study Guide</h2>
                            <div class="container-fluid" id="study-guide-progression-container" style="height: 300px;">
                                <canvas id="study-guide-progression"></canvas>
                            </div>
                        </div><!-- end col-md-8 -->

                        <div class="col-md-9">
                            <div class="row basic-clearfix">
                                <div class="col-md-4">
                                    <h3>Videos</h3>
                                    <div class="container-fluid" id="video-progression-container" style="height: 300px;">
                                        <canvas id="video-progression"></canvas>
                                    </div>
                                </div> <!-- end col-md-4 -->

                                <div class="col-md-4">
                                    <h3>E-Books</h3>
                                    <div class="container-fluid" id="ebook-progression-container" style="height: 300px;">
                                        <canvas id="ebook-progression"></canvas>
                                    </div>
                                </div><!-- end col-md-8 -->

                                <div class="col-md-4">
                                    <h3>Articles</h3>
                                    <div class="container-fluid" id="article-progression-container" style="height: 300px;">
                                        <canvas id="article-progression"></canvas>
                                    </div>
                                </div><!-- end col-md-8 -->

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Student Analysis
                </div>

                <div class="basic-clearfix">
                    <div class="progress-charts basic-clearfix">

                        <h3>Student Trends</h3>

                        <div class="container-fluid" id="student-trends-container" style="height: 400px;">
                            <canvas id="student-trends"></canvas>
                        </div>

                    </div>
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
                        <div class="col-lg-9 col-md-8 col-xs-12">
                            <div id="student-timeline"></div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-12">
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
        defaultDate: '2018-10-12',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'FBN101 Test',
                start: '2018-10-01',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'New Student Welcome',
                start: '2018-10-07',
                end: '2018-10-10'
            },
            {
                id: 999,
                title: 'FBN102 Exam',
                start: '2018-10-09T16:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-10-16T16:00:00'
            },
            {
                title: 'Student Conference',
                start: '2018-10-11',
                end: '2018-10-13'
            },
            {
                title: 'Meeting',
                start: '2018-10-12T10:30:00',
                end: '2018-10-12T12:30:00',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'FBN101 Exam',
                start: '2018-10-12T12:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                title: 'FNB104 Test',
                start: '2018-10-12T14:30:00'
            },
            {
                title: 'FBN105 Test',
                start: '2018-10-12T17:30:00'
            },
            {
                title: 'FBN103 Exam',
                start: '2018-10-12T20:00:00',
                backgroundColor: '#dd4b39', //red
                borderColor: '#dd4b39' //red
            },
            {
                title: 'FBN102 Test',
                start: '2018-10-13T07:00:00',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'MyUnisa',
                url: 'http://unisa.ac.za/',
                start: '2018-10-28'
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
                    "student_id": "ALL",
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
                    "course_id": "FBN1501",
                    "student_id": "S1",
                    "progress": {
                        "videos": {
                            "class_progress": [25],
                            "my_progress": [58],
                            "course_timeline": [43]
                        },
                        "ebooks": {
                            "class_progress": [51],
                            "my_progress": [38],
                            "course_timeline": [52]
                        },
                        "articles": {
                            "class_progress": [61],
                            "my_progress": [57],
                            "course_timeline": [70]
                        },
                        "study_guide": {
                            "class_progress": [34],
                            "my_progress": [35],
                            "course_timeline": [51]
                        }
                    }
                },
                {
                    "course_id": "FBN1502",
                    "student_id": "ALL",
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
                },
                {
                    "course_id": "FBN1502",
                    "student_id": "S1",
                    "progress": {
                        "videos": {
                            "class_progress": [32],
                            "my_progress": [52],
                            "course_timeline": [66]
                        },
                        "ebooks": {
                            "class_progress": [43],
                            "my_progress": [39],
                            "course_timeline": [65]
                        },
                        "articles": {
                            "class_progress": [41],
                            "my_progress": [49],
                            "course_timeline": [46]
                        },
                        "study_guide": {
                            "class_progress": [69],
                            "my_progress": [59],
                            "course_timeline": [61]
                        }
                    }
                }
            ];

            var results = [
                // ALL FBN1501
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "ALL",
                    "labels": [],
                    "your_results": [0, 49, 65, 80, 56, 45, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 73, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 49.67, 69.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "ALL",
                    "labels": [],
                    "your_results": [0, 59, 65, 60, 56, 45, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 63, 62, 65, 59, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 59.67, 59.75, 59, 56.67, 58.71, 0, 0, 0, 0, 0, 0]
                },
                // ALL FBN1502
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "ALL",
                    "labels": [],
                    "your_results": [0, 0, 0, 0, 0, 0, 71, 59, 76, 62, 63, 0],
                    "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 0],
                    "your_average": [0, 0, 0, 0, 0, 0, 58.75, 60.67, 60.80, 61, 61.08, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "ALL",
                    "labels": [],
                    "your_results": [0, 0, 0, 0, 0, 0, 51, 59, 76, 62, 63, 0],
                    "class_average": [0, 0, 0, 0, 0, 0, 60, 75, 58, 55, 61, 0],
                    "your_average": [0, 0, 0, 0, 0, 0, 48.75, 60.67, 60.80, 61, 61.08, 0]
                },
                // STUDENT ALL FBN1501
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S1",
                    "labels": [],
                    "your_results": [0, 66, 60, 58, 55, 41, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 56, 82, 45, 69, 85, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 54, 85, 69, 66, 68, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S2",
                    "labels": [],
                    "your_results": [0, 53, 70, 83, 61, 51, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 66, 48, 50, 69, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 85, 41, 89, 84, 67, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S3",
                    "labels": [],
                    "your_results": [0, 73, 67, 89, 46, 64, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 45, 46, 48, 41, 41, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 77, 45, 61, 72, 69, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S1",
                    "labels": [],
                    "your_results": [0, 66, 60, 58, 55, 41, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 56, 82, 45, 69, 85, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 54, 85, 69, 66, 68, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S2",
                    "labels": [],
                    "your_results": [0, 53, 70, 83, 61, 51, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 66, 48, 50, 69, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 85, 41, 89, 84, 67, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1501",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S3",
                    "labels": [],
                    "your_results": [0, 73, 67, 89, 46, 64, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 45, 46, 48, 41, 41, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 77, 45, 61, 72, 69, 0, 0, 0, 0, 0, 0]
                },
                // STUDENT ALL FBN1502
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S1",
                    "labels": [],
                    "your_results": [0, 66, 60, 58, 55, 41, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 56, 82, 45, 69, 85, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 54, 85, 69, 66, 68, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S2",
                    "labels": [],
                    "your_results": [0, 53, 70, 83, 61, 51, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 66, 48, 50, 69, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 85, 41, 89, 84, 67, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "FA",
                    "assessment_type_id": "FA-ALL",
                    "student_id": "S3",
                    "labels": [],
                    "your_results": [0, 73, 67, 89, 46, 64, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 45, 46, 48, 41, 41, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 77, 45, 61, 72, 69, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S1",
                    "labels": [],
                    "your_results": [0, 66, 60, 58, 55, 41, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 56, 82, 45, 69, 85, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 54, 85, 69, 66, 68, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S2",
                    "labels": [],
                    "your_results": [0, 53, 70, 83, 61, 51, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 66, 48, 50, 69, 65, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 85, 41, 89, 84, 67, 0, 0, 0, 0, 0, 0]
                },
                {
                    "course_id": "FBN1502",
                    "assessment": "SA",
                    "assessment_type_id": "SA-ALL",
                    "student_id": "S3",
                    "labels": [],
                    "your_results": [0, 73, 67, 89, 46, 64, 0, 0, 0, 0, 0, 0],
                    "class_average": [0, 45, 46, 48, 41, 41, 0, 0, 0, 0, 0, 0],
                    "your_average": [0, 77, 45, 61, 72, 69, 0, 0, 0, 0, 0, 0]
                },
                // STUDENT S1 SA's
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
            var selected_student;
            var selected_assessment;

            // event for change on metrics
            $("#assessment-filter").on("change", function () {
                var self = $(this);
                selected_assessment = self.val();
                updateAssessmentTypes(selected_assessment);

                // lodash methods for rendering graph
                var courses = _.filter(results, _.iteratee({
                    'course_id': selected_course,
                    'student_id': selected_student,
                    'assessment': selected_assessment}
                ));

                renderResultsGraph(_.head(courses));

                // lodash methods for rendering progression
                var prog = _.filter(progression, _.iteratee({'course_id': selected_course}));
                renderVideoProgressionGraph(_.head(prog));
                renderEbookProgressionGraph(_.head(prog));
                renderArticleProgressionGraph(_.head(prog));
                renderStudyGuideProgressionGraph(_.head(prog));
            });

            // event for change of student name
            $("#student-filter").on("change", function () {
                var self = $(this);
                selected_student = self.val();
                // trigger the assessment filter change event
                $("#assessment-filter").trigger("change");
            });

            $("#course-filter").on("change", function () {
                var self = $(this);
                selected_course = self.val();
                // trigger the student filter change event
                $("#student-filter").trigger("change");
            });
            // and lets just select the first record on page load
            $("#course-filter").trigger("change");

            // event for change on assessment-type items
            $("#assessment-type-filter").on("change", function () {
                var self = $(this);
                // lodash methods for rendering graph
                var courses = _.filter(results, _.iteratee({'course_id': selected_course, 'assessment': selected_assessment, 'assessment_type_id': self.val()}));
                renderResultsGraph(_.head(courses));
            });

            $("#student-trend-filter").on("change", function () {
                var self = $(this);

                var studtrends = [];
                //var studtrends = _.filter(trends, _.iteratee({'period': self.val()}));
                switch (self.val())
                {
                    case "today":
                        studtrends = generateRandomDataset(24, "hours");
                        break;
                    case "week":
                        studtrends = generateRandomDataset(7, "days");
                        break;
                    case "month":
                        studtrends = generateRandomDataset(30, "days");
                        break;
                    case "3-month":
                        studtrends = generateRandomDataset(3, "months");
                        break;
                    case "6-month":
                        studtrends = generateRandomDataset(6, "months");
                        break;
                    case "year":
                        studtrends = generateRandomDataset(12, "months");
                        break;
                    default:
                        studtrends = generateRandomDataSet(24, "hours");
                        break;
                }

                renderTrendsGraph(studtrends);
            });
            $("#student-trend-filter").trigger("change");

            function generateRandomNumber(minimum, maximum, boost_factor)
            {
                var r = Math.floor(Math.random() * (maximum - minimum + 1)) + minimum;
                return r * boost_factor; // this is to boost entries for certain periods
            }

            function getDayName(dateStr, locale)
            {
                console.log("date is:" + dateStr);
                var date = new Date(dateStr);
                return date.toLocaleDateString(locale, {weekday: 'long'});
            }

            function generateRandomDataset(value, period)
            {
                var labels = [];
                var logins = [];
                var videos = [];
                var ebooks = [];
                var articles = [];
                var assessments = [];
                var boost_factor = 1;
                var hours_of_interest = [8, 9, 18, 19, 20, 21, 22];
                var days_of_interest = [3, 7, 14, 21, 25];

                switch (period) {
                    case "hours":
                        for (x = 0; x < value; x++)
                        {
                            (_.indexOf(hours_of_interest, x) > 0) ? boost_factor = 7 : boost_factor = 1;
                            labels.push(x + "h00");
                            logins.push(generateRandomNumber(3, 120, boost_factor));
                            videos.push(generateRandomNumber(3, 120, boost_factor));
                            ebooks.push(generateRandomNumber(3, 120, boost_factor));
                            articles.push(generateRandomNumber(3, 120, boost_factor));
                            assessments.push(generateRandomNumber(3, 120, boost_factor));
                        }
                        break;
                    case "days":
                        for (x = value; x > 0; x--)
                        {
                            (_.indexOf(days_of_interest, x) > 0) ? boost_factor = 7 : boost_factor = 1;
                            labels.push(getDayName(new Date().getDate() - x, "en-US"));
                            logins.push(generateRandomNumber(3, 120, boost_factor));
                            videos.push(generateRandomNumber(3, 120, boost_factor));
                            ebooks.push(generateRandomNumber(3, 120, boost_factor));
                            articles.push(generateRandomNumber(3, 120, boost_factor));
                            assessments.push(generateRandomNumber(3, 120, boost_factor));
                        }
                        break;
                    case "months":
                        break;
                }

                var ds =
                        {
                            //"course_id": "FBN1501",
                            //"assessment": "SA",
                            //"assessment_type_id": "SA-ALL",
                            "student_id": selected_student,
                            "labels": labels,
                            "logins": logins,
                            "videos": videos,
                            "ebooks": ebooks,
                            "articles": articles,
                            "assessments": assessments
                        };

                return ds;
            }

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
                            label: 'Student Results',
                            backgroundColor: 'rgba(251, 114, 23, 1)',
                            borderWidth: 0,
                            data: data.your_results
                        },
                        {
                            label: 'Student Average',
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
                            label: 'Student Progress',
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
                            label: 'Student Progress',
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
                            label: 'Student Progress',
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
                            label: 'Student Progress',
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

            function renderTrendsGraph(data) {
                // MH: this is a workaround to trash the canvas
                // .destroy() does not work :(
                $('#student-trends').remove();
                $('#student-trends-container').append('<canvas id="student-trends"><canvas>');

                // pull a switch-a-roo on the labels and axis count
                if (data && data.labels.length < 1)
                {
                    data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                }

                var areaChartCanvas = $('#student-trends').get(0).getContext('2d');

                var areaChartData = {
                    labels: data.labels,
                    datasets: [

                        {
                            label: 'Logins',
                            fill: false,
                            backgroundColor: 'rgba(251, 114, 23, 1)',
                            borderColor: 'rgba(251, 114, 23, 1)',
                            borderWidth: 0,
                            data: data.logins
                        },
                        {
                            label: 'Videos',
                            fill: false,
                            backgroundColor: 'rgba(251, 158, 96, 1)',
                            borderColor: 'rgba(251, 158, 96, 1)',
                            borderWidth: 0,
                            data: data.videos
                        },
                        {
                            label: 'E-Books',
                            fill: false,
                            backgroundColor: 'rgba(158, 251, 46, 1)',
                            borderColor: 'rgba(158, 251, 46, 1)',
                            borderWidth: 0,
                            data: data.ebooks
                        },
                        {
                            label: 'Articles',
                            fill: false,
                            backgroundColor: 'rgba(51, 158, 216, 1)',
                            borderColor: 'rgba(51, 158, 216, 1)',
                            borderWidth: 0,
                            data: data.articles
                        },
                        {
                            label: 'Self-Assessments',
                            fill: false,
                            backgroundColor: 'rgba(200, 200, 200, 1)',
                            borderColor: 'rgba(200, 200, 200, 1)',
                            borderWidth: 0,
                            data: data.assessments
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
                                    //max: 100  // minimum value will be 0.
                                }
                            }]
                    }
                };

                // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
                var areaChart = new Chart(areaChartCanvas, {
                    type: "line",
                    data: areaChartData,
                    options: areaChartOptions
                });
            }
        });
    </script>

    @endsection