<?php $__env->startSection('content'); ?>

<div id="app">
    <create-course></create-course>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('/js/app.js')); ?>"></script>
    <!--<script src="<?php echo e(url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')); ?>"></script>-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>