<?php

Route::group(['middleware' => ['web'], 'prefix' => '/eon/lti', 'namespace' => 'EONConsulting\AppStore\Http\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function() {

        // list all of the api's
        Route::get('/appstore', ['as' => 'eon.laravellti.appstore', 'uses' => 'AppStoreController@index']);
        Route::any('/appstore/launch/{context}', ['as' => 'eon.laravellti.appstore.launch', 'uses' => 'AppStoreController@launch']);
    });
});

