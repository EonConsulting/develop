<?php

Route::group(['namespace' => 'EONConsulting\HtmlToPdf\Controllers', 'middleware' => ['web']], function () {

    Route::post('/html-to-pdf', [
        'middleware' => ['web'],
        'as' => 'html-to-pdf.store',
        'uses' => 'ConvertController@store'
    ]);
});