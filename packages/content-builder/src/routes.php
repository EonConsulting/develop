<?php

Route::group(['middleware' => ['web'], 'prefix' => 'content', 'namespace' => 'EONConsulting\ContentBuilder\Controllers'], function() {

    /**
     * ------------------------------------
     * Storyline Builder Core Routes
     * ------------------------------------
     */

    //Core Routes
    Route::match(['get', 'post'],'/', 'ContentBuilderCore@index')->name('eon.contentbuilder');

    Route::match(['get', 'post'],'/create', 'ContentBuilderCore@create')->name('eon.contentbuilder.create');

    Route::match(['get', 'post'],'/save', 'ContentBuilderCore@save')->name('eon.contentbuilder.save');

    Route::match(['get', 'post'],'/update/{course_id}', 'ContentBuilderCore@update')->name('eon.contentbuilder.update');

    Route::match(['get', 'post'],'/edit/{course_id}', 'ContentBuilderCore@edit')->name('eon.contentbuilder.edit');

    Route::match(['get', 'post'],'/store', 'ContentBuilderCore@store')->name('eon.contentbuilder.store');

    Route::match(['get', 'post'], '/view/{course_id}', 'ContentBuilderCore@view')->name('eon.contentbuilder.view');

    Route::match(['get', 'post'],'/categories', 'ContentBuilderCategories@index')->name('eon.contentbuilder.categories');

    Route::match(['get', 'post'],'/update-category', 'ContentBuilderCategories@update')->name('eon.contentbuilder.categories.update');


});