@extends('ph::layouts.app')
@section('content')
<div class="content">
    <input type="hidden" id="xposition" name="xposition" value="1" onchange="XX()">
    <input type="hidden" id="yposition" name="yposition" value="0" onchange="XX()">
    <script>
        function XX() {

            var firstX = document.getElementById("Axposition").value;
            var firstY = document.getElementById("Ayposition").value;


            var secondX = document.getElementById("Bxposition").value;
            var secondY = document.getElementById("Byposition").value;

            var thirdX = document.getElementById("Cxposition").value;
            var thirdY = document.getElementById("Cyposition").value;


            var board = JXG.JSXGraph.initBoard('box2', {
                boundingbox: [-7, 7, 7, -7],
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

                    A = board.create('point', [firstX, firstY], cerise),
                    B = board.create('point', [secondX, secondY], cerise),
                    C = board.create('point', [thirdX, thirdY], cerise),
                    pol = board.create('polygon', [A, B, C], {
                        fillColor: '#FFFF00',
                        lines: {
                            strokeWidth: 2,
                            strokeColor: '#009256'
                        }
                    });

            A.setProperty({fixed: true});
            B.setProperty({fixed: true});
            C.setProperty({fixed: true});


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

        }
    </script>

    <div class="col-lg-4 col-md-4">
        <h4></h4>

        <div id='box2' class='jxgbox' style='width:660px; height:660px;'></div>
    </div>

       <script type="text/javascript">
        // Euler line
        (function () {
            var firstX = document.getElementById("xposition").value;
            var firstY = document.getElementById("yposition").value;
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

            A.setProperty({fixed: true});
            B.setProperty({fixed: true});
            C.setProperty({fixed: true});

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
@endsection