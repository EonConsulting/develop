<?php

$lti = laravel_lti()->is_lti(auth()->user());

?>

<!DOCTYPE html>
<html>
    <head>
        <?php echo $__env->make('templates.pagehead', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php echo $__env->yieldContent('custom-styles'); ?>

    </head>

    <body>

        <div class="menu-area hidden-xs">
            <?php echo $__env->make('templates.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="rightside-area basic-clearfix">

            <div class="header-area">
                <?php echo $__env->make('templates.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="content-area">
                    <?php echo $__env->yieldContent('content'); ?>
            </div>

        </div>


        <?php echo $__env->make('templates.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('templates.default-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('custom-scripts'); ?>

    </body>

</html>
