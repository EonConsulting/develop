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
                    <div class="panel-heading">Metadata Store <a href="#" id="meta-store" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a><div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Metada store..."></div><div class="clearfix"></div></div>
                    <table class="panel-body table table-hover table-striped" id="meta-table">
                        <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-5">Metadata Type</th>
                                <th class="col-md-2"># Description</th>
                                <th class="col-md-2"># Classification</th>
                                <th class="col-md-2"># Sequence</th>
                                <th class="col-md-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($metadatas as $index => $metadata)
                                <tr class="clickable-row" data-href="{{ route('eon.admin.roles.single', $metadata->id) }}" data-roleid="{{ $metadata->id }}">
                                    <a href="">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $metadata->metadata_type }}</td>
                                        <td>{{ $metadata->description }}</td>
                                        <td>{{ $metadata->classification }}</td>
                                        <td>{{ $metadata->sequence }}</td>
                                        
                                        <td>
                                         <button type="button" class="remove-metadata btn btn-danger btn-xs" data-roleid="{{ $metadata->id }}">Remove</button>
                                         <button type="button" class="edit-metadata btn btn-primary btn-xs" data-roleid="{{ $metadata->id }}">Edit</button>
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
   @section('exterior-content')
        <div id="metaModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
             <form id="saveMeta" action="{{ route('eon.admin.metadata.save') }}">
                <div class="modal-header">
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
   @endsection
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function($) {
            var _token = $('#tok').val();

            $("#meta-store").click(function(){
               $("#metaModal").modal();
               var url = '{{ route('eon.admin.metadata.create') }}';
               $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.data-info').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR)
                {
                    $(".meta-title").text('Create Metadata');
                    $(".meta-submit").text('Submit');
                    $(".data-info").html(data);
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
              });
            });
            
            $(".edit-metadata").click(function(event){
               event.preventDefault();
               $("#metaModal").modal();
               var id = $(this).attr('data-roleid');               
               var url = '{{ route("eon.admin.metadata.edit",":id") }}';
               url = url.replace(':id', id);
               //alert(url);
               $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.data-info').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR)
                {
                    $(".meta-title").text('Edit Metadata');
                    $(".meta-submit").text('Submit');
                    $(".data-info").html(data);
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    //location.reload();
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
                    success: function (data, textStatus, jqXHR){
                       	       if($.isEmptyObject(data.error)){
                                   printSuccessMsg (data.success);
                                   setTimeout(function(){                                      
                                       location.reload();
                                   },3000);
	                        }else{                                     
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
            
            function printErrorMsg (msg) {
			$(".print-error-msg").find("ul").html('');
			$(".print-error-msg").css('display','block');
			$.each( msg, function( key, value ) {
				$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
			});
		}   
            
            function printSuccessMsg (msg) {                        
                        $('.alert-danger').removeClass('alert-danger').addClass('alert-success');
			$(".print-error-msg").find("ul").html('');
			$(".print-error-msg").css('display','block');
			$(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
		
		}     
            
            $('.clickable-row').on('click', '.remove-group', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var role_id = $(this).data('roleid');

                var url = '{{ route('eon.admin.roles.delete') }}';
                url = url.replace('--role--', role_id);

                $('.clickable-row[data-roleid="' + role_id + '"]').hide();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {_token: _token},
                    success: function(res) {
                        console.log('res', res);
                        if(res.hasOwnProperty('success')) {
                            if(res.success) {
                                $('.clickable-row[data-roleid="' + role_id + '"]').remove();
                            } else {
                                $('.clickable-row[data-roleid="' + role_id + '"]').hide();
                                alert(res.error_messages);
                            }
                        }
                    },
                    error: function(res) {
                        console.log('res', res);
                        $('.clickable-row[data-roleid="' + role_id + '"]').hide();
                    }
                });
            });

            $(".clickable-row").click(function() {
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
