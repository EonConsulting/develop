<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:07 AM
 */

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\CKEditorPlugin\Http\Controllers'], function() {

        // CK Editor Routes
        Route::any('/ltiCKEditor', ['as' => 'ckeditor.', 'uses' => 'CKLaunchController@setLaunchContent']);
        Route::get('/forms', ['as' => 'ckeditor.launchframe', 'uses' => 'CKLaunchController@forms']);
        Route::any('/launchUrlEditor', ['as' => 'ckeditor.launchurl', 'uses' => 'CKLaunchController@getLaunchContent']);
        Route::post('/postUrlEditor', ['as' => 'ckeditor.launchurl', 'uses' => 'CKLaunchController@setLaunchContent']);

});
