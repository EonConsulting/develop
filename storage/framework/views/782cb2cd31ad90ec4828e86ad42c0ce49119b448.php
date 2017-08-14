<?php $__env->startSection('custom-styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="tok" value="<?php echo e(csrf_token()); ?>" />
                <div class="panel panel-default">
                    <div class="panel-heading">Modules <a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a><div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Courses.."></div><div class="clearfix"></div></div>
                    <table class="panel-body table table-hover table-striped" id="courses-table">
                        <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-5">Title</th>
                            <th class="col-md-2">Instructor</th>
                            <th class="col-md-2">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($course->title); ?></td>
                                <td><?php echo e($course->creator->name); ?></td>
                                <td><a href="<?php echo e(route('courses.single', $course->id)); ?>" class="btn btn-success btn-xs">Manage</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>

    <script src="<?php echo e(url('/js/app.js')); ?>"></script>

    <script>
        $(document).ready(function($) {
            var _token = $('#tok').val();

            $('.clickable-row').on('click', '.manage-course', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var group_id = $(this).data('courseid');

                $('.clickable-row[data-courseid="' + group_id + '"]').hide();

//                $.ajax({
//                    url: url,
//                    type: 'POST',
//                    data: {_token: _token},
//                    success: function(res) {
//                        console.log('res', res);
//                        if(res.hasOwnProperty('success')) {
//                            if(res.success) {
//                                $('.clickable-row[data-courseid="' + group_id + '"]').remove();
//                            } else {
//                                $('.clickable-row[data-courseid="' + group_id + '"]').show();
//                                alert(res.error_messages);
//                            }
//                        }
//                    },
//                    error: function(res) {
//                        console.log('res', res);
//                        $('.clickable-row[data-courseid="' + group_id + '"]').show();
//                    }
//                });
            });

            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
        function search() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("txt_search");
            filter = input.value.toLowerCase();
            table = document.getElementById("courses-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>