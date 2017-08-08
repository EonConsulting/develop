<?php
/**
 * Routes for the PHPSaaSWrapper
 */

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\PHPSaasWrapper\src\Controllers'], function() {
    // authentication via OAuth
    Route::get('/_eon_authenticate', 'AuthController@auth');
    Route::get('/_eon_phpsaaswrapper/auth/callback', function (\Illuminate\Http\Request $request) {
        return phpsaaswrapper()->callback($request);
    });

    // list all of the api's
    Route::get('/list', 'TestAPIController@index');

    // API usage
    Route::get('/_eon/{key}', 'TestAPIController@base_request')->name('phpsaaswrapper.base_request');
    Route::get('/_eon/{key}/consume/{use}', 'TestAPIController@consume')->name('phpsaaswrapper.consume');
    Route::get('/_eon/{key}/consume/{use}/intermediate', 'TestAPIController@consume_intermediate')->name('phpsaaswrapper.consume.intermediate');
    Route::get('/_eon/{key}/consume/{use}/{options}', 'TestAPIController@consume_with_options')->name('phpsaaswrapper.consume_with_options');
});

