@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <form method="POST" id="edit-form" name="frmCreateCourse" class="form-horizontal">
            <div class="col-md-12">
                <div class="dashboard-card shadow">
                    <div class="dashboard-card-heading">
                        <label>Course Information</label>
                    </div>
                    <div class="container-fluid">
                        {{ csrf_field() }}
                        <input type="hidden" name="metadata_payload" id="metadata_payload" />
                        <div class="form-group">
                            <div class="col-md-12">
                                {{ Form::label('title', 'Module Title') }}
                                {{ Form::hidden('id', $course->id, array('id' => 'form-id')) }}
                                {{ Form::text('title', $course->title, array('class' => 'form-control')) }}
                            </div>
                            <!--<div class="col-md-4">
                              <label>Module Slug</label>
                               <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon3">modules/</span>
                                   <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled v-model="course_slug">
                               </div>
                           </div>-->
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {{ Form::label('description', 'Module Summary') }}
                                {{ Form::textarea('description', $course->description, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {{ Form::label('tags', 'Tags (Separate by a comma)') }}
                                {{ Form::text('tags', $course->description, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <!--<div class="form-group">
                          <div class="col-md-4">
                                <label>Featured Image</label>
                                <upload-form></upload-form>
                            </div>
                        </div>-->
                        <!-- div class="pull-right">
                            <input class="btn btn-success" type="submit" value="Submit" />
                        </div -->

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-success" id="btnSubmit">Submit</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            </div>

        </form>
    </div>

    <!--<div class="row">
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
</div>-->  
    @endsection
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
                <a href="{{ route('courses') }}" class="btn btn-default">OK</a>
            </div>
        </div>

    </div>
</div>
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
            // submit the form after populating the metadata hidden input
            $("#edit-form").submit(function (e) {
                e.preventDefault();
                var id = $("#form-id").val();               
                var formData = $(this).serialize();
                var url = '{{ route("courses.update",":id") }}';
                url = url.replace(':id', id);
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
                            $(".modal-info").html("<div class='alert alert-success modal-msg'>" + data.success + "</div>");
                            modalMsg();
                        } else {
                            $(".modal-info").html("<div class='alert alert-danger modal-msg'>" + data.error + "</div>");
                            modalMsg();
                        }
                        $('.btnSubmit').text("Submit");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        location.reload();
                    }
                });
            });
            
            function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }

        function printSuccessMsg(msg) {
            $('.alert-danger').removeClass('alert-danger').addClass('alert-success');
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-error-msg").find("ul").append('<li>' + msg + '</li>');

        }

        function modalMsg() {
            $("#msgModal").modal();
        }

        });
    </script>
    @endsection
