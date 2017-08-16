<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/22/2017
 * Time: 12:26 PM
 */
namespace EONConsulting\Storyline\Core\Flow\DBTaxonomy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;

/**
 * Class CourseStorylineBase
 * @package EONConsulting\Storyline\Core\Flow\DBTaxonomy
 */
class DBCourseStorylineBase extends Controller
{
    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    /**
     * @var $nodes
     */
    protected $nodes;
    /**
     * @var $stId
     */
    protected $stId;

    /**
     * @param Request $request
     */
    public function setNodes(Request $request) {
        $this->nodes = json_decode($request->all()['parts'], true);
        
       return $this->nodes;
    }

    /**
     * @param $storylineId
     */
    public function setstId($storylineId) {
        $this->stId = $storylineId;
    }

    /**
     * Store or Update the New StoryLine
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function asset_store(Request $request, Course $course)
    {
        if($this->checkRequestHasData()) {
            throw new Exception('Request is Empty !');
        }

        if($this->checkHasStoryLineId()) {
            throw new Exception('Could Not Find Storyline');
        }
       
        $this->createStoryLIne($request, $course);
 exit();
        return response('The Storyline has been Saved', 200);
    }

    /**
     * Check Request Has Data
     */
    protected function checkRequestHasData() {
        $this->nodes == null || count($this->nodes) == 0;
    }

    /**
     * Check StoryLine Id is Set
     */
    protected function checkHasStoryLineId() {
        $this->stId == null || !isset($this->stId);
    }

    /**
     * Create the StoryLine
     * @param Request $request
     * @param Course $course
     */
    protected function createStoryLIne(Request $request, Course $course) {
        if ($this->stId == null) {
            $storyline = new Storyline;
            $storyline->course_id = $course->id;
            $storyline->creator_id = $request->user()->id;
            $storyline->save();
            $this->asset_save_storyline_items($storyline, $this->nodes);
        } else {
            $this->stId->update();
            $this->asset_save_storyline_items($this->stId, $this->nodes);
             var_dump($this->nodes);
        }
        exit();
    }

    /**
     * @param $storyline
     * @param $data
     */
    protected function asset_save_storyline_items($storyline, $data)
    {
        $item = new StorylineItem;
        //$storyline_id = $storyline->id;
        $item->currentStoryLine($storyline->id);
        $item->buildTree($data);


    }

    /**
     * Fetch the Latest Storyline
     * @param Course $course
     * @return string
     *
     */
    public function asset_fetch(Course $course)
    {

        $storyline = $course->latest_storyline();
        $items = $storyline->items;
        $decoded = (json_encode($items));
        return $decoded;
    }

    /**
     * @param array $elements
     * @param $childIten
     * @return array
     */
    public function asset_get_feed_items(array $elements, $childIten)
    {
        $nodes = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == 0) {
                if ($childIten) {
                    $children = $this->asset_get_feed_items($elements, $element['id']);
                    $element['children'] = $children;
                }
                $nodes[] = $element;
            }
        }
        return $nodes;
    }

    /**
     * Fetch From Feed
     * @param Course $course
     * @return array
     */
    public function asset_get(Course $course)
    {
        $storyline = $course->latest_storyline();
        if (!$storyline) {
            return ['course' => $course, 'storyline' => [], 'items' => [], 'parts' => []];
        }
        $items = $storyline->items;

        $tree = $this->asset_get_storyline($items->toArray());

        return ['course' => $course, 'storyline' => $storyline, 'items' => $items, 'parts' => $tree];
    }

    /**
     * @param array $elements
     * @param bool $parentId
     * @return array
     */
    protected function asset_get_storyline(array $elements, $parentId = false)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->asset_get_storyline($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }

                if (array_key_exists('file_name', $element) && !is_null($element['file_name']) && array_key_exists('file_url', $element) && !is_null($element['file_url'])) {
                    $element['files'] = [
                        ['name' => $element['file_name'], 'url' => $element['file_url']]
                    ];
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

}
