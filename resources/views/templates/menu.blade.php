
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
    <ul>    
        <li class="{{ (Route::currentRouteName() == 'lti.dashboards' || 
                    Route::currentRouteName() == 'home.dashboards' || 
                    Route::currentRouteName() == 'lti.dashboards.lecturer-stud-analysis' || 
                    Route::currentRouteName() == 'lti.dashboards.mentor-stud-analysis' || 
                    Route::currentRouteName() == 'lti.dashboards.lecturer-course-analysis' || 
                    Route::currentRouteName() == 'lti.dashboards.lecturer-assess-analysis'
                ) ? 'left-menu-active' : '' }}">



            <a href="{{ (laravel_lti()->is_instructor(auth()->user()) || laravel_lti()->is_mentor(auth()->user())) ? '#' : route('lti.dashboards') }}" {{ (laravel_lti()->is_instructor(auth()->user()) || laravel_lti()->is_mentor(auth()->user())) ? "class=accordian" : "" }}>
                <i class="fa fa-braille fa-lg left-menu-icon"></i>
                <span class="menu_collapse">
                    Dashboard
                </span>

                <?php if (laravel_lti()->is_instructor(auth()->user()) || laravel_lti()->is_mentor(auth()->user())): ?>
                    <span class='pull-right'><i class='toggle fa fa-plus'></i></span>
                <?php endif; ?>
            </a>

            <?php if (laravel_lti()->is_instructor(auth()->user()) || laravel_lti()->is_mentor(auth()->user())): ?>
                <div class="left-menu-sub {{ (Route::currentRouteName() == 'lti.dashboards' ||
                                                            Route::currentRouteName() == 'home.dashboards' ||
                                                            Route::currentRouteName() == 'lti.dashboards.lecturer-stud-analysis' || 
                                                            Route::currentRouteName() == 'lti.dashboards.mentor-stud-analysis' || 
                                                            Route::currentRouteName() == 'lti.dashboards.lecturer-course-analysis' || 
                                                            Route::currentRouteName() == 'lti.dashboards.lecturer-assess-analysis'
                                                        ) ? '' : 'hidden' }}">
                    <ul>

                        <li class="{{ (Route::currentRouteName() == 'home.dashboards') ? 'left-menu-active' : '' }}">
                            <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                                <a href="{{ route('lti.dashboards.lecturer-stud-analysis') }}">
                                <?php elseif (laravel_lti()->is_mentor(auth()->user())): ?>
                                    <a href="{{ route('lti.dashboards.mentor-stud-analysis') }}">    
                                    <?php endif; ?>
                                    <i class="fa fa-circle-o left-menu-icon"></i>
                                    Student Analysis
                                </a>
                        </li>

                        <?php if (laravel_lti()->is_instructor(auth()->user())): ?>
                            <li class="{{ (Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : '' }}">
                                <a href="{{ route('lti.dashboards.lecturer-course-analysis') }}">
                                    <i class="fa fa-circle-o left-menu-icon"></i>
                                    Course Analysis
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="{{ (Route::currentRouteName() == 'courses.create') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('lti.dashboards.lecturer-assess-analysis') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Assessment Analysis
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

        </li>
        
        <li class="{{ (Route::currentRouteName() == 'lti.dashboards.planning') ? 'left-menu-active' : '' }}">
            <a href="{{ route('lti.dashboards.planning') }}" class="planning"> <i class="fa fa-calendar left-menu-icon"></i> Planning</a>
        </li>

        <?php // if (laravel_lti()->is_instructor(auth()->user())): ?>
        <li class="{{ (Route::currentRouteName() == 'courses' || Route::currentRouteName() == 'courses.create' || Route::currentRouteName() == 'courses.show') ? 'left-menu-active' : '' }}">
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
                <div class="left-menu-sub {{ (Route::currentRouteName() == 'courses' || Route::currentRouteName() == 'courses.create' || Route::currentRouteName() == 'courses.show') ? '' : 'hidden' }}">
                    <ul>

                        <li class="{{ (Route::currentRouteName() == 'courses') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('courses') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                All
                            </a>
                        </li>

                        <li class="{{ (Route::currentRouteName() == 'courses.show') ? 'left-menu-active' : '' }}">
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
            <?php //endif; ?>
        </li>

        <?php if (laravel_lti()->is_instructor(auth()->user())) : ?>
            <!-- TODO: If role == instructor/admin the show this menu item -->
            <li class="{{ (Route::currentRouteName() == 'content.builder' || Route::currentRouteName() == 'eon.contentbuilder' || Route::currentRouteName() == 'eon.contentbuilder.update' || Route::currentRouteName() == 'categories.index') || Route::currentRouteName() == ('assets.index') || Route::currentRouteName() == ('assets.create') ? 'left-menu-active' : '' }}">
                <a href="#" class="accordian">
                    <i class="fa fa-book fa-lg left-menu-icon"></i>
                    <span class="menu_collapse">
                        Content Builder
                    </span>
                    <span class="pull-right"><i class="toggle fa fa-plus"></i></span>
                </a>
                <div class="left-menu-sub {{ (Route::currentRouteName() == 'eon.contentbuilder' || Route::currentRouteName() == 'eon.contentbuilder.update' || Route::currentRouteName() == 'categories.index') || Route::currentRouteName() == ('assets.index') || Route::currentRouteName() == ('assets.create') ? '' : 'hidden' }}">
                    <ul>
                        <li></li>
                        <a href="{{ route('eon.contentbuilder') . '?from=0&size=12&searchterm=' }}"><i class="fa fa-circle-o left-menu-icon"></i>All Content</a>
                        </li>
                        <li>
                            <a href="{{ route('eon.contentbuilder.update', 'new') }}"><i class="fa fa-circle-o left-menu-icon"></i>Create Content</a>
                        </li>
                        <li>
                            <a href="{{ route('assets.index') . '?from=0&size=20&searchterm=' }}"><i class="fa fa-circle-o left-menu-icon"></i>All Assets</a>
                        </li>
                        <li>
                            <a href="{{ route('assets.create') }}"><i class="fa fa-circle-o left-menu-icon"></i>Create Asset</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}"><i class="fa fa-circle-o left-menu-icon"></i>Categories</a>
                        </li>

                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (laravel_lti()->is_admin(auth()->user())) : ?>
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
                        <!--
                        <li class="{{ (Route::currentRouteName() == 'eon.admin.groups') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.groups') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Groups
                            </a>
                        </li>
                        -->
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

                        <li class="{{ (Route::currentRouteName() == 'eon.admin.metadata-item') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.metadata-item') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Metadata Items
                            </a>
                        </li>
                        <li class="{{ (Route::currentRouteName() == 'eon.admin.metadata-type') ? 'left-menu-active' : '' }}">
                            <a href="{{ route('eon.admin.metadata-type') }}">
                                <i class="fa fa-circle-o left-menu-icon"></i>
                                Metadata Types
                            </a>
                        </li>

                    </ul>
                </div>    
            </li>
        <?php endif; ?>
        <li><a href="#" class="support"> <i class="fa fa-support left-menu-icon"></i> Support</a></li>
        <li><a href="javascript:void();" id="messages-index"> <i class="fa fa-commenting-o left-menu-icon"></i> Messages</a></li>
    </ul>
</div>

<div id="support2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p class="v-alert"></p>

                <div class="form-group">
                    <input type="text" class="form-control" name="subject" autocomplete="off" id="subj" placeholder="Subject">
                </div>

                <div class="form-group">
                    <textarea class="form-control textarea" rows="3" name="message" id="message" placeholder="Message"></textarea>
                </div>

                {{ csrf_field()}} 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="support" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="support-m">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Support Message</h4>
                </div>

                <div class="modal-body">
                    <p class="v-alert"></p>

                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" autocomplete="off" id="subj" placeholder="Subject">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control textarea" rows="3" name="message" id="msg" placeholder="Message"></textarea>
                    </div>

                    {{ csrf_field()}}

                </div>

                <div class="modal-footer">                        
                    <button type="submit" class="btn btn-primary send-m">Send a message</button>
                    <button type="button" class="btn btn-default close-m" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>

    </div>
</div>

@include('messages::popup')