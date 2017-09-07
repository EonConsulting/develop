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
use Symfony\Component\HttpFoundation\Request;

class Storyline2ViewsJSON extends BaseController {

    /**
     * 
     * @param Course $course
     * @return type
     */
    public function render(Course $course) {
        $var = $course::find(20);
        $storyline = $var->latest_storyline();
        $items = $storyline->items;

        return $this->items_to_tree($items);
    }

    /**
     * 
     * @param type $items
     * @return type
     */
    public function items_to_tree($items) {

        $map = [];

        foreach ($items as $node) {
            $map[] = [
                'id' => $node['id'],
                'parent' => ($node['parent_id'] === null ? '#' : $node['parent_id']),
                'text' => $node['name']
            ];
        }

        return json_encode($map);
    }

    /**
     * 
     * @param type $items
     * @return type
     */
    public function tree_to_items($items) {

        $map = [];

        foreach ($items as $k => $node) {
            $map[] = [
                'id' => $node['id'],
                'parent_id' => ($node['parent'] === '#' ? null : $node['parent_id']),
                'name' => $node['text']
            ];
        }

        return json_encode($map);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function rename(Request $request) {
        if ($request->data['text'] === 'New node') {
            $ItemId   = (int) $request->data['parent'];
            $text     = $request->data['original']['text'];
            $parentId = (int)$request->data['parents'][1];    
            //dd($text);
            $Item = StorylineItem::where('id', '=', $ItemId)->first();
            $newItem = StorylineItem::create(['name' => $text,'storyline_id' => $Item->storyline_id,'parent_id' => $ItemId,'root_parent' => $parentId]);
            if ($Item->moveToLeftOf($newItem)) {
                $msg = 'success';
            } else {
                $msg = 'failed';
            }
        } else {
            $ItemId = (int) $request->data['id'];
            $text     = $request->data['text'];
            $Item = StorylineItem::where('id', '=', $ItemId)->first();
            $Item->name = $text;
            if ($Item->save()) {
                $msg = 'success2';
            } else {
                $msg = 'failed';
            }
        }
        return response()->json(['msg' => $msg]);
    }

    public function delete(Request $request) {
            $ItemId = (int) $request->id;
            $Item = StorylineItem::where('id', '=', $ItemId)->first();
            if ($Item->delete()) {
                $msg = 'success2';
            } else {
                $msg = 'failed';
            }
        }

}
