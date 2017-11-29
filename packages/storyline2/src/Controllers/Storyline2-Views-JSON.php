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
use App\Models\StudentProgress;
use EONConsulting\ContentBuilder\Controllers\ContentBuilderCore as ContentBuilder;


class Storyline2ViewsJSON extends BaseController {

    /**
     * @return array
     */
    public function render($storyline_id) {

        /*
          $var = $course::find(20);
          $storyline = $var->latest_storyline();
          $items = $var['items'];
         */

        $storyline = Storyline::find(storyline_id);

        $items = $storyline['items'];

        return $this->items_to_tree($items);
    }

    /**
     * @param $storyline
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_items($storyline) {

        echo ($storyline);
        $sl = Storyline::find($storyline);
        $sl['items'] = StorylineItem::where("storyline_id", $storyline)->get();

        //dd($items);

        //$result = $this->items_to_tree(Storyline::find($storyline)->items);
        $result = $this->items_to_tree($sl);
        
        //dd($result);

        usort($result, [$this, "self::compare"]);
        $result = $this->createTree($result);
        $result = $result[0]['children'];

        return response()->json($result);
    }


    public function getTreeProgess($storyline){
        
        $sl = Storyline::find($storyline);
        $items = $this->items_to_tree($sl);

        $progress = StudentProgress::where([
            ['storyline_id', '=', $storyline],
            ['student_id', '=', Auth()->user()->id]
        ])->first();

        usort($items, [$this, "self::compare"]);

        if($progress === null){
            $progress = [
                'furthest' => (int) $items[1]['id']
            ];
        }
        //dd($progress);

        $found = false;
        $result = [];
        $visited = [];
        
        //dd($items);

        foreach($items as $k => $item){

            $temp = $item;

            if($found === true){
                if(in_array($item['required'],$visited)){
                    $temp['enabled'] = true;
                }else{
                    $temp['enabled'] = false;
                }
            }else{
                $temp['enabled'] = true;
                $visited[] = (string) $temp['id'];

                if((int) $item['id'] === (int) $progress['furthest']){
                    $found = true;
                }
            }

            $result[] = $temp;

        }

        $result = $this->createTree($result);
        $result = $result[0]['children'];

        return $result;

    }

    /**
     * @param $items
     * @param int $left
     * @param null $right
     * @param int $i
     * @param string $num
     * @param int $order
     * @return array
     */
    public function createTree($items, $left = 0, $right = null, $i = 0, $num = '', &$order = 0) {
        $tree = [];
        $count = 0;

        for($i; $i < count($items); $i++) {
            $temp = $items[$i];
            if ($temp['lft'] === $left + 1 && (is_null($right) || $temp['rgt'] < $right)) {
                $count++;
                $temp['order'] = $order;
                $order++;

                if($i < 2 ){ //I say 2 because we don't display the root node, so by saying 2 instead of 1, we jump over the root
                    $temp['prev'] = '#';
                    $temp_num = "";
                } else {
                    $temp['prev'] = $items[$i-1]['id'];
                    $temp_num = $num . (string) $count . '.';
                }

                if($i === count($items)-1){
                    $temp['next'] = '#';
                } else {
                    $temp['next'] = $items[$i+1]['id'];

                }

                if($num === ''){
                    $temp['parent_id'] = '#';
                }

                $temp['num'] = $num . (string) $count . ')';

                if($temp['rgt'] - $temp['lft'] !== 1){
                    $temp['children'] = $this->createTree($items, $temp['lft'], $temp['rgt'], $i+1, $temp_num, $order);
                }

                $tree[] = $temp;
                
                $left = $temp['rgt'];
            }
        }
        return $tree;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

    /**
     * @param $items
     * @return array
     */
    public function items_to_tree($items) {

        $map = [];

        foreach ($items->items as $k => $node) {

            $map[] = [
                'required' => $node['required'],
                'student_progress'=>$node['student_progress']['student_id'],
                'id' => (string) $node['id'],
                'text' => $node['name'],
                'parent_id' => ($node['parent_id'] === null) ? "#" : $node['parent_id'],
                'rgt' => $node['_rgt'],
                'lft' => $node['_lft']
            ];
        }

        return $map;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

        $data = $request->json()->all();
       
        $parent_id = (int) $data['parent'];

        $text = $data['original']['text'];
        $root_i = count($data['parents']) - 2;

        $root_parent = $data['parents'][$root_i];

        $parent = StorylineItem::where('id', '=', $parent_id)->first(); //parent

        //dd($root_parent);

        $new_details = [
            'name' => $text,
            'storyline_id' => $parent->storyline_id,
            'parent_id' => $parent_id,
            'root_parent' => $root_parent
        ];

        $new = StorylineItem::create($new_details);

        if ($new->makeChildOf($parent)) {
            $msg = 'success';
        } else {
            $msg = 'failed';
        }

        $response = [
            "Data Received" => $data,
            "Parent" => $parent,
            "New Node" => $new,
            "Root Parent Index" => $root_i,
            "Root Parent" => $root_parent,
            "msg" => $msg,
            "id" => $new->id
        ];

        return response()->json($response);
    }

    private function findPosition($decendants, $position) {
        $i = 0;
        foreach ($decendants as $decendant) {
            if ($i == $position) {
                return $decendant;
            }
            $i++;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function move(Request $request) {

        $data = $request->json()->all();
        $parentId = (int) $data['node']['parent'];
        $itemId = (int) $data['node']['id'];
        $position = (int) $data['position'];
        $old_position = (int) $data['old_position'];
        $parent = StorylineItem::find($parentId);
        $decendants = $parent->getImmediateDescendants();
        $num_children = count($decendants);
        $node = StorylineItem::find($itemId);

        if($num_children === 0 || $position === 0){
            $msg = $node->makeFirstChildOf($parent) ? "Made First Child of Parent" : "Failure";
        } else {

            if($position === $num_children-1){
                $msg = $node->makeLastChildOf($parent) ? "Made Last Child of Parent" : "Failure";
            }else {
                $msg = $node->makeLastChildOf($parent);

                $decendants = $parent->getImmediateDescendants();

                $msg = $node->moveToLeftOf($decendants[$position]) ? "Moved To Position ".$position : "Failure";

            }
        }
        
        return response()->json(['msg' => $msg]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
