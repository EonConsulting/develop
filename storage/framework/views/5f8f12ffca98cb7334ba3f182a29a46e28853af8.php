<?php $__env->startSection('content'); ?>
    <div class="col-sm-12">
        <h4 class="primary">Your Saved Graphs</h4>
        <hr>
        <div class="row">

            <?php $count = 0; ?>

            <?php $__currentLoopData = $graphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="app-item col-xs-3" id="app-listjs">
                    <div class="app-contents list">
                        <div class="app-details">
                            <h5 style="border-bottom:2px dashed #ccc;background:#e2e3ef;padding:3px; margin:0" class="title"><?php echo $tool['name']; ?></h5>
                            
                            <div class="pull-bottom-left">
                                <a data-context="<?php echo e($tool['id']); ?>" class="appitem btn unisa-black-btn btn-sm"
                                   role="button"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Insert
                                    Graph</a>
                            <!-- href="<?php echo e(route('lecturer.graphstore.init', $tool['id'])); ?>" -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-sm-12">
        <hr>
        <h4>Create a New Graph</h4>

        <div class="row">
            <?php if(session('error_message')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error_message')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success_message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success_message')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->count() > 0): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="col-sm-5 " style="background-color:#eee; height:100%;">
                <p>Code</p>
                <form action="savetodatabase" method="post">
                <textarea id="textareaCode" class="textareaCode" name="textareaCode"
                          style="background-color: none; color: black;"
                          placeholder="Make sure the first parameter of initBoard is jxgbox eg: JXG.JSXGraph.initBoard('jxgbox')"></textarea><br>
                    <br style="color:red ;"> Graph Name: <input type="text" name="graphName" id="graphName"
                                                                required="true">
                    <button id="save" type="submit"
                            style="background: #172652 !important; border-color: #172652; color:#fff;">Save Graph
                    </button>
                </form>
            </div>

            <div class="col-sm-1 " style="background-color:#eee; height:100%;">
                <button class="btn-primary"
                        style="border:none; position: absolute; top:35%;background-color:transparent; color: black ; ">
                    <h3>
                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h3>
                    Preview
                </button>
            </div>

            <div class="col-sm-6 " style="background-color:none; ">

                <p>Preview</p>
                <div id="preview1  ">
                    <div id='jxgbox' class='textareaCode' style=' border: 1px solid rgb(169, 169, 169);'></div>

                </div>
            </div>

        </div>

    </div>
    <div id="preview2">
        <script type="text/javascript">
            (function () {
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
            })();
        </script>
    </div>
    <script>
        $(document).ready(function () {

            $("button").click(function () {

                var $this = $(this);
                var code = document.getElementById("textareaCode").value;
                var divreplace = "<div id='box2' class='textareaCode' style=' border: groove;'> ";
                // graphs()->drawgraph($this, $code, $divreplace);
                if ($this.hasClass("clicked-once")) {
                    // already been clicked once, refresh the page
                    location.reload();
                    $("#preview2").replaceWith(code);
                    $("#preview1").replaceWith(divreplace);
                    console.log(code);
                }
                else {
                    // first time this is clicked, mark it
                    $this.addClass("clicked-once");

                    //   var code = document.getElementById("textareaCode").value;
                    $("#preview2").replaceWith(code);
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('ph::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>