<?php

Route::get('/auditing/content/show/{audit}', [
    'as' => 'auditing.content.show',
    'uses' => 'ContentAuditController@show'
]);

Route::get('/auditing/content/{storylineItem}', [
    'as' => 'auditing.content.index',
    'uses' => 'ContentAuditController@index'
]);

