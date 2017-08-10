<?php $__env->startSection('custom-styles'); ?>
    
    
    
    
    
    
    
    
    <link rel="stylesheet" href="<?php echo e(url('/dist/js/jstree/themes/proton/style.min.css')); ?>" />


    

    <style>
        <?php for($i = 0 ;$i < count($custom_styles); $i++): ?>
            <?php echo e($custom_styles[$i]); ?>

        <?php endfor; ?>
.dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .child:hover {display:block}

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
        iframe {
            width: 100%;
            height: 100%;
        }

        .dropdown-menu>li>a {
            white-space: normal !important;
        }
        ul li ul {
            display: none;
        }

        ol ol, ol ul, ul ol, ul ul {padding-left: 7px !important;}

        .breadcrumbs {
            list-style: none;
            overflow: hidden;
            margin: 10px;
            padding: 0px;

        }

        .breadcrumbs ul {

        }

        .breadcrumbs li {
            float: left;
        }

        .breadcrumbs li a {
            color: #fb7217;
            text-decoration: none;
            padding: 0px 5px 10px;
            position: relative;
            display: block;
            float: left;
        }

        .breadcrumbs li a:hover {
            color: #333;
        }

        .breadcrumbs li a::after {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            top: 50%;
            margin-top: -50px;
            left: 100%;
            z-index: 2;
        }

        .breadcrumbs li a::before {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            position: absolute;
            top: 50%;
            margin-top: -50px;
            margin-left: 1px;
            left: 100%;
            z-index: 1;
        }
        .breadcrumbs li:first-child a {
            padding-left: 10px;
        }


    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
    <div class="">
        <ul class="nav navbar-nav" data-submenu="true;">
                <?php echo $menu; ?>

        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3">
                <ul class="nav navbar-nav" data-submenu="true;">
                        <?php echo $menu; ?>

                </ul>
            </div>

            <div class="col-md-9">
                <!--breadcrumbs-->
                <ul class="breadcrumbs">

                    <li><a href="<?php echo e(route('lti.courses.single.lectures.item', [$course->id, $storyline_item->id])); ?>">Home</a> &raquo;</li>
                    <?php echo $catBreadcrumbs; ?>

                    <li>&nbsp;&nbsp;<?php echo e($storyline_item->name); ?></li>

                </ul>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-3">
                
                <div id ="navigation">
                    <ul class="course-nav">
                        <?php echo $navigation; ?>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-9">
                <iframe src="<?php echo e('/e-content/'); ?><?php echo e($storyline_item->file_url); ?>" width="100%" class="composite-embed" id="idIframe" frameBorder="0" style="height: 100%; min-height: 750px;" onload="resizeIframe(this)"></iframe>
                <a href="<?php echo e(route('lti.courses.single.lectures.item', [$course->id, $previous])); ?>" class="subtopic-left subtopic-arrow"><i style="font-size: 24px;" class="fa fa-arrow-left"></i></a>
                <a href="<?php echo e(route('lti.courses.single.lectures.item', [$course->id, $next])); ?>" class="subtopic-right subtopic-arrow pull-right"><i style="font-size: 24px;" class="fa fa-arrow-right"></i></a>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('/dist/js/jstree/jstree.min.js')); ?>"></script>
    
    
    
    
    
    
    

    
    
    
    
    
    <script>
        $(function() {
            $('#navigation').jstree({
                'core': {
                    'themes': {
                        'name': 'proton',
                        'responsive': true
                    }
                }
            });
        })
        jQuery("#navigation").on("click","li.jstree-node a",function(){
            document.location.href = this;
        });
        //Add A Class to Open First Item in Tree
        $('ul.course-nav li:first-child').addClass('jstree-open');
    </script>
    
    
    

    <?php $cs = ''; ?>
    <?php for($i = 0; $i < count($custom_scripts); $i++): ?>
        <?php $cs .= $custom_scripts[$i]; ?>
    <?php endfor; ?>

    <script>

        window.onload = function() {
            <?php echo $cs; ?>

            $('a.sidebar-toggle').trigger('click');
        };

        $('.dropdown').hover(function(){
            $('.dropdown-toggle', this).trigger('click');
        });

        $(document).on('load', '#idIframe', function() {
            resizeIframe(this);
        });

        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
//            var frames = $(obj).contents().find('iframe');
//            console.log('frames', frames);
//            for(var i = 0; i < frames.length; i++) {
//                console.log(frames[i]);
//                $(frames[i]).on('onload', function() {
//                    resizeIframe(this);
//                });
//            }
        }
        //        $('[data-submenu]').submenupicker();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>