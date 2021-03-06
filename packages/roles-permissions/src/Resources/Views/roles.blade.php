@extends('layouts.app')

@section('custom-styles')
<link rel="stylesheet" type="text/css" href="/vendor/roles/css/font-awesome.css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="tok" value="{{ csrf_token() }}" />
            <div class="panel panel-default">
                <div class="panel-heading">Roles <a href="#" id="add-role" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a><div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Roles.."></div><div class="clearfix"></div></div>
                <table class="panel-body table table-hover table-striped" id="roles-table">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-5">Role</th>
                            <th class="col-md-5">Description</th>
                            <th class="col-md-5">Created</th>
                            <th class="col-md-5">Updated</th>
                            <th class="col-md-2">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $index => $role)
                        <tr class="" data-href="{{ route('eon.admin.roles.single', $role->id) }}" data-roleid="{{ $role->id }}">
                    <a href="">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>
                            <button type="button" class="remove-role btn btn-danger btn-xs" data-roleid="{{ $role->id }}">Remove</button>
                            <button type="button" class="edit-role btn btn-primary btn-xs" data-roleid="{{ $role->id }}">Edit</button>
                        </td>
                    </a>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<div id="roleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="saveMeta" action="{{ route('eon.admin.roles.save') }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title meta-title"></h4>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="data-info">

                    </div>
                </div>

                <div class="modal-footer">
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

@section('custom-scripts')
<script>
    $(document).ready(function ($) {
        var _token = $('#tok').val();

        $("#add-role").click(function () {
            $("#roleModal").modal();
            var action = '{{ route("eon.admin.roles.create") }}';
            $('#saveMeta').attr('action', action);
            var url = '{{ route("eon.admin.roles.create") }}';
            $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.data-info').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR)
                {
                    $(".meta-title").text('Create Role');
                    $(".meta-submit").text('Submit');
                    $(".data-info").html(data);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        $(document).on('submit', '#saveMeta', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr("action");
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.meta-submit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if ($.isEmptyObject(data.error)) {
                        printSuccessMsg(data.success);
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        printErrorMsg(data.error);
                    }
                    $('.meta-submit').text("Submit");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        $(".edit-role").click(function () {
            $("#roleModal").modal();
            var id = $(this).attr('data-roleid');
            var action = '{{ route("eon.admin.roles.update",":id") }}';
            action = action.replace(':id', id);
            $('#saveMeta').attr('action', action);
            var url = '{{ route("eon.admin.roles.edit",":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.data-info').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR) {
                    $(".meta-title").text('Edit Role');
                    $(".meta-submit").text('Submit');
                    $(".data-info").html(data);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    //location.reload();
                }
            });
        });

        $(document).on('submit', '#updateMeta', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr("action");
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.meta-submit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if ($.isEmptyObject(data.error)) {
                        printSuccessMsg(data.success);
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        printErrorMsg(data.error);
                    }
                    $('.meta-submit').text("Submit");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        $(".remove-role").click(function () {
            var id = $(this).attr('data-roleid');
            var url = '{{ route("eon.admin.roles.delete",":id") }}';
            url = url.replace(':id', id);
            var r = confirm("Are you sure");
            if (r == true) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    asyn: false,
                    headers: {
                        'X-CSRF-Token': _token
                    },
                    success: function (data, textStatus, jqXHR) {
                        if ($.isEmptyObject(data.error)) {
                            $(".modal-info").html("<div class='alert alert-success modal-msg'>" + data.success + "</div>");
                            modalMsg();
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        } else {
                            $(".modal-info").html("<div class='alert alert-danger modal-msg'>" + data.error + "</div>");
                            modalMsg();
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        //location.reload();
                    }
                });
            }
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




        $(".clickable-row").click(function () {
            window.document.location = $(this).data("href");
        });
    });
    function search() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("txt_search");
        filter = input.value.toLowerCase();
        table = document.getElementById("roles-table");
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
