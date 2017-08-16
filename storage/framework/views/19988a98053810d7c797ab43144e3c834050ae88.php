<!DOCTYPE html>
<html>
    <head>
        <?php echo $__env->make('templates.pagehead', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('custom-styles'); ?>
    </head>

    <body>

        <div class="content">
            <!-- Main content -->
            <section class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </section>
            <!-- /.content -->
        </div>

        <?php echo $__env->make('templates.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('templates.default-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('custom-scripts'); ?>

    </body>

</html>
