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

        // add TAO
        $all_items[] = [
            "id" => "SELF",
            "name" => "Self-Assessments"
        ];

        // add Assisgnement
        $all_items[] = [
            "id" => "ASSIGN",
            "name" => "Assignments"
        ];

        // add Portfolio
        $all_items[] = [
            "id" => "PORT",
            "name" => "Portfolio"
        ];

        return $all_items;
    }

    public function getAllSummativeAssessments($course_id, $student_id) {
        $all_items = [];

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

    public function getAssessmentResults($course_id, $student_id, $assessment_type) {

        $average = 0;
        $combined_score = 0;
        $result_count = 0;

        // just get out of here for all items
        if ($student_id == "ALL") {
            return;
        }

        switch ($assessment_type) {
            case "SELF":
                // get TAO items
                // JOIN on the storyline items
                $tao_items = DB::select('SELECT si.id, si.name, (itr.score * 100) as score, itr.created_at
                    FROM courses c
                    LEFT JOIN storylines s ON c.id = s.course_id
                    LEFT JOIN storyline_items si ON s.id = si.storyline_id
                    INNER JOIN integrate_tao_results itr ON itr.storyline_item_id = si.id
                    WHERE c.id = :course_id
                    AND itr.user_id = :student_id
                    AND itr.score IS NOT NULL', ["course_id" => $course_id, "student_id" => $student_id]);

                foreach ($tao_items as $ti) {
                    // do some aggregations
                    $result_count++;
                    $combined_score = $combined_score + $ti->score;

                    // append the arrays
                    $labels[] = $ti->name;
                    $your_results[] = $ti->score;
                    $your_average[] = $combined_score / $result_count;
                }
                break;
            // TODO:
            // add assigment items
            case "ASSIGN":
                break;
            // TODO:
            // add portfolio items
            case "PORT":
                break;
        }

        // assemble the completed results
        $all_items = [
            "labels" => $labels,
            "your_results" => $your_results,
            "your_average" => $your_average,
            "class_average" => [] // TODO
        ];

        return $all_items;
    }

}
