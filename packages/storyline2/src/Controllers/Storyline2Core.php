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
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\ContentBuilder\Controllers\ContentBuilderCore as ContentBuilder;
use EONConsulting\Storyline2\Controllers\Storyline2ViewsJSON;
use App\Models\StudentProgress;

class Storyline2Core extends BaseController {

    public function index() {
         $result = $this->items_to_tree(Storyline::find($storyline)->items);
        usort($result, [$this, "self::compare"]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rename_storyline_item(Request $request) {
        if (is_array($request->data)) {
            $ItemId = (int) $request->data['id'];
            $node = StorylineItem::find($ItemId);
            $node->name = $request->data['text'];
            if ($node->save()) {
                $msg = 'success';
            } else {
                $msg = 'failed';
            }

            return response()->json(['msg' => $msg]);
        }
    }

    /**
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_content($item) {

        $storyline_item = StorylineItem::find($item);
        $req = '';
        if(!empty($storyline_item->required)){
            $req = $storyline_item = StorylineItem::find($storyline_item->required);
          }
        //$Siblings    = $storyline_item->getAncestorsAndSelfWithoutRoot();
         $Storyline2ViewsJSON  = new Storyline2ViewsJSON;
         $topicArray = $Storyline2ViewsJSON->items_to_tree(Storyline::find($storyline_item->storyline_id)->with('items.student_progress')->first());
         usort($topicArray, [$this, "self::compare"]);
        
        if ($storyline_item['content_id'] == null) {
            $result = [
                "topics" => $topicArray,
                "item" => $item,
                "req" =>$req,
                "found" => false
            ];
        } else {
            $content = Content::find((int) $storyline_item['content_id']);
            $result = [
                "found" => true, 
                "topics" => $topicArray,
                "item" => $item,
                "req" =>$req,
                "content" => $content,
                "categories" => $content->categories
            ];
        }

        return response()->json($result);
    }

    /**
     * @param $content
     * @param $item
     * @param $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function attach_content_to_item($content, $item, $action) {

        $result = ["id" => $item];

        if ($action === "copy") {

            $this_content = Content::find($content);

            $new_content = new Content($this_content->toArray());
            $new_content->title = "";
            $new_content->cloned_id = $content;
            $new_content->save();

            foreach ($this_content->categories as $k => $category) {
                $temp = Category::find($category->id);
                $new_content->categories()->save($temp);
            }

            $storyline_item = StorylineItem::find($item);
            $storyline_item->content_id = $new_content->id;
            $storyline_item->save();
        } elseif ($action === "link") {

            $storyline_item = StorylineItem::find($item);
            $storyline_item->content_id = $content;
            $storyline_item->save();
        }


        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param $item
     * @return int
     */
    public function save_content(Request $request, $item) {

        $data = $request->json()->all();

        if ($data['id'] === "") {

            $content = new Content([
                'title' => $data['title'],
                'body' => $data['body'],
                'tags' => $data['tags'],
                'creator_id' => auth()->user()->id,
                'description' => $data['description']
            ]);

            $content->save();

            $categories = $data['categories'];

            foreach ($categories as $k => $category_id) {
                $temp = Category::find($category_id);
                $content->categories()->save($temp);
            }

            $item = StorylineItem::find($item);
            
            $item->content_id = $content->id;

            $item->save();                      
            
        } else {
            $content_id = (int) $data['id'];

            $content = Content::find($content_id);

            $content->title = $data['title'];
            $content->body = $data['body'];
            $content->tags = $data['tags'];
            $content->creator_id = auth()->user()->id;
            $content->description = $data['description'];

            $content->save();

            $categories = $data['categories'];

            $content->categories()->sync($categories);
            $this->storeProgress($item,$data);
        }

        return 200;
    }
    
    /**
     * 
     * @param type $item
     * @param type $data
     */
    public function storeProgress($item,$data){
            $item = StorylineItem::find($item);            
            $item->required = $data['topic'];           
            $item->save();
               /*
               $StudentProgress = new StudentProgress([
                'student_id' => $user,
                'course_id' => (int)$data['course'],
                'storyline_item_id' => $item->storyline_id,
                'storyline_item_id' => $item
            ]);

            $StudentProgress->save();
                * 
                */
          
    }
   
    
    /**
     * 
     * @param type $a
     * @param type $b
     * @return int
     */
    public function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

}
