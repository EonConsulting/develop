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
            $result = [
                "found" => true,
                "content" => Content::find((int) $storyline_item['content_id'])
            ];
        }

        return json_encode($result);

    }

}
