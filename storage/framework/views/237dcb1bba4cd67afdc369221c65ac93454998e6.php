<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('site-title'); ?> |  <?php echo e(config('app.name')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?php echo e(URL::asset('vendor/ckeditorpluginv2/ckeditor/ckeditor.js')); ?>"></script>
    <script src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG"></script></head>
    <![endif]-->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>


    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//dev.unisaonline.net/piwik/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Piwik Code -->

<?php echo $__env->yieldContent('custom-styles'); ?>
<!-- <link href="<?php echo e(url('/vendor/laravellti/css/bootstrap.min.css')); ?>" rel="stylesheet" /> -->

<script type="text/javascript">

    </script>



    <!-- Custom Stylesheet for the CKEditor LTI Plugin -->
    <style>

        body {font-family: "Open Sans",sans-serif; background: transparent !important; margin: 0px; padding: 15px;}

        .cke_button__LTIButton_icon { display:none !important;  }
        .cke_button__LtiTools_label { display: inline !important }


        .h5, h5 {  font-size: 1.2rem !important;  color:#002a80; }
        p {  margin-top: 0;  margin-bottom: 1rem;  font-size: 13px;  }
        .ltickplugin {background: transparent;}

        /* Backgrounds */
        .unisa-grey     {background: #777777 !important}

        /* Buttons Active */

        .unisa-blue-btn     {background: #172652 !important; border-color: #172652; color:#fff;}
        .unisa-red-btn      {background: #930010 !important; border-color: #930010; color:#fff;}
        .unisa-black-btn    {background: #222222 !important; border-color: #222222; color:#fff;}
        .unisa-orange-btn   {background: #F7931D !important; border-color: #F7931D; color:#fff;}
        .unisa-grey-btn     {background: #777777 !important; border-color: #777777; color:#fff;}

        /* Borders and Shadows */
        .unisabdr           {border:1px solid #222222}

        .unisa-blue-btn:hover     {background: #172652 !important; border-color: #172652; color:#fff;}
        .unisa-red-btn:hover      {background:red;color:#cccccc;}
        .unisa-black-btn:hover    {background: #222222 !important; border-color: #222222; color:#fff;}
        .unisa-orange-btn:hover   {background: #F7931D !important; border-color: #F7931D; color:#fff;}
        .unisa-grey-btn:hover     {background: #777777 !important; border-color: #777777; color:#fff;}

        /* Apps Css */
        .container{width:100%}
        .col-xs-3 {width:25%; float:left; position:relative}
        #app-container {width:100%;}
        .app-item {padding:10px;}
        #app-container .app-item .app-contents {background:#fff; border:1px solid #e0e0e0; padding:0px; position: relative;}
        #app-container .app-item .app-contents .app-logo {padding:10px; border-bottom: 1px dashed #cccccc}
        #app-container .app-item .app-contents .app-logo img {width:140px; height:auto; border: 0; padding: 0; vertical-align: middle}
        .img-thumbnail {max-width:100%; display: inline-block; border-radius:0; line-height:1.428571429;}
        #app-container .app-item .app-contents .app-details{padding:5px 10px;}
        #app-container .app-item .app-contents .app-details h4 {color:#222222; margin:0; padding:0 0 5px 0; font-size: 12px; text-align:center; border-bottom:1px dashed #cccccc; height:20px;}
        #app-container .app-item .app-contents .app-details p.app-description {font-size:10px; color: #2e383c; height:38px; overflow: hidden; padding:10px 0}
    </style>

    <script>
        //Dialogue Insertion Point -->

             var config = {
                    extraPlugins: 'dialog',
                    toolbar: [ [ 'LTIButton', 'mathjax' ] ]
                };

    </script>
</head>

<body>
<div class="wrapper" id="app">
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>
