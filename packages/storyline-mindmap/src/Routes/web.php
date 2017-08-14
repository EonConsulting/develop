<?php
Route::group(['middleware' => ['web'], 'prefix' => '/eon', 'namespace' => 'EONConsulting\Storyline\MindMap\Controllers'], function () {
        Route::get('/storylinemind/{course}', ['as' => 'eon.mindmaps', 'uses' => 'CourseStoryLineMindMapCtrl@index']);
});
