<div class="row">
    <div class="col-md-12 sp-top-15">
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Course Results
            </div>

            <div class="row sp-top-15 sp-bot-15 basic-clearfix">

                <div class="col-md-4">
                    <div class="container-fluid">
                        <h3>Filters</h3>
                        <label for="course-filter">Module</label>
                        <select class="form-control" id="course-filter">
                            <option value="FBN1501">FBN1501 - Business Numerical Skills A</option>
                            <option value="FBN1502">FBN1502 - Business Numerical Skills B</option>
                        </select>
                        <br>
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

                <div class="col-md-8">
                    <h3>Results</h3>
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

        
        // bind some events so that we
        // can simulate remote data store
        // bind some events so that we
        // can simulate remote data store
        var selected_course;
        var selected_assessment;

        // event for change on metrics
        $("#assessment-filter").on("change", function () {
            var self = $(this);
            selected_assessment = self.val();
            updateAssessmentTypes(selected_assessment);

            // lodash methods for rendering graph
            var courses = _.filter(results, _.iteratee({'course_id': selected_course, 'assessment': selected_assessment}));
            renderResultsGraph(_.head(courses));

            // lodash methods for rendering progression
            var prog = _.filter(progression, _.iteratee({'course_id': selected_course}));
            // these methods exist in other plugins but they
            // need to be triggered in the event they exist
            if (typeof $.fn.renderVideoProgressionGraph === "function") {
                $.fn.renderVideoProgressionGraph(_.head(prog));
            }
            if (typeof $.fn.renderEbookProgressionGraph === "function") {
                $.fn.renderVideoProgressionGraph(_.head(prog));
            }
            if (typeof $.fn.renderArticleProgressionGraph === "function") {
                $.fn.renderVideoProgressionGraph(_.head(prog));
            }
            if (typeof $.fn.renderStudyGuideProgressionGraph === "function") {
                $.fn.renderVideoProgressionGraph(_.head(prog));
            }
        });

        $("#course-filter").on("change", function () {
            var self = $(this);
            selected_course = $(this).val();
            // trigger the assessment filter change event
            $("#assessment-filter").trigger("change");
        });
        // and lets just select the first record on page load
        $("#course-filter").trigger("change");

        // event for change on metric items
        $("#assessment-type-filter").on("change", function () {
            var self = $(this);
            // lodash methods for rendering graph
            var courses = _.filter(results, _.iteratee({'course_id': selected_course, 'assessment': selected_assessment, 'assessment_type_id': self.val()}));
            renderResultsGraph(_.head(courses));
        });

        function updateAssessmentTypes(a_type)
        {
            var select = $("#assessment-type-filter");
            select.empty();
            var items = _.filter(assessment_types, _.iteratee({'assessment': a_type}));
            $.each(items, function (idx, obj) {
                var option = new Option(obj.description, obj.assessment_type_id);
                select.append($(option));
            });
        }

        function renderResultsGraph(data) {
            // MH: this is a workaround to trash the canvas
            // .destroy() does not work :(
            $('#student-results').remove();
            $('#student-results-container').append('<canvas id="student-results"><canvas>');

            // pull a switch-a-roo on the labels and axis count
            if (data && data.labels.length < 1)
            {
                data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }

            var areaChartCanvas = $('#student-results').get(0).getContext('2d');

            var areaChartData = {
                labels: data.labels,
                datasets: [

                    {
                        label: 'Your Results',
                        backgroundColor: 'rgba(251, 114, 23, 1)',
                        borderWidth: 0,
                        data: data.your_results
                    },
                    {
                        label: 'Your Average',
                        backgroundColor: 'rgba(251, 158, 96, 1)',
                        borderWidth: 0,
                        data: data.your_average
                    },
                    {
                        label: 'Class Average',
                        backgroundColor: 'rgba(200, 200, 200, 1)',
                        borderWidth: 0,
                        data: data.class_average
                    }
                ]
            };


            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot: true,
                //Number - Radius of each point dot in pixels
                pointDotRadius: 1,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,

                scales: {
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                max: 100  // minimum value will be 0.
                            }
                        }]
                }
            };

            // In Chart.js 2.0.0 Alpha 3 onwards you will need to create your chart like so:
            var areaChart = new Chart(areaChartCanvas, {
                type: "bar",
                data: areaChartData,
                options: areaChartOptions
            });
        }
    });
</script>
@endpush