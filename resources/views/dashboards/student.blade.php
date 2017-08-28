@extends('layouts.app')


@section('page-title')
Student Dashboard
@endsection


@section('custom-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />
@endsection


@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12" style="margin-bottom: 15px;">
            <div class="beta-notice">
                Please note that this site is currently in development and is not complete. Certain features in this website are currently under construction, and they do not represent the final intended functionality. This site is available to allow you to have a look at progress, and to get an idea of where this site is headed.
            </div>
        </div>
    </div>

    <div class="row">

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

    </div>

    <div class="row">

        <div class="col-md-8 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Results
                </div>

                <div class="container-fluid">
                    <canvas id="student-results"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 sp-top-15 sp-bot-15">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

                <div class="dashboard-card-heading">
                    Course Filters
                </div>

                <div class="container-fluid">
                    <label for="course-filter">Please select a course</label>
                    <select class="form-control" id="course-filter">
                        <option>FBN101 - Financial Business 101</option>
                        <option>SHF101 - Superhero Fundamentals 101</option>
                        <option>SHE101 - Sperhero Equipment 101</option>
                    </select>
                    <label for="metric-type-filter">Please select a metric type</label>
                    <select class="form-control" id="metric-type-filter">
                        <option>Current Average</option>
                        <option>Formal Assessment</option>
                        <option>Assignment</option>
                        <option>Exam</option>
                        <option>Self Assessment</option>
                    </select>
                    <label for="metric-item-filter">Please select item</label>
                    <select class="form-control" id="metric-item-filter">
                        <option>Assignment 1</option>
                        <option>Assignment 2</option>
                        <option>Assignment 3</option>
                        <option>Assignment 4</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8 sp-top-15 sp-bot-15">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

                <div class="dashboard-card-heading">
                    Timeline
                </div>

                <div class="container-fluid">
                    <div id="student-timeline"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Timeline Key
                </div>

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
    </div>

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

        // AREA CHART
        /*var line = new Morris.Line({
            element: 'student-results',
            resize: true,
            data: [
                {y: '2018-03-01', ca: 55, ya: 55, yr: 55},
                {y: '2018-04-01', ca: 62, ya: 55, yr: 63},
                {y: '2018-05-02', ca: 55, ya: 55, yr: 61},
                {y: '2018-05-22', ca: 63, ya: 55, yr: 55},
                {y: '2018-06-03', ca: 70, ya: 55, yr: 49},
                {y: '2018-06-15', ca: 62, ya: 55, yr: 50},
                {y: '2018-07-10', ca: 69, ya: 55, yr: 50},
                {y: '2018-07-15', ca: 76, ya: 55, yr: 70},
                {y: '2018-07-22', ca: 59, ya: 55, yr: 65},
                {y: '2018-08-01', ca: 63, ya: 55, yr: 61}
            ],
            pointSize: 7,
            postUnits: '%',
            ymax: 100,
            xkey: 'y',
            ykeys: ['ca', 'ya', 'yr'],
            labels: ['Class Average', 'Your Average', 'Your Result'],
            lineColors: ['#930010', '#012147', '#f7931d'],
            hideHover: 'auto',
            axes: true,
            grid: true
        }); */

        var areaChartCanvas = $('#student-results').get(0).getContext('2d');
        
        var areaChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Class Average',
                    backgroundColor: 'rgba(147, 0, 16, 0.3)',
                    borderColor: 'rgba(147, 0, 16, 1)',
                    borderWidth: 1,
                    fillColor: 'rgba(210, 214, 222, 1)',
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [55, 66, 80, 81, 56, 60, 40, 55, 62, 75, 51, 80]
                },
                {
                    label: 'Your Average',
                    backgroundColor: 'rgba(1, 33, 71, 0.3)',
                    borderColor: 'rgba(1, 33, 71, 1)',
                    borderWidth: 1,
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [48, 58, 60, 62, 67, 55, 70, 82, 74, 58, 73, 83]
                },
                {
                    label: 'Your Results',
                    backgroundColor: 'rgba(247, 147, 29, 0.3)',
                    borderColor: 'rgba(247, 147, 29, 1)',
                    borderWidth: 1,
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [68, 59, 60, 72, 56, 55, 60, 49, 66, 72, 76, 52]
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
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
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
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
        
        // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
        var areaChart = new Chart(areaChartCanvas , {
            type: "line",
            data: areaChartData,
            options: areaChartOptions
        });

    });
</script>

@endsection
