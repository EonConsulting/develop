<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/4/2017
 * Time: 1:46 PM
 */

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Http\Controllers\LTI\Courses\CourseLectureLTIController;

class CourseLectureController extends CourseLectureLTIController
{
    protected $hasLTI = false;

    public function index(Course $course)
    {

        $latest_storyline = $course->latest_storyline()->items()->first();
        return redirect()->route('home.courses.single.lectures.item', [$course->id, $latest_storyline->id]);
    }
}