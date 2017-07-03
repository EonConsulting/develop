<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesLTIController extends LTIBaseController {

    public function index() {
        $courses = Course::get();

        return view('lti.courses.list', ['courses' => $courses]);
    }

}
