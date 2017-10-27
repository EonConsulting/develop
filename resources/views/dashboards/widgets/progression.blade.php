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
                Module Progression
            </div>

            <div class="basic-clearfix">

                <div class="progress-charts basic-clearfix">

                    <div class="col-md-3 main-chart">
                        <h2>Study Guide</h2>
                        <div class="container-fluid" id="study-guide-progression-container" style="height: 300px;">
                            <canvas id="study-guide-progression"></canvas>
                        </div>
                    </div><!-- end col-md-8 -->

                    <div class="col-md-9">
                        <div class="row basic-clearfix">
                            <div class="col-md-4">
                                <h3>Videos</h3>
                                <div class="container-fluid" id="video-progression-container" style="height: 300px;">
                                    <canvas id="video-progression"></canvas>
                                </div>
                            </div> <!-- end col-md-4 -->

                            <div class="col-md-4">
                                <h3>E-Books</h3>
                                <div class="container-fluid" id="ebook-progression-container" style="height: 300px;">
                                    <canvas id="ebook-progression"></canvas>
                                </div>
                            </div><!-- end col-md-8 -->

                            <div class="col-md-4">
                                <h3>Articles</h3>
                                <div class="container-fluid" id="article-progression-container" style="height: 300px;">
                                    <canvas id="article-progression"></canvas>
                                </div>
                            </div><!-- end col-md-8 -->

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
