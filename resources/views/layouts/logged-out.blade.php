<!DOCTYPE html>
<html>
    <head>
        @include('templates.pagehead')
    </head>

    <body>

        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('page-title')
                    <!--   <small>Version 2.0</small> -->
                </h1>
            </section>

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
