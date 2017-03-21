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
        Route::any('/ajresponse', ['as' => 'ajaxresponse', 'uses' => 'CKLaunchController@getLaunchParams']);
        Route::any('/xmltransport', ['as' => 'xmltransport', 'uses' => 'CKLaunchController@xmltransport']);
        Route::any('/launchtransport', ['as' => 'launchtransport', 'uses' => 'CKLaunchController@launchtransport']);
        Route::any('/cklaunch', ['as' => 'cklaunch', 'uses' => 'CKLaunchController@newLaunch']);
        Route::any('/ckesavedata', ['as' => 'ckesavedata', 'uses' => 'SaveController@update']);
});


