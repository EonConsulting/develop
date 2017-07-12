<?php



Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\ImgProcessor'], function() {
        // list all Application Routes
        Route::any('/img-processor', ['as' => 'img.processor', 'uses' => 'ImgProcessor@load_process_image']);

});
