<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller {

    public function index() {
        //Could actually filter the request and return view
        return view('lecturer.courses.list', ['courses' => $this->allCourses()]);
    }

    public function courses() {
        return view('nonlti.courses.list', ['courses' => $this->allCourses()]);
    }

    public function allCourses() {
        $courses = Course::get();
        return $courses;
    }

}
