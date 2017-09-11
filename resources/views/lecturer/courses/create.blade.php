@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <form method="POST" class="form-horizontal">
            <div class="col-md-12">
                <div class="dashboard-card shadow">
                    <div class="dashboard-card-heading">
                        <label>Course Information</label>
                    </div>
                    <div class="container-fluid">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Module Title</label>
                                <input type="text" class="form-control" placeholder="Module Title" name="title" v-model="course_title" @keyup="make_course_slug">
                            </div>
                            <div class="col-md-4">
                                <label>Module Slug</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">modules/</span>
                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled v-model="course_slug">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Module Summary</label>
                                <textarea class="form-control" name="description" placeholder="Module Summary" v-model="course_summary" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Tags <small>(Separate by a comma)</small></label>
                                <input type="text" class="form-control tags"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Featured Image</label>
                                <!--<upload-form></upload-form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-card shadow">
                <div class="dashboard-card-heading">
                    <label>Meta Information</label>
                </div>
                <div class="container-fluid">	
                    <p>Please choose metadata items</p>
                    <div class="form-group">
                        <div class="col-md-4">
                            <select id="metadata_store_list" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <div id="metadata_forms"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-scripts')
<!-- lodash -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="{{url('/js/app.js')}}"></script>
<script>
$(document).ready(function () {
    $('#login-token').val(window.Laravel.csrfToken);
});
</script>
<script>
    $(document).ready(function () {
        // some vars for re-use
        var dataSet = null;

        // main ajax method for select
        $.ajax({
            method: "GET",
            url: global_conf.subdir + '/lecturer/courses/create/metadata',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            statusCode: {
                200: function (data) {
                    dataSet = data;
                    // using lodash to get the metadata types
                    var mtypes = _.groupBy(data, "metadata_type");
                    $.each(mtypes, function (idx, obj) {
                        var option = new Option(idx, obj.metadata_type);
                        $("#metadata_store_list").append($(option));
                    });
                },
                400: function () {
                },
                500: function () {
                }
            }
        }).error(function (data) {
        });

        // and now some magic when u click on the select
        $("#metadata_store_list").on("click", function () {
            buildForm($(this).val());
        });

        // re-usable form builder
        function buildForm(mtype)
        {
            $("#metadata_forms").html('');

            var _fields = _.filter(dataSet, _.iteratee({'metadata_type': mtype}));
            $.each(_fields, function (idx, obj) {
                $("#metadata_forms").html(obj.description);
            });
        }
    });
</script>
@endsection
