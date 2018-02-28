<?php

namespace EONConsulting\Core;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;

use GuzzleHttp\Client as GuzzleClient;
use EONConsulting\Core\Services\HttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Http\Response;
use Storage;

class eContentCoreServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\Core';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadCommands();
        $this->bootCollectionMacro();
        $this->loadViews('ecore');
        $this->registerRouteMacros();

        /*\DB::listen(function ($query) {
            \Log::debug($query->sql);
            // $query->bindings
            // $query->time
        });*/

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HttpClient::class, function ($app) {
            return new HttpClient(new GuzzleClient);
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

    /*
     * Register a macro helper
     *
     * @return collection
     */
    protected function bootCollectionMacro()
    {
        if ( ! $this->app->runningInConsole()) {
            return;
        }

        Collection::make(glob(__DIR__ . '/Collections/macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                require_once $path;
            });
    }

    /*
     * Register helper response macros to help with ajax requests
     *
     * @return void
     */
    protected function registerRouteMacros()
    {
        Response::macro('stream_file', function($disk, $filename)
        {
            ob_end_clean();

            return response()->stream(function() use ($disk, $filename)
            {
                $stream = Storage::disk($disk)->readStream($filename);

                fpassthru($stream);

                if (is_resource($stream)) {
                    fclose($stream);
                }

            }, 200, [
                'Cache-Control'         => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Type'          => Storage::disk($disk)->mimeType($filename),
                'Content-Length'        => Storage::disk($disk)->size($filename),
                'Content-Disposition'   => 'attachment; filename="' . basename($filename) . '"',
                'Pragma'                => 'public',
            ]);
        });

    }
}
