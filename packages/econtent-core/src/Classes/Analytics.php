<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for analytics
 */

namespace EONConsulting\Core\Classes;

use Illuminate\Support\Facades\DB;

class Analytics {

    public function __construct() {
        
    }

    public function getAllFormativeAssessments($course_id, $student_id) {
        $all_items = [];
        
        // just get out of here for all items
        if ($student_id == "ALL"){
            return $all_items;
        }
        
        // get TAO items
        // JOIN on the storyline items
        $tao_items = DB::select('SELECT si.id, si.name
            FROM courses c
            LEFT JOIN storylines s ON c.id = s.course_id
            LEFT JOIN storyline_items si ON s.id = si.storyline_id
            INNER JOIN integrate_tao_results itr ON itr.storyline_item_id = si.id
            WHERE c.id = :course_id
            AND itr.user_id = :student_id
            GROUP by si.id, si.name', ["course_id" => $course_id, "student_id" => $student_id]);
        
        foreach ($tao_items as $ti)
        {
            $all_items[] = [
                "id" => "tao_" . $ti->id,
                "name" => $ti->name
            ];
        }

        // TODO:
        // add assigment items
        
        // TODO:
        // add portfolio items
        
        return $all_items;
    }
    
    public function GetAllSummativeAssessments($course_id, $student_id)
    {
        $all_items = [];
        // add ALL
        $all_items[] = [
            "id" => "ALL",
            "name" => "ALL"
        ];
        
        // add MCQ
        $all_items[] = [
            "id" => "MCQ-DEMO",
            "name" => "MCQ Demo"
        ];
        
        // add Venue Based
        $all_items[] = [
            "id" => "VENUE-DEMO",
            "name" => "Venue Demo"
        ];
        
        // add Portfolio
        $all_items[] = [
            "id" => "PORTFOLIO-DEMO",
            "name" => "Portfolio Demo"
        ];
        
        return $all_items;
    }

}
