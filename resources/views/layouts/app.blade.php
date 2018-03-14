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

                @if (isset($errors) && count($errors) > 0)

                    @component('components.alert-container', ['type' => 'danger'])
                        @slot('title')
                            Validation failed!
                        @endslot

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endcomponent

                @endif

                @if(session()->has('flash.success'))

                    @component('components.alert-container', ['type' => 'success'])
                        @slot('title')
                            Success!
                        @endslot

                        {{ session()->get('flash.success') }}
                    @endcomponent

                @endif

                @if(session()->has('flash.error'))

                    @component('components.alert-container', ['type' => 'danger'])
                        @slot('title')
                            Request failed!
                        @endslot

                        {{ session()->get('flash.error') }}
                    @endcomponent

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
