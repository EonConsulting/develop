@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <form method="POST" id="frmCreateCourse" name="frmCreateCourse" class="form-horizontal">
            <div class="col-md-12">
                <div class="dashboard-card shadow">
                    <div class="dashboard-card-heading">
                        <label>Course Information</label>
                    </div>
                    <div class="container-fluid">
                        {{ csrf_field() }}
                        <input type="hidden" name="metadata_payload" id="metadata_payload" />
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
                        <!-- div class="pull-right">
                            <input class="btn btn-success" type="submit" value="Submit" />
                        </div -->
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <button class="btn btn-success" id="btnSubmit">Submit</button>
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
                    <div class="col-md-4">
                        <p>Please choose metadata items</p>
                        <div class="form-group">
                            <select id="metadata_store_list" size="15" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
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
        var metaSet = [];

        // main ajax method for select
        $.ajax({
            method: "GET",
            url: global_conf.subdir + '/lecturer/courses/create/metadata',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "entities": "storyline"
            },
            statusCode: {
                200: function (data) {
                    dataSet = data;
                    console.log(dataSet);
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
        $("#metadata_store_list").on("change", function () {
            buildForm($(this).val());
        });

        // re-usable form builder
        function buildForm(mtype)
        {
            var form = $("#metadata_forms");
            form.html('');
            form.append('<form id="metadata_form_body" class="form-horizontal">');

            var fields = _.filter(dataSet, _.iteratee({'metadata_type': mtype}));
            $.each(fields, function (idx, obj) {
                form.append('<div class="form-group">'
                        + '<label for="check_' + obj.id + '" >' + obj.description + '</label>'
                        + '<input type="checkbox" data-id="' + obj.id + '" class="form-control" id="meta_check_' + obj.id + '" >'
                        + '<input type="text" data-id="' + obj.id + '" class="form-control" id="meta_value_' + obj.id + '" >'
                        + '</div>');
            });

            form.append('</form>');

            // bind the click events on all checkboxes
            $("input[id^='meta_check_']").on("click", function () {
                var self = $(this);
                var id = self.data("id");
                if (self.prop("checked")) {
                    // set the object checkbox and value in case someone dbl-checks
                    var value = $("input[id^='meta_value_" + id + "']").val();
                    metaSet.push({"id": id, "value": value});
                } else
                {
                    _.pullAllBy(metaSet, [{"id": id}], "id");
                }

                console.log(metaSet);
            });
            // bind the change event on all input texts
            $("input[id^='meta_value_']").on("change", function () {
                alert("value input changed");
            });
        }
        
        // submit the form after populating the metadata hidden input
        $("#btnSubmit").on("click", function(){
            // stringify the payload and json_decode on server side
            $("#metadata_payload").val(JSON.stringify(metaSet));
            $("#frmCreateCourse").submit();
        });
    });
</script>
@endsection
