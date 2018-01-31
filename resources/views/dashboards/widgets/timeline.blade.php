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
        var events = [];
        
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
        
        function prepareTimelineForm(id, title, start, end, event_type, is_global)
        {
            // prepare the datetimepickers
            $('#dt_from').datetimepicker();
            $('#dt_to').datetimepicker({
                useCurrent: false, //Important! See issue #1075
            });
            $("#dt_from").on("dp.change", function (e) {
                $('#dt_to').data("DateTimePicker").minDate(e.date);
            });
            $("#dt_to").on("dp.change", function (e) {
                $('#dt_from').data("DateTimePicker").maxDate(e.date);
            });
            
            // set the fields
            if (id > 0)
            {
                // existing record
                $("#event_id").val(id);
                $("#title").val(title);
                $("#event_type").val(event_type).change();
                $("#is_global").prop('checked', !!parseInt(is_global));
            } else {
                // new record
                $("#title").val('');
                $("#event_type").val($("#event_type option:first").val());
                $("#is_global").prop('checked', false);
            }
            // set the dates according to what was selected
            $("#dt_from").data("DateTimePicker").date(new Date(start));
            $("#dt_to").data("DateTimePicker").date(new Date(end));
        }
        
        function saveTimelineEvent(){
            $.ajax({
                url: "{{ url("") }}/lti/data-timeline",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                data: {
                    id: $("#event_id").val(),
                    title: $("#title").val(),
                    //url: $("#url").val(),
                    start: $("#dt_from").data("DateTimePicker").date().format('YYYY-MM-DD HH:mm:ss'),
                    end: $("#dt_to").data("DateTimePicker").date().format('YYYY-MM-DD HH:mm:ss'),
                    is_global: ($("#is_global").is(":checked")) ? 1 : 0,
                    type: $("#event_type").val(),
                    course_id: selected_course
                },
                statusCode: {
                    201: function () { //created
                        $('#editTimelineModal').modal('hide');  
                        $('#calendar-timeline').fullCalendar("refetchEvents");
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
                    $('#editTimelineModal').modal('show');  
                    prepareTimelineForm(id, title, start, end, event_type, is_global);
                    $('#btnSaveTimelineEntry').on("click", saveTimelineEvent);
                  /*  
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
                  */
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
                                events = [];
                                $.each(data, function(idx, obj) {
                                    var _item = {
                                        id: obj['id'],
                                        title: obj['title'],
                                        start: obj['start'], // will be parsed
                                        end: obj['end'], // will be parsed
                                        type: obj['type'],
                                        is_global: obj['is_global'],
                                        backgroundColor: getFillColor(obj['type']),
                                        borderColor: getFillColor(obj['type'])
                                        //url: obj['url']
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
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $('#editTimelineModal').modal('show');  
                    // we store the dataset in memory in events objects
                    var ev = _.head(_.filter(events, _.iteratee({'id': calEvent.id})));
                    prepareTimelineForm(ev.id, ev.title, ev.start, 
                        ev.end, ev.type, ev.is_global);
                    $('#btnSaveTimelineEntry').on("click", saveTimelineEvent);
                }
            });
        };
    });
</script>
@endsection

@section('exterior-content')
<div id="editTimelineModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Timeline Entry</h4>
        </div>
        <div class="modal-body" >    
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="hidden" id="event_id">
                    <input type="text" class="form-control" id="title" aria-describedby="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <div class="container">
                        <div class='col-md-3'>
                            <div class="form-group">
                                <label for="dt_from">From</label>
                                <div class='input-group date' id='dt_from'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-3'>
                            <div class="form-group">
                                <label for="dt_to">To</label>
                                <div class='input-group date' id='dt_to'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="event_type">Event Type</label>
                    <select class="form-control" id="event_type">
                        <option value="assignment">Assignment</option>
                        <option value="exam">Exam</option>
                        <option value="formal_assessment">Formal Assessment</option>
                        <option value="self_assessment">Self Assessment</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_global">
                    <label class="form-check-label" for="is_global">Global</label>
                </div>                
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSaveTimelineEntry" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>    
</div>
@endsection