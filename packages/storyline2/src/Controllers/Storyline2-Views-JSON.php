<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
//use EONConsulting\Storyline2\Models\Course;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;


class Storyline2ViewsJSON extends BaseController {

    public function index() {
        //TODO: get course tree and use instead of the following demo array

        $var = $course::find(14);//hard coded
        $storyline = $var->latest_storyline();
        $items = $storyline->items;
        dd(json_encode($items));
        $decoded = json_encode($items);
        return $decoded;

    }

    public function render(Course $course) {

        $var = $course::find(14);
        $storyline = $var->latest_storyline();
        $items = $storyline->items;
        //dd(json_encode($items));
        //$decoded = json_encode($items);
        //return $decoded;

        return $this->items_to_tree($items);
    }

    public function items_to_tree($input) {

        $map = [];

        foreach($input as $k => $node) {

            $map[] = [
                'id' => $node['id'],
                'parent' => ($node['parent_id'] === null ? '#' : $node['parent_id']),
                'text' => $node['name']
            ];

        }

        return json_encode($map);

    }

    public function tree_to_items($input) {

        $map = [];

        foreach($input as $k => $node) {

            $map[] = [
                'id' => $node['id'],
                'parent_id' => ($node['parent'] === '#' ? null : $node['parent_id']),
                'name' => $node['text']
            ];

        }

        return json_encode($map);

    }



}
