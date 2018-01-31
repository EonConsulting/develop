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

        @include('html-to-pdf::javascript')

        <div id="js-loading">
            Loading...<br>
            <img src="{{ url('img/loading.gif') }}" alt="">
        </div>
    </body>

</html>
