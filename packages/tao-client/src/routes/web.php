<?php

Route::get('/tao-client/show', ['middleware' => ['web', 'auth', 'role:instructor|learner'],
    'as' => 'tao-client.show',
    'uses' => 'TaoController@show'
]);

Route::post('/tao-client/store', ['middleware' => ['web', 'auth', 'role:instructor'],
    'as' => 'tao-client.store',
    'uses' => 'TaoController@store'
]);

Route::any('/tao-outcome/store', ['middleware' => [\EONConsulting\TaoClient\Http\Middleware\TaoOutcome::class],
    'as' => 'tao-outcome.store',
    'uses' => 'OutcomeController@store'
]);

Route::get('/tao-outcome/show', ['middleware' => ['web', 'auth', 'role:instructor|learner'],
    'as' => 'tao-outcome.show',
    'uses' => 'OutcomeController@show'
]);