<?php

namespace EONConsulting\TaoClient;

use Illuminate\Support\ServiceProvider;
use EONConsulting\TaoClient\Services\TaoApi;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\TaoClient\Observers\StoryLineItemObserver;

use EONConsulting\TaoClient\Console\Commands\TaoRetryJobsCommand;
use EONConsulting\TaoClient\Console\Commands\TaoRemoveJobsCommand;
use EONConsulting\TaoClient\Console\Commands\TaoFixIframesCommand;

class TaoClientServiceProvider extends ServiceProvider
{
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

        $this->registerCommands();
        $this->registerObservers();
        $this->registerRoutes();
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
     * Register commands
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TaoRetryJobsCommand::class,
                TaoRemoveJobsCommand::class,
                TaoFixIframesCommand::class,
            ]);
        }
    }

    /**
     * Register modal observers
     */
    protected function registerObservers()
    {
        StorylineItem::observe(StoryLineItemObserver::class);
    }

    /**
     * Register routes
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
