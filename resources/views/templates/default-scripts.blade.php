<!-- jQuery 2.2.3 -->
<script src="{{ url('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App
<script src="{{ url('/dist/js/app.js')}}"></script>-->

<script>
    $( window ).resize(function() {
          $( "#log" ).append( "<div>Handler for .resize() called.</div>" );

          if ($(window).width() < 750) {
              $('.rightside-area').addClass('rightside-area-collapse');
          }
          else {
              $('.rightside-area').removeClass('rightside-area-collapse');
          }
    });

</script>
