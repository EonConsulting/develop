<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for summaries tables
 */

namespace EONConsulting\Core\Classes;

use App\Models\SummaryStudentProgression;
use Illuminate\Support\Facades\Log;

/**
 * Description of Summaries
 *
 * @author michael
 */
class Summaries {

    public function __construct() {
        
    }

    /* ============================= PUBLIC METHODS ========================= */

    /**
     * This method gets the current progression for a student per course and module
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param string $student_id 
     * @param string $course_id
     * @param string $storyline_id
     * @return row
     */
    function GetSummaryStudentProgression($student_id, $course_id, $storyline_id) {
        $sp = SummaryStudentProgression::where('student_user_id', $student_id)
                ->where('storyline_id', $storyline_id)
                ->where('course_id', $course_id)
                ->first();

        return $sp;
    }

    /**
     * This method updates the new progression for a student per course and module
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param object $item the object to update
     * @return row
     */
    function UpdateSummaryStudentProgress($item, $percentages = null) {
        
        //$sp = SummaryStudentProgression::find($item->id);
        
        // we only save if necessary
        if ($percentages)
        {
            if (!empty($percentages["percent"]))
            {
                $item->progress = $percentages["percent"];
            }
            
            if (!empty($percentages["video_percent"]))
            {
                $item->video_progress = $percentages["video_percent"];
            }
            
            if (!empty($percentages["ebook_percent"]))
            {
                $item->ebook_progress = $percentages["ebook_percent"];
            }
              
            $item->save();
            Log::debug("Asset progress updated for summary_asset_id:" . $item->id);
        } 
    }

    /**
     * This method inserts the new progression for a student per course and module
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param object $item the object to insert
     * @return row
     */
    function InsertSummaryStudentProgress($item) {
        $sp = new SummaryStudentProgression();
        $sp->progress_type_id = $item["progress_type_id"];
        $sp->course_id = $item["course_id"];
        $sp->storyline_id = $item["storyline_id"];
        $sp->student_user_id = $item["student_user_id"];
        $sp->progress = $item["progress"];
        $sp->video_progress = $item["video_progress"];
        $sp->ebook_progress = $item["ebook_progress"];

        $sp->save();
    }

}
