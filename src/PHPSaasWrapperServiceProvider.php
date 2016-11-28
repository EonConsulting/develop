<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:08 AM
 */

namespace EONConsulting\PHPSaasWrapper\src;


use Illuminate\Support\ServiceProvider;

class PHPSaasWrapperServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register('');
        $this->app->bind( 'phpsaaswrapper', function () {
            return new PHPSaasWrapper;
        });

        /* $this->mergeConfigFrom(
             __DIR__ . '/config/boilerplate.php', 'boilerplate'
         );*/
    }

    public function boot()
    {
//        $this->loadViewsFrom(__DIR__ . '/resources/views', 'phpstencil');
//        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
    }

}