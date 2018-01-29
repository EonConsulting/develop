<?php

/*
  |--------------------------------------------------------------------------
  | E-Content System Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now work !
  |
  | These Routes are only System Specific Routes, Package and Component
  | Routes are in there individual packages.
  |
 */

/*
 * ---------------------------------------
 * Public Front Page
 * ---------------------------------------
 */
Route::get('/', function () {
//    return laravel_lti()->launch('https://dev.unisaonline.net/mahara/auth/blti/login/login.php', 'unisa', '12345');
    return view('welcome');
});

/*
 * ---------------------------------------
 * Auth::routes();
 * ---------------------------------------
 */
Auth::routes();
/*
 * ---------------------------------------
 * Builders : Page : Storyline
 * ---------------------------------------
 */

Route::group(['middleware' => ['auth']], function () {
    Route::get('/builders/page', ['as' => 'builders.page', 'uses' => 'Builders\\PageBuilderController@index']);
    Route::get('/builders/storyline', ['as' => 'builders.storyline', 'uses' => 'Builders\\StorylineBuilderController@index']);
});

/*
 * --------------------------------------
 * Home - Non LTI Routes
 * --------------------------------------
 */
Route::group(['middleware' => ['auth'], 'prefix' => '/home'], function () {
    Route::match(['get', 'post'], '/', ['as' => 'home.dashboards', 'uses' => 'HomeController@index']);
    Route::group(['namespace' => 'Users'], function () {
        Route::match(['get', 'post'], '/profile', ['as' => 'home.users.profile', 'uses' => 'ProfileController@index']);
        Route::match(['get', 'post'], '/profile/update', ['as' => 'home.users.profile.update', 'uses' => 'ProfileController@update']);
    });
    Route::group(['namespace' => 'Courses', 'prefix' => '/courses'], function () {
        //NON LTI Courses Controller - Create an Instance of the Same Course
        Route::match(['get', 'post'], '/', ['as' => 'home.courses', 'uses' => 'CoursesController@courses']);
        Route::match(['get', 'post'], '/{course}', ['as' => 'home.courses.single', 'uses' => 'CourseController@course']);

        Route::match(['get', 'post'], '/{course}/lectures', ['as' => 'home.courses.single.lectures', 'uses' => 'CourseLectureController@index']);
        Route::match(['get', 'post'], '/{course}/lectures/{storylineItem}', ['as' => 'home.courses.single.lectures.item', 'uses' => 'CourseLectureItemController@index']);
    });
});



//Route::match(['get', 'post'], '/nonltiprofile', ['as' => 'nonlti.users.profile', 'uses' => 'Users\ProfileController@index']);
//Route::group(['middleware' => ['auth'], 'prefix' => '/lecturer'], function() {// TODO::replace-test
//Instructor, auth, Sysadmin
//Route::group(['middleware' => ['auth', 'instructor'], 'prefix' => '/lecturer'], function() {  // TODO::replace-test



/*
 * --------------------------------------
 * Lecturer - Routes
 * --------------------------------------
 */

Route::group(['middleware' => ['auth','instructor'], 'prefix' => '/lecturer'], function () {
    Route::group(['prefix' => '/courses', 'namespace' => 'Courses'], function () {
        Route::get('/', ['as' => 'courses', 'uses' => 'CoursesController@index']);
        Route::get('/show', ['as' => 'courses.show', 'uses' => 'CoursesController@show']);
        Route::get('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@index']);        
        Route::get('/{course}', ['as' => 'courses.single', 'uses' => 'CourseController@show']);
        Route::get('/{course}/content', ['as' => 'courses.single.content', 'uses' => 'CourseContentController@index']);
        Route::get('/{course}/content/{storylineItem}', ['as' => 'courses.single.content.item', 'uses' => 'CourseContentController@show']);
        Route::post('/{course}/content/{storylineItem}', ['as' => 'courses.single.content.item', 'uses' => 'CourseContentController@update']);
        //Route::get('/{course}/notify', ['as' => 'courses.single.notify', 'uses' => 'CourseNotifyController@index']);
        //Route::post('/{course}/notify', ['as' => 'courses.single.notify', 'uses' => 'CourseNotifyController@store']);
        Route::get('/{course}/notify/users', ['as' => 'courses.single.notify.users', 'uses' => 'CourseNotifyController@getUsers']);
        Route::post('/edit', ['as' => 'courses.edit', 'uses' => 'CoursesController@edit']);
        Route::post('/update', ['as' => 'courses.update', 'uses' => 'CoursesController@update']);
        Route::post('/course-metadata/update', ['as' => 'course-metadata.update', 'uses' => 'CreateCourseController@updatemetadata']);
        Route::post('/store-metadata', ['as' => 'courses.storemetadata', 'uses' => 'CreateCourseController@storemetadata']);
        Route::get('/metadata-store/{id}', ['as' => 'metadata.list', 'uses' => 'CreateCourseController@metadatalist']);
        Route::get('/view-metadata/{id}', ['as' => 'courses.viewmetadata', 'uses' => 'CreateCourseController@viewmetadata']);
        Route::post('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@store']);
        Route::get('/create/metadata', ['as' => 'courses.create.metadata', 'uses' => 'CreateCourseController@fill_metadata_store']); 
        // Feed POst Route from Web Pack
        //Route::get('/{course}/storyline/feed', ['as' => 'courses.single.storyline.feed', 'uses' => 'CourseStorylineController@get']);
        Route::match(['get', 'post'], '/{course}/storyline/feed', ['as' => 'courses.single.storyline.feed', 'uses' => 'CourseStorylineController@fetch']);
        Route::post('/{course}/storyline', ['as' => 'courses.single.storyline', 'uses' => 'CourseStorylineController@store']);
    });
});

