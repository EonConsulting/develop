<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/01/19
 * Time: 9:27 AM
 */

Route::group(['prefix' => '/lti/story', 'namespace' => '\\EONConsulting\\StoryCore\\Controllers', 'middleware' => ['web']], function() {
    Route::match(['get', 'post'], '/', ['as' => 'lti.index', 'uses' => 'StoryCoreController@index']);
    Route::match(['get', 'post'], 'createstory', ['as' => 'lti.lesson', 'uses' => 'StoryCoreController@storyitem']);
});