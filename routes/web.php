<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Initialise EON LTI Components
*/
//Route::get('/mindmapinit', function () {
//    return mindmap()->getNowMindMap();
//});


Route::get('/', function () {
//    return laravel_lti()->launch('https://dev.unisaonline.net/mahara/auth/blti/login/login.php', 'unisa', '12345');
     return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/builders/page', ['as' => 'builders.page', 'uses' => 'Builders\\PageBuilderController@index']);
    Route::get('/builders/storyline', ['as' => 'builders.storyline', 'uses' => 'Builders\\StorylineBuilderController@index']);
});

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/home');
});

//Route::group(['middleware' => ['auth'], 'prefix' => '/lecturer'], function() {// TODO::replace-test
//Instructor, auth, Sysadmin
//Route::group(['middleware' => ['auth', 'instructor'], 'prefix' => '/lecturer'], function() {  TODO::replace-test
Route::group(['middleware' => ['auth'], 'prefix' => '/lecturer'], function() {
    Route::group(['prefix' => '/courses', 'namespace' => 'Courses'], function() {
        Route::get('/', ['as' => 'courses', 'uses' => 'CoursesController@index']);
        Route::get('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@index']);
        Route::post('/create', ['as' => 'courses.create', 'uses' => 'CreateCourseController@store']);
        Route::get('/{course}', ['as' => 'courses.single', 'uses' => 'CourseController@show']);
        Route::get('/{course}/content', ['as' => 'courses.single.content', 'uses' => 'CourseContentController@index']);
        Route::get('/{course}/content/{storylineItem}', ['as' => 'courses.single.content.item', 'uses' => 'CourseContentController@show']);
        Route::post('/{course}/content/{storylineItem}', ['as' => 'courses.single.content.item', 'uses' => 'CourseContentController@update']);
        Route::get('/{course}/notify', ['as' => 'courses.single.notify', 'uses' => 'CourseNotifyController@index']);
        Route::post('/{course}/notify', ['as' => 'courses.single.notify', 'uses' => 'CourseNotifyController@store']);
        Route::get('/{course}/notify/users', ['as' => 'courses.single.notify.users', 'uses' => 'CourseNotifyController@getUsers']);
        Route::get('/{course}/storyline', ['as' => 'courses.single.storyline', 'uses' => 'CourseStorylineController@index']);
        // Feed POst Route from Web Pack
        //Route::get('/{course}/storyline/feed', ['as' => 'courses.single.storyline.feed', 'uses' => 'CourseStorylineController@get']);

        Route::match(['get', 'post'], '/{course}/storyline/feed', ['as' => 'courses.single.storyline.feed', 'uses' => 'CourseStorylineController@fetch']);
        Route::post('/{course}/storyline', ['as' => 'courses.single.storyline', 'uses' => 'CourseStorylineController@store']);
    });
    Route::group(['prefix' => '/content', 'namespace' => 'Content'], function() {
        Route::get('/builder', ['as' => 'content.builder', 'uses' => 'ContentBuilderController@index']);
        Route::post('/builder', ['as' => 'content.builder', 'uses' => 'ContentBuilderController@store']);
    });
});

//Route::group(['prefix' => '/lti', 'middleware' => ['auth'], 'namespace' => 'LTI'], function() {
Route::group(['prefix' => '/lti', 'namespace' => 'LTI'], function() {
    Route::group(['namespace' => 'Dashboards'], function() {
        Route::match(['get', 'post'], '/', ['as' => 'lti.dashboards', 'uses' => 'DashboardLTIController@index']);
    });
    Route::group(['namespace' => 'Users'], function() {
        Route::match(['get', 'post'], '/profile', ['as' => 'lti.users.profile', 'uses' => 'ProfileLTIController@index']);





        Route::match(['get', 'post'], '/profile/update', ['as' => 'lti.users.profile.update', 'uses' => 'ProfileLTIController@update']);
    });
    Route::group(['namespace' => 'Courses', 'prefix' => '/courses'], function() {
        Route::match(['get', 'post'], '/', ['as' => 'lti.courses', 'uses' => 'CoursesLTIController@index']);
        Route::match(['get', 'post'], '/{course}', ['as' => 'lti.courses.single', 'uses' => 'CourseLTIController@index']);
        Route::match(['get', 'post'], '/{course}/lectures', ['as' => 'lti.courses.single.lectures', 'uses' => 'CourseLectureLTIController@index']);
        Route::match(['get', 'post'], '/{course}/lectures/{storylineItem}', ['as' => 'lti.courses.single.lectures.item', 'uses' => 'CourseLectureItemLTIController@index']);
    });
});

Route::match(['get', 'post'], '/nonltiprofile', ['as' => 'nonlti.users.profile', 'uses' => 'Users\ProfileController@index']);