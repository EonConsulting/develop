<?php

//Route::post('/html-to-pdf', ['as' => 'html-to-pdf.store','uses' => 'ConvertController@store']);
Route::get('/module/downloadPDF/{course}',['as'=>'module.downloadPDF','uses'=>'ExportsController@downloadPDF']);
Route::get('/module/print/{id}',['as'=>'module.pdf-view','uses'=>'ExportsController@modulePDF']);
