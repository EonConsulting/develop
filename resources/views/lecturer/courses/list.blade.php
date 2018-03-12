@extends('layouts.app')

@section('page-title')
Course List
@endsection

@section('custom-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<style>
    .dropdown-link {
        display: block;
        margin-bottom: 5px;
    }

    .dropdown-menu {
        padding: 5px 10px 0px 10px;
    }
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }   

</style>
@endsection
@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="tok" value="{{ csrf_token() }}" />
            <div class="panel panel-default">
                <div class="panel-heading">Modules <a href="{{ route('courses.create') }}" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a>                   
                    <div class="col-md-4 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Courses.."></div>
                    <div class="col-md-4 btn-group pull-right" id="radioBtn">
                        <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="my">My Modules</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="all">All Modules</a>
                    </div>
                    <div class="clearfix"></div>                       
                </div>
                <table class="panel-body table table-hover table-striped" id="courses-table">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-3">Title</th>
                            <th class="col-md-4">Description</th>
                            <th class="col-md-2">Instructor</th>
                            <th class="col-md-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="module-view">
                        @foreach($courses as $index => $course)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->creator->name }}</td>
                            <td>
                                <a href="{{ route('storyline2.lecturer.edit', $course->id) }}" class="btn btn-info btn-sm">Storyline</a>
                                <a href="{{ route('storyline2.preview', $course->id) }}" class="btn btn-success btn-sm">Preview</a>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Edit Module</a>
                                        <a href="#" class="notifyId dropdown-link" type="button" data-id="{{$course->id}}" data-toggle="modal" data-target="#notificationModal"><i class="fa fa-envelope"></i> Notify</a>
                                        <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Module</a>
                                        <a href="{{ route('metadata.list', $course->id) }}" class="metadataId dropdown-link" id="{{$course->id}}"><i class="fa fa-tags"></i> Metadata</a>
                                        <a href="#" class="marksId dropdown-link" id="{{$course->id}}"><i class="fa fa-file-excel-o"></i> Export Marks</a>

                                        <a href="{{ route('export.full-html-export', $course) }}" class="dropdown-link"><i class="fa fa-tags"></i> Export Full Course</a>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('exterior-content')

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="saveModule" action="{{ route('course-metadata.update') }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title data-title"></h4>
                </div>

                <div class="modal-body edit-data">

                </div>
                <div class="modal-footer meta-footer">
                    <button type="submit" class="btn btn-success meta-submit">Submit</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>

<div id="csvModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assessment Results Period</h4>
            </div>
            <form id="m-res">
                <div class="modal-body csv-loadig">  
                    <div class="m-res-info"></div>
                    <div class="form-group">
                        <div class="container">
                            <div class='col-md-3'>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="dt_from">Start Date:</label>
                                    <div class='input-group date' id='dt_from'>
                                        <input type='text' class="form-control" name="dt_from"/>                                   
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <input type='hidden' class="form-control courseId" name="course_id"/>
                            </div>
                            <div class='col-md-3'>
                                <div class="form-group">
                                    <label for="dt_to">End Date:</label>
                                    <div class='input-group date' id='dt_to'>
                                        <input type='text' class="form-control " name="dt_to"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Export</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('package-css')
<style>
    .badgebox { opacity: 0; }
    .badgebox + .badge { text-indent: -999999px; width: 27px; }
    .badgebox:focus + .badge { box-shadow: inset 0px 0px 5px; }
    .badgebox:checked + .badge { text-indent: 0; }
</style>
@endpush

<!-- Notification Model -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('storyline2.courses.single.notify') }}" method="post" id="notification-form">
                {{ csrf_field() }}
                <input type="hidden" name="course_id" value="" />

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Course Notification</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="primary" class="btn btn-primary">Email <input type="checkbox" id="primary" class="badgebox" name="options[]" value="mail"><span class="badge">&check;</span></label>
                        <label for="info" class="btn btn-info">SMS <input type="checkbox" id="info" class="badgebox" name="options[]" value="nexmo"><span class="badge">&check;</span></label>
                        <label for="success" class="btn btn-success">In system notice <input type="checkbox" id="success" class="badgebox" name="options[]" value="database" checked><span class="badge">&check;</span></label>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" style="height: 150px;"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Notifications</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@endsection

