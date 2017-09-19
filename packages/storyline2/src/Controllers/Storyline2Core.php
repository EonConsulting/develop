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


class Storyline2Core extends BaseController {

    public function index() {

    }
    
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
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

    public function get_content($item){

        $storyline_item = StorylineItem::find($item);

        if ($storyline_item['content_id'] == null)
        {
            $result = [
                "found" => false
            ];

        } else {
            $content = Content::find((int) $storyline_item['content_id']);

            

            $result = [
                "found" => true,
                "content" => $content,
                "categories" => $content->categories
            ];
        }

        return json_encode($result);

    }

    public function attach_content_to_item($content, $item){

        $this_content = (array) Content::find($content)->toArray();

        $new_content = new Content($this_content);
        $new_content->save();

        $storyline_item = StorylineItem::find($item);
        $storyline_item->content_id = $new_content->id;
        $storyline_item->save();

        return response()->json(["id" => $item]);

    }

    public function save_content(Request $request, $item){

        $data = $request->json()->all();
        
        if($data['id'] === ""){

            $content = new Content([
                'title' => $data['title'],
                'body' => $data['body'],
                'tags' => $data['tags'],
                'creator_id' => auth()->user()->id,
                'description' => $data['description']
            ]);
            
            $content->save();

            $categories = $data['categories'];
            
            foreach($categories as $k => $category_id) {
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

        }
        
        return 200;

    }

}
