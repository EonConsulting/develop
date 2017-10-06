
<div class="user-box">

    <div id="menu-open">
        <!--Profile pic icon -->
        <div class="user-icon">
            <img src="{{url('/img/templates/user-default.jpg')}}" alt="">
        </div>

        <!--Name and online indicator -->
        <div class="user-info">
            <div class="user-name">
                {{ auth()->user()->name }}
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
            <a href="#" id="collapse-menu" data-toggle="tooltip" data-placement="bottom" title="Collapse Menu">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <div id="menu-closed" class="hidden">
        <div class="menu-open-btn">
            <a href="#" id="expand-menu">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>

    <div class="clearfix"> </div>
</div>

<!-- side menu -->

<div class="left-menu">

</div>

<div class="left-menu">
    <ul>           
        <li class="{{ (Route::currentRouteName() == 'lti.dashboards') ? 'left-menu-active' : '' }}">
            <a href="{{ ($lti == true) ? route('lti.dashboards') : route('home.dashboards') }}">
                <i class="fa fa-braille fa-lg left-menu-icon"></i>
                <span class="menu_collapse">
                    Dashboard
                </span>
            </a>
        </li>

        <?php if (laravel_lti()->is_instructor(auth()->user())) : ?>
            <li class="{{ (Route::currentRouteName() == 'courses' || Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : '' }}">
                <a href="{{ (laravel_lti()->is_instructor(auth()->user())) ? '#' : route('lti.courses') }}" {{ (laravel_lti()->is_instructor(auth()->user())) ? "class=accordian" : "" }}>
                    <i class="fa fa-edit fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        Modules
                    </span>

                    <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                        <span class='pull-right'><i class='toggle fa fa-plus'></i></span>
                    <?php endif; ?>
                </a>

                <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                    <div class="left-menu-sub hidden">
                        <ul>

                            <li class="{{ (Route::currentRouteName() == 'courses') ? 'left-menu-active' : '' }}">
                                <a href="{{ route('courses') }}">
                                    <i class="fa fa-circle-o left-menu-icon"></i>
                                    All
                                </a>
                            </li>

                            <li class="{{ (Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : '' }}">
                                <a href="{{ route('courses.show') }}">
                                    <i class="fa fa-circle-o left-menu-icon"></i>
                                    My Modules
                                </a>
                            </li>

                            <li class="{{ (Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : '' }}">
                                <a href="{{ route('courses.create') }}">
                                    <i class="fa fa-circle-o left-menu-icon"></i>
                                    Create
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </li>

        <?php if (laravel_lti()->is_instructor(auth()->user())) : ?>
            <!-- TODO: If role == instructor/admin the show this menu item -->
            <li class="{{ (Route::currentRouteName() == 'content.builder') ? 'left-menu-active' : '' }}">
                <a href="#" class="accordian">
                    <i class="fa fa-book fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        Content Builder
                    </span>
                    <span class="pull-right"><i class="toggle fa fa-plus"></i></span>
                </a>
                <div class="left-menu-sub hidden">
                    <ul>
                        <li class="{{ (Route::currentRouteName() == 'eon.contentbuilder') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.contentbuilder') }}"><i class="fa fa-circle-o left-menu-icon"></i>All Content</a></li>
                        <li class="{{ (Route::currentRouteName() == 'eon.contentbuilder.new') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.contentbuilder.update', 'new') }}"><i class="fa fa-circle-o left-menu-icon"></i>Create Content</a></li>
                        <li class="{{ (Route::currentRouteName() == 'categories.index') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('categories.index') }}"><i class="fa fa-circle-o left-menu-icon"></i>Categories</a></li>
 
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (laravel_lti()->is_instructor(auth()->user())) : ?>
            <!-- TODO: If role == instructor/admin the show this menu item -->
            <li class="{{ (Route::currentRouteName() == 'eon.laravellti.appstore') ? 'left-menu-active' : '' }}">
                <a href="#" class="accordian">
                    <i class="fa fa-th fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        App Store
                    </span>
                    <span class="pull-right"><i class="toggle fa fa-plus"></i></span>
                </a>
                <div class="left-menu-sub hidden">
                    <ul>
                        <li class="{{ (Route::currentRouteName() == 'eon.laravellti.appstore') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.laravellti.appstore') }}"><i class="fa fa-circle-o left-menu-icon"></i>All Apps</a></li>
                        <li class="{{ (Route::currentRouteName() == 'eon.laravellti.appstore.install') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.laravellti.install') }}"><i class="fa fa-circle-o left-menu-icon"></i>Add Apps</a></li>
                        <li class="{{ (Route::currentRouteName() == 'eon.laravellti.cats') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.laravellti.cats') }}"><i class="fa fa-circle-o left-menu-icon"></i>Categories</a></li>
                        <li class="{{ (Route::currentRouteName() == 'eeon.laravellti.cats.create') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.laravellti.cats.create') }}"><i class="fa fa-circle-o left-menu-icon"></i>Create</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (laravel_lti()->is_admin(auth()->user())) : ?>    
            <!-- TODO: If role == admin the show this menu item -->
            <li class="left-menu-tree {{ (Route::currentRouteName() == 'eon.admin.groups' || Route::currentRouteName() == 'eon.admin.permissions' || Route::currentRouteName() == 'eon.admin.roles' || Route::currentRouteName() == 'eon.admin.roles.users') ? 'left-menu-active' : '' }}">
                <a href="#" class="accordian">
                    <i class="fa fa-user-circle fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        Roles and Permissions
                    </span>
                    <span class="pull-right"><i class="toggle fa fa-plus"></i></span>
                </a>

                <div class="left-menu-sub hidden">
                    <ul>

                        <li class="{{ (Route::currentRouteName() == 'eon.admin.groups') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.groups') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Groups
                            </a>
                        </li>


                        <li class="{{ (Route::currentRouteName() == 'eon.admin.permissions') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.permissions') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Permissions
                            </a>
                        </li>


                        <li class="{{ (Route::currentRouteName() == 'eon.admin.roles') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.roles') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Roles
                            </a>
                        </li>


                        <li class="{{ (Route::currentRouteName() == 'eon.admin.roles.users') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.roles.users') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Users
                            </a>
                        </li>

                    </ul>
                </div>

            </li>
        <?php endif; ?>
        <?php if (laravel_lti()->is_admin(auth()->user())) : ?>
            <li class="{{ (Route::currentRouteName() == 'lti.dashboards') ? 'left-menu-active' : '' }}">
                <a href="#" class="accordian">
                    <i class="fa fa-database fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        Data Maintenance
                    </span>
                    <span class="pull-right"><i class="toggle fa fa-plus"></i></span>
                </a>
                <div class="left-menu-sub hidden">
                    <ul>

                        <li class="{{ (Route::currentRouteName() == 'eon.admin.groups') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.metadata') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Metadata
                            </a>
                        </li>


                    </ul>
                </div>    
            </li>
        <?php endif; ?>
    </ul>
</div>
