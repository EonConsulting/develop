<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>


<link rel="stylesheet" type="text/css" href="jsxgraph.css" />
<script type="text/javascript" src="http://jsxgraph.uni-bayreuth.de/distrib/jsxgraphcore.js"></script>
<!-- <script type="text/javascript" src="js/jsxgraph2core.js"></script> -->




    </head>
    <body>







<div class="content">
<!--                 <div class="title m-b-md">
                    Interactive Graph
                </div>
                <div class="links">
                    <a href="#">Interactive Graph</a>
                    <a href="graph">Fixed Graph</a> -->
                    









                  <!--   <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> -->
                </div>
            </div>





<center>

<div class="col-lg-4 col-md-4">
    <h4></h4>

    <div id='box2' class='jxgbox' style='width:690px; height:690px;'  ></div>
  </div>


</center>





        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
<!--             <div class="content">
                <div class="title m-b-md">
                    Laravel 
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div> -->
        </div>


<script type="text/javascript">
 

// Euler line
(function () {



    var board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-1.5, 2, 1.5, -1], keepaspectratio:true, showcopyright: false, shownavigation: true});

    var cerise = {
            strokeColor: '#901B77',
            fillColor: '#CA147A'
        },

        grass = {
            strokeColor: '#009256',
            fillColor: '#65B72E',
            visible: true,
            withLabel: true
        },

        perpendicular = {
            strokeColor: 'black',
            dash: 1,
            strokeWidth: 1,
            point: JXG.deepCopy(cerise, {
                visible: true,
                withLabel: true
            })
        },

        median = {
            strokeWidth: 1,
            strokeColor: '#333333',
            dash:2
        },

        A = board.create('point', [1, 0], cerise),
        B = board.create('point', [-1, 0], cerise),
        C = board.create('point', [0.2, 1.5], cerise),
        pol = board.create('polygon',[A,B,C], {
            fillColor: '#FFFF00',
            lines: {
                strokeWidth: 2,
                strokeColor: '#009256'
            }
        });




    var pABC, pBCA, pCAB, i1;
    perpendicular.point.name = 'H_c';
    pABC = board.create('perpendicular', [pol.borders[0], C], perpendicular);
    perpendicular.point.name = 'H_a';
    pBCA = board.create('perpendicular', [pol.borders[1], A], perpendicular);
    perpendicular.point.name = 'H_b';
    pCAB = board.create('perpendicular', [pol.borders[2], B], perpendicular);
    grass.name = 'H';
    i1 = board.create('intersection', [pABC, pCAB, 0], grass);

    var mAB, mBC, mCA;
    cerise.name = 'M_c';
    mAB = board.create('midpoint', [A, B], cerise);
    cerise.name = 'M_a';
    mBC = board.create('midpoint', [B, C], cerise);
    cerise.name = 'M_b';
    mCA = board.create('midpoint', [C, A], cerise);

    var ma, mb, mc, i2;
    ma = board.create('segment', [mBC, A], median);
    mb = board.create('segment', [mCA, B], median);
    mc = board.create('segment', [mAB, C], median);
    grass.name = 'S';
    i2 = board.create('intersection', [ma, mc, 0], grass);

    var c;
    grass.name = 'U';
    c = board.create('circumcircle',[A, B, C], {
        strokeColor: '#000000',
        dash: 3,
        strokeWidth: 1,
        point: grass
    });

    var euler;
    euler = board.create('line', [i1, i2], {
        strokeWidth: 2,
        strokeColor:'#901B77'
    });
    board.update();
})();


</script>>

    </body>
</html>
