<?php



Route::group(['middleware' => ['web'], 'prefix' => 'storyline2', 'namespace' => 'EONConsulting\Storyline2\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function() {

        /*
         * ---------------------------------------------
         * Storyline 2 - Core - Routes
         * ---------------------------------------------
         */

        //Core Routes
        Route::get('/', 'Storyline2Core@index')->name('storyline2');



        /*
         * ---------------------------------------------
         * Storyline 2 - Views - Blade - Routes
         * ---------------------------------------------
         */

        //Student Routes
        Route::get('/view', 'Storyline2ViewsBlade@view')->name('storyline2studentsingle');

        //Lecturer Routes
        Route::get('/edit', 'Storyline2ViewsBlade@edit')->name('storyline2lectureredit');


        /*
         * ---------------------------------------------
         * Storyline 2 - Views - JSON - Routes
         * ---------------------------------------------
         */

        //RESTful routes
        Route::resource('/items', 'ContentBuilderCategories');

        //Render JSON Route
        Route::get('/json-render', 'Storyline2ViewsJSON@render')->name('storyline2JSONrender');
        Route::get('/show_items/{storyline}', 'Storyline2ViewsJSON@show_items')->name('storyline2.JSON.items');
        //Route::match(['get', 'post'], '/json-render','Storyline2ViewsJSON@render')->name('storyline2JSONrender');
        Route::match(['get', 'post'], '/move','Storyline2ViewsJSON@move')->name('storyline2JSONmove');
        Route::match(['get', 'post'], '/rename','Storyline2ViewsJSON@rename')->name('storyline2JSONrename');
        Route::match(['get', 'post'], '/delete','Storyline2ViewsJSON@delete')->name('storyline2JSONdelete');
        Route::post('/create','Storyline2ViewsJSON@create')->name('storyline2JSONcreate');

        //Add more routes
    });
});
