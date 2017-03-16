<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



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









<style>
.bene{

    float: left;
    margin: 5px;
    padding: 15px;
    max-width: 300px;
    height: 300px;
    border: 1px solid black;
}
.textarea {
    color: black;

}

.col-md-3 {
 position: relative;
  min-height: 1px;
  padding-right: 1px;
  padding-left: 1px;
  max-width: 20px;

}
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #f1f1f1}

.show {display:block;}
</style>



























<link rel="stylesheet" type="text/css" href="jsxgraph.css" />
<!-- <script type="text/javascript" src="http://jsxgraph.uni-bayreuth.de/distrib/jsxgraphcore.js"></script> -->
<script type="text/javascript" src="js/jsxgraph2core.js"></script>













<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("button").click(function(){


var code = document.getElementById("textareaCode").value;

 $("#preview2").replaceWith(code);


console.log(code);







        var text = document.createElement('div');
        text.setAttribute('class', 'jxgbox');
        text.setAttribute('id', 'box2');
        text.setAttribute('style', 'width:660px; height:660px; float:right;');
        //console.log(text);
        $("#preview1").append(text);
        
    });
});
</script>




    </head>
    <body>





<div class="content">
<!--                 <div class="title m-b-md">
                    Fixed Graph
                </div>
                <div class="links">
                    <a href="graph2">Interactive Graph</a>
                    <a href="#">Fixed Graph</a> -->
                  <!--   <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> -->

                    <input type="hidden" id="xposition" name="xposition" value="1" onchange="XX()">
                    <input type="hidden" id="yposition" name="yposition" value="0" onchange="XX()">






<!-- <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Graph Type</button> 
  <div id="myDropdown" class="dropdown-content " >
<a href="graph2">Interactive Graph</a>
<a href="#">Fixed Graph</a>
  </div>
</div> -->

<!-- <form action="insert.blade.php" method="post">
<select name="cars">
  <option value="boundingbox">Bounding box</option>
  <option value="line">Line</option>
  <option value="circle">Circle</option>
  <option value="polygon">Polygon</option>
</select>
<input type="checkbox" name="vehicle" value="Bike" checked="checked"> Read only <br>
<input type="submit" value="Submit">
</form>
 -->


               <!--  </div> -->
            </div>





<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}


</script>


<div class="container-fluid ">
  <!-- <h1>Hello World!</h1>
  <p>Resize the browser window to see the effect.</p> -->

  <div class="row">

    <div class="col-sm-5 " >
      
       Code
       <form action="test" method="post" >
         <textarea id ="textareaCode" name="textareaCode"  rows="25" cols="60" style="color: black"></textarea>
        <br> Graph Name: <input type="text" name="graphName" id="graphName" required="true">
         <button id="save" type="submit" >Save Graph</button>
</form>
    </div>

    <div class="col-sm-1 " style="background-color:none;">
<br> <br> <br> <br> <br> <br> <br> <br>

       <button>Drow The Graph</button> <br> <br>
      

  </div>

    <div class="col-sm-6 " style="background-color:none;">

    Preview
    <div id="preview1  ">
               <div id='box2' class='jxgbox' style='width:550px; height:510px; float:right; border: groove;' ></div>
    </div>
    </div>

  </div>

</div>






<!-- 
<center>

<div class="col-lg-4 col-md-4">


   

    <div id='box2' class='jxgbox' style='width:660px; height:660px;' ></div>
</div>


</center> -->

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

<div id="preview2">

<script type="text/javascript">
 

// Euler line
(function () {




//custom code 

        var firstX = document.getElementById("xposition").value;
        var firstY = document.getElementById("yposition").value;










    var board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-1.5, 2, 1.5, -1], keepaspectratio:true, showcopyright: false, shownavigation: false});

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

        A = board.create('point', [firstX, firstY], cerise),
        B = board.create('point', [-1, 0], cerise),
        C = board.create('point', [0.2, 1.5], cerise),
        pol = board.create('polygon',[A,B,C], {
            fillColor: '#FFFF00',
            lines: {
                strokeWidth: 2,
                strokeColor: '#009256'
            }
        });



// A.setProperty({fixed:true});
// B.setProperty({fixed:true});
// C.setProperty({fixed:true});



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


</script>

    
</div>








<!-- <button>Replace the first p element with new text</button> -->
    </body>
</html>
