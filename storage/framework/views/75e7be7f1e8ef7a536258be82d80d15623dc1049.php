<?php $__env->startSection('content'); ?>

    <div class="col-sm-12">
        <!-- <h1>Hello World!</h1>
        <p>Resize the browser window to see the effect.</p> -->

        <div class="row">

            <div class="col-sm-12 " style="background-color:none; ">

                <p>Preview</p>
                <div id="preview1  ">
                    <div id='jxgbox' class='textareaCode' style=' border: groove;'></div>
                </div>
            </div>

        </div>

    </div>
    <div id="preview2">
        <
        <script style="text/javascript">
            <?php echo $graph->code; ?>

        </script>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('ph::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>