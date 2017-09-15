<?php
Route::group(['middleware' => ['web'],'prefix' => 'student', 'namespace' => 'EONConsulting\Student\Progression\Http\Controllers'], function() {
Route::post('/progression','DefaultController@storeProgress');
//Route::match(['post'],'/storeContent','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@storeContent');

});
