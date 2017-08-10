  

<!-- <?php $__env->startSection('site-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('body-class'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mini-logo-title'); ?>
    Unisa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('logo-title'); ?>
    Unisa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    
<?php $__env->stopSection(); ?> -->

<?php $__env->startSection('content'); ?>







  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content" >
      <div class="error-page" >
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
         <br>
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
          <p>
            We could not find the page you were looking for.
            <br> 
            Meanwhile, you may <a href="<?php echo e(url('/home')); ?>">return to dashboard</a> 
          </p>
          
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <!-- jvectormap -->
    <script src="<?php echo e(url('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(url('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo e(url('/plugins/chartjs/Chart.min.js')); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo e(url('/dist/js/pages/dashboard2.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(url('/dist/js/demo.js')); ?>"></script>
<?php $__env->stopSection(); ?>




























<?php echo $__env->make('layouts.custom-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>