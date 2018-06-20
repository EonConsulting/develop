<?php

Route::middleware(['role:instructor'])->group(function () {

    Route::get('/course/full-html-export/{course}', [
        'as' => 'export.full-html-export',
        'uses' => 'ExportCourseHtmlController@generate'
    ]);

    Route::get('/course/full-pdf-export/{course}', [
        'as' => 'export.full-pdf-export',
        'uses' => 'ExportCoursePdfController@generate'
    ]);

    Route::post('/course/tao-results-export', [
        'as' => 'export.tao-results-export',
        'uses' => 'TaoResultsExportController@store'
    ]);
});

Route::middleware(['role:instructor|learner'])->group(function () {

    Route::get('/storyline-item/pdf-download/{storyline_item}', [
        'as'=>'export.single-pdf-download',
        'uses'=>'DownloadSinglePdfController@show'
    ]);

    Route::get('/course/html-download/{file}', [
        'as'=>'export.course-html-download',
        'uses'=>'DownloadCourseFileController@show'
    ]);

    Route::get('/course/pdf-download/{file}', [
        'as'=>'export.course-pdf-download',
        'uses'=>'DownloadCoursePdfController@show'
    ]);
});





//Route::post('/html-to-pdf', ['as' => 'html-to-pdf.store','uses' => 'ConvertController@store']);
//Route::get('/module/downloadPDF/{course}',['as'=>'module.downloadPDF','uses'=>'ExportsController@modulePDF']);
//Route::get('/module/print/{course}',['as'=>'module.pdf-view','uses'=>'ExportsController@downloadPDF']);
//Route::post('/module/export-marks',['as'=>'module.export-marks','uses'=>'ExportsController@export_marks']);
//Route::get('/module/csv/download/{course}/{from}/{to}',['as'=>'module.csv-download','uses'=>'ExportsController@csv_download']);

