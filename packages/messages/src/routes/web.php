<?php

Route::resource('messages', 'MessagesController', ['only' => [
    'index', 'show', 'destroy'
]]);