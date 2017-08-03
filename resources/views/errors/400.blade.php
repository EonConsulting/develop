@extends('layouts.custom-error')

@section('site-title')
    Dashboard
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('mini-logo-title')
    Unisa
@endsection

@section('logo-title')
    Unisa
@endsection

@section('page-title')
    
@endsection

@section('content')







  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content" >
      <div class="error-page" >
        <h2 class="headline text-yellow"> 400</h2>
        <div class="error-content">
         <br>
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Bad Request.</h3>
          <p>
            The server could not process your request.
                                 <br> 
            Meanwhile, you may <a href="{{ url('/home') }}">return to dashboard</a> 
          </p>
          
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>



@endsection

@section('custom-scripts')
    <!-- jvectormap -->
    <script src="{{url('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{url('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{url('/plugins/chartjs/Chart.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/dist/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('/dist/js/demo.js')}}"></script>
@endsection



























