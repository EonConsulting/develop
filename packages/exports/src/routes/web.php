<?php

//Route::post('/html-to-pdf', ['as' => 'html-to-pdf.store','uses' => 'ConvertController@store']);
Route::get('/module/downloadPDF/{course}',['as'=>'module.downloadPDF','uses'=>'ExportsController@modulePDF']);
Route::get('/module/print/{course}',['as'=>'module.pdf-view','uses'=>'ExportsController@downloadPDF']);