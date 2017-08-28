<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
    <script src="{{ URL::asset('vendor/ckeditorplugin/ckeditor/ckeditor.js') }}"></script>


    <!-- Custom Stylesheet for the CKEditor LTI Plugin -->
    <style>

        .cke_button__LTIButton_icon {
            display: none !important;
        }

        .cke_button__LtiTools_label {
            display: inline !important
        }

        body {
            font-family: arial;
            background: transparent !important;
        }

        .h5, h5 {
            font-size: 1.2rem !important;
            color: #002a80;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 13px;
        }

        .ltickplugin {
            background: transparent;
        }

        #editor-wrapper {
            position: relative;
            min-height: 450px;
            height: 100%;
            width: 100%;
        }

        /* Buttons Active */

        .unisa-blue-btn {
            background: #172652 !important;
            border-color: #172652;
            color: #fff;
        }

        .unisa-red-btn {
            background: #930010 !important;
            border-color: #930010;
            color: #fff;
        }

        .unisa-black-btn {
            background: #222222 !important;
            border-color: #222222;
            color: #fff;
        }

        .unisa-orange-btn {
            background: #F7931D !important;
            border-color: #F7931D;
            color: #fff;
        }

        .unisa-grey-btn {
            background: #777777 !important;
            border-color: #777777;
            color: #fff;
        }

        .unisa-blue-btn:hover {
            background: #172652 !important;
            border-color: #172652;
            color: #fff;
        }

        .unisa-red-btn:hover {
            background: red;
            color: #cccccc;
        }

        .unisa-black-btn:hover {
            background: #222222 !important;
            border-color: #222222;
            color: #fff;
        }

        .unisa-orange-btn:hover {
            background: #F7931D !important;
            border-color: #F7931D;
            color: #fff;
        }

        .unisa-grey-btn:hover {
            background: #777777 !important;
            border-color: #777777;
            color: #fff;
        }

    </style>

</head>

<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>