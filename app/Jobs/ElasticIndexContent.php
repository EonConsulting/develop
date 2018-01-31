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
use EONConsulting\ContentBuilder\Models\Content;

class ElasticIndexContent implements ShouldQueue {

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

        $this->fetchAndIndexContent();
    }

    function fetchAndIndexContent() {

        // get content that has not been ingested
        // lets take a 1000 at a time and stay in this loop until finished
        Log::debug("Starting content sync to Elastic");
        while (true) {
            /*$content = Db::table('content')
                    ->where('ingested', '0')
                    ->orderBy('id', 'asc')
                    ->limit(1000)
                    ->get();*/

            //$content = Content::where('ingested', '0')->get();

            $content = DB::select("
                SELECT c.id as content_id, c.title, c.body, c.description, c.tags, GROUP_CONCAT(s.course_id) as course_ids, GROUP_CONCAT(cat.name) as categories FROM content c 
                    LEFT JOIN storyline_items si ON si.content_id = c.id
                    LEFT JOIN storylines s ON s.id = si.storyline_id
                    LEFT JOIN content_categories cc ON cc.content_id = c.id
                    LEFT JOIN lk_content_categories cat ON cat.id = cc.category_id
                    WHERE 1=1
                    AND c.ingested = 0
                    GROUP BY c.id
                    ORDER BY c.id ASC
            ");

            // break out if the work is done
            if (count($content) <= 0) {
                Log::debug("Finished content sync to Elastic");
                break;
            }

            // put an entry to Elastic for each row
            foreach ($content as $c) {

                $entry = [
                    "id" => $c->content_id,
                    "title" => $c->title,
                    "body" => $c->body,
                    "description" => $c->description,
                    "tags" => $c->tags,
                    "categories" => explode(',',$c->categories),
                    "courses" => explode(',',$c->course_ids)
                ];
                
                $this->postElasticItem($entry);
            }
        }
    }

    
    function fetchAndIndexContentbyID($id){

        Log::debug("Starting content sync by ID to Elastic");

        $c = DB::select('
            SELECT c.id as content_id, c.title, c.body, c.description, c.tags, GROUP_CONCAT(s.course_id) as course_ids, GROUP_CONCAT(cat.name) as categories FROM content c 
                LEFT JOIN storyline_items si ON si.content_id = c.id
                LEFT JOIN storylines s ON s.id = si.storyline_id
                LEFT JOIN content_categories cc ON cc.content_id = c.id
                LEFT JOIN lk_content_categories cat ON cat.id = cc.category_id
                WHERE 1=1
                AND c.id = '.$id.'
                GROUP BY c.id
                ORDER BY c.id ASC
        ')[0];

        //Log::debug($c);

        $entry = [
            "id" => $c->content_id,
            "title" => $c->title,
            "body" => $c->body,
            "description" => $c->description,
            "tags" => $c->tags,
            "categories" => explode(',',$c->categories),
            "courses" => explode(',',$c->course_ids)
        ];

        $this->postElasticItem($entry);
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
            $indexname = "content";
            try {
                $response = $this->client->request('POST', $indexname . "/external/" . $entry["id"], ["json" => $entry]);
                switch ($response->getStatusCode()) {
                    case "200":
                        Log::info("POST of item id:" . $entry["id"] . " to index:" . $indexname . " successful");
                        $this->updateContentIngestedStatus($entry["id"]);
                        break;
                }
            } catch (\Exception $e) {
                Log::error("POST of item id:" . $entry["id"] . " to index:" . $indexname . " failed :: " . $e->getMessage());
            }
        }
    }

    function updateContentIngestedStatus($content_id) {
        DB::table('content')
                ->where('id', $content_id)
                ->update(['ingested' => 1]);
    }

    function resetIngestedStatus(){
        DB::table('content')
        ->update(['ingested' => 0]);
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
