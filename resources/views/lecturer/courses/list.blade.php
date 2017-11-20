@extends('layouts.app')

@section('page-title')
    Course List
@endsection

@section('custom-styles')

<style>
    .dropdown-link {
        display: block;
        margin-bottom: 5px;
    }

    .dropdown-menu {
        padding: 5px 10px 0px 10px;
    }

</style>

@endsection

@section('content')
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="tok" value="{{ csrf_token() }}" />
                <div class="panel panel-default">
                    <div class="panel-heading">Modules <a href="{{ route('courses.create') }}" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a><div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Courses.."></div><div class="clearfix"></div></div>
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
                        <tbody>
                        @foreach($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->creator->name }}</td>
                                <td>
                                    <a href="{{ route('storyline2.lecturer.edit', $course->id) }}" class="btn btn-success btn-sm">Storyline</a>
                                    {{--<a href="{{ route('storyline2.courses.single.notify', $course->id) }}" class="btn btn-info btn-xs" style="width:60px">Notify</a>--}}
                                   
                                    <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                        <div class="dropdown-menu">
                                            <!--<button class="dropdown-item notifyId" type="button" id="{{$course->id}}"><i class="fa fa-bell"></i>Notify</button>-->
                                            <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Module</a>
                                            <a href="{{ route('metadata.list', $course->id) }}" class="metadataId dropdown-link" id="{{$course->id}}"><i class="fa fa-tags"></i> Metadata</a>
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


@endsection
@endsection

@section('custom-scripts')

    <script src="{{url('/js/app.js') }}"></script>

    <script>
        $(document).ready(function($) {
            var _token = $('#tok').val();            
            $(".moduleId").click(function () {
            var text = $(this).text();
            var id = $(this).attr('id');
            var url = '{{ route("courses.edit") }}';          
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: {id:id, text:text},
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                   $("#formModal").modal();                  
                     if(text === 'Module'){                   
                     $(".data-title").text('Edit Module');
                     }else{
                     $(".data-title").text('Edit Metadata');
                     $("#saveModule").attr('id','saveMetadata');
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
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if(data.success){
                      $(".msgdata-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                      $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                       } else{
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
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if(data.success){
                      $(".msgdata-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                      $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                       } else{
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
