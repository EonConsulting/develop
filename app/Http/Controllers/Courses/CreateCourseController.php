<?php

namespace App\Http\Controllers\Courses;

use App\Http\Requests\Instructors\Courses\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateCourseController extends Controller {

    public function index() {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create a Module',
            ],
        ];

        return view('lecturer.courses.create', ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(StoreCourseRequest $request) {
        $title = $request->get('title', '');
        $description = $request->get('description', '');
        $tags = $request->get('tags', '');
        $featured_images = $request->file('featured_image');
        $course = new Course;

        $course->title = $title;
        $course->description = $description;
        $course->tags = $tags;
        $course->creator_id = $request->user()->id;

        $course->save();

        session()->flash('success_message', 'Course saved.');
        return redirect()->route('courses');
    }

}
