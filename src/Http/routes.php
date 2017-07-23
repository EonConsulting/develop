<?php

Route::group(['middleware' => ['web'],'prefix' => '/lecturer'], function() {

Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\File\Reader\Http\Controllers\DefaultController@getFileuploadView');
Route::match(['get','post'],'/csv/storeStoryline/{course}','EONConsulting\File\Reader\Http\Controllers\DefaultController@storeStoryline');

});
