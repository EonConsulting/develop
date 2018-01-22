<?php



Route::group(['middleware' => ['web'], 'prefix' => 'student', 'namespace' => 'EONConsulting\Student\Progression\Http\Controllers'], function() {
    Route::get('/module/downloadPDF/{course}',['as'=>'module.downloadPDF','uses'=>'DefaultController@downloadPDF']);
    Route::get('/module/print/{id}',['as'=>'module.pdf-view','uses'=>'DefaultController@modulePDF']);
    Route::group(['middleware' => ['auth', 'learner']], function() {
    Route::post('/progression','DefaultController@storeProgress')->name('student.progression');
    });
        
    Route::group(['middleware' => ['auth','instructor']], function() {
        //Route::get('/csv/fileupload/{course}/{filetype}','EONConsulting\Storyline\Table\Http\Controllers\DefaultController@getFileuploadView');
       Route::post('/copyleaks','DefaultController@copyleaks')->name('copyleaks');
    });    
        
});
