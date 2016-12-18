<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 1:27 PM
 */

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\PHPSaasWrapper\src\Controllers'], function() {
    Route::get('/_eon_authenticate', 'AuthController@auth');
    Route::get('/_eon_phpsaaswrapper/auth/callback', function (\Illuminate\Http\Request $request) {
        return phpsaaswrapper()->callback($request);
    });
    Route::get('/list', 'TestAPIController@index');

    Route::any('/{key}', 'TestAPIController@base_request')->name('phpsaaswrapper.base_request');
    Route::any('/{key}/consume/{use}', 'TestAPIController@consume')->name('phpsaaswrapper.consume');
    Route::any('/{key}/consume/{use}/intermediate', 'TestAPIController@consume_intermediate')->name('phpsaaswrapper.consume.intermediate');
    Route::any('/{key}/consume/{use}/{options}', 'TestAPIController@consume_with_options')->name('phpsaaswrapper.consume_with_options');
});

