<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:40 AM
 */

Route::group(['namespace' => 'EONConsulting\PHPStencil\src\Factories\WebService\REST\Controllers'], function() {
    Route::get('/_eon_phpstencil/api/rest/{id}', ['as' => 'phpstencil.rest.get', 'uses' => 'RestController@get']);
    Route::put('/_eon_phpstencil/api/rest', ['as' => 'phpstencil.rest.put', 'uses' => 'RestController@put']);
    Route::post('/_eon_phpstencil/api/rest/{id}', ['as' => 'phpstencil.rest.post', 'uses' => 'RestController@post']);
    Route::delete('/_eon_phpstencil/api/rest/{id}', ['as' => 'phpstencil.rest.delete', 'uses' => 'RestController@delete']);
});