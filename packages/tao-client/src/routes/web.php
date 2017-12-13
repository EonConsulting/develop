<?php

Route::group(['namespace' => '\EONConsulting\TaoClient\Http\Controllers', 'middleware' => ['web']], function () {

    Route::get('/tao-client/show', [
        'as' => 'tao-client.show',
        'uses' => 'TaoController@show'
    ]);

    Route::post('/tao-client/store', [
        'as' => 'tao-client.store',
        'uses' => 'TaoController@store'
    ]);


    Route::any('/tao-outcome/store', [
        'as' => 'tao-outcome.store',
        'uses' => 'OutcomeController@store'
    ]);

    Route::get('/tao-outcome/show', [
        'as' => 'tao-outcome.show',
        'uses' => 'OutcomeController@show'
    ]);

});

