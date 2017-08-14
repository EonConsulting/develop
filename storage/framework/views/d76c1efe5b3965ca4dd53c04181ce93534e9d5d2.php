<?php $__env->startSection('content'); ?>

    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo e($course->title); ?></div>
                    <div class="panel-body">
                        <?php echo e($course->description); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu</div>
                    <div class="list-group">
                        <a href="<?php echo e(route('courses.single.storyline', $course->id)); ?>" class="list-group-item">Storyline</a>
                        <a href="<?php echo e(route('courses.single.notify', $course->id)); ?>" class="list-group-item">Notify Users</a>
                        <a href="<?php echo e(route('courses.single.content', $course->id)); ?>" class="list-group-item">Content</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('/js/app.js')); ?>"></script>
    <script>
        $(document).ready(function($) {

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>