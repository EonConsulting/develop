@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <form method="POST" id="frmCreateCourse" action="{{ route('courses.create') }}" name="frmCreateCourse" class="form-horizontal">
        <div class="dashboard-card shadow">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div> <!-- end .flash-message -->
            <div class="dashboard-card-heading">
                <label>Course Information</label>
            </div>
            <div class="container-fluid">
                {{ csrf_field() }}
                <!--<input type="hidden" name="metadata_payload" id="metadata_payload" />-->
                <br>

                <div class="error-info"></div>

                <div>

                    <div class="col-md-8">
                        <div class="form-group" style="margin-right: 10px;">
                            <label>Module Title</label>
                            <input type="text" class="form-control" placeholder="Module Title" name="title" v-model="course_title" @keyup="make_course_slug">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="template">Template</label>
                            <select class="form-control" name="template" id="">

                                <?php foreach($templates as $template): ?>

                                <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>

                                <?php endforeach; ?>

                            </select>
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
                        <input type="text" class="form-control tags" name="tags"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btnSubmit">Submit</button>
                    </div>
                </div>
                <br>
            </div>
        </div>

    </form>
</div>
@endsection

@section('exterior-content')
<div id="metadataModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="saveMetadata" action="{{ route('eon.admin.metadata-item.save') }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title meta-title"></h4>
                </div>

                <div class="modal-body">
                    <div class="metamsg-info"></div> 
                    <div class="form-group">
                        {{ Form::label('metadata_type_id', 'Metadata Type') }}   
                        {{ Form::select('metadata_type_id', $metadataType, null, array('placeholder' => 'Please select ...','class' => 'form-control metadata-ch')) }}
                        {{ Form::hidden('course_id',null,array('id' => 'course-id'))}}
                    </div>

                    <div class="form-group metadata-list">

                    </div>
                </div>

                <div class="modal-footer meta-footer">
                    <button type="submit" class="btn btn-success meta-submit">Submit</button>   
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>   
<!-- Modal -->
<div id="msgModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body modal-info">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@endsection

@section('custom-scripts')
<!-- lodash -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>-->
<!--<script src="{{url('/js/app.js')}}"></script>-->
<script>
    $(document).ready(function () {
        $("#frmCreateCours").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = '{{ route("courses.create") }}';
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if ($.isEmptyObject(data.error)) {
                        $("#metadataModal").modal();
                        $("#course-id").val(data.course);
                    } else {
                        $(".error-info").html("<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! </strong>" + data.error + "</div>");
                    }
                    $('.btnSubmit').text("Submit");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        $(".metadata-ch").change(function () {
            var id = $(this).val();
            $(this).val(id);
            var url = '{{ route("metadata.list",":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    $(".metadata-list").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        $("#saveMetadata").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = '{{ route("courses.storemetadata") }}';
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.success) {
                        $(".metamsg-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                        $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                    } else {
                        $(".metamsg-info").html("<div class='alert alert-error alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! </strong>" + data.success + "</div>");
                        $('.btnSubmit').text("Submit");
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });
    });
</script>

@endsection
