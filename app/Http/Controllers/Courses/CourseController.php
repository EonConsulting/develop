<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Http\Controllers\Controller;

class CourseController extends Controller {
    //LTI
    public function show(Course $course) {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Manage '.$course->title,
            ],
        ];

        return view('lecturer.courses.single', ['course' => $course, 'breadcrumbs' => $breadcrumbs]);
    }
    //NON LTI
    public function course(Course $course) {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Manage '.$course->title,
            ],
        ];

        return view('nonlti.courses.single', ['course' => $course, 'breadcrumbs' => $breadcrumbs]);
    }

}
