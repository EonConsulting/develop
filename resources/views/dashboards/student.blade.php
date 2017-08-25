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
        <div class="col-md-12 sp-top-15">
            <div class="dashboard-card shadow top-bdr-4">

                <div class="dashboard-card-heading">
                    Monthly Performance
                </div>

                <div class="container-fluid">

                    <div class="row sp-top-15">
                        <div class="col-md-8" style="height: 180px;">
                            <canvas id="assignmentChart" height="180" style="height: 180px"></canvas>
                        </div>
                        <div class="col-md-4">

                            <div class="progressbar-wrapper">
                                <span>Goal 1</span>
                                <div id="goal1bar" class="progressbar">
                                    <div id="goal1progress" class="progressbar-fill bg-col-1"></div>
                                </div>
                            </div>

                            <div class="progressbar-wrapper">
                                <span>Goal 2</span>
                                <div id="goal2bar" class="progressbar">
                                    <div id="goal2progress" class="progressbar-fill bg-col-2"></div>
                                </div>
                            </div>

                            <div class="progressbar-wrapper">
                                <span>Goal 3</span>
                                <div id="goal3bar" class="progressbar">
                                    <div id="goal3progress" class="progressbar-fill bg-col-3"></div>
                                </div>
                            </div>

                            <div class="progressbar-wrapper">
                                <span>Goal 4</span>
                                <div id="goal4bar" class="progressbar">
                                    <div id="goal4progress" class="progressbar-fill bg-col-4"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!--<hr>

                    <div class="row sp-top-15 sp-bot-15">

                        <div class="col-md-3">
                            1
                        </div>

                        <div class="col-md-3">
                            2
                        </div>

                        <div class="col-md-3">
                            3
                        </div>

                        <div class="col-md-3">
                            4
                        </div>
                        <div class="clearfix"></div>
                    </div>-->
                    <div style="height: 10px;"></div>
                </div>

            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-4 sp-top-15 sp-bot-15">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">
                <div class="dashboard-card-heading">
                    Dashboard Filters
                </div>
                <div class="container-fluid">
                    <div class="col-md-12">
                        <label class="control-label" for="db_filters_course">Please select a course</label>
                        <select class="form-control" id="db_filters_course">
                            <option>FNB101 Financial Accounting</option>
                            <option>XYZ201 Superhero Fundamentals</option>
                            <option>ABC202 Superhero Gadgetary</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 sp-top-15 sp-bot-15">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

                <div class="dashboard-card-heading">
                    Timeline
                </div>
                <div class="container-fluid">
                    <div id="student_timeline"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 sp-top-15 sp-bot-15">
            <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

                <div class="dashboard-card-heading">
                    Direct Chats
                </div>


                <div data-simplebar class="chatbox-messages">

                    <them>
                        Hi there
                    </them>

                    <div class="clearfix"></div>

                    <them>
                        How are you?
                    </them>

                    <div class="clearfix"></div>

                    <me>
                        Hi, I'm fine and you?
                    </me>

                    <div class="clearfix"></div>

                    <me>
                        What's up?
                    </me>

                    <div class="clearfix"></div>

                    <them>
                        Have you done task 4? I'm stuck on the second question. I'm not sure what they want.
                    </them>

                    <div class="clearfix"></div>

                    <me>
                        I have, it was quite tricky.
                    </me>

                    <div class="clearfix"></div>

                    <me>
                        I found some info in the text book that helped.
                    </me>

                    <div class="clearfix"></div>

                </div>

                <div class="container-fluid top-bdr-0">
                    <div class="chatbox-entry">
                        <form action="#">

                            <div class="chatbox-submit-wrapper">
                                <input class="chatbox-submit" type="submit" value="">
                            </div>

                            <div class="chatbox-message-wrapper">
                                <input class="chatbox-message" type="text" placeholder="Enter your message here...">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 sp-top-15">
            <div class="dashboard-card shadow top-bdr-3  mr-bot-15">

                <div class="dashboard-card-heading">
                    Modules
                </div>

                <div class="container-fluid sp-top-15">

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Module 1</h1>
                            <p>Description of the Module</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Module 2</h1>
                            <p>Description of the Module</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Module 3</h1>
                            <p>Description of the Module</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Module 4</h1>
                            <p>Description of the Module</p>
                        </div>
                    </div>


                </div>

                <hr>

                <div class="dashboard-card-bottom-link">
                    <a href="#">View all Modules</a>
                </div>

            </div>
        </div>

        <div class="col-md-4 sp-top-15">
            <div class="dashboard-card shadow top-bdr-1  mr-bot-15">

                <div class="dashboard-card-heading">
                    Assignments
                </div>

                <div class="container-fluid sp-top-15">

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Assignemnt 1</h1>
                            <p>Description of the Assignemnt</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Assignemnt 2</h1>
                            <p>Description of the Assignemnt</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Assignemnt 3</h1>
                            <p>Description of the Assignemnt</p>
                        </div>
                    </div>

                    <hr>

                    <div class="dashboard-card-item">
                        <div class="dashboard-card-item-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="dashboard-card-item-text">
                            <h1>Assignemnt 4</h1>
                            <p>Description of the Assignemnt</p>
                        </div>
                    </div>


                </div>

                <hr>

                <div class="dashboard-card-bottom-link">
                    <a href="#">View all Assignements</a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@section('custom-scripts')
