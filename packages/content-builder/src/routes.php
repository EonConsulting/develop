<?php

Route::group(['middleware' => ['web'], 'prefix' => 'content', 'namespace' => 'EONConsulting\ContentBuilder\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function() {
        
        /**
         * ------------------------------------
         * Content Builder Core Routes
         * ------------------------------------
         */
        
        //Core Routes
        Route::get('/', 'ContentBuilderCore@index')->name('eon.contentbuilder');

        Route::get('/update/{content_id}', 'ContentBuilderCore@update')->name('eon.contentbuilder.update');
        Route::post('/update}', 'ContentBuilderCore@update_asset')->name('asset.update');
        Route::post('/store', 'ContentBuilderCore@store')->name('eon.contentbuilder.store');
        Route::match(['get', 'post'], '/view/{course_id}', 'ContentBuilderCore@view')->name('eon.contentbuilder.view');
        Route::get('/show/{content}', 'ContentBuilderCore@show')->name('content.show');
        Route::post('/search', 'ContentBuilderCore@contentSearchToHTML')->name('content.search');
        Route::post('/assets/search', 'ContentBuilderAssets@assetSearchToHTML')->name('content.search');

        //RESTful Routes
        Route::resource('/categories', 'ContentBuilderCategories');
        Route::resource('/assets', 'ContentBuilderAssets');
        Route::get('/assets/delete/{asset}', 'ContentBuilderAssets@delete')->name('assets.delete');
        Route::get('/assets/edit/{asset}', 'ContentBuilderAssets@edit')->name('assets.edit');
        //Route::get('/categories', 'ContentBuilderCategories@index')->name('categories.index');
        
        //other JSON routes
        Route::post('/content-title-exists', "ContentBuilderCore@title_exists")->name('eon.contentbuilder.content.title.exists');
    
    });

});
