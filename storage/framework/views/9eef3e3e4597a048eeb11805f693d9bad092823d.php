<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="tok" value="<?php echo e(csrf_token()); ?>" />
                <div class="panel panel-default">
                    <div class="panel-heading basic-clearfix">
                        Groups
                        <a href="<?php echo e(route('eon.admin.groups.create')); ?>" class="btn btn-primary btn-xs">
                            <span class="fa fa-plus"></span>
                        </a>
                        <div class="col-md-6 pull-right">
                        <input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Groups.."></div>
                    </div>
                    <table class="table table-hover table-striped" id="group-table">
                        <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-7">Group</th>
                                <th class="col-md-2"># Roles</th>
                                <th class="col-md-2">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="clickable-row" data-href="<?php echo e(route('eon.admin.groups.single', $group->id)); ?>" data-groupid="<?php echo e($group->id); ?>">
                                <a href="">
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($group->name); ?></td>
                                    <td><?php echo e($group->users_roles->count()); ?></td>
                                    <td><button type="button" class="remove-group btn btn-danger btn-xs" data-groupid="<?php echo e($group->id); ?>">Remove</button></td>
                                </a>
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
    <script>
        $(document).ready(function($) {
            var _token = $('#tok').val();

            $('.clickable-row').on('click', '.remove-group', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var group_id = $(this).data('groupid');

                var url = '<?php echo e(route('eon.admin.groups.delete')); ?>';
                url = url.replace('--group--', group_id);

                $('.clickable-row[data-groupid="' + group_id + '"]').hide();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {_token: _token},
                    success: function(res) {
                        console.log('res', res);
                        if(res.hasOwnProperty('success')) {
                            if(res.success) {
                                $('.clickable-row[data-groupid="' + group_id + '"]').remove();
                            } else {
                                $('.clickable-row[data-groupid="' + group_id + '"]').show();
                                alert(res.error_messages);
                            }
                        }
                    },
                    error: function(res) {
                        console.log('res', res);
                        $('.clickable-row[data-groupid="' + group_id + '"]').show();
                    }
                });
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
            table = document.getElementById("roles-table");
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