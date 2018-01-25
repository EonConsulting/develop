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
        
        selected_course = "";
        
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
                    dataTimeline();
                });
                $("#module-filter").trigger("change");
            });
        }
        bindModuleFilter();
        
        var dataTimeline = function()
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
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: "{{ url("") }}/lti/data-timeline",
                        contentType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                        },
                        data: {
                            start: start.format('YYYY-MM-DD'),
                            end: end.format('YYYY-MM-DD'),
                            course: selected_course
                        },
                        success: function(doc) {
                            var events = [];
                            $(doc).find('event').each(function() {
                                events.push({
                                    title: $(this).attr('title'),
                                    start: $(this).attr('start'), // will be parsed
                                    end: $(this).attr('end'), // will be parsed
                                    backgroundColor: $(this).attr('backgroundColor'),
                                    borderColor: $(this).attr('borderColor'),
                                    url: $(this).attr('url')
                                });
                            });
                            callback(events);
                        }
                    });
                }
            });
        };
    });
</script>
@endsection