<?php

//Route::post('/html-to-pdf', ['as' => 'html-to-pdf.store','uses' => 'ConvertController@store']);
Route::get('/module/downloadPDF/{course}',['as'=>'module.downloadPDF','uses'=>'ExportsController@modulePDF']);
Route::get('/module/print/{course}',['as'=>'module.pdf-view','uses'=>'ExportsController@downloadPDF']);
Route::post('/module/export-marks',['as'=>'module.export-marks','uses'=>'ExportsController@export_marks']);
Route::get('/module/csv/download/{course}/{from}/{to}',['as'=>'module.csv-download','uses'=>'ExportsController@csv_download']);

