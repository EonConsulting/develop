<?php $__env->startSection('custom-styles'); ?>
    <style>

        .course-card {
            background: #FFF;
            width: 300px;
            float: left;
            margin-right: 20px;
            margin-bottom: 20px;
            padding: 15px;
            height: 280px;
            position: relative;
        }

        .course-card h1 {
            display: block;
            background: #fb7217;
            font-size: 18px;
            line-height: 24px;
            color: #FFF;
            margin-top: -15px;
            margin-bottom: 5px;
            margin-left: -15px;
            margin-right: -15px;
            padding: 15px;
            height: 80px;
        }

        .course-card p {
            font-size: 12px;
        }

        .btn-course-container {margin: 0px -15px 0px -15px; background: #fcfcfc; position: absolute; bottom: 0; width: 100%; border-width: 1px 0px 0px 0px; border-style: solid; border-color: #e2e2e2;}

        .btn-course {padding: 15px 0px 15px 15px; color: #7d7d7d; font-size: 20px;}

        .btn-course-view {float: left;}

        .btn-course-delete {padding: 15px 15px 15px 0px; float: right; color: #dd4b39;}


    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php $count = 0; ?>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="course-card shadow">
                        <div class="">
                            <div class="caption">
                                <h1><?php echo $course['title']; ?></h1><br />
                                <p><?php echo $course['description']; ?></p>
                            </div>
                            <div class="btn-course-container">
                                <a href="<?php echo e(route('lti.courses.single', $course['id'])); ?>" class="btn-course btn-course-view" role="button">
                                    <span class="glyphicon glyphicon-blackboard"></span> View
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <!-- jvectormap -->
    <script src="<?php echo e(url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo e(url('plugins/chartjs/Chart.min.js')); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo e(url('dist/js/pages/dashboard2.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(url('dist/js/demo.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>