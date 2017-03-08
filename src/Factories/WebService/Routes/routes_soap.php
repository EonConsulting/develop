<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:47 AM
 */

Route::group(['namespace' => 'EONConsulting\PHPStencil\src\Factories\WebService\SOAP\Controllers', 'prefix' => '/_eon_phpstencil/api/soap'], function() {
    Route::get('/{id}', ['as' => 'phpstencil.rest.get', 'uses' => 'RestController@get']);
    Route::put('/', ['as' => 'phpstencil.rest.put', 'uses' => 'RestController@put']);
    Route::post('/{id}', ['as' => 'phpstencil.rest.post', 'uses' => 'RestController@post']);
    Route::delete('/{id}', ['as' => 'phpstencil.rest.delete', 'uses' => 'RestController@delete']);
});