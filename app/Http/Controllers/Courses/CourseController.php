<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Http\Controllers\Controller;

class CourseController extends Controller {
    //LTI
    public function show(Course $course) {
        return view('lecturer.courses.single', ['course' => $course]);
    }
    //NON LTI
    public function course(Course $course) {
        return view('nonlti.courses.single', ['course' => $course]);
    }

}
