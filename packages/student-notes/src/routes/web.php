<?php

Route::group(['namespace' => '\EONConsulting\StudentNotes\Http\Controllers','middleware' => ['web']], function () {

    Route::get('/student-notes', [
        'as' => 'student-notes.index',
        'uses' => 'NoteController@index'
    ]);

    Route::post('/student-notes/store', [
        'as' => 'student-notes.store',
        'uses' => 'NoteController@store'
    ]);

    Route::delete('/student-notes/destroy/{id}', [
        'as' => 'student-notes.destroy',
        'uses' => 'NoteController@destroy'
    ]);

});
