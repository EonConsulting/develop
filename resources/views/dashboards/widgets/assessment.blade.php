<div class="row">
    <div class="col-md-6 sp-top-15">
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Student Assessment
            </div>

            <div class="basic-clearfix">
                <div class="progress-charts basic-clearfix">
                    <div class="container-fluid">

                        <div class="container-fluid" id="student-assessment-container" style="height: 400px;">
                            <canvas id="student-assessment"></canvas>
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