<?php

namespace EONConsulting\ContentBuilder\Jobs\Bulk;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\ContentBuilder\Models\Asset;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;

class AssetsElasticUpdate implements ShouldQueue
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
    public $timeout = 360;

    /**
     * Execute the job.
     *
     * @param  Elastic  $elastic
     * @return void
     */
    public function handle(Elastic $elastic)
    {
        $assets = Asset::where('ingested', '0')->take(500)->get();

        if($assets->count() < 1)
        {
            Log::debug("AssetsElasticUpdate: Finished asset sync to Elastic");
            return true;
        }

        foreach($assets as $asset)
        {
            try {

                $categories = $asset->categories()->pluck('name')->implode(",");

                $response = $elastic->type("external")
                    ->index("assets")
                    ->id($asset->id)
                    ->insert([
                        "id" => $asset->id,
                        "title" => $asset->title,
                        "content" => $asset->content,
                        "description" => $asset->description,
                        "tags" => $asset->tags,
                        "categories" => $categories
                    ]);

                if($response->result == 'updated' || $response->result == 'created')
                {
                    Log::debug("AssetsElasticUpdate POST of item id: {$asset->id} to index: [assets] was successful {$response->result}");

                    $asset->ingested = 1;
                    $asset->update();

                } else {
                    Log::error("AssetsElasticUpdate: POST of item id:  {$asset->id} to index: [assets] failed :: " . $e->getMessage());
                }

            } catch(Exception $e) {
                Log::error("AssetsElasticUpdate: POST of item id: {$asset->id} to index: [assets] failed :: " . $e->getMessage());
            }
        }

        return true;
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::debug('AssetsElasticUpdate: ' . $exception->getMessage());
    }
}