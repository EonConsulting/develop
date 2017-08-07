
    <div class="user-box">

        <!--Profile pic icon -->
        <div class="user-icon">
            <img src="<?php echo e(url('/img/templates/user-default.jpg')); ?>" alt="">
        </div>

        <!--Name and online indicator -->
        <div class="user-info">
            <div class="user-name">
                <?php echo e(auth()->user()->name); ?>

            </div>
            <div class="user-online-status">

                <!--
                TODO: if online then class should be user-online-dot,
                      if offline, then user-offline-dot.
                -->
                <div class="user-online-dot"> </div>


                <div class="user-online-text">
                    Online
                </div>

            </div>
        </div>

        <div class="menu-collapse-button">
            <a href="#">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>

        <div class="clearfix"> </div>
    </div>

    <!-- side menu -->

    <div class="left-menu">

    </div>

    <div class="left-menu">
        <ul>


            <li class="<?php echo e((Route::currentRouteName() == 'lti.dashboards') ? 'left-menu-active' : ''); ?>">
                <a href="<?php echo e(($lti == true) ? route('lti.dashboards') : route('home.dashboards')); ?>">
                    <i class="fa fa-braille fa-lg left-menu-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="<?php echo e((Route::currentRouteName() == 'courses' || Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : ''); ?>">
                <a href="<?php echo e((laravel_lti()->is_instructor(auth()->user())) ? '#' : route('lti.courses')); ?>">
                    <i class="fa fa-edit fa-lg left-menu-icon"></i>
                    Modules
                </a>

                <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                <div class="left-menu-sub">
                    <ul>

                        <li class="<?php echo e((Route::currentRouteName() == 'courses') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('courses')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                All
                            </a>
                        </li>


                        <li class="<?php echo e((Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('courses.create')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Create
                            </a>
                        </li>

                    </ul>
                </div>
            <?php endif; ?>

            </li>

            <?php if (laravel_lti()->is_instructor(auth()->user())): ?>

            <!-- TODO: If role == instructor/admin the show this menu item -->
            <li class="<?php echo e((Route::currentRouteName() == 'content.builder') ? 'left-menu-active' : ''); ?>">
                <a href="<?php echo e(route('content.builder')); ?>">
                    <i class="fa fa-book fa-lg left-menu-icon"></i>
                    Content Builder
                </a>
            </li>


            <!-- TODO: If role == instructor/admin the show this menu item -->
            <li class="<?php echo e((Route::currentRouteName() == 'eon.laravellti.appstore') ? 'left-menu-active' : ''); ?>">
                <a href="<?php echo e(route('eon.laravellti.appstore')); ?>">
                    <i class="fa fa-th fa-lg left-menu-icon"></i>
                    App Store
                </a>
                <div class="left-menu-sub">
                <ul>
                    <li class="<?php echo e((Route::currentRouteName() == 'eon.laravellti.appstore') ? 'left-menu-active' : ''); ?>">
                        <a href="<?php echo e(route('eon.laravellti.appstore')); ?>"><i class="fa fa-circle-o left-menu-icon"></i>All Apps</a></li>
                    <li class="<?php echo e((Route::currentRouteName() == 'eon.laravellti.appstore.install') ? 'left-menu-active' : ''); ?>">
                        <a href="<?php echo e(route('eon.laravellti.install')); ?>"><i class="fa fa-circle-o left-menu-icon"></i>Add Apps</a></li>
                    <li class="<?php echo e((Route::currentRouteName() == 'eon.laravellti.cats') ? 'left-menu-active' : ''); ?>">
                        <a href="<?php echo e(route('eon.laravellti.cats')); ?>"><i class="fa fa-circle-o left-menu-icon"></i>Categories</a></li>
                    <li class="<?php echo e((Route::currentRouteName() == 'eeon.laravellti.cats.create') ? 'left-menu-active' : ''); ?>">
                        <a href="<?php echo e(route('eon.laravellti.cats.create')); ?>"><i class="fa fa-circle-o left-menu-icon"></i>Create</a></li>
                </ul>
                </div>
            </li>

            <!-- TODO: If role == admin the show this menu item -->
            <li class="left-menu-tree <?php echo e((Route::currentRouteName() == 'eon.admin.groups' || Route::currentRouteName() == 'eon.admin.permissions' || Route::currentRouteName() == 'eon.admin.roles' || Route::currentRouteName() == 'eon.admin.roles.users') ? 'left-menu-active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-user-circle fa-lg left-menu-icon"></i>
                    Roles and Permissions
                </a>

                <div class="left-menu-sub">
                    <ul>

                        <li class="<?php echo e((Route::currentRouteName() == 'eon.admin.groups') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('eon.admin.groups')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Groups
                            </a>
                        </li>


                        <li class="<?php echo e((Route::currentRouteName() == 'eon.admin.permissions') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('eon.admin.permissions')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Permissions
                            </a>
                        </li>


                        <li class="<?php echo e((Route::currentRouteName() == 'eon.admin.roles') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('eon.admin.roles')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Roles
                            </a>
                        </li>


                        <li class="<?php echo e((Route::currentRouteName() == 'eon.admin.roles.users') ? 'left-menu-active' : ''); ?>">
                            <a href="<?php echo e(route('eon.admin.roles.users')); ?>">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Users
                            </a>
                        </li>

                    </ul>
                </div>

            </li>
        <?php endif; ?>
        </ul>
    </div>
