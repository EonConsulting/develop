<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:07 AM
 */

Route::group(['middleware' => ['web']], function () {
    // your routes here
    Route::match(['get', 'post'], '/lti/stencil/test', '\\EONConsulting\\PHPStencil\\Http\\Controllers\\TestStencilController@test');
});