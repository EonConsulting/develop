<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Http\Controllers\Controller;

class CourseController extends Controller {

    public function show(Course $course) {
        return view('lecturer.courses.single', ['course' => $course]);
    }

}
