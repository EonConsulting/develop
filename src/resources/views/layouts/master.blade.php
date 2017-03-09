<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('vendor/ckeditorplugin/ckeditor/ckeditor.js') }}"></script>


    <!-- Custom Stylesheet for the CKEditor LTI Plugin -->
    <style>

        .cke_button__LTIButton_icon { display:none !important;  }
        .cke_button__LtiTools_label { display: inline !important }

        body {font-family:arial; background: transparent !important;}
        .h5, h5 {  font-size: 1.2rem !important;  color:#002a80; }
        p {  margin-top: 0;  margin-bottom: 1rem;  font-size: 13px;  }
        .ltickplugin {background: transparent;}
        .cke_dialog_contents_body {background-image: url("{{ URL::asset('vendor/ckeditorplugin/ckeditor/plugins/coursecontent/logo/ckltiheader.gif') }}") !important;}
        .cke_dialog_contents tbody.tr {background: url("{{ URL::asset('vendor/ckeditorplugin/ckeditor/plugins/coursecontent/logo/ckltiheader.gif') }}") !important}
        .iframeCover {background: url("{{ URL::asset('vendor/ckeditorplugin/ckeditor/plugins/coursecontent/logo/ckeditorLtiPlugin.gif') }}") !important}
        .ckeditorframe {background: transparent !important;}

    </style>

    <script>
        //Dialogue Insertion Point -->

        var config = {
            extraPlugins: 'dialog',
            toolbar: [ [ 'LTIButton' ] ]
        };
    </script>
</head>

<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>