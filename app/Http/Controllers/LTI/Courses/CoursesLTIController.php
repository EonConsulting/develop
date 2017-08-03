<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesLTIController extends LTIBaseController {

    public function index() {
        $courses = Course::get();

        $breadcrumbs = [
            'title' => 'Modules',
        ];

        return view('student.courses.list', ['courses' => $courses, 'breadcrumbs' => $breadcrumbs]);
    }

}
