<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\Core\Classes as ECC;

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
            try {
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
                                $this->processAssets($log, $json);
                                break;
                            default:
                                // u r probably an unwanted entry, mark u as ingested
                                $this->updateAnalyticsIngestedStatus($log->id, 1);
                                break;
                        }
                    } else {
                        Log::error("Analytics log item malformed payload id:" . $log["id"]);
                    }
                }
            } catch (\Exception $e) {
                Log::error("Exiting loop on topic progress with log id:" . $log->id . " message: " . $e->getMessage());
                break;
            }
        }
    }

    function processContentSearch($log, $json) {
        // to be implemented
        Log::debug("Not implemented yet for log id:" . $log->id);
        $this->updateAnalyticsIngestedStatus($log->id, 1);
    }

    function processCourseSearch($log, $json) {
        // to be implemented
        Log::debug("Not implemented yet for log id:" . $log->id);
        $this->updateAnalyticsIngestedStatus($log->id, 1);
    }

    function processTopic($log, $json) {
        if ($json) {
            try {
                // quick validation on json vars, dirty but effective
                if ($json && $json->context && $json->context->extensions && $json->context->extensions->course 
                        && $json->context->extensions->storyline && $json->context->extensions->storyline_item 
                        && $json->actor && $json->actor->mbox) {
                    // get some user info
                    $mbox = str_replace("mailto:", "", $json->actor->mbox);
                    $U = new ECC\Users();
                    $user = $U->GetUserFromEmailAddy($mbox);
                    $student_id = $user->id;

                    $course_id = $json->context->extensions->course;
                    $storyline_id = $json->context->extensions->storyline;
                    $storyline_item = $json->context->extensions->storyline_item;

                    // get the structure of the course
                    $SL = new ECC\Storylines();
                    $items = $SL->GetStorylineItems($storyline_id);
                    $sorted_items = $SL->TransformStorylineItemsToFlatArray($items);
                    $storyline_item_ids = array_column($SL->GetStorylineItemIdsFromFlatArray($sorted_items), "id");

                    // so where in the array is this storyline_item_id
                    // we will use simple arithmetic : (position in array + 1) / array count
                    $percent = 1; // default
                    $index = array_search($storyline_item, $storyline_item_ids);
                    if ($index !== false) {
                        $new_percent = number_format((($index + 1) / sizeof($storyline_item_ids)) * 100, 2, '.', '');
                        $percent = ($new_percent > $percent) ? $new_percent : $percent;
                    }

                    // we only update our progress if it is greater than 
                    // what is already recorded as progress
                    $SP = new ECC\Summaries();
                    $progress_item = $SP->GetSummaryStudentProgression($student_id, $course_id, $storyline_id);

                    if ($progress_item) {
                        // this is an existing progress
                        $percentages = [
                            "percent" => $percent
                        ];
                        //$progress_item->progress = $percent;
                        $SP->UpdateSummaryStudentProgress($progress_item, $percentages);
                    } else {
                        // this is a new progress
                        $progress_item = [
                            "progress_type_id" => 1, // hard-wired for now, awaiting requirements
                            "course_id" => $course_id,
                            "storyline_id" => $storyline_id,
                            "student_user_id" => $student_id,
                            "progress" => $percent,
                            "video_progress" => 0,
                            "ebook_progress" => 0
                        ];
                        $SP->InsertSummaryStudentProgress($progress_item);
                        Log::debug("New summary item created for log id:" . $log->id);
                    }

                    // set this log as processed
                    $this->updateAnalyticsIngestedStatus($log->id, 1);
                    Log::info("Successful topic progress from log id:" . $log->id);
                } else {
                    Log::info("Unable to ingest log, missing required ids, see log id:" . $log->id);
                }
            } catch (\Exception $e) {
                Log::error("Error on persisting progress from log id:" . $log->id . " message: " . $e->getMessage());
                $this->updateAnalyticsIngestedStatus($log->id, 2);
            }
        }
    }

    function processAssets($log, $json) {
        if ($json) {
            try {
                // quick validation on json vars, dirty but effective
                if ($json && $json->context && $json->context->extensions && $json->context->extensions->course 
                        && $json->context->extensions->storyline && $json->context->extensions->storyline_item 
                        && $json->actor && $json->actor->mbox) {
                    // get some user info
                    $mbox = str_replace("mailto:", "", $json->actor->mbox);
                    $U = new ECC\Users();
                    $user = $U->GetUserFromEmailAddy($mbox);
                    $student_id = $user->id;

                    $course_id = $json->context->extensions->course;
                    $storyline_id = $json->context->extensions->storyline;
                    $storyline_item = $json->context->extensions->storyline_item;

                    // so now shit gets real because we have no idea how many asset types
                    // there are per course, so what we have to do is check if there is
                    // a course asset summary register, if not, build one
                    // get the structure of the course
                    $SA = new ECC\Assets();
                    $asset_register = $SA->BuildAssetRegister($course_id, $storyline_id);
                    
                    if (count($asset_register) > 0) {
                        // YAY!!! There is an asset register
                        
                        // determine progress if it exists
                        // this is the common student progress table
                        $SP = new ECC\Summaries();
                        $progress_item = $SP->GetSummaryStudentProgression($student_id, $course_id, $storyline_id);
                        
                        if (count($progress_item) > 0) {
                            // work out the percent progress
                            $asset_percentages = $SA->GetAssetProgressPercentage($course_id, $storyline_item);
                            $SP->UpdateSummaryStudentProgress($progress_item, $asset_percentages);
                        } else {
                            // this is a new progress
                            $progress_item = [
                                "progress_type_id" => 1, // hard-wired for now, awaiting requirements
                                "course_id" => $course_id,
                                "storyline_id" => $storyline_id,
                                "student_user_id" => $student_id,
                                "progress" => 0,
                                "video_progress" => 0,
                                "ebook_progress" => 0
                            ];
                            $SP->InsertSummaryStudentProgress($progress_item);
                            Log::debug("New asset summary item created for log id:" . $log->id);
                        }
                    } else {
                        // CRAP!!! No asset register, get out of here
                        Log::error("Error building asset register for course_id:" . $course_id);
                        return;
                    }

                    // set this log as processed
                    $this->updateAnalyticsIngestedStatus($log->id, 1);
                    Log::info("Successful topic progress from log id:" . $log->id);
                } else {
                    Log::info("Unable to ingest log, missing required ids, see log id:" . $log->id);
                }
            } catch (\Exception $e) {
                Log::error("Error on persisting progress from log id:" . $log->id . " message: " . $e->getMessage());
                $this->updateAnalyticsIngestedStatus($log->id, 2);
            }
        }
    }

    function updateAnalyticsIngestedStatus($id, $status) {
        Db::table('analytics_log')
                ->where('id', $id)
                ->update(['ingested' => $status]);
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
