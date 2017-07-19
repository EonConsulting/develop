<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 2017/01/25
 * Time: 12:07 PM
 */
namespace EONConsulting\Storyline\MindMap;


use EONConsulting\Storyline\MindMap\Classes\CourseStorylineMap;

class StorylineMindMap extends CourseStorylineMap  {
    /**
     * @var bool
     */
    protected $storyline = true;
    /**
     * @var string
     */
    protected $type = 'JSON';

}