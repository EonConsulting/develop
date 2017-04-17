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
                          style="background-color: none; color: black;" placeholder="Make sure the first parameter of initBoard is jxgbox eg: JXG.JSXGraph.initBoard('jxgbox' "></textarea><br>
                <br style="color:red ;"> Graph Name: <input type="text" name="graphName" id="graphName" required="true">
                <button id="save" type="submit"
                        style="background: #172652 !important; border-color: #172652; color:#fff;">Save Graph
                </button>
            </form>
        </div>

        <div class="col-sm-1 " style="background-color:none;">
            <br> <br> <br> <br> <br> <br> <br> <br>

            <center>
                <button style=" border:none; background-color:transparent; color: black ; ">  <h3> > </h3></button>
                <br> <br>
            </center>
            <br> <br> <br> <br> <br> <br> <br> <br>
        
        </div>

        <div class="col-sm-6 " style="background-color:none; ">

            <p>Preview</p>
            <div id="preview1  ">
                             <div id='jxgbox' class='textareaCode' style=' border: groove;'></div>
                      
            </div>
        </div>

    </div>

</div>
<script>

</script>
 <div id="preview2">
    <script type="text/javascript">
      
            var board = JXG.JSXGraph.initBoard('jxgbox', {
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
    
        </script>
 </div>
    <script>
        $(document).ready(function () {
     
            $("button").on("click", function () {
  
  var $this = $(this); 
  var code =  document.getElementById("textareaCode").value; 
  var divreplace = "<div id='box2' class='textareaCode' style=' border: groove;'> ";
 // graphs()->drawgraph($this, $code, $divreplace);
if ($this.hasClass("clicked-once")) {
    // already been clicked once, refresh the page
   location.reload();
   $("#preview2").replaceWith('<script>'+code+'<\/script>');
// $("#preview1").replaceWith(divreplace);
    console.log(code);
}
 else {
    // first time this is clicked, mark it
    $this.addClass("clicked-once");
               
             //   var code = document.getElementById("textareaCode").value;
                $("#preview2").replaceWith('<script>'+code+'<\/script>');
                // var text = document.createElement('div');
                // text.setAttribute('class', 'textareaCode');
                // text.setAttribute('id', 'box2');
                // text.setAttribute('style', 'width:660px; height:660px; float:right;');
             
                // $("#preview1").append(text);
  
                $("#preview1").replaceWith(divreplace);
}
            });
        });
    </script>


@endsection
