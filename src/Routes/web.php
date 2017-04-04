<?php

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\ImgProcessor'], function() {
        // list all Application Routes
        Route::any('/html2PDF', ['as' => 'html2PDF', 'uses' => 'ImgProcessor@load']);

});

