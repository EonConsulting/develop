<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline\Nav\StorylineNav;
use EONConsulting\Storyline\Core\StorylineCore;
use EONConsulting\Storyline\Menu\StorylineMenu;
use EONConsulting\Storyline\Breadcrumbs\StorylineBreadcrumbs;
use EONConsulting\Storyline\TagCloud\StorylineTagCloud;

class CourseLectureItemLTIController extends LTIBaseController {

    public function index(Course $course, StorylineItem $storylineItem) {

        $slCore = new StorylineCore();
        $data = $slCore->getIndex($course);

        $storyline = $course->storylines()->first();

        $styles = [];
        $scripts = [];
        $custom_scripts = [];
        $custom_styles = [];

        $nav = '';

        $slNav = new StorylineNav();
        $nav = $slNav->getNavHTMLFromCourse($course);
        $styles = array_merge($styles, $slNav->getStyles());
        $scripts = array_merge($scripts, $slNav->getScripts());
        $custom_scripts[] = $slNav->getCustomScripts();

        //Peace Additions to J. Harington's Initial Storyline Nav
        // Mike H refactored this so that we just pass data in 1 query
        // and then user @each in blade to process the tree
        $navigation = '';
        $navigation = $slNav->getNavTreeFromCourse($course);

        // MH: This is also creating too many queries
        // also using same result from above, 1 query to rule them all :)
        $menu = '';
        $menu = $navigation;

        $breadcrumbs = '';

        //Get and Make Breadcrumbs
        $slBreadcrumbs = new StorylineBreadcrumbs();
        $catBreadcrumbs = $slBreadcrumbs->showCatBreadCrumb($storylineItem->id, $storylineItem->id, $course);
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
        $slTagcloud = new StorylineTagCloud();
        if (function_exists('storyline_tag_cloud')) {
            $tag_cloud = $slTagcloud->getHTML($course);
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
