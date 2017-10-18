<div class="row">
    <div class="col-md-6 sp-top-15">
        <div class="dashboard-card shadow top-bdr-4">

            <div class="dashboard-card-heading">
                Top Content
            </div>

            <div class="basic-clearfix">
                <div class="progress-charts basic-clearfix">
                    <div class="container-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Topic</th>
                                    <th>Count</th>
                                    <th>Time Spent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>FBN1501</td>
                                    <td>Curves</td>
                                    <td>99</td>
                                    <td>8h20m</td>
                                    <td><a href="" class="btn btn-small btn-info">View</a></td>
                                </tr>
                                <tr>
                                    <td>FBN1501</td>
                                    <td>Curves</td>
                                    <td>99</td>
                                    <td>6h10m</td>
                                    <td><a href="" class="btn btn-small btn-info">View</a></td>
                                </tr>
                                <tr>
                                    <td>FBN1501</td>
                                    <td>Curves</td>
                                    <td>99</td>
                                    <td>5h23m</td>
                                    <td><a href="" class="btn btn-small btn-info">View</a></td>
                                </tr>
                            </tbody>
                        </table>
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