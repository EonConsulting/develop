@extends('ph::layouts.app')
@section('content')

<div class="col-sm-12">
    <!-- <h1>Hello World!</h1>
    <p>Resize the browser window to see the effect.</p> -->

    <div class="row">

        <div class="col-sm-5 " style="background-color:none;">
        <p>Code</p>
            <form action="savetodatabase" method="post">
                <textarea id="textareaCode" class="textareaCode" name="textareaCode"
                          style="background-color:none; color: black;">Math.sin(x)*Math.cos(x)</textarea> <br>
                <br style="color:red ;"> Graph Name: <input type="text" name="graphName" id="graphName" required="true">
                <button id="save" type="submit"
                        style="background: #172652 !important; border-color: #172652; color:#fff;">Save Graph
                </button>
            </form>
        </div>

        <div class="col-sm-1 " style="background-color:none;">
            <br> <br> <br> <br> <br> <br> <br> <br>

            <center>
                <button style=" border:none; background-color:transparent; color: black ; " onClick="doIt()">  <h3> > </h3></button>
                <br> <br>
            </center>
            <br> <br> <br> <br> <br> <br> <br> <br>
        
        </div>

        <div class="col-sm-6 " style="background-color:none; ">

            <p>Preview</p>
            <div id="preview1  ">
                <div id='box2' class='textareaCode' style=' border: groove;'></div>
            </div>
        </div>

    </div>

</div>
<div id="preview2">
    <script type="text/javascript">


        (function () {
            var board = JXG.JSXGraph.initBoard('box2', {
                boundingbox: [-1.5, 2, 1.5, -1],
                keepaspectratio: true,
                showcopyright: false,
                shownavigation: false
            });

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
                        dash: 2
                    },

                    A = board.create('point', [1, 0], cerise),
                    B = board.create('point', [-1, 0], cerise),
                    C = board.create('point', [0.2, 1.5], cerise),
                    pol = board.create('polygon', [A, B, C], {
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
            c = board.create('circumcircle', [A, B, C], {
                strokeColor: '#000000',
                dash: 3,
                strokeWidth: 1,
                point: grass
            });

            var euler;
            euler = board.create('line', [i1, i2], {
                strokeWidth: 2,
                strokeColor: '#901B77'
            });
            board.update();
        })();

        </script>
</div>
   




    <script>
board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-6, 12, 8, -6], axis: true,    showcopyright: false,
                shownavigation: false});
       eval("function f(x){ return "+document.getElementById("textareaCode").value+";}");
       graph = board.create('functiongraph', [function(x){ return f(x); },-10, 10]);
//glider on the curve
p1 = board.create('glider', [0,0,graph], {style:6, name:'P'});
//define the derivative of f
g = JXG.Math.Numerics.D(f);
//a point on the tangent
//                                 variable x coordinate           variable y coordinate depending on the derivative of f at point p1.X()
p2 = board.create('point', [function() { return p1.X()+1;}, function() {return p1.Y()+JXG.Math.Numerics.D(graph.Y)(p1.X());}], {style:1, name:''});
//the tangent 
l1 = board.create('line', [p1,p2],{}); 
//a third point fpr the slope triangle
p3 = board.create('point', [function() { return p2.X();}, function() {return p1.Y();}],{style:1, name:''});
//the slope triangle
pol = board.create('polygon', [p1,p2,p3], {});
//a text for displaying slope's value
//                               variable x coordinate          variable y coordinate                        variable value
t = board.create('text', [function(){return p1.X()+1.1;},function(){return p1.Y()+(p2.Y()-p3.Y())/2;},function(){ return "m="+(Math.round(p2.Y()-p3.Y(),2));}],{color:ff0000});

function doIt(){
  //redefine function f according to the current text field value
  eval("function f(x){ return "+document.getElementById("textareaCode").value+";}");
  //change the Y attribute of the graph to the new function 
  graph.Y = function(x){ return f(x); };
  //update the graph
  graph.updateCurve();
  //update the whole board
  board.update();
}


    </script>


@endsection




