<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller {

    public function index() {
        $courses = Course::get();

        return view('lecturer.courses.list', ['courses' => $courses]);
    }

}
