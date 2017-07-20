<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/19/2017
 * Time: 9:36 AM
 */
namespace EONConsulting\Storyline\MindMap\Classes;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\Storyline\Nav\StorylineNav;

class CourseStorylineMap
{
    /**
     * @var bool
     */
    protected $storyline = false;
    /**
     * @var string
     */
    protected $type;

    /**
     * @param Course $course
     * @return mixed
     */
    public function get_course_map(Course $course)
    {
        if ($this->storyline) {
            switch ($this->type) {
                case 'HTML' :
                    return storyline_nav()->getNavHTMLFromCourseNORECURSION($course);
                    break;
                case 'JSON' :
                    $storyline = $course->latest_storyline();
                    return json_encode($storyline->items);
                    break;
            }
        }

    }

}