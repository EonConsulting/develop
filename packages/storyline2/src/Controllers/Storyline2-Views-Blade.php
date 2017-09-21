<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use Symfony\Component\HttpFoundation\Request;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Controllers\ContentBuilderCore as ContentBuilder;

class Storyline2ViewsBlade extends BaseController {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index() {

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function view() {
        $breadcrumbs = [
          'title' => 'View [Course Name] Storyline' //pass $course as param and load name here
        ];

        return view('eon.storyline2::student.view', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function edit($course) {
        $breadcrumbs = [
          'title' => 'Edit [Course Name] Storyline' //pass $course as param and load name here
        ];

        $course = Course::find($course);
        $contents = Content::all();

        if (count($course->latest_storyline()))
        {
            $storyline_id = $course->latest_storyline()->id;
        } else {
            $storyline = new Storyline([
                'course_id' => $course->id,
                'creator_id' => auth()->user()->id,
                'version' => 1
            ]);

            $storyline->save();
            $storyline_id = $storyline->id;

            $storyline_item = new StorylineItem([
                'storyline_id' => $storyline_id,
                'name' => 'Start Here'
            ]);

            $storyline_item->save();

            $storyline->items()->save($storyline_item);

            $course->storylines()->save($storyline);
            
        }

        $categories = Category::all();
       

        return view('eon.storyline2::lecturer.edit', [
            'contents' => $contents,
            'storyline_id' => $storyline_id,
            'categories' => $categories,
            'breadcrumbs' => $breadcrumbs
        ]);

    }

}
