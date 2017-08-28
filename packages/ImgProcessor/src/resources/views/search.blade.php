@extends('ckeditorpluginv2::layouts.master')

@section('content')

    <div class="domains">

        <div class="panel panel-default">
            <form id="form1" action="selectsearch" class="navbar-form navbar-left" method="get">
                <div class="input-group custom-search-form">
                    <input type="text" id="search" class="form-control" name="term" placeholder="Search for a Component">
                    <span class="input-group-btn ">
                <button class="btn btn-primary btn-sm" id="submit" type="submit">
                <i class="fa fa-search"></i>
                </button>
                </span>
                </div>
            </form>
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



                    @foreach($searches as $search)
                        @if(!empty($searches))
                        <div class="app-item col-xs-3" id="app-listjs">
                            <div class="app-contents list">
                                <div class ="app-logo">
                                    <img class="img-thumbnail" src="{{'http://placehold.it/100x100'}}" alt="">
                                </div>
                                <div class="app-details">
                                    <h4 class="title">{!! $search->title !!}</h4>
                                    <p class="app-description">{{ json_decode($search->json)->bltidescription }}</p>
                                    <div class="pull-bottom-left">
                                        <a data-context="{{$search->context_id}}" class="appitem btn unisa-orange-btn btn-sm" role="button"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Insert Tool</a>
                                    <!-- href="{{ route('eon.laravellti.appstore.launch', $search->context_id) }}" -->
                                    </div>
                                </div>
                            </div>
                        </div>
                            @else
                            <h3>Your Search Did not Match any Components</h3>
                            <btn onclick="goBack()" class="btn btn-sm unisa-black-btn">Back</btn>
                            @endif
                    @endforeach
                        {{ $searches->render() }}
                </div>

                <div class="clearfix"></div>
                <script>

                    function goBack() {
                        window.history.back();
                    }
                    $.(document).ready( function () {
                        $.('#submit').on('submit', function (e) {
                            e.preventDefault();
                            var formdata = $.('#search').val();
                            if (formdata == '') {
                            alert('This Field Can not be submitted Empty')}
                            console.log(formdata);
                        });

                        return false;
                    })

                </script>

            </div> <!-- /row -->

        </div> <!-- /container -->
    </div>
@endsection
