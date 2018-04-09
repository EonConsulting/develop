<?php

namespace EONConsulting\ContentBuilder\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\ContentBuilder\Models\Asset;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;

class AssetElasticDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /*
     * Asset Id
     *
     * @var $asset_id
     */
    protected $asset_id;

    /**
     * Create a new job instance.
     *
     * @param string  $asset_id
     * @return void
     */
    public function __construct($asset_id)
    {
        $this->asset_id = $asset_id;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(Elastic $elastic)
    {

        try {

            $response = $elastic->type("external")
                ->index("assets")
                ->id($this->asset_id)
                ->delete();

            return true;

        } catch(Exception $e)
        {
            Log::debug('AssetElasticDelete: ' . $e->getMessage());

            return false;
        }

    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::debug('AssetElasticDelete: ' . $exception->getMessage());
    }
}