<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('vendor/ckeditorpluginv2/ckeditor/ckeditor.js') }}"></script>


    <!-- Custom Stylesheet for the CKEditor LTI Plugin -->
    <style>

        .cke_button__LTIButton_icon { display:none !important;  }
        .cke_button__LtiTools_label { display: inline !important }

        body {font-family:arial; background: transparent !important;}
        .h5, h5 {  font-size: 1.2rem !important;  color:#002a80; }
        p {  margin-top: 0;  margin-bottom: 1rem;  font-size: 13px;  }
        .ltickplugin {background: transparent;}

        /* Backgrounds */
        .unisa-grey     {background: #777777 !important}

        /* Buttons */
        .unisa-blue-btn     {background: #172652 !important; border-color: #172652; color:#fff;}
        .unisa-red-btn      {background: #930010 !important; border-color: #930010; color:#fff;}
        .unisa-black-btn    {background: #222222 !important; border-color: #222222; color:#fff;}
        .unisa-orange-btn   {background: #F7931D !important; border-color: #F7931D; color:#fff;}
        .unisa-grey-btn     {background: #777777 !important; border-color: #777777; color:#fff;}

        /* Apps Css */
        .container{width:100%}
        .col-xs-3 {width:25%; float:left; position:relative}
        #app-container {width:100%;}
        .app-item {padding:10px;}
        #app-container .app-item .app-contents {background:#fff; border:1px solid #e0e0e0; padding:0px; position: relative;}
        #app-container .app-item .app-contents .app-logo {padding:10px; border-bottom: 1px dashed #cccccc}
        #app-container .app-item .app-contents .app-logo img {width:140px; height:70px; border: 0; padding: 0; vertical-align: middle}
        .img-thumbnail {max-width:100%; display: inline-block; border-radius:0; line-height:1.428571429;}
        #app-container .app-item .app-contents .app-details{padding:5px 10px;}
        #app-container .app-item .app-contents .app-details h4 {color:#222222; margin:0; padding:0 0 5px 0; font-size: 12px; text-align:center; border-bottom:1px dashed #cccccc; height:20px;}
        #app-container .app-item .app-contents .app-details p.app-description {font-size:10px; color: #2e383c; height:38px; overflow: hidden; padding:10px 0}
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