<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:27 AM
 */

Route::group(['prefix' => '/lti/storyline', 'namespace' => '\\EONConsulting\\Storyline\\Core\\Controllers', 'middleware' => ['web']], function() {
    Route::match(['get', 'post'], '/', ['as' => 'lti.index', 'uses' => 'LTIController@index']);
    Route::match(['get', 'post'], '/{config}', ['as' => 'lti.config', 'uses' => 'LTIController@config']);
    Route::match(['get', 'post'], '/{config}/{link}', ['as' => 'lti.single', 'uses' => 'LTIController@single']);
});
