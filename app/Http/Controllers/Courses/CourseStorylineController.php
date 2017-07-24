<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseStorylineController extends Controller {
    /**
     * @var
     */
    protected $storylineId;

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Course $course) {
        return view('lecturer.storylines.single', ['course' => $course]);
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, Course $course) {
        //Check If Course has a Storyline and do an Update else Create a New Storyline

        $nodes = $request->all()['parts'];

        $data = json_decode($nodes, true);
        dd($data);
        exit();
        $stId = Storyline::where('course_id', '=', $course->id)->first();

        //dd($stId);
        if ($stId == null) {
            $storyline = new Storyline;
            $storyline->course_id = $course->id;
            $storyline->creator_id = $request->user()->id;
            $storyline->save();
            $this->save_storyline_items($storyline,$data);
        } else {
            //$storyline = new Storyline;
            //$storyline->course_id = $course->id;
            //$storyline->creator_id = $request->user()->id;
			//dd($stId);
            $stId->update();
            $this->save_storyline_items($stId,$data);

        }


        return response('The Storyline has been Saved', 200);

    }

    public function save_storyline_items($storyline, $data) {
        $item = new StorylineItem;
        //$storyline_id = $storyline->id;
        $item->currentStoryLine($storyline->id);
        $item->buildTree($data);
    }

    public function fixtree() {
        //Fill in the _lft and _rgt Colunms if they are empty e.g imported Data
        //Try and Catch
//        $treefixer = new StorylineItem();
//
//      return $treefixer->fixTree();
        return StorylineItem::scoped([ 'storyline_id' => 55 ])->fixTree();

    }
    /**
     * @param Course $course
     * @return string
     * Credit Julius Nhodo | API and Angular
     */
    public function fetch(Course $course) {

        $storyline = $course->latest_storyline();
        $items = $storyline->items;
        $decoded = (json_encode($items));
        return $decoded;
    }



    public function get_feed_items(array $elements, $childIten) {
        $nodes = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == 0) {
                if ($childIten) {
                    $children = $this->get_feed_items($elements, $element['id']);
                    $element['children'] = $children;
                }
                $nodes[] = $element;
            }
        }
        return $nodes;
    }


        //From Feed
    public function get(Course $course) {
        $storyline = $course->latest_storyline();
        if(!$storyline) {
            return ['course' => $course, 'storyline' => [], 'items' => [], 'parts' => []];
        }
        $items = $storyline->items;

        $tree = $this->get_storyline($items->toArray());

        return ['course' => $course, 'storyline' => $storyline, 'items' => $items, 'parts' => $tree];
    }

    private function get_storyline(array $elements, $parentId = false) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->get_storyline($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }

                if(array_key_exists('file_name', $element) && !is_null($element['file_name']) && array_key_exists('file_url', $element) && !is_null($element['file_url'])) {
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
