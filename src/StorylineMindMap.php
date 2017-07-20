<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 2017/01/25
 * Time: 12:07 PM
 */
namespace EONConsulting\Storyline\MindMap;

use App\Models\Course;
use EONConsulting\Storyline\MindMap\Classes\CourseStorylineMap;

class StorylineMindMap extends CourseStorylineMap
{
    /**
     * @var bool
     */
    protected $storyline = true;
    /**
     * @var string
     */
    protected $type;

    /**
     * @param Course $course
     * @param $type
     * @return mixed
     */
    public function get_mind_map(Course $course, $type)
    {
        if (isset($type)) {
            $this->type = $type;
        }
        return $this->get_course_map($course);
    }

}