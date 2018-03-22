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
use EONConsulting\Core\Services\Elastic\Elastic;

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
        $this->publishConfigs();

        if(env('APP_DEBUG', 'false') == 'true')
        {
            \DB::listen(function($query) {

                if( ! preg_match("/from \`jobs\` where/", $query->sql))
                {
                    \Log::info(
                        $query->sql,
                        $query->bindings,
                        $query->time
                    );
                }
            });
        }

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

        $this->registerElastic();
    }

    protected function registerElastic()
    {
        $this->app->singleton(Elastic::class, function ($app) {
            return new Elastic();
        });
    }

    protected function publishConfigs()
    {
        $this->publishes([
            $this->getPackageFolder() . '/../config/elastic.php' => config_path('elastic.php'),
        ]);
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
        Response::macro('stream_file', function($disk, $filepath, $filename_override = null)
        {
            return response()->stream(function() use ($disk, $filepath, $filename_override)
            {
                $stream = Storage::disk($disk)->readStream($filepath);

                fpassthru($stream);

                if (is_resource($stream)) {
                    fclose($stream);
                }

            }, 200, [
                'Cache-Control'         => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Type'          => Storage::disk($disk)->mimeType($filepath),
                'Content-Length'        => Storage::disk($disk)->size($filepath),
                'Content-Disposition'   => 'attachment; filename="' . basename($filename_override ?? $filepath) . '"',
                'Pragma'                => 'public',
            ]);
        });

    }

}
