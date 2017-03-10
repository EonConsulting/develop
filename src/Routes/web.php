<?php

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\CKEditorPluginV2\Http\Controllers'], function() {

        // list all of the api's
        Route::match(['get', 'post'], '/ckeditorstore', ['as' => 'ckeditorstore', 'uses' => 'CKDomainsController@index']);
       // Route::any('/appstore/launch/{context}', ['as' => 'eon.laravellti.appstore.launch', 'uses' => 'CKDomainsController@launch']);
        //Route::group(['middleware' => ['auth']], function() {

    //});
});

