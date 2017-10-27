<?php
    Route::group(['middleware' => ['web'], 'prefix' => '/eon/lti', 'namespace' => 'EONConsulting\AppStore\Http\Controllers'], function () {
        Route::group(['middleware' => ['auth']], function () {

            // list all of the api's
            Route::match(['get', 'post'], '/appstore', ['as' => 'eon.laravellti.appstore', 'uses' => 'AppStoreController@index']);
            //Added A new Angular Rest Route
            Route::match(['get', 'post'], '/ngappstore', ['as' => 'eon.laravellti.ngappstore', 'uses' => 'AppStoreController@AngularRest']);
            Route::any('/appstore/launch/{context}', ['as' => 'eon.laravellti.appstore.launch', 'uses' => 'AppStoreController@launch']);
        });
    });
