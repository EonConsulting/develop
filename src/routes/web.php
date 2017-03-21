<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:07 AM
 */

Route::group(['middleware' => ['web'],  'namespace' => 'EONConsulting\Graphs\Http\Controllers'], function() {

        // list all of the api's
        Route::any('/savetodatabase', ['as' => 'eon.test', 'uses' => 'TestStencilController@save']);
        Route::any('/tested', ['as' => 'eon.test', 'uses' => 'TestStencilController@tested']);


        Route::post('/delete/{lticontext}', ['as' => 'eon.laravellti.delete', 'uses' => 'DeleteLTIToolController@destroy']);

       

        Route::match(['get', 'post'], '/insert', 'TestStencilController@insert');
});

Route::match(['get', 'post'], '/fixed', function () {
    
    return view('ph::welcomed');
 
 //   echo phpstencil()->output();
});

Route::match(['get', 'post'], 'igraph', function () {
    
    return view('ph::goodbye');
 
 //   echo phpstencil()->output();
});

Route::match(['get', 'post'], '/lecturer', function () {
    
    return view('ph::lecturer');
 
 //   echo phpstencil()->output();
});

Route::match(['get', 'post'], '/insert', 'TestStencilController@insert'); 
Route::match(['get', 'post'], '/student', function () {
    
    return view('ph::student');
 
 //   echo phpstencil()->output();
});