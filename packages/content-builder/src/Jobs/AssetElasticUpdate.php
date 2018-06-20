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

class AssetElasticUpdate implements ShouldQueue
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
     * Asset Model
     */
    protected $asset;

    /**
     * Create a new job instance.
     *
     * @param  Asset  $asset
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
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

            $categories = $this->asset->categories()->pluck('name')->implode(",");

            $response = $elastic->type("external")
                ->index("assets")
                ->id($this->asset->id)
                ->update([
                    "id" => $this->asset->id,
                    "title" => $this->asset->title,
                    "content" => $this->asset->content,
                    "description" => $this->asset->description,
                    "tags" => $this->asset->tags,
                    "categories" => $categories
                ]);

            Log::debug("AssetElasticUpdate: asset[{$this->asset->id}] was {$response->result}");

            return true;

        } catch(Exception $e)
        {
            Log::debug('AssetElasticUpdate: ' . $e->getMessage());

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
        Log::debug('AssetElasticUpdate: ' . $exception->getMessage());
    }
}