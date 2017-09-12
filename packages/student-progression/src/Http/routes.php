<?php

Route::group(['middleware' => ['web'],'prefix' => '/student'], function(){
//Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@getFileuploadView');
Route::match(['post'],'/progression','EONConsulting\Student\Progression\Http\Controllers\DefaultController@storeProgress');
//Route::match(['post'],'/storeContent','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@storeContent');
});
