<?php $__env->startSection('custom-styles'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
    <script src="<?php echo e(url('/js/ng.js')); ?>"></script>

    <link href="<?php echo e(url('/vendor/appstore/css/radio-checkbox.css')); ?>" rel="stylesheet" />

    <style>

        .header {}

        .filters {width: 180px; float: left;}
        .filters h1 {font-size: 20px; color: #c2c2c2;}

        .applist {margin-left: 180px; padding: 0px 10px 0px 10px;}

        .install-button {width: 180px; float: left;}
        .btn-install {width: 100%; margin: 0px 10px 0px 10px;}

        .search-bar {margin-left: 195px; padding: 0px 10px 0px 10px;}
        .search-bar input[type=text] {outline: none; border-radius: 0px; border-width: 0px 0px 1px 0px; border-color: #e6e6e6; border-style: solid;}
        .search-bar input[type=text]:focus {outline: none; border-color: #fb7217;}

        .form-control {box-shadow: none; transition: none;}
        .form-control:focus {box-shadow: none;}

        .app-entry {width: 200px; margin: 0px 20px 20px 0px; padding: 10px; background: #FFF; height: 300px; position:relative;}

        .tool-desc {font-size: 11px; color: #666; overflow: hidden}

        .tool-title {font-weight: 700; font-size: 13px; color: #c2c2c2;}

        .custom_form_style {width: 100% !important; max-width: 100% !important; display: inline-block; margin: 15px;}

        .app-logo{height: 100px; position: relative; top: 50%; left: 50%;}

        .app-entry img {max-height: 100px; position: absolute; top: 50%; transform: translateY(-50%) translateX(-50%);}

        .btn-entry-container {margin: 0px -10px 0px -10px; background: #fcfcfc; position: absolute; bottom: 0; width: 100%; border-width: 1px 0px 0px 0px; border-style: solid; border-color: #e2e2e2;}

        .btn-entry {padding: 15px 0px 15px 15px; color: #7d7d7d; font-size: 20px;}

        .btn-entry-view {float: left;}

        .btn-entry-delete {padding: 15px 15px 15px 0px; float: right; color: #dd4b39;}

        .caption {position: relative;}

        .block {overflow: hidden; padding: 10px; margin-top: 10px; height: auto; background-color: #f9f9f9;}

        @media (min-width: 768px ) {
            .row {position: relative;}
            .pull-bottom-left {position: absolute; bottom: 0px; left: 10px;}
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <div class="row">
            <?php if(session('error_message')): ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <?php echo e(session('error_message')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('success_message')): ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <?php echo e(session('success_message')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if($errors->count() > 0): ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>


        <div id="tools" ng-app="tools" ng-controller="ToolsListCtrl">
            <header class="header basic-clearfix">

                <div class="row">
                    <div class="install-button">
                        <div class="form-group">
                            <a href="<?php echo e(route('eon.laravellti.install')); ?>" class="btn-install btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Install App</a>
                        </div>
                    </div>

                    <div class="search-bar">
                        <div class="form-group">
                            <input placeholder="Search by name or type" class="form-control" type="text" id="query" ng-model="query"/>
                        </div>
                    </div>

                </div>
            </header>

            <div class="filters">
                <h1>Sort</h1>
                <div class="form-group">
                    <!--<select class="form-control" ng-model="orderList">
                        <option value="name">Sort By Title</option>
                        <option value="description">Sort By Type</option>
                        <option value="">Oldest</option>
                    </select>-->
                    <div class="radio">
                        <input id="radio1" name="sort" type="radio" value="name" ng-model="orderList">
                        <label for="radio1">
                            Sort by Title
                        </label>
                    </div>

                    <div class="radio">
                        <input id="radio2" name="sort" type="radio" value="description" ng-model="orderList">
                        <label for="radio2">
                            Sort By Type
                        </label>
                    </div>

                    <div class="radio">
                        <input id="radio3" name="sort" type="radio" value="oldest" ng-model="orderList">
                        <label for="radio3">
                            Oldest
                        </label>
                    </div>

                </div>
                <hr>

                <h1>Categories</h1>
                <div class="form-group">

                    <div class="radio">
                        <input id="radio4" name="All Categories" type="radio" value="" ng-model="catFilter" checked />
                        <label for="radio4">All Categories</label>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input id="<?php echo e($category['title']); ?>" name="<?php echo e($category['title']); ?>" type="radio" value="<?php echo e($category['title']); ?>" ng-model="catFilter" />
                            <label for="<?php echo e($category['title']); ?>"><?php echo e($category['title']); ?></label><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                    
                        
                    
                        
                    
                    
                

            </div>



            <div class="applist">
                <p><span>Results: <% tools.length %></span></p>
                <div ng-repeat="tool in tools | filter:query | orderBy: orderList | filter:catFilter" class="app-entry shadow pull-left">
                    <div>
                        <div class="app-logo">
                            <img src="<% tool.logo_url %>" alt="" class="img img-responsive">
                        </div>
                        <div class="caption">
                            <h4 class="tool-title"><% tool.title %></h4>
                            <p class="tool-desc"><% tool.description %></p>
                        </div>
                        <div>
                            <div class="btn-entry-container basic-clearfix">
                                <a href="<?php echo e(url('/eon/lti/appstore/launch/<% tool.context_id %>')); ?>" class="btn-entry btn-entry-view" role="button" title="Open">
                                    <span class="glyphicon glyphicon-open"></span>
                                </a>
                                <a href="#" class="btn-entry btn-entry-view" role="button" title="Configure">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </a>
                                <a href="<?php echo e(url('/eon/lti/delete/<% tool.context_id %>')); ?>" class="btn-entry btn-entry-delete" role="button" title="Delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>

    </div> <!-- /container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(document).ready(function () {
            $(".thumbnail").height(Math.max.apply(null, $(".thumbnail").map(function () {
                return $(this).height() + 20;
            })));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>