@section('custom-scripts')

<script src="{{url('/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>

                        $('.notifyId').on('click', function ()
                        {
                            $("#notification-form input[name='course_id']").val($(this).data('id'));
                        });

                        $(document).ready(function ($) {
                            var _token = $('#tok').val();

                            $(".moduleId").click(function (event) {
                                event.preventDefault();
                                var text = $(this).text();
                                var id = $(this).attr('id');
                                var url = '{{ route("courses.edit") }}';

                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: {id: id, text: text},
                                    beforeSend: function () {
                                        $('.btnSubmit').text("Saving.....");
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        $("#formModal").modal();
                                        if (text === 'Module') {
                                            $(".data-title").text('Edit Module');
                                        } else {
                                            $(".data-title").text('Edit Metadata');
                                            $("#saveModule").attr('id', 'saveMetadata');
                                        }

                                        $(".edit-data").html(data);
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert(errorThrown);
                                        location.reload();
                                    }
                                });
                            });

                            $("#saveModule").submit(function (event) {
                                event.preventDefault();
                                var formData = $(this).serialize();
                                var url = '{{ route("courses.update") }}';
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: formData,
                                    beforeSend: function () {
                                        $('.btnSubmit').text("Saving.....");
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        if (data.success) {
                                            $(".msgdata-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                                            $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                                        } else {
                                            $(".msg-info").html("<div class='alert alert-error alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! </strong>" + data.success + "</div>");
                                            $('.btnSubmit').text("Submit");
                                        }
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
                                var url = '{{ route("course-metadata.update") }}';
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: formData,
                                    beforeSend: function () {
                                        $('.btnSubmit').text("Saving.....");
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        if (data.success) {
                                            $(".msgdata-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                                            $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                                        } else {
                                            $(".msg-info").html("<div class='alert alert-error alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! </strong>" + data.success + "</div>");
                                            $('.btnSubmit').text("Submit");
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert(errorThrown);
                                        location.reload();
                                    }
                                });
                            });

                            $('#dt_from').datetimepicker({
                                //viewMode: 'years',
                                format: 'DD-MMM-YYYY'
                            });

                            $('#dt_to').datetimepicker({
                                //viewMode: 'years',
                                format: 'DD-MMM-YYYY'
                            });

                            $(".marksId").click(function (event) {
                                event.preventDefault();
                                $(".courseId").val($(this).attr("id"));
                                $("#csvModal").modal();
                            });

                            $("#m-res").on("submit", function (event) {
                                event.preventDefault();
                                var data = $(this).serialize();
                                var url = '{{ route("module.export-marks") }}';
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: data,
                                    beforeSend: function () {
                                        $('.csv-loading').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Exporting marks to CSV....</button>");
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        if (data.res == '200') {
                                            $(".m-res-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.msg + "</div>");
                                            window.location.href = "{{ url("") }}/module/csv/download/" + data.id + '/' + data.from + '/' + data.to;
                                        } else {
                                            $(".m-res-info").html("<div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning! </strong>" + data.msg + "</div>");
                                            //$('.btnSubmit').text("Submit");
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert(errorThrown);
                                        //location.reload();
                                    }
                                });
                            });

                            $('#radioBtn a').on('click', function () {
                                var sel = $(this).data('title');
                                var tog = $(this).data('toggle');
                
                                $('#' + tog).prop('value', sel);
                                $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
                                $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');    
                                 var url = '{{ route("courses.show",":title") }}';    
                                 url = url.replace(':title', sel);                     
                                 $.ajax({
                                    url: url,
                                    type: "GET",
                                    beforeSend: function () {
                                        $('.module-view').html("<i class='fa fa-spinner fa-spin'></i>");
                                    },
                                    success: function (data, textStatus, jqXHR) {
                                        $(".module-view").html(data);
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                      
                                    }
                                });
                            })

                        });

                        function search() {
                            // Declare variables
                            var input, filter, table, tr, td, i;
                            input = document.getElementById("txt_search");
                            filter = input.value.toLowerCase();
                            table = document.getElementById("courses-table");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[1];
                                if (td) {
                                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }
</script>
@endsection
