<?php

Route::group(['middleware' => ['web'], 'namespace' => 'EONConsulting\CKEditorPluginV2\Http\Controllers'], function() {

        // list all of the api's

        Route::any('/ckeditorstore', ['as' => 'ckeditorstore', 'uses' => 'CKDomainsController@index']);
        Route::match(['get', 'post'], '/getEditorView', ['as' => 'getEditorView', 'uses' => 'CKDomainsController@getEditorView']);
        Route::any('/ajaxresponse/{context}', ['as' => 'ckresponse', 'uses' => 'CKDomainsController@getAJAXresponse']);     //Route::group(['middleware' => ['auth']], function() {
        Route::match(['get', 'post'], '/connection', ['as' => 'connection', 'uses' => 'CKDomainsController@taoLaunch']);
        Route::any('/cksavedata', ['as' => 'connection', 'uses' => 'CKEditorSaveController@update']);
        Route::any('/htmltoPDF', ['as' => 'htmltoPDF', 'uses' => 'CKEditorSaveController@htmltoPDF']);
        Route::any('/selectsearch', ['as' => 'selectsearch', 'uses' => 'CKDomainsController@selectsearch']);



    //});
});

