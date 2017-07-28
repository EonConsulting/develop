<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseLectureLTIController extends LTIBaseController {

    public function index(Course $course) {

        $data = storyline_core()->getIndex($course);

        $latest_storyline = $course->latest_storyline()->items()->first();


        return redirect()->route('lti.courses.single.lectures.item', [$course->id, $latest_storyline->id]);

//        dd($data);

        $styles = [];
        $scripts = [];
        $custom_scripts = [];
        $custom_styles = [];

        $nav = '';
        if(function_exists('storyline_nav')) {
//            $nav = storyline_nav()->getNavHTML();
            $nav = storyline_nav()->getNavHTMLFromCourse($course);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        $menu = '';

        if(function_exists('storyline_nav')) {
            $menu = storyline_menu()->getMenuHTMLFromCourse($course);
//            $styles = array_merge($styles, storyline_menu()->getStyles());
//            $scripts = array_merge($scripts, storyline_menu()->getScripts());
//            $custom_scripts[] = storyline_menu()->getCustomScripts();
        }

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('lti.courses'),
            'child' => [
                'title' => $course->title,
                'href' => '',
                'child' => [
                    'title' => 'Lectures'
                ],
            ],
        ];

        return view('student.courses.lectures', [
            'data' => $data,
            'course' => $course,
            'nav' => $nav,
            'styles' => $styles,
            'scripts' => $scripts,
            'custom_scripts' => $custom_scripts,
            'custom_styles' => $custom_styles,
            'menu' => $menu,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

}