<!-- Sparkline -->
<script src="{{url('/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{url('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS for Student Calendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>

//--------------------------
//-CHART CODE---------------
//--------------------------

var ctx = document.getElementById("assignmentChart");

var assignmentChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
                label: 'Assessment Score',
                data: [92, 62, 53, 81, 72, 78],
                backgroundColor: [
                    'rgba(251, 114, 23, 1)'
                            /*'rgba(255, 99, 132, 0.2)',
                             'rgba(54, 162, 235, 0.2)',
                             'rgba(255, 206, 86, 0.2)',
                             'rgba(75, 192, 192, 0.2)',
                             'rgba(153, 102, 255, 0.2)',
                             'rgba(255, 159, 64, 0.2)'*/
                ],
                borderColor: [
                    'rgba(251, 114, 25, 1)'
                            /*'rgba(255,99,132,1)',
                             'rgba(54, 162, 235, 1)',
                             'rgba(255, 206, 86, 1)',
                             'rgba(75, 192, 192, 1)',
                             'rgba(153, 102, 255, 1)',
                             'rgba(255, 159, 64, 1)'*/
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

//--------------------------
//-PROGRESS BAR CODE--------
//--------------------------



function move(elem, progress) {
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
move(document.getElementById('goal4progress'), 78);

</script>
<script>
//--------------------------
//-STUDENT CALENDAR---------
//--------------------------
    $(document).ready(function () {
        $('#student_timeline').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '2017-08-20',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2017-08-01',
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954' //red
                },
                {
                    title: 'Long Event',
                    start: '2017-08-07',
                    end: '2017-08-10',
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-08-09T16:00:00',
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2017-08-16T16:00:00',
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954' //red
                },
                {
                    title: 'Conference',
                    start: '2017-08-11',
                    end: '2017-08-13',
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor: '#00a65a' //Success (green)
                },
                {
                    title: 'Meeting',
                    start: '2017-08-12T10:30:00',
                    end: '2017-08-12T12:30:00',
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Lunch',
                    start: '2017-08-12T12:00:00',
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Meeting',
                    start: '2017-08-12T14:30:00',
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954' //red
                },
                {
                    title: 'Happy Hour',
                    start: '2017-08-12T17:30:00',
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Dinner',
                    start: '2017-08-12T20:00:00',
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Birthday Party',
                    start: '2017-08-13T07:00:00',
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954' //red
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2017-08-28',
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                }
            ]
        });
    });
</script>

@endsection
