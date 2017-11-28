<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;

class AnalyticsLogIngester implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    // how many times the job should be retried
    public $tries = 1;
    private $client = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->fetchAndProcessLogs();
    }

    function fetchAndProcessLogs() {

        // get log items that have not been ingested
        // lets take a 1000 at a time and stay in this loop until finished
        Log::debug("Starting analytics log ingestion");
        while (true) {
            $logs = Db::table('analytics_log')
                    ->where('ingested', '0')
                    ->orderBy('id', 'asc')
                    ->limit(1000)
                    ->get();

            // break out if the work is done
            if (count($logs) <= 0) {
                Log::debug("Finished analytics_log ingestion");
                break;
            }

            // run through logs and decide on processing logic
            foreach ($logs as $log) {

                // turn the json payload into an object
                $json = json_decode($log->payload);

                if ($json && $json->verb && $json->verb->id) {
                    // here we switch to the correct summarization process
                    switch ($json->verb->id) {
                        case "https://unisaonline.net/schema/1.0/content_search":
                            $this->processContentSearch($json);
                            break;
                        case "https://unisaonline.net/schema/1.0/course_search":
                            $this->processCourseSearch($json);
                            break;
                        case "https://unisaonline.net/schema/1.0/topic":
                            $this->processTopic($json);
                            break;
                    }
                } else {
                    Log::error("Analytics log item malformed payload id:" . $log["id"]);
                }
            }
        }
    }

    function processContentSearch($json)
    {
        // to be implemented
    }
    
    function processCourseSearch($json)
    {
        // to be implemented
    }
    
    function processTopic($json) {
        if ($json) {
            try {
                $response = $this->client->request('POST', $indexname . "/external/" . $entry["id"], ["json" => $entry]);
                switch ($response->getStatusCode()) {
                    case "200":
                        Log::info("POST of item id:" . $entry["id"] . " to index:" . $indexname . " successful");
                        $this->updateCourseIngestedStatus($entry["id"]);
                        break;
                }
            } catch (\Exception $e) {
                Log::error("POST of item id:" . $entry["id"] . " to index:" . $indexname . " failed :: " . $e->getMessage());
            }
        }
    }

    function updateAnalyticsIngestedStatus($id) {
        Db::table('analytics_log')
                ->where('id', $id)
                ->update(['ingested' => 1]);
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
