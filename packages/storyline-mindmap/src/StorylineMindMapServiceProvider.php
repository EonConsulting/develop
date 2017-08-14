<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 2017/01/25
 * Time: 12:07 PM
 */

namespace EONConsulting\Storyline\MindMap;


use Illuminate\Support\ServiceProvider;
use App\Models\Course;

/**
 * Class StorylineMindMapServiceProvider
 * @package EONConsulting\Storyline\MindMap
 */
class StorylineMindMapServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_mind_map', function () {
            return new StorylineMindMap();
        });
    }

    public function boot() {
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/storyline/mindmap'),
        ], 'public');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.mindmap');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

}