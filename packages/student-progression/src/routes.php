<?php

Route::group(['middleware' => ['web'], 'prefix' => 'student', 'namespace' => 'EONConsulting\Student\Progression\Http\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function() {

        //Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@getFileuploadView');
        Route::post('/progression', 'DefaultController@storeProgress')->name('student.progression');
        //Route::match(['post'],'/storeContent','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@storeContent');
    });
});
