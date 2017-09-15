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

           /* $storyline_item = new StorylineItem([
                'parent_id' => null,
                'storyline_id' => $storyline_id,
                


                
                'course_id' => $course->id,
                'creator_id' => auth()->user()->id,
                'version' => 1
            ]);*/

            $course->storylines()->save($storyline);

            
        }
       

        return view('eon.storyline2::lecturer.edit', ['storyline_id' => $storyline_id, 'breadcrumbs' => $breadcrumbs]);
    }

}
