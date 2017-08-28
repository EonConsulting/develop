@extends('layouts.app')


@section('page-title')
Student Dashboard
@endsection


@section('custom-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
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
                    <div id="student-results"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>

//--------------------------
//-CHART CODE---------------
//--------------------------

/*
 Element ctx = document.getElementById("assignmentChart");
 var assignmentChart = new Chart(ctx, {
 type: 'bar',
 data: {
 labels: ["January", "February", "March", "April", "May", "June"],
 datasets: [{
 label: 'Assessment Score',
 data: [92, 62, 53, 81, 72, 78],
 backgroundColor: [
 'rgba(251, 114, 23, 1)'
 'rgba(255, 99, 132, 0.2)',
 'rgba(54, 162, 235, 0.2)',
 'rgba(255, 206, 86, 0.2)',
 'rgba(75, 192, 192, 0.2)',
 'rgba(153, 102, 255, 0.2)',
 'rgba(255, 159, 64, 0.2)'
 ],
 borderColor: [
 'rgba(251, 114, 25, 1)'
 'rgba(255,99,132,1)',
 'rgba(54, 162, 235, 1)',
 'rgba(255, 206, 86, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(153, 102, 255, 1)',
 'rgba(255, 159, 64, 1)'
 ],
 borderWidth: 1
 }]
 },
 options: {
 responsive: true,
 maintainAspectRatio: false,
 scales: {
 yAxes: [{
 ticks: {
 beginAtZero: true
 }
 }]
 },
 elements: {
 point: {
 radius: 0
 }
 }
 },
 });
 */
//--------------------------
//-PROGRESS BAR CODE--------
//--------------------------

/* function move(elem, progress) {
 //var elem = document.getElementById("goal1progress");
 var width = 1;
 var id = setInterval(frame, 10);
 function frame() {
 if (width >= progress) {
 clearInterval(id);
 } else {
 width++;
 elem.style.width = width + '%';
 }
 }
 }
 
 move(document.getElementById('goal1progress'), 65);
 move(document.getElementById('goal2progress'), 13);
 move(document.getElementById('goal3progress'), 44);
 move(document.getElementById('goal4progress'), 78); */
</script>

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
        var area = new Morris.Area({
            element: 'student-results',
            resize: true,
            data: [
                {y: '2018-03-01 Test 1', ca: 60, ya: 55, re: 65},
                {y: '2018-04-01 Test 2', ca: 62, ya: 55, re: 63},
                {y: '2018-05-02 Test 3', ca: 55, ya: 55, re: 61},
                {y: '2018-05-22 Test 4', ca: 63, ya: 55, re: 55},
                {y: '2018-06-03 Test 5', ca: 70, ya: 55, re: 49},
                {y: '2018-06-15 Test 6', ca: 62, ya: 55, re: 50},
                {y: '2018-07-10 Test 7', ca: 69, ya: 55, re: 50},
                {y: '2018-07-15 Test 8', ca: 57, ya: 55, re: 70},
                {y: '2018-07-22 Test 9', ca: 59, ya: 55, re: 65},
                {y: '2018-08-01 Test 10', ca: 63, ya: 55, re: 61}
            ],
            xkey: 'y',
            ykeys: ['ca', 'ya', 're'],
            labels: ['Class Average', 'Your Average', 'Your Result'],
            lineColors: ['#930010', '#012147', '#f7931d'],
            hideHover: 'auto'
        });

    });
</script>

@endsection
