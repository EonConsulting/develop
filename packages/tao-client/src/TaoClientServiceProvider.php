<?php

namespace EONConsulting\TaoClient;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;
use EONConsulting\TaoClient\Services\TaoApi;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\TaoClient\Observers\StoryLineItemObserver;

use EONConsulting\TaoClient\Console\Commands\TaoRetryJobsCommand;
use EONConsulting\TaoClient\Console\Commands\TaoRemoveJobsCommand;
use EONConsulting\TaoClient\Console\Commands\TaoFixIframesCommand;
use EONConsulting\TaoClient\Console\Commands\TaoCommand;


class TaoClientServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\TaoClient';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/tao-client.php' => config_path('tao-client.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'tao-client');

        $this->registerObservers();
        $this->registerRoutes();

        $this->loadCommands(realpath(__DIR__ . '/Console/Commands'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TaoApi::class, function () {
            $tao_api = new TaoApi(new \GuzzleHttp\Client(), $this->app['config']['tao-client']);
            return $tao_api;
        });
    }

    /**
     * Get the pat of this package
     *
     * @return string
     */
    protected function getPackageFolder()
    {
        return realpath(__DIR__);
    }

    /**
     * Register modal observers
     */
    protected function registerObservers()
    {
        StorylineItem::observe(StoryLineItemObserver::class);
    }

}
