@extends('ckeditorpluginv2::layouts.master')

@section('content')

    <div class="domains">

    <div class="panel panel-default">

    <div id="app-container" class="container">
        <div class="app-header">
        <form action="selectsearch" class="navbar-form navbar-left" method="get">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control unisabdr" name="term" placeholder="Search for a Component">
                <span class="input-group-btn">
                <button class="btn unisa-black-btn btn-sm" type="submit">
                <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>
        </div>

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
                <div class="app-item col-xs-3" id="app-listjs">
                    <div class="app-contents list">
                            <div class ="app-logo">
                                <img class="img-thumbnail" src="{!! (is_string($tool['icon']) && $tool['icon'] == '') ? 'http://placehold.it/100x100' : $tool['icon'] !!}" alt="">
                            </div>
                            <div class="app-details">
                                    <h4 class="title">{!! $tool['title'] !!}</h4>
                                    <p class="app-description">{!! $tool['description'] !!}</p>
                                    <div class="pull-bottom-left">
                                        <a data-context="{{$tool['context_id']}}" class="appitem btn unisa-orange-btn btn-sm" role="button"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Insert Tool</a>
                                            <!-- href="{{ route('eon.laravellti.appstore.launch', $tool['context_id']) }}" -->
                                    </div>
                            </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="clearfix"></div>
        <script>

        </script>
            <script>
                {{--//Initialise Select 2 with Jquery--}}
                {{--$(document).ready(function (){--}}
                {{--var data = '{{ $tools }}';--}}
                    {{--$.each( data, function( key, value ) {--}}
                        {{--console.log('data');--}}
                    {{--});--}}

{{--//                    $('#search-box').select2({--}}
{{--//                    data:sum--}}
{{--//--}}
{{--//                })--}}
                {{--});--}}
//                $(document).ready(function (){
//                    $('#search-box').select2({
//                        ajax: {
//                            url: '/selectsearch',
//                            delay: 250,
//                            processResults: function (data) {
//                                return{
//                                    results: data.title
//                                }
//                            }
//                        }
//                    });
//
//                })

            </script>

        </div> <!-- /row -->

    </div> <!-- /container -->
@endsection

@section('custom-scripts')
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function() { return $(this).height() + 20; })));--}}
    {{--</script>--}}

@endsection