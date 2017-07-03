<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseLTIController extends LTIBaseController {

    public function index(Course $course) {
//        dd(storyline_core()->getIndex($course));

        $data = storyline_core()->getIndex($course);

        return view('lti.courses.single', ['data' => $data, 'course' => $course]);
    }

}
