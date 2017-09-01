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

    <!--    <div class="row">
    
            <div class="col-md-3">
                <div class="nofitication-card shadow">
                    <div class="notification-card-icon bg-col-1">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="notification-card-text">
                        <h1>Emails</h1>
                        <p>123</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="nofitication-card shadow">
                    <div class="notification-card-icon bg-col-2">
                        <i class="fa fa-flag-o"></i>
                    </div>
                    <div class="notification-card-text">
                        <h1>Bookmarks</h1>
                        <p>410</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="nofitication-card shadow">
                    <div class="notification-card-icon bg-col-3">
                        <i class="fa fa-files-o"></i>
                    </div>
                    <div class="notification-card-text">
                        <h1>Uploads</h1>
                        <p>23</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="nofitication-card shadow">
                    <div class="notification-card-icon bg-col-4">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="notification-card-text">
                        <h1>Messages</h1>
                        <p>200</p>
                    </div>
                </div>
            </div>
    
        </div>-->

    <div class="row">

        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Course Results
                </div>

                <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                    <div class="col-md-2">
                        <div class="container-fluid">
                            <h3>Filters</h3>
                            <label for="course-filter">Course</label>
                            <select class="form-control" id="course-filter">
                                <option value="FBN1501">FBN1501 - Business Numerical Skills A</option>
                                <option value="FBN1502">FBN1502 - Business Numerical Skills B</option>
                            </select>
                            <br>
                            <label for="metric-type-filter">Metric</label>
                            <select class="form-control" id="metric-type-filter">
                                <option>Current Average</option>
                                <option>Formal Assessment</option>
                                <option>Assignment</option>
                                <option>Exam</option>
                                <option>Self Assessment</option>
                            </select>
                            <br>
                            <label for="metric-item-filter">Assignment/Assessment</label>
                            <select class="form-control" id="metric-item-filter">
                                <option>Assignment 1</option>
                                <option>Assignment 2</option>
                                <option>Assignment 3</option>
                                <option>Assignment 4</option>
                            </select>
                        </div>
                    </div> <!-- end col-md-4 -->

                    <div class="col-md-2">
                        <h3>Progession</h3>
                        <div class="container-fluid sp-top-15 sp-bot-15">

                            Videos
                            <div class="progress">
                                <div class="progress-bar bg-col-1" id="progress_videos" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
                                    70%
                                </div>
                            </div>

                            E-Books
                            <div class="progress">
                                <div class="progress-bar bg-col-2" id="progress_ebooks" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
                                    25%
                                </div>
                            </div>

                            Articles
                            <div class="progress">
                                <div class="progress-bar bg-col-3" id="progress_articles" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
                                    40%
                                </div>
                            </div>
                            Study Guide
                            <div class="progress">
                                <div class="progress-bar bg-col-4" id="progress_study_guide" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
                                    35%
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-8">
                        <h3>Results</h3>
                        <div class="container-fluid" style="height: 300px;">

                            <canvas id="student-results"></canvas>
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
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <div id="student-timeline"></div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <h3>Timeline Key</h3>
                        <div class="container-fluid">
                            <div id="external-events">
                                <div class="btn btn-success">Formal Assessment</div><br/>
                                <div class="btn btn-warning">Assignment</div><br/>
                                <div class="btn btn-danger">Exam</div><br/>
                                <div class="btn btn-info">Self Assessment</div><br/>
                                <div class="btn btn-primary">Other</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- end card -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

    <div class="clearfix"></div>

</div>

@endsection

