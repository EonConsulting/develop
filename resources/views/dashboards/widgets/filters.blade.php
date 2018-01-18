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
                Course Filters
            </div>

            <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                <div class="col-md-12">
                    <div class="container-fluid">
                        <label for="module-filter">Module</label>
                        <select class="form-control" id="module-filter">
                        </select>
                        <br>
                        <label for="student-filter">Student</label>
                        <select class="form-control" id="student-filter">
                        </select>
                        <button class="btn btn-xs pull-right" id="btnUpdateModuleGraphs">UPDATE GRAPH</button>
                        <br/>
                        <hr>
                        <br/>
                        <label for="assessment-filter">Assessment</label>
                        <select class="form-control" id="assessment-filter">
                            <option value="FA">Formative Assessment</option>
                            <option value="SA">Summative Assessment</option>
                        </select>
                        <br>
                        <label for="assessment-type-filter">Assessment Type</label>
                        <select class="form-control" id="assessment-type-filter">
                        </select>
                        <button class="btn btn-xs pull-right" id="btnUpdateAssessGraphs">UPDATE GRAPH</button>
                    </div>
                </div> <!-- end col-md-4 -->
            </div>
        </div>
    </div>
</div>