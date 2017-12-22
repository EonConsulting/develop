<?php

namespace App\Http\Controllers\LTI\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Models\Course;
use App\Models\IntegrateTaoResults;
use App\Models\SummaryStudentProgression;
use App\Models\SummaryModuleProgression;


class DashboardDataController extends LTIBaseController {

    /**
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function data_courses() {
        $result = Course::all();

        return response()->json($result);
    }

    /**
     * 
     * @param int $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function data_students($course_id) {

        // different user lists for instructors and mentors
        /* THIS WILl EVENTUALLY BE ENABLED
          if (laravel_lti()->is_instructor(auth()->user())){
          $result = "";
          } else if (laravel_lti()->is_mentor(auth()->user())){
          $result = "";
          }
         * 
         */

        $result = [
            [
                "student_id" => "2",
                "name" => "Hlobisile Student",
            ],
            [
                "student_id" => "S2",
                "name" => "Student 2",
            ],
            [
                "student_id" => "S3",
                "name" => "Student 3",
            ],
        ];

        return response()->json($result);
    }

    /**
     * 
     * @param int $course_id
     * @param int $student_id
     * @param int $assessment
     * @return \Illuminate\Http\JsonResponse
     */
    public function data_assessment_types($course_id, $student_id, $assessment) {
        
        // this is the different assessments that a student
        // has participated in
        $analytics = new \EONConsulting\Core\Classes\Analytics();
        
        // switch assessment
        $result = [];
        switch($assessment)
        {
            case "FA": // formative assessments
                $result = $analytics->getAllFormativeAssessments($course_id, $student_id);
                break;
            case "SA": // summative assessments
                $result = $analytics->getAllSummativeAssessments($course_id, $student_id);
                break;
        }

        return response()->json($result);
    }

    /**
     * 
     * @param int $course_id
     * @param int $student_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function data_progression($course_id, $student_id) {
        if ($student_id == "ALL") {
            // this is the expected progress for the course
            // as well as the class average, pre-calculated
            $smp_items = SummaryModuleProgression::where("course_id", $course_id)
                    ->firstOrFail();

            //$ssp_avg = SummaryStudentProgression::where("course_id", $course_id)
            //        ->avg("progress");


            $result = [
                "course_id" => $course_id,
                "student_id" => $student_id,
                "progress" => [
                    "storyline" => [
                        "class_progress" => [
                            $smp_items["class_progress"]
                        ],
                        "module_progress" => [
                            $smp_items["module_progress"]
                        ],
                        "my_progress" => [
                            0
                        //(int)$ssp_avg
                        ]
                    ]
                ]
            ];
        } else {
            // this is the expected progress for the course
            // as well as the class average, pre-calculated
            $smp_items = SummaryModuleProgression::where("course_id", $course_id)
                    ->firstOrFail();

            $ssp_items = SummaryStudentProgression::where("course_id", $course_id)
                    ->where("student_user_id", $student_id)
                    ->firstOrFail();

            $result = [
                "course_id" => $course_id,
                "student_id" => $student_id,
                "progress" => [
                    "storyline" => [
                        "class_progress" => [
                            $smp_items["class_progress"]
                        ],
                        "module_progress" => [
                            $smp_items["module_progress"]
                        ],
                        "my_progress" => [
                            $ssp_items["progress"]
                        ]
                    ]
                ]
            ];
        }


        return response()->json($result);
    }
}