@section('custom-scripts')
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
        height: 400,
        aspectRatio: 1,
        defaultDate: '2018-08-12',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2018-08-01',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'Long Event',
                start: '2018-08-07',
                end: '2018-08-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-08-09T16:00:00',
                backgroundColor: '#f56954', //red
                borderColor: '#f56954' //red
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-08-16T16:00:00'
            },
            {
                title: 'Conference',
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
                title: 'Lunch',
                start: '2018-08-12T12:00:00',
                backgroundColor: '#f56954', //red
                borderColor: '#f56954' //red
            },
            {
                title: 'Meeting',
                start: '2018-08-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2018-08-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2018-08-12T20:00:00',
                backgroundColor: '#f56954', //red
                borderColor: '#f56954' //red
            },
            {
                title: 'Birthday Party',
                start: '2018-08-13T07:00:00',
                backgroundColor: '#00a65a', //Success (green)
                borderColor: '#00a65a' //Success (green)
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
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
        
        var progression = [
            {
                "course_id": "FBN1501",
                "progress": {
                    "videos": "35",
                    "ebooks": "45",
                    "articles": "50",
                    "study_guide": "72"
                }
            },
            {
                "course_id": "FBN1502",
                "progress": {
                    "videos": "45",
                    "ebooks": "75",
                    "articles": "60",
                    "study_guide": "52"
                }
            }
        ];

        var results = [
            {
                "course_id": "FBN1501",
                "your_results": [68, 59, 60, 72, 56, 55, 61, 49, 66, 72, 76, 52],
                "class_average": [62, 66, 63, 59, 56, 60, 40, 55, 62, 75, 51, 80],
                "your_average": [68, 64, 62.3, 64.75, 63, 62, 60, 62, 63, 64, 65, 63]
            },
            {
                "course_id": "FBN1502",
                "your_results": [55, 59, 65, 60, 56, 45, 71, 59, 76, 62, 63, 62],
                "class_average": [52, 63, 62, 65, 59, 65, 60, 75, 58, 55, 61, 70],
                "your_average": [57, 59.67, 59.75, 59, 56.67, 58.71, 58.75, 60.67, 60.80, 61, 61.08]
            }
        ];
        // bind some events so that we
        // can simulate remote data store
        $("#course-filter").on("change", function () {
            var self = $(this);
            $.each(results, function(index, obj){
                if (obj.course_id === self.val())
                {
                    renderGraph(obj);
                }
            });
            $.each(progression, function(index, obj){
               if (obj.course_id === self.val())
               {
                   renderProgression(obj);
               }
            });
        });
        
        // and lets just select the first record on page load
        $("#course-filter").trigger("change"); // val("val2").change();

        function renderGraph(data) {
            var areaChartCanvas = $('#student-results').get(0).getContext('2d');

            var areaChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Your Results',
                        backgroundColor: 'rgba(0, 166, 90, 0)',
                        borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 2,
                        fillColor: 'rgba(0, 166, 90, 0.9)',
                        strokeColor: 'rgba(0, 166, 90, 0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(0, 166, 90,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: data.your_results
                    },
                    {
                        label: 'Your Average',
                        backgroundColor: 'rgba(130, 201, 169, 0)',
                        borderColor: 'rgba(130, 201, 169, 1)',
                        borderWidth: 1,
                        fillColor: 'rgba(221, 75, 57,0.9)',
                        strokeColor: 'rgba(221, 75, 57,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(221, 75, 57,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: data.your_average
                    },
                    {
                        label: 'Class Average',
                        backgroundColor: 'rgba(220, 220, 220, 0)',
                        borderColor: 'rgba(220, 220, 220, 1)',
                        borderWidth: 1,
                        fillColor: 'rgba(0, 192, 239,1)',
                        strokeColor: 'rgba(0, 192, 239,1)',
                        pointColor: 'rgba(0, 192, 239,1)',
                        pointStrokeColor: 'rgba(0, 192, 239,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
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
                type: "line",
                data: areaChartData,
                options: areaChartOptions
            });
        }
        
        function renderProgression(data)
        {
            // set progress bar width and values
            $("#progress_videos").attr('aria-valuenow', data.progress.videos).css('width', data.progress.videos + '%');
            $("#progress_videos").html(data.progress.videos + '%');
            
            $("#progress_ebooks").attr('aria-valuenow', data.progress.ebooks).css('width', data.progress.ebooks + '%');
            $("#progress_ebooks").html(data.progress.ebooks + '%');
            
            $("#progress_articles").attr('aria-valuenow', data.progress.articles).css('width', data.progress.articles + '%');
            $("#progress_articles").html(data.progress.articles + '%');
            
            $("#progress_study_guide").attr('aria-valuenow', data.progress.study_guide).css('width', data.progress.study_guide + '%');
            $("#progress_study_guide").html(data.progress.study_guide + '%');
        }
    });
</script>

@endsection
