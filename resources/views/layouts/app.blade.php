<?php

$lti = laravel_lti()->is_lti(auth()->user());

if (!isset($page_title)) {
    $page_title = 'Page title not set.';
}

if(!isset($parent_title)) {
    $parent_title = '';
}

?>

<!DOCTYPE html>
<html>
    <head>
        @include('templates.pagehead')


        @yield('custom-styles')

    </head>

    <body>

        <div class="menu-area hidden-xs">
            @include('templates.menu')
        </div>

        <div class="rightside-area basic-clearfix">

            <div class="header-area">
                @include('templates.header')
            </div>

            <div class="content-area">
                    @yield('content')
            </div>

        </div>


        @include('templates.footer')

        @include('templates.default-scripts')

        @yield('custom-scripts')

    </body>

</html>
