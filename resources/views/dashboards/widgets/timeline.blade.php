<div class="row">
    <div class="col-md-12 sp-top-15">            
        <div class="dashboard-card shadow top-bdr-2 sp-bot-15  mr-bot-15">

            <div class="dashboard-card-heading">
                Timeline
            </div>

            <div class="row basic-clearfix sp-top-15 sp-bot-15">
                <div class="container-fluid">

                    <div class="col-lg-9 col-md-8 col-xs-12">
                        <label for="module-filter">Module</label>
                        <select class="form-control" id="module-filter">
                        </select>
                        <br/>
                    </div>
                    
                    <div class="col-lg-9 col-md-8 col-xs-12">
                        <div id="calendar-timeline"></div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <h4>Timeline Key</h3>
                        <div class="col-lg-2 col-md-3 col-xs-6">
                            <div class="btn btn-success btn-cal-key">Formal Assessment</div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6">
                            <div class="btn btn-warning btn-cal-key">Assignment</div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6">
                            <div class="btn btn-danger btn-cal-key">Exam</div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6">
                            <div class="btn btn-info btn-cal-key">Self Assessment</div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6">
                            <div class="btn btn-primary btn-cal-key">Other</div>
                        </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
    <div class="clearfix"></div>
</div>

@section('custom-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        
        var selected_course = "";
        var calendarIsInitialized = false;
        
        var dataCourses = function(callback) {
            $.ajax({
                method: "GET",
                url: "{{ url("") }}/lti/data-courses/",
                contentType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        callback(data);
                    },
                    400: function () { //bad request
                        console.log("Bad request");
                    },
                    500: function () { //server kakked
                        console.log("Server error");
                    }
                }
            }).error(function (req, status, error) {
                return [];
            });
        }

        var bindModuleFilter = function()
        {
            dataCourses(function(data){
                var listitems = '';
                $.each(data, function(key, value){
                    listitems += '<option value=' + value.id + '>' + value.title + '</option>';
                });
                $("#module-filter").append(listitems);
                
                $("#module-filter").on("change", function () {
                    var self = $(this);
                    selected_course = self.val();
                    // refresh the calendar events
                    if (calendarIsInitialized){
                        $('#calendar-timeline').fullCalendar("refetchEvents");
                    } else {
                        renderTimeline();
                        calendarIsInitialized = true;
                    }
                });
                $("#module-filter").trigger("change");
            });
        }
        bindModuleFilter();
        
        function getFillColor(type){
            switch(type){
                case 'formal_assessment':
                    return "#20895e";
                break;
                case 'assignment':
                    return "#fb7217";
                break;
                case 'exam':
                    return "#dd4b39";
                break;
                case 'self_assessment':
                    return "#00c0ef";
                break;
                case 'other':
                default:
                    return "#3097D1";
                break;
            }
        }
        
        function renderTimeline()
        {
            $('#calendar-timeline').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,listMonth'
                },
                height: 500,
                views: {
                    listMonth: { buttonText: 'list month' }
                },
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                  var title = prompt('Event Title:');
                  var eventData;
                  if (title) {
                    eventData = {
                      title: title,
                      start: start,
                      end: end
                    };
                    $('#calendar-timeline').fullCalendar('renderEvent', eventData, true); // stick? = true
                  }
                  $('#calendar-timeline').fullCalendar('unselect');
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: "{{ url("") }}/lti/data-timeline/",
                        contentType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                        },
                        data: {
                            start: start.format('YYYY-MM-DD'),
                            end: end.format('YYYY-MM-DD'),
                            course_id: selected_course
                        },
                        statusCode: {
                            200: function (data) { //success
                                var events = [];
                                $.each(data, function(idx, obj) {
                                    var _item = {
                                        title: obj['title'],
                                        start: obj['start'], // will be parsed
                                        end: obj['end'], // will be parsed
                                        type: obj['type'],
                                        backgroundColor: getFillColor(obj['type']),
                                        borderColor: getFillColor(obj['type']),
                                        url: obj['url']
                                    }
                                    events.push(_item);
                                });
                                //console.log(events);
                                callback(events);
                            },
                            400: function () { //bad request
                                console.log("Bad request");
                            },
                            500: function () { //server kakked
                                console.log("Server error");
                            }
                        }
                    }).error(function (req, status, error) {
                        return [];
                    });
                }
            });
        };
    });
</script>
@endsection