<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller {

    public function index() {
        //Could actually filter the request and return view

        $breadcrumbs = [
            'title' => 'Modules',
        ];

        return view('lecturer.courses.list', ['courses' => $this->allCourses(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function allCourses() {
        $courses = Course::get();
        return $courses;
    }

}
