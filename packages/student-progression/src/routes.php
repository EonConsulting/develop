<?php

Route::group(['middleware' => ['web','learner'], 'prefix' => 'student', 'namespace' => 'EONConsulting\Student\Progression\Http\Controllers'], function() {
        //Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@getFileuploadView');
        Route::post('/progression','DefaultController@storeProgress')->name('student.progression');
        Route::post('/copyleaks','DefaultController@copyleaks')->name('copyleaks');
});
