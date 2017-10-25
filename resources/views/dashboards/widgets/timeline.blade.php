<div class="row">
    <?php switch($size): case "small": ?>
        <div class="col-md-3 sp-top-15">
    <?php break; case "medium": ?>
        <div class="col-md-6 sp-top-15">
    <?php break; case "large": ?>
        <div class="col-md-9 sp-top-15">
    <?php break; case "xlarge": default: ?>
        <div class="col-md-12 sp-top-15">            
    <?php break; endswitch; ?>
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
            </div>
        </div> <!-- end row -->
    </div>
    <div class="clearfix"></div>
</div>

@push('custom-scripts')
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
@endpush