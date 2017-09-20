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


        Route::match(['get', 'post'],'/new', 'ContentBuilderCore@new')->name('eon.contentbuilder.new');

        Route::match(['get', 'post'],'/save', 'ContentBuilderCore@save')->name('eon.contentbuilder.save');

        Route::match(['get', 'post'],'/update/{course_id}', 'ContentBuilderCore@update')->name('eon.contentbuilder.update');

        Route::match(['get', 'post'],'/edit/{course_id}', 'ContentBuilderCore@edit')->name('eon.contentbuilder.edit');

        Route::match(['get', 'post'],'/store', 'ContentBuilderCore@store')->name('eon.contentbuilder.store');

        Route::match(['get', 'post'], '/view/{course_id}', 'ContentBuilderCore@view')->name('eon.contentbuilder.view');

        //Route::match(['get', 'post'],'/categories', 'ContentBuilderCategories@index')->name('eon.contentbuilder.categories');

        Route::get('/{content}', 'ContentBuilderCore@show')->name('content.show');

        //-----------------------------------------------------------------------------------------------------------------------

        /*Route::post('/categories/update', 'ContentBuilderCategories@update')->name('eon.contentbuilder.categories.update');

        Route::get('/categories/{$category_id}', 'ContentBuilderCategories@json')->name('eon.contentbuilder.categories.get');

        Route::get('/categories/delete/{$category_id}', 'ContentBuilderCategories@delete')->name('eon.contentbuilder.categories.delete');*/

        Route::resource('/categories', 'ContentBuilderCategories');
    
    });

});