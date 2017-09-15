<?php

Route::group(['middleware' => ['web'],'prefix' => 'student', 'namespace' => 'EONConsulting\Student\Progression\Http\Controllers'], function() {

//Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@getFileuploadView');
Route::post('/progression',['as' => 'student.progression', 'uses' => 'DefaultController@storeProgress']);
//Route::match(['post'],'/storeContent','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@storeContent');

});