<?php

Route::post('/html-to-pdf', [
    'as' => 'html-to-pdf.store',
    'uses' => 'ConvertController@store'
]);
