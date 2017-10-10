<div class="row">
    <div class="col-md-12 sp-top-15">
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

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $.fn.renderVideoProgressionGraph = function(data) {
            // MH: this is a workaround to trash the canvas
            // .destroy() does not work :(
            $('#video-progression').remove();
            $('#video-progression-container').append('<canvas id="video-progression"><canvas>');

            // pull a switch-a-roo on the labels and axis count
            var labels = ['Progress'];
            var areaChartCanvas = $('#video-progression').get(0).getContext('2d');

            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Class Progress',
                        backgroundColor: 'rgba(0, 192, 239, 1)',
                        //borderColor: 'rgba(0, 192, 239, 1)',
                        borderWidth: 0,
                        data: data.progress.videos.class_progress
                    },
                    {
                        label: 'My Progress',
                        backgroundColor: 'rgba(111, 215, 241, 1)',
                        //borderColor: 'rgba(221, 75, 57, 1)',
                        borderWidth: 0,
                        data: data.progress.videos.my_progress
                    },
                    {
                        label: 'Course Timeline',
                        backgroundColor: 'rgba(200, 200, 200, 1)',
                        //borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 0,
                        data: data.progress.videos.course_timeline
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
        };

        $.fn.renderEbookProgressionGraph = function(data) {
            // MH: this is a workaround to trash the canvas
            // .destroy() does not work :(
            $('#ebook-progression').remove();
            $('#ebook-progression-container').append('<canvas id="ebook-progression"><canvas>');

            // pull a switch-a-roo on the labels and axis count
            var labels = ['Progress'];
            var areaChartCanvas = $('#ebook-progression').get(0).getContext('2d');

            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Class Progress',
                        backgroundColor: 'rgba(221, 75, 57, 1)',
                        //borderColor: 'rgba(0, 192, 239, 1)',
                        borderWidth: 0,
                        data: data.progress.ebooks.class_progress
                    },
                    {
                        label: 'My Progress',
                        backgroundColor: 'rgba(226, 145, 135, 1)',
                        //borderColor: 'rgba(221, 75, 57, 1)',
                        borderWidth: 0,
                        data: data.progress.ebooks.my_progress
                    },
                    {
                        label: 'Course Timeline',
                        backgroundColor: 'rgba(200, 200, 200, 1)',
                        //borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 0,
                        data: data.progress.ebooks.course_timeline
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
        };

        $.fn.renderArticleProgressionGraph = function(data) {
            // MH: this is a workaround to trash the canvas
            // .destroy() does not work :(
            $('#article-progression').remove();
            $('#article-progression-container').append('<canvas id="article-progression"><canvas>');

            // pull a switch-a-roo on the labels and axis count
            var labels = ['Progress'];
            var areaChartCanvas = $('#article-progression').get(0).getContext('2d');

            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Class Progress',
                        backgroundColor: 'rgba(0, 166, 90, 1)',
                        //borderColor: 'rgba(0, 192, 239, 1)',
                        borderWidth: 0,
                        data: data.progress.articles.class_progress
                    },
                    {
                        label: 'My Progress',
                        backgroundColor: 'rgba(91, 211, 157, 1)',
                        //borderColor: 'rgba(221, 75, 57, 1)',
                        borderWidth: 0,
                        data: data.progress.articles.my_progress
                    },
                    {
                        label: 'Course Timeline',
                        backgroundColor: 'rgba(200, 200, 200, 1)',
                        //borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 0,
                        data: data.progress.articles.course_timeline
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
        };

        $.fn.renderStudyGuideProgressionGraph = function(data) {
            // MH: this is a workaround to trash the canvas
            // .destroy() does not work :(
            $('#study-guide-progression').remove();
            $('#study-guide-progression-container').append('<canvas id="study-guide-progression"><canvas>');

            // pull a switch-a-roo on the labels and axis count
            var labels = ['Progress'];
            var areaChartCanvas = $('#study-guide-progression').get(0).getContext('2d');

            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Class Progress',
                        backgroundColor: 'rgba(251, 114, 23, 1)',
                        //borderColor: 'rgba(0, 192, 239, 1)',
                        borderWidth: 0,
                        data: data.progress.study_guide.class_progress
                    },
                    {
                        label: 'My Progress',
                        backgroundColor: 'rgba(251, 158, 96, 1)',
                        //borderColor: 'rgba(221, 75, 57, 1)',
                        borderWidth: 0,
                        data: data.progress.study_guide.my_progress
                    },
                    {
                        label: 'Course Timeline',
                        backgroundColor: 'rgba(200, 200, 200, 1)',
                        //borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 0,
                        data: data.progress.study_guide.course_timeline
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
        };
    });
</script>
@endpush
