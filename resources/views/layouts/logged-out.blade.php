<!DOCTYPE html>
<html>
    <head>
        @include('templates.pagehead')

        @yield('custom-styles')
    </head>

    <body id="app-body">


        <div class="rightside-area rightside-area-collapse">

            <div data-simplebar class="content-area">
                <div style="height: 15px;"></div>
                @yield('content')
            </div>

            <div>
                @include('templates.footer')
            </div>

        </div>

        @include('templates.default-scripts')

        @yield('custom-scripts')

    </body>

</html>
