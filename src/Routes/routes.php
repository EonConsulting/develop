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
//    Route::get('/cs50', 'TestAPIController@cs50');
    Route::get('/{key}', 'TestAPIController@base_request')->name('phpsaaswrapper.base_request');
    Route::get('/{key}/consume/{use}', 'TestAPIController@consume')->name('phpsaaswrapper.consume');
    Route::get('/{key}/consume/{use}/intermediate', 'TestAPIController@consume_intermediate')->name('phpsaaswrapper.consume.intermediate');
    Route::get('/{key}/consume/{use}/{options}', 'TestAPIController@consume_with_options')->name('phpsaaswrapper.consume_with_options');
});

