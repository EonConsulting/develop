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

        //Route::match(['get', 'post'], '/save', 'ContentBuilderCore@save')->name('eon.contentbuilder.save');

        //Route::match(['get', 'post'], '/update/{course_id}', 'ContentBuilderCore@update')->name('eon.contentbuilder.update');

        //Route::match(['get', 'post'], '/edit/{course_id}', 'ContentBuilderCore@edit')->name('eon.contentbuilder.edit');

        Route::post('/store', 'ContentBuilderCore@store')->name('eon.contentbuilder.store');

        Route::match(['get', 'post'], '/view/{course_id}', 'ContentBuilderCore@view')->name('eon.contentbuilder.view');

        Route::get('/show/{content}', 'ContentBuilderCore@show')->name('content.show');


        //RESTful Routes
        Route::resource('/categories', 'ContentBuilderCategories');
        Route::resource('/assets', 'ContentBuilderAssets');
        Route::get('/assets/delete/{asset}', 'ContentBuilderAssets@delete')->name('assets.delete');;
        //Route::get('/categories', 'ContentBuilderCategories@index')->name('categories.index');
        
        //other JSON routes
        Route::post('/content-title-exists', "ContentBuilderCore@title_exists")->name('eon.contentbuilder.content.title.exists');
    
    });

});
