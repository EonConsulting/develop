<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:07 AM
 */

Route::group(['middleware' => ['web'],  'namespace' => 'EONConsulting\MindMap\Http\Controllers'], function() {

        // list all of the api's
        Route::any('/mindmap', ['as' => 'eon.mindmap', 'uses' => 'TestStencilController@index']);
        Route::any('/tested', ['as' => 'eon.test', 'uses' => 'TestStencilController@tested']);
  
});
//
//Route::match(['get', 'post'], '/fixed', function () {
//
//    return view('ph::index');
//
// //   echo phpstencil()->output();
//});
//
//Route::match(['get', 'post'], 'igraph', function () {
//
//    return view('ph::goodbye');
//
// //   echo phpstencil()->output();
//});
//
//Route::match(['get', 'post'], '/lecturer', function () {
//
//    return view('ph::lecturer');
//
// //   echo phpstencil()->output();
//});
//
//
//Route::match(['get', 'post'], 'plotgraph', function () {
//
//    return view('ph::plotgraph');
//    });