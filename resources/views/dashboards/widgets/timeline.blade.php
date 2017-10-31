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
                        <div id="calendar-timeline"></div>
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
    $(document).ready(function () {
        // this will instantiate a version of WidgetCore
        let wc = new WidgetCore("<?php echo laravel_lti()->get_role(auth()->user()) ?>");
        wc.setupBindings();
    });
</script>
@endpush