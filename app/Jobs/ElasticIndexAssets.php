<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ElasticIndexAssets implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    // how many times the job should be retried
    public $tries = 1;
    private $client = null;
    private $refresh;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($r = false) {
        $this->refresh = $r;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        if($this->refresh){
            $this->resetIngestedStatus();
        }
        
        $this->fetchAndIndexAssets();
    }

    function fetchAndIndexAssets() {

        // get asset that has not been ingested
        // lets take a 1000 at a time and stay in this loop until finished
        Log::debug("Starting asset sync to Elastic");
        while (true) {
            $assets = Db::table('assets')
                    ->where('ingested', '0')
                    ->orderBy('id', 'asc')
                    ->limit(1000)
                    ->get();

            // break out if the work is done
            if (count($assets) <= 0) {
                Log::debug("Finished asset sync to Elastic");
                break;
            }

            // put an entry to Elastic for each row
            foreach ($assets as $c) {
                $entry = [
                    "id" => $c->id,
                    "title" => $c->title,
                    "content" => $c->content,
                    "description" => $c->description,
                    "tags" => $c->tags
                ];
                $this->postElasticItem($entry);
            }
        }
    }

    function postElasticItem($entry) {
        if ($entry) {
            // GuzzleHttp\Client instance
            if (!$this->client) {
                $this->client = new Client([
                    // Base URI is used with relative requests
                    'base_uri' => config('app.es_uri'),
                    // You can set any number of default request options.
                    'timeout' => 30,
                ]);
            }
            // just drop the index in ES in-case it exists
            $indexname = "assets";
            try {
                $response = $this->client->request('POST', $indexname . "/external/" . $entry["id"], ["json" => $entry]);
                switch ($response->getStatusCode()) {
                    case "200":
                        Log::info("POST of item id:" . $entry["id"] . " to index:" . $indexname . " successful");
                        $this->updateAssetIngestedStatus($entry["id"]);
                        break;
                }
            } catch (\Exception $e) {
                Log::error("POST of item id:" . $entry["id"] . " to index:" . $indexname . " failed :: " . $e->getMessage());
            }
        }
    }

    function updateAssetIngestedStatus($course_id) {
        Db::table('assets')
                ->where('id', $course_id)
                ->update(['ingested' => 1]);
    }

    function resetIngestedStatus(){
        DB::table('assets')
        ->update(['ingested' => 0]);
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
