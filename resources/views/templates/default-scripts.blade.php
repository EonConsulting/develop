<!-- Global JS Config -->
<script src="{{ url('/js/global-config.js') }}"></script>
<!-- jQuery 2.2.3 -->
<script src="{{ url('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Menu Collapse script -->
<script src="{{ url('/js/menu-collapse.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('/plugins/fastclick/fastclick.js') }}"></script>
{{--<script src="{{ url('/js/contextMenu.min.js') }}"></script>--}}
<!--Simple Bar-->
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.js"></script>

<script src="https://unpkg.com/sweetalert2@7.0.7/dist/sweetalert2.all.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
   $(document).ready(function(){
         $(".support").click(function(){
            $("#support").modal();
         });
         
         $(".close-m").click(function(){
            location.reload(); 
         });
        
         $('#support-m').submit(function (event) {

             event.preventDefault();

             var modal = $(this);

             if( ! $(modal).find('#subj').val() ) {
                 $(".v-alert").html("<div class='alert alert-warning'>\n\
                                   <a class='close' href='#' data-dismiss='alert' aria-label='close' title='close'>×</a>\n\
                                   <strong>Warning!</strong> Please enter a subject.</div>");
                 return false;
             } else if( ! $(modal).find('#msg').val() ) {
                 $(".v-alert").html("<div class='alert alert-warning'>\n\
                                   <a class='close' href='#' data-dismiss='alert' aria-label='close' title='close'>×</a>\n\
                                   <strong>Warning!</strong> Please enter a message.</div>");
                 return false;
             } else {

                 var formData = $("#support-m").serialize();
                 var url = "{{ url("") }}/notifications/support/message";
                 $.ajax({
                     url: url,
                     type: "POST",
                     asyn: false,
                     data: formData,
                     beforeSend: function () {
                         $('.send-m').html("sending.....");
                     },
                     success: function (data, textStatus, jqXHR) {
                         if (data.msg === '200') {
                             $('.send-m').html("Send a message");
                             $(".v-alert").html("<div class='alert alert-success'>\n\
                                       <a class='close' href='#' data-dismiss='alert' aria-label='close' title='close'>×</a>\n\
                                       <strong>Success!</strong> Message has been sent successfully.</div>");
                         } else {
                             $('.send-m').html("Send a message");
                             $(".v-alert").html("<div class='alert alert-danger'>\n\
                                       <a class='close' href='#' data-dismiss='alert' aria-label='close' title='close'>×</a>\n\
                                       <strong>Error!</strong> An error occured, please try again.</div>");
                         }
                     },
                     error: function (jqXHR, textStatus, errorThrown) {
                         swal('Oops...', 'Unable to send support message, please try again later.', 'error');
                         location.reload();
                     }
                 });
             }

             event.preventDefault();
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (x, status, error)
        {
            if (x.status == 422)
            {
                var error_messages = x.responseJSON.message;

                if(x.responseJSON.errors)
                {
                    error_messages+= "<br/><br/>";

                    jQuery.each( x.responseJSON.errors, function( i, val ) {
                        error_messages += val + "<br/>";
                    });
                }

                swal.close();
                swal('Oops...', error_messages, 'error');
            }
        }
    });



    function show_pre_loader(){
        $("#js-loading").show();
    }

    function hide_pre_loader(){
        $("#js-loading").hide();
    }



</script>