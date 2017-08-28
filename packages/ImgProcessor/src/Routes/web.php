<?php

Route::group(['middleware' => ['web'],'prefix' => '/img-processor', 'namespace' => 'EONConsulting\ImgProcessor'], function() {
        // list all Application Routes
        Route::any('/', ['as' => 'img.processor', 'uses' => 'ImgProcessor@init']);
        Route::any('/{key}/', ['as' => 'img.key.processor', 'uses' => 'ImgProcessor@load_process_image_key']);
        //Route::any('/{key}/', ['as' => 'img.key.processor', 'uses' => 'ImgProcessor@load_process_image_key']);
});
