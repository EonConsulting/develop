<?php

namespace EONConsulting\HtmlToPdf;

use Illuminate\Support\ServiceProvider;

class HtmlToPdfServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/html-to-pdf.php' => config_path('html-to-pdf.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'html-to-pdf');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/html-to-pdf.php', 'html-to-pdf'
        );
    }
}
