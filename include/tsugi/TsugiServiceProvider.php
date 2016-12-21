<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2016/12/18
 * Time: 11:08 PM
 */

namespace Tsugi;


use Illuminate\Support\ServiceProvider;

class TsugiServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( 'tsugi', function () {
            return new Tsugi;
        });
    }

    public function boot() {

    }

}