/*
 * --------------------------------------
 * Home - LTI Routes
 * --------------------------------------
 */
//
//Route::group(['prefix' => '/lti', 'middleware' => ['auth'], 'namespace' => 'LTI'], function() {
Route::group(['prefix' => '/lti', 'namespace' => 'LTI'], function () {
    Route::group(['namespace' => 'Dashboards'], function () {
        Route::match(['get', 'post'], '/', ['as' => 'lti.dashboards', 'uses' => 'DashboardLTIController@index']);
        Route::match(['get', 'post'], '/lecturer-course-analysis', ['as' => 'lti.dashboards.lecturer-course-analysis', 'uses' => 'DashboardLTIController@lecturer_course_analysis']);
        Route::match(['get', 'post'], '/lecturer-stud-analysis', ['as' => 'lti.dashboards.lecturer-stud-analysis', 'uses' => 'DashboardLTIController@lecturer_stud_analysis']);
        Route::match(['get', 'post'], '/lecturer-assess-analysis', ['as' => 'lti.dashboards.lecturer-assess-analysis', 'uses' => 'DashboardLTIController@lecturer_assess_analysis']);
        Route::match(['get', 'post'], '/mentor-stud-analysis', ['as' => 'lti.dashboards.mentor-stud-analysis', 'uses' => 'DashboardLTIController@mentor_stud_analysis']);
        Route::match(['get', 'post'], '/mentor-assess-analysis', ['as' => 'lti.dashboards.mentor-assess-analysis', 'uses' => 'DashboardLTIController@mentor_assess_analysis']);
        Route::match(['get', 'post'], '/planning', ['as' => 'lti.dashboards.planning', 'uses' => 'DashboardLTIController@planning']);
    });
    Route::group(['namespace' => 'Data'], function() {
        Route::match(['get'], '/data-courses/', ['as' => 'lti.dashboards.data-courses', 'uses' => 'DashboardDataController@data_courses']);
        Route::match(['get'], '/data-students/{course_id}', ['as' => 'lti.dashboards.data-students', 'uses' => 'DashboardDataController@data_students']);
        Route::match(['get'], '/data-assessment-types/{course_id}/{student_id}/{assessment}', ['as' => 'lti.dashboards.data-assessment-types', 'uses' => 'DashboardDataController@data_assessment_types']);
        Route::match(['get'], '/data-assessment-results/{course_id}/{student_id}/{assessment_type}', ['as' => 'lti.dashboards.data-assessment-results', 'uses' => 'DashboardDataController@data_assessment_results']);
        Route::match(['get'], '/data-progression/{course_id}/{student_id}', ['as' => 'lti.dashboards.data-progression', 'uses' => 'DashboardDataController@data_progression']);
        Route::match(['get'], '/data-timeline/', ['as' => 'lti.dashboards.data-timeline', 'uses' => 'DashboardDataController@filter_timeline_events']);
    });
    Route::group(['namespace' => 'Users'], function () {
        Route::match(['get', 'post'], '/profile', ['as' => 'lti.users.profile', 'uses' => 'ProfileLTIController@index']);
        Route::match(['get', 'post'], '/profile/update', ['as' => 'lti.users.profile.update', 'uses' => 'ProfileLTIController@update']);
    });
    Route::group(['namespace' => 'Courses', 'prefix' => '/courses'], function () {
        Route::match(['get', 'post'], '/', ['as' => 'lti.courses', 'uses' => 'CoursesLTIController@index']);
        Route::match(['get', 'post'], '/{course}', ['as' => 'lti.courses.single', 'uses' => 'CourseLTIController@index']);
        Route::match(['get', 'post'], '/{course}/lectures', ['as' => 'lti.courses.single.lectures', 'uses' => 'CourseLectureLTIController@index']);
        Route::match(['get', 'post'], '/{course}/lectures/{storylineItem}', ['as' => 'lti.courses.single.lectures.item', 'uses' => 'CourseLectureItemLTIController@index']);
    });
});

/*
 * ----------------------------------------------------
 * Other Routes
 * ----------------------------------------------------
 */
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return Redirect::to('/home');
});

/*
 * ----------------------------------------------------
 * Playground API's
 * ----------------------------------------------------
 */
Route::group(['prefix' => '/apis']/* 'middleware' => 'auth'] */, function () {
    Route::match(['get', 'post'], '/loggeduser', ['as' => 'current.user', 'uses' => 'HomeController@current_user']);
});
