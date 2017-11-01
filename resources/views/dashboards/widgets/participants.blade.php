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
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Course Participation
            </div>

            <div class="basic-clearfix" style="padding: 15px 0px 15px 0px;">
                <div class="progress-charts basic-clearfix">
                    <div class="container-fluid basic-clearfix">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="nofitication-card shadow" style="margin-bottom: 10px">
                                    <div class="notification-card-icon bg-col-1">
                                        <i class="fa fa-group"></i>
                                    </div>
                                    <div class="notification-card-text">
                                        <h1>Students</h1>
                                        <p id="participant_student_count">-</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="nofitication-card shadow" style="margin-bottom: 10px">
                                    <div class="notification-card-icon bg-col-2">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="notification-card-text">
                                        <h1>Mentors</h1>
                                        <p id="participant_mentor_count">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="nofitication-card shadow" style="margin-bottom: 10px">
                                    <div class="notification-card-icon bg-col-3">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="notification-card-text">
                                        <h1>Lecturers</h1>
                                        <p id="participant_lecturer_count">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('custom-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        // this will instantiate a version of WidgetCore
        let wc = new WidgetCore("<?php echo laravel_lti()->get_role(auth()->user()) ?>");
        wc.setupBindings();
    });
</script>
@endsection