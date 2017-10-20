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
                Course Filters
            </div>

            <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                <div class="col-md-12">
                    <div class="container-fluid">
                        <label for="module-filter">Module</label>
                        <select class="form-control" id="module-filter">
                            <option value="FBN1501">FBN1501 - Business Numerical Skills A</option>
                            <option value="FBN1502">FBN1502 - Business Numerical Skills B</option>
                        </select>
                        <br>
                        <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                            <label for="student-filter">Student</label>
                            <select class="form-control" id="student-filter">
                                <option value="ALL">ALL</option>
                                <option value="S1">1234 - Hlobisile Student</option>
                                <option value="S2">5678 - Student 2</option>
                                <option value="S3">5679 - Student 3</option>
                            </select>
                            <br/>
                        <?php endif; ?>
                        <?php if (laravel_lti()->is_mentor(auth()->user())): ?>                            
                            <label for="student-filter">Student</label>
                            <select class="form-control" id="student-filter">
                                <option value="ALL">ALL</option>
                                <option value="S1">1234 - Hlobisile Student</option>
                                <option value="S2">5678 - Student 2</option>
                            </select>
                            <br/>
                        <?php endif; ?>                            
                        <label for="assessment-filter">Assessment</label>
                        <select class="form-control" id="assessment-filter">
                            <option value="FA">Formative Assessment</option>
                            <option value="SA">Summative Assessment</option>
                        </select>
                        <br>
                        <label for="assessment-type-filter">Assessment Type</label>
                        <select class="form-control" id="assessment-type-filter">
                        </select>
                    </div>
                </div> <!-- end col-md-4 -->
            </div>
        </div>
    </div>
</div>