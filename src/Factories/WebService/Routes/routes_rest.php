<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:40 AM
 */

Route::group(['namespace' => 'EONConsulting\PHPStencil\src\Factories\WebService\REST\Controllers', 'prefix' => '/_eon_phpstencil/api/rest'], function() {

    Route::get('/{id}', ['as' => 'phpstencil.rest.get', 'uses' => 'RestController@get']);
    Route::put('/', ['as' => 'phpstencil.rest.put', 'uses' => 'RestController@put']);
    Route::post('/{id}', ['as' => 'phpstencil.rest.post', 'uses' => 'RestController@post']);
    Route::delete('/{id}', ['as' => 'phpstencil.rest.delete', 'uses' => 'RestController@delete']);

    /**
     *  PLACE YOUR ROUTES HERE
     */

});