<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:07 AM
 */

Route::group(['middleware' => ['web'],  'namespace' => 'EONConsulting\Graphs\Http\Controllers'], function() {

        // list all of the api's
        Route::any('/savetodatabase', ['as' => 'lecturer.save', 'uses' => 'TestStencilController@save']);
        Route::any('/tested', ['as' => 'eon.test', 'uses' => 'TestStencilController@tested']);
        Route::any('/lecturer', ['as' => 'lecturer.graph', 'uses' => 'TestStencilController@lecturer']);
        Route::any('/graphstore', ['as' => 'lecturer.graphstore', 'uses' => 'TestStencilController@graph_response']);
        Route::any('/graphstore/init/{id}', ['as' => 'lecturer.graphstore.init', 'uses' => 'TestStencilController@init']);
});

Route::match(['get', 'post'], '/fixed', function () {
    
    return view('ph::welcomed');
 
 //   echo phpstencil()->output();
});

Route::match(['get', 'post'], 'igraph', function () {
    
    return view('ph::goodbye');
 
 //   echo phpstencil()->output();
});



//Route::match(['get', 'post'], '/lecturer', function () {
//
//    return view('ph::lecturer');
//
// //   echo phpstencil()->output();
//});


Route::match(['get', 'post'], 'plotgraph', function () {
    
    return view('ph::plotgraph');
    });
