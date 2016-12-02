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
    Route::get('/cs50', 'TestAPIController@cs50');
});

