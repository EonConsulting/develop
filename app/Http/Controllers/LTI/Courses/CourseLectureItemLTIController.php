<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline\Nav\StorylineNav;

class CourseLectureItemLTIController extends LTIBaseController {

    public function index(Course $course, StorylineItem $storylineItem) {

        $data = storyline_core()->getIndex($course);

//        dd($data);
        $storyline = $course->storylines()->first();

        $styles = [];
        $scripts = [];
        $custom_scripts = [];
        $custom_styles = [];

        $nav = '';

        if(function_exists('storyline_nav')) {
            $nav = storyline_nav()->getNavHTMLFromCourse($course);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        //Peace Additions to J. Harington's Initial Storyline Nav
        $navigation = '';
        if (function_exists('storyline_nav')){
            $navigation = storyline_nav()->getNavHTMLFromCourseNORECURSION($course);
        }

        $menu = '';
        if(function_exists('storyline_menu')) {
            $menu = storyline_menu()->getMenuHTMLFromCourse($course);
        }

        $breadcrumbs = '';

        //Get and Make Breadcrumbs
        if (function_exists('storyline_breadcrumbs')) {
            $catBreadcrumbs = storyline_breadcrumbs()->showCatBreadCrumb($storylineItem->id, $storylineItem->id, $course);

        }
        //Get Next Storyline Item uses the Course Model
        //Get Next Storyline Item uses the Course Model
        //$next = $storylineItem['next'];
        //$previous = $storylineItem['previous'];
        // Get Previous Int that is < than Current Storyline->id
        //$previous = StorylineItem::where('id', '<', $storylineItem->id)->max('id');
        //Get Next Big Int Id on DB MysQL
        //$next = StorylineItem::where('id', '>', $storylineItem->id)->min('id');
		$previous = StorylineItem::where('id', '<', $storylineItem->id)
            ->where('storyline_id', '=', $storyline->id)
            ->max('id');
        //Get Next Big Int Id on DB MysQL
        $next = StorylineItem::where('id', '>', $storylineItem->id)
            ->where('storyline_id', '=', $storyline->id)
            ->min('id');
        $tag_cloud = '';
        if (function_exists('storyline_tag_cloud')) {
            $tag_cloud = storyline_tag_cloud()->getHTML($course);
        }

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('lti.courses'),
            'child' => [
                'title' => $course->title,
                'href' => route('lti.courses.single', $course['id']),
                'child' => [
                    'title' => 'Lectures'
                ],
            ],
        ];

        return view('student.courses.lecture', [
            'data' => $data,
            'course' => $course,
            'catBreadcrumbs' => $catBreadcrumbs,
            'navigation' => $navigation,
            'nav' => $nav,
            'styles' => $styles,
            'scripts' => $scripts,
            'custom_scripts' => $custom_scripts,
            'custom_styles' => $custom_styles,
            'menu' => $menu,
            'storyline' => $storyline,
            'storyline_item' => $storylineItem,
            'next' => $next,
            'previous' => $previous,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

}
