<?php $__env->startSection('custom-styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8">
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
            <form action="<?php echo e(route('eon.laravellti.cats.create')); ?>" method="post" >
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="title" name="title" class="form-control" id="title" placeholder="title">
                </div>
                <div class="form-group">
                    <label for="Description">Category Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="tags" name="tags" class="form-control" id="tags" placeholder="Comma Separated tags">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Categories<div class="col-md-8 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Categories"></div><div class="clearfix"></div></div>
                <table class="panel-body table table-hover table-striped" id="courses-table">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-5">Title</th>
                        <th class="col-md-2">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($category->title); ?></td>
                            <td><a href="<?php echo e(route('eon.laravellti.delete', $category->id)); ?>" class="btn btn-danger btn-xs">Delete</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('/js/app.js')); ?>"></script>
    <script src="<?php echo e(url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>