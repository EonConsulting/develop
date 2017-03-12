@extends('ckeditorpluginv2::layouts.master')

@section('content')
    <div id="app-container" class="container">

        <div class="row">
            @if (session('error_message'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{ session('error_message') }}
                    </div>
                </div>
            @endif

            @if (session('success_message'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('success_message') }}
                    </div>
                </div>
            @endif

            @if($errors->count() > 0)
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="row">

            <?php $count = 0; ?>
            @foreach($tools as $tool)
                <div class="app-item col-xs-3">
                    <div class="app-contents">
                        <a href ="#">
                            <div class ="app-logo">
                                <img class="img-thumbnail" src="{!! (is_string($tool['icon']) && $tool['icon'] == '') ? 'http://placehold.it/100x100' : $tool['icon'] !!}" alt="">
                            </div>
                            <div class="app-details">
                                    <h4>{!! $tool['title'] !!}</h4>
                                    <p class="app-description">{!! $tool['description'] !!}</p>
                                    <div class="pull-bottom-left">
                                         <p><a href="{{ route('eon.laravellti.appstore.launch', $tool['context_id']) }}" data-context="{{$tool['context_id']}}" class="appitem btn unisa-blue-btn btn-sm" role="button">View</a>
                                             <a href="{{ route('eon.laravellti.delete', $tool['context_id']) }}" class="btn unisa-black-btn btn-sm" role="button">Delete</a></p>
                                    </div>
                            </div>

                        </a>
                    </div>
                </div>
            @endforeach

            <div class="clearfix"></div>

        </div> <!-- /row -->

    </div> <!-- /container -->
@endsection

@section('custom-scripts')
    <script>

        $(document).ready(function() {
            $(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function() { return $(this).height() + 20; })));


    </script>
@endsection