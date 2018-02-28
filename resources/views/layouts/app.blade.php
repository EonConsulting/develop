<?php

$lti = laravel_lti()->is_lti(auth()->user());

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        @include('templates.pagehead')

        <title>@yield('page-title') | {{config('app.name')}}</title>
        
        @yield('custom-styles')

        @stack('package-css')

    </head>

    <body id="app-body">

        <div class="menu-area" id="menu" >
            @include('templates.menu')
        </div>

        <div class="rightside-area">

            <div class="header-area">
                @include('templates.header')
            </div>

            <div data-simplebar class="content-area" id="content-area">
                <div style="height: 15px;"></div>


                @if(session()->has('flash.success'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">x</button>

                                    <strong>Success! </strong>
                                    {{ session()->get('flash.success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session()->has('flash.error'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>

                                    <strong>Request failed! </strong>
                                    {{ session()->get('flash.error') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @yield('content')
            </div>

            <div>
                @include('templates.footer')
            </div>


        </div>

        @yield('exterior-content')
        @include('templates.default-scripts')

        @stack('hoisted-scripts')

        @stack('package-js')

        @stack('package-modals')

        @yield('custom-scripts')

        <script>
            jQuery(document).ready(function($)
            {
                $(".alert-success").delay(4000).slideUp(200, function() {
                    $(this).alert('close');
                });

            });
        </script>

        <div id="js-loading">
            <img src="{{ url('img/loading.gif') }}" alt=""><br>
            <p>Loading...</p>
        </div>
    </body>

</html>
