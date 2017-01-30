<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/economics.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/font-awesome.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/bootstrap-3.3.7.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/custom.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    @for($i = 0 ;$i < count($styles); $i++)
        <link type="text/css" rel="stylesheet" href="{{ $styles[$i] }}"/>
    @endfor

    <title>UNISA - eLearning</title>
</head>

<body>
<div class="navbar-fixed">
    <nav class="grey">
        <div class="nav-wrapper container subtopic">
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <a href="{{ route('lti.index') }}"><i class="fa fa-home fa-lg"></i></a>
            <ul class="left hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="fa fa-bars"></i></a>{!! $menu !!}</li>
            </ul>

            <div class="google-search">
                <!-- STAGING SEARCH SUBTOPIC 2 -->
                <script>
                    (function() {
                        var cx = '017962765554458024236:uxqa-nm-kuw';
                        var gcse = document.createElement('script');
                        gcse.type = 'text/javascript';
                        gcse.async = true;
                        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(gcse, s);
                    })();
                </script>
                <gcse:search linkTarget="_parent" enableImageSearch="true"></gcse:search>
            </div>

            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="fa fa-print"></i></a></li>
            </ul>
        </div>
    </nav>
</div>

<ul id="dropdown1" class="dropdown-content">
    <!--    --><?php
    //    error_reporting(0);
    //    ini_set('display_errors', 'On');
    //
    //    $HeaderSL=$Header_SL;
    //    $PageSL = $Page_SL;
    //    $Page = $Pg;
    //
    //    $GLOBALS['menu_tree']= array();
    //
    //    Build_Storyline('assets/', $HeaderSL, false, true, 0);
    //
    //    function Display_Storyline_Root_Start($n, $StoryLine, $current_level) {
    //        $key = $StoryLine . '|' . get_Attribute($n, 'link');
    //        $link_value = 'index.php?HeaderSL=' . $GLOBALS['HeaderSL'] . '&PageSL=' . $StoryLine . '&page=' . get_Attribute($n, 'link');
    //        $GLOBALS['menu_tree'][$key] = $link_value;
    //        echo '<li><a class="waves-effect waves-light blue full-width" href="' . $link_value  . '" >' . get_Attribute($n, 'title') . '</a></li>';
    //    }
    //
    //    function Display_Storyline_Root_End($n, $StoryLine, $current_level) {
    //        echo '';
    //    }
    //
    //    function Display_Storyline_Branch_Start($n, $StoryLine, $current_level) {
    //        $key = $StoryLine . '|' . get_Attribute($n, 'link');
    //        $link_value = 'index.php?HeaderSL=' . $GLOBALS['HeaderSL'] . '&PageSL=' . $StoryLine . '&page=' . get_Attribute($n, 'link');
    //        $GLOBALS['menu_tree'][$key] = $link_value;
    //        echo '<li class="parent"><a class="waves-effect waves-light full-width" href="' . $link_value  . '" >' . get_Attribute($n, 'title')  . '</a><ul>';
    //    }
    //
    //    function Display_Storyline_Branch_End($n, $StoryLine, $current_level) {
    //        echo '</ul></li>';
    //    }
    //
    //    function Display_Storyline_Branch($n, $StoryLine, $current_level) {
    //        $key = $StoryLine . '|' . get_Attribute($n, 'link');
    //        $link_value = 'index.php?HeaderSL=' . $GLOBALS['HeaderSL'] . '&PageSL=' . $StoryLine . '&page=' . get_Attribute($n, 'link');
    //        $GLOBALS['menu_tree'][$key] = $link_value;
    //        echo '<li><a class="waves-effect waves-light full-width" href="' . $link_value  . '">' . get_Attribute($n, 'title')  . '</a></li>';
    //    }
    //
    //    function Display_Storyline_Leaf($n, $StoryLine, $current_level) {
    //        $key = $StoryLine . '|' . get_Attribute($n, 'link');
    //        $link_value = 'index.php?HeaderSL=' . $GLOBALS['HeaderSL'] . '&PageSL=' . $StoryLine . '&page=' . get_Attribute($n, 'link');
    //        $GLOBALS['menu_tree'][$key] = $link_value;
    //        echo '<li><a class="waves-effect waves-light full-width" href="' . $link_value  . '" >' . get_Attribute($n, 'title')  . '</a></li>';
    //    }
    //    ?>
</ul>

<ul id="dropdown2" class="dropdown-content">
    <?php
    //    if(!empty($_GET['page'])) {
    //        echo '<li><a target="_blank" href="includes/print/print_single.php?HeaderSL=' . $HeaderSL .'&PageSL=' . $PageSL . '&page=' . $Page . '" class="waves-effect waves-light btn grey darken-3 full-width">This Section</a></li>';
    //    }
    //    if(empty($_GET['page'])) {
    //        echo '<li><a target="_blank" href="includes/print/print_storyline.php?&HeaderSL=' .  $HeaderSL. '&PageSL=' . $PageSL .'" class="waves-effect waves-light btn grey darken-3 full-width">Topic</a></li>';
    //    }
    //    ?>
</ul>


<div class="container">
    <div class="row">
        <div class="col s12">
            <h1 class="topic-list-header">{{ $taxonomy['title'] }}</h1>
            <br />
            <p>{!! strip_tags($taxonomy['summary']) !!}</p>
            <br /><br />
            {!! $breadcrumb !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(array_key_exists('children', $taxonomy))
                @foreach($taxonomy['children'] as $item)
                    <div class="col-md-4 subtopic-card">
                        <a class="topic-container" href="{{ route('lti.single', [$config, $item['link']]) }}">
                            <img src="{{ (array_key_exists('img', $item) && $item['img'] != '') ? ((strpos($item['img'], 'http') !== false) ? $item['img'] : '/vendor/storyline/core/images/' . $item['img']) : 'http://placehold.it/240x200' }}" alt="" class="img responsive-img">
                            <div class="card-title">
                                {{ $item['title'] }}
                            </div>
                            <div class="card-description">
                                <!-- hover effect -->
                                {{--{!! str_replace(' ', '', strip_tags($item['summary'])) !!}--}}
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/vendor/storyline/core/js/materialize.min.js"></script>
<script type="text/javascript" src="/vendor/storyline/core/js/economics.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-77532820-1', 'auto');
    ga('send', 'pageview');

</script>

<style>
    .gsc-result .gs-title {
        height:2em !important;
    }
</style>
</body>
</html>
