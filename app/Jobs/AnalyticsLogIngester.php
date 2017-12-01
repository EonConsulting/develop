<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;
use \EONConsulting\Core\Classes as ECC;

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
                            $this->processContentSearch($log, $json);
                            break;
                        case "https://unisaonline.net/schema/1.0/course_search":
                            $this->processCourseSearch($log, $json);
                            break;
                        case "https://unisaonline.net/schema/1.0/topic":
                            $this->processTopic($log, $json);
                            break;
                    }
                } else {
                    Log::error("Analytics log item malformed payload id:" . $log["id"]);
                }
            }
        }
    }

    function processContentSearch($log, $json) {
        // to be implemented
    }

    function processCourseSearch($log, $json) {
        // to be implemented
    }

    function processTopic($log, $json) {
        if ($json) {
            try {
                // quick validation on json vars
                if ($json && $json->context && $json->context->extensions && $json->context->extensions->course_id && $json->context->extensions->storyline && $json->context->extensions->storyline_item && $json->actor && $json->actor->mbox) {
                    $mbox = str_replace("mailto:", "", $json->actor->mbox);
                    $U = new ECC\Users();
                    $student_id = $U->GetUserFromEmailAddy($email);
                    $course_id = $json->context->extensions->course_id;
                    $storyline_id = $json->context->extensions->storyline;
                    $storyline_item = $json->context->extensions->storyline_item;

                    // get the structure of the course
                    $SL = new ECC\Storylines();
                    $items = $SL->GetStorylineItems($storyline_id);
                    $sorted_items = $SL->TransformStorylineItemsToFlatArray($items);
                    $storyline_item_ids = $SL->GetStorylineItemIdsFromFlatArray($sorted_items);

                    // so where in the array is this storyline_item_id
                    // we will use simple arithmetic : (position in array + 1) / array count
                    $percent = 0; // default
                    $index = array_search($storyline_item, $storyline_item_ids);
                    if ($index !== false) {
                        $percent = (($index + 1) / sizeof($storyline_item_ids)) * 100;
                    }

                    // we only update our progress if it is greater than 
                    // what is already recorded as progress
                    $SP = new ECC\Summaries();
                    $progress_item = $SP->GetSummaryStudentProgression($student_id, $course_id, $storyline_id);

                    if ($progress_item) {
                        // this is an existing progress
                        // we only save if necessary
                        if ($percent > $current_progress) {
                            $progress_item->progress = $percent;
                            $SP->UpdateSummaryStudentProgress($progress_item);
                        }
                    } else {
                        // this is a new progress
                        $progress_item = [
                            "progress_type_id" => $progress_type_id,
                            "course_id" => $course_id,
                            "storyline_id" => $storyline_id,
                            "student_user_id" => $student_id,
                            "progress" => $percent
                        ];
                            
                        $SP->InsertSummaryStudentProgress($progress_item);
                    }

                    // set this log as processed
                    $this->updateAnalyticsIngestedStatus($log->id);
                    Log::info("Successful topic progress from log id:" . $log->id);
                } else {
                    Log::info("Unable to ingest log, missing storyline id, see log id:" . $log->id);
                }
            } catch (\Exception $e) {
                Log::error("Error on topic progress from log id:" . $log->id . " message: " . $e->getMessage());
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
