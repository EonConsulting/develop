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
use EONConsulting\Storyline2\Controllers\Storyline2ViewsJSON as Storyline2JSON;

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
    public function view($course) {

        $SL2JSON = new Storyline2JSON;

        $course = Course::find($course);
        $storyline_id = $course->latest_storyline()->id;

        $items = $SL2JSON->items_to_tree(Storyline::find($storyline_id)->items);

        usort($items, array($this, "self::compare"));

        $items = $SL2JSON->createTree($items);

        //dd($items);

        $items = $this->makeList($items[0]['children']);

        $breadcrumbs = [
          'title' => 'View [Course Name] Storyline' //pass $course as param and load name here
        ];

        return view('eon.storyline2::student.view', ['items' => $items, 'breadcrumbs' => $breadcrumbs]);
    }

    public function makeList($list)
    {
        $result = '<ol>';

        foreach ($list as $item)
        {
            $result = $result . '<li><a href="#" class="menu-btn" data-item-id="'. $item['id'] .'">'.$item['text'].'</a>';
            if (isset($item['children']))
            {
                $result = $result . $this->makeList($item['children']);
            }
            $result = $result . '</li>';
        }
        $result = $result . '</ol>';

        return $result;
    }

    public function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function edit($course) {
        

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

        $breadcrumbs = [
            'title' => 'Edit ' . $course['title'] . ' Storyline' //pass $course as param and load name here
          ];

        return view('eon.storyline2::lecturer.edit', [
            'contents' => $contents,
            'storyline_id' => $storyline_id,
            'categories' => $categories,
            'breadcrumbs' => $breadcrumbs
        ]);

    }

}
