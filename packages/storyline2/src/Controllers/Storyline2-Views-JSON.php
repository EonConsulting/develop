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

class Storyline2ViewsJSON extends BaseController {

    /**
     *
     * @param Course $course
     * @return type
     */
    public function render() {

        /*
          $var = $course::find(20);
          $storyline = $var->latest_storyline();
          $items = $var['items'];
         */

        $storyline = Storyline::find(47);

        $items = $storyline['items'];

        return $this->items_to_tree($items);
    }

    /**
     * Undocumented function
     *
     * @param [type] $storyline
     * @return void
     */
    public function show_items($storyline) {

        $result = Storyline::find($storyline);

        return $this->items_to_tree($result->items);
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

        $data = $request->json()->all();

        $ItemId = (int) $data['id'];
        $text = $data['text'];

        $Item = StorylineItem::find($ItemId);
        $Item->name = $text;

        if ($Item->save()) {
            $msg = 'success2';
        } else {
            $msg = 'failed';
        }

        return response()->json(['msg' => $msg]);
    }

    public function create(Request $request) {

        $data = $request->json()->all();

        $parent_id = (int) $data['parent'];
        $text = $data['original']['text'];

        $root_i = count($data['parents']) - 1;

        $root_parent = (int) $data['parents'][$root_i];
        //dd($text);

        $Item = StorylineItem::where('id', '=', $parent_id)->first();

        $newItem = StorylineItem::create(['name' => $text, 'storyline_id' => $Item->storyline_id, 'parent_id' => $parent_id, 'root_parent' => $root_parent]);

        if ($Item->moveToLeftOf($newItem)) {
            $msg = 'success';
        } else {
            $msg = 'failed';
        }

        return response()->json(['msg' => $msg, 'id' => $newItem->id]);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function move(Request $request) {

        $data = $request->json()->all();

        $parentId = (int) $data['parent'];
        $ItemId = (int) $data['id'];
        
        $Item = StorylineItem::where('id', '=', $ItemId)->first();
        $parent = StorylineItem::find($parentId);
        $Item->parent_id = $parentId;
         //dd($data);
        if($parentId == 0){
           $Item->parent_id = (int) $data['original']['parent']; 
        }
       
        if ($Item->save()) {
            $msg = 'success2';
        } else {
            $msg = 'failed';
        }
        
        return response()->json(['msg' => $msg]);
    }

    /**
     * 
     * @param Request $request
     */
    public function delete(Request $request) {

        $data = $request->json()->all();

        $ItemId = (int) $data[0];

        $Item = StorylineItem::where('id', '=', $ItemId)->first();
        if ($Item->delete()) {
            $msg = 'success2';
        } else {
            $msg = 'failed';
        }
        return response()->json(['msg' => $msg]);
    }

}
