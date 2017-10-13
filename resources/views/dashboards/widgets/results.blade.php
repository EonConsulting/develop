<div class="row">
    <div class="col-md-12 sp-top-15">
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Module Results
            </div>

            <div class="row sp-top-15 sp-bot-15 basic-clearfix">
                <div class="col-md-8">
                    <div class="container-fluid" id="student-results-container" style="height: 300px;">
                        <canvas id="student-results"></canvas>
                    </div>
                </div><!-- end col-md-8 -->
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        // this will instantiate a version of WidgetCore
        let wc = new WidgetCore("<?php echo laravel_lti()->get_role(auth()->user()) ?>");
        wc.setupBindings("results");
    });
</script>
@endpush