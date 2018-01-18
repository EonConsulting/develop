<?php

Route::group(['middleware' => ['web'], 'prefix' => 'notifications', 'namespace' => 'EONConsulting\Notifications\Controllers'], function() {
       Route::post('/support/message','NotificationsController@supportMail')->name('support.mail');  
});