<!DOCTYPE html>
<html>
    <head>
        @include('templates.pagehead')

        @yield('custom-styles')
    </head>

    <body>

        <div class="content">
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        @include('templates.footer')

        @include('templates.default-scripts')

        @yield('custom-scripts')

    </body>

</html>
