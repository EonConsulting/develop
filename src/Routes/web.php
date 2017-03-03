<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/21
 * Time: 10:47 PM
 */

Route::group(['prefix' => '/file-manager', 'middleware' => ['web', 'auth'], 'namespace' => 'EONConsulting\\FileManager\\Http\\Controllers'], function() {
    Route::get('/', ['as' => 'eon.file-manager', 'uses' => 'FileManagerController@index']);
    Route::post('/save', ['as' => 'eon.file-manager.save', 'uses' => 'FileManagerController@update']);
    Route::get('/editor', ['as' => 'eon.file-manager.editor', 'uses' => 'EditorController@index']);
});