@extends('layouts.app')


@section('page-title')
Lecturer Dashboard
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

    @push('custom-scripts')
    <!-- DO NOT MOVE !!!! Because of stacking order, these JS scripts need to load before the widgets -->
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
    @endpush
    
    <script type="text/javascript">
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            // event for change on metrics
            
            // event for change of student name
            $("#student-filter").on("change", function(){
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
        });
    </script>

    @endsection
