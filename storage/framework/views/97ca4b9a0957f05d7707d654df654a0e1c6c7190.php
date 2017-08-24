<?php $__env->startSection('page-title'); ?>
    Lecturer Dashboard
<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom-styles'); ?>
<style>

    .rightside-area {
        background: #FFF;
    }

    .top-bar {
        text-align: right;
    }

    .top-bar a {
        display: inline-block;
        padding: 10px;
    }

    .title {
        font-size: 36px;
        text-align: center;
        margin-top: 150px;
        font-weight: 300;
    }

    .title-image {
        margin-bottom: 50px;
    }

    .links {
        text-align: center;
    }

    .links a {
        display: inline-block;
        padding: 10px;
    }

    .notice-container {
        padding-top: 50px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="top-bar">
            <?php if(Route::has('login')): ?>
                <a href="<?php echo e(url('/login')); ?>">Login</a>
                <a href="<?php echo e(url('/register')); ?>">Register</a>
            <?php endif; ?>
        </div>

        <div class="title">
            <div class="title-image">
                <img width="200px" src="<?php echo e(url('/img/unisa-logo.png')); ?>" alt="">
            </div>

            e-Content System
        </div>

        <div class="links">
            <a href="https://github.com/EonConsulting">Github</a>
            <a href="https://github.com/orgs/EonConsulting/people">Team</a>
        </div>

        <div class="notice-container">
            <div class="beta-notice">
                Please note that this site is currently in development and is not complete. Certain features in this website are currently under construction, and they do not represent the final intended functionality. This site is available to allow you to have a look at progress, and to get an idea of where this site is headed.
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.logged-out', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>