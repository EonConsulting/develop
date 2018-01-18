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

class TaoResultsIngester implements ShouldQueue {

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
        Log::debug("Starting tao results log ingestion");
        while (true) {
            try {
                $logs = Db::table('integrate_tao_results')
                        ->where('ingested', '0')
                        ->orderBy('id', 'asc')
                        ->limit(1000)
                        ->get();

                // break out if the work is done
                if (count($logs) <= 0) {
                    Log::debug("Finished tao results log ingestion");
                    break;
                }

                // run through logs and decide on processing logic
                foreach ($logs as $log) {

                    // turn the json payload into an object
                    //$json = json_decode($log->response);

                    // take the score and pass it into the summaries_assessment_results table
                    $user_id = $log->user_id;
                    $test_id = $log->id;
                    $sourcedid = $log->lis_result_sourcedid;
                    $score = $log->score;
                    $testname = ""; // get via API call
                    
                    $this->summarizeEntry($user_id, $test_id, $sourcedid, $testname, $score);
                    
                }
            } catch (\Exception $e) {
                Log::error("Exiting loop on tao results log id:" . $log->id . " message: " . $e->getMessage());
                break;
            }
        }
    }

    function summarizeEntry($user_id, $test_id, $testname, $score) {
        // to be implemented
        Log::debug("Summarizing entry for test_id:" + $test_id);
    }

    function processTopic($log, $json) {
        if ($json) {
            try {
                // quick validation on json vars, dirty but effective
                if ($json 
                        && $json->context 
                        && $json->context->extensions 
                        && $json->context->extensions->course 
                        && $json->context->extensions->storyline 
                        && $json->context->extensions->storyline_item 
                        && $json->actor 
                        && $json->actor->mbox) {
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
                        // we only save if necessary
                        if ($percent > $progress_item->progress) {
                            $progress_item->progress = $percent;
                            $SP->UpdateSummaryStudentProgress($progress_item);
                            Log::debug("Progress updated for log id:" . $log->id);
                        }
                        Log::debug("Progress ignored for log id:" . $log->id);
                    } else {
                        // this is a new progress
                        $progress_item = [
                            "progress_type_id" => 1, // hard-wired for now, awaiting requirements
                            "course_id" => $course_id,
                            "storyline_id" => $storyline_id,
                            "student_user_id" => $student_id,
                            "progress" => $percent
                        ];
                        $SP->InsertSummaryStudentProgress($progress_item);
                        Log::debug("New summary item created for log id:" . $log->id);
                    }

                    // set this log as processed
                    $this->updateAnalyticsIngestedStatus($log->id, 1);
                    Log::info("Successful topic progress from log id:" . $log->id);
                } else {
                    Log::info("Unable to ingest log, missing storyline id, see log id:" . $log->id);
                }
            } catch (\Exception $e) {
                Log::error("Error on persisting progress from log id:" . $log->id . " message: " . $e->getMessage());
                $this->updateAnalyticsIngestedStatus($log->id, 2);
            }
        }
    }

    function updateAnalyticsIngestedStatus($id, $ingested, $status, $status_message) {
        Db::table('integrate_tao_results')
                ->where('id', $id)
                ->update(['ingested' => $ingested, 'status' => $status, 'status_message' => $status_message]);
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
