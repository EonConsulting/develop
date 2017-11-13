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
        Route::get('/view/{course}', 'Storyline2ViewsBlade@view')->name('storyline2.student.single');

        //Lecturer Routes
        Route::get('/edit/{course}', 'Storyline2ViewsBlade@edit')->name('storyline2.lecturer.edit');


        /*
         * ---------------------------------------------
         * Storyline 2 - Views - JSON - Routes
         * ---------------------------------------------
         */

        //RESTful routes
        //Route::resource('/items', 'ContentBuilderCategories');

        //Render JSON Route
        Route::get('/json-render', 'Storyline2ViewsJSON@render')->name('storyline2.JSON.render');
        Route::get('/show_items/{storyline}', 'Storyline2ViewsJSON@show_items')->name('storyline2.JSON.items');

        Route::get('/item-content/{item}', 'Storyline2Core@get_content')->name('storyline2.item.content');
        Route::post('/save-item-content/{item}', 'Storyline2Core@save_content')->name('storyline2.item.content.save');
        Route::post('/add-item-content/{content}/{item}/{action}', 'Storyline2Core@attach_content_to_item')->name('storyline2.item.content.add');

        //Route::match(['get', 'post'], '/json-render','Storyline2ViewsJSON@render')->name('storyline2JSONrender');
        Route::match(['get', 'post'], '/move','Storyline2ViewsJSON@move')->name('storyline2.JSON.move');
        Route::match(['get', 'post'], '/rename','Storyline2ViewsJSON@rename')->name('storyline2.JSON.rename');
        Route::match(['get', 'post'], '/delete','Storyline2ViewsJSON@delete')->name('storyline2.JSON.delete');
        Route::post('/create','Storyline2ViewsJSON@create')->name('storyline2.JSON.create');
        //Add more routes
    });
});
