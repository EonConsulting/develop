<div class="row">
    <?php switch($size): case "small": ?>
        <div class="col-md-3 sp-top-15">
    <?php break; case "medium": ?>
        <div class="col-md-6 sp-top-15">
    <?php break; case "large": default: ?>
        <div class="col-md-12 sp-top-15">
    <?php break; endswitch; ?>
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Student Engagement
            </div>

            <div class="basic-clearfix">
                <div class="progress-charts basic-clearfix">
                    <div class="container-fluid">

                        <label for="student-engagement-filter">Period</label>
                        <select class="form-control" id="student-engagement-filter">
                            <option value="today">Today</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="3-month">3 Month</option>
                            <option value="6-month">6 Month</option>
                            <option value="year">Year</option>
                        </select>

                        <div class="container-fluid" id="student-engagement-container" style="height: 400px;">
                            <canvas id="student-engagement"></canvas>
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