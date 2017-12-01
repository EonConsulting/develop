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
use EONConsulting\ContentBuilder\Models\Asset;
use App\Models\ContentTemplates;
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
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($course) {

        $SL2JSON = new Storyline2JSON;

        $course = Course::find($course);
        $storyline_id = $course->latest_storyline()->id;
        $userId = auth()->user()->id;
    
        $items = $SL2JSON->getTreeProgess($storyline_id);

        $course['template'] = ContentTemplates::find($course->template_id);

        $breadcrumbs = [
          'title' => 'View Storyline: ' . $course->title //pass $course as param and load name here
        ];

        return view('eon.storyline2::student.view', ['items' => $items,'breadcrumbs' => $breadcrumbs,'course'=>$course,'storylineId'=>$storyline_id]);
    }
    
    public function refresh_items($course,$item) {
        $SL2JSON = new Storyline2JSON;

        $course = Course::find($course);
        $storyline_id = $course->latest_storyline()->id;
        $userId = auth()->user()->id;

        $items = $SL2JSON->getTreeProgess($storyline_id);
        
        $items_view = view('eon.storyline2::partials.refresh_items', ['items' => $items,'id'=>$item])->render();
        $drop_view = view('eon.storyline2::partials.refresh_drop', ['items' => $items,'id'=>$item])->render();

        return ['items_html' => $items_view, 'drop_html' => $drop_view];
    }

    public function makeList($list, $number = '')
    {
        $result = '<ul>';
        $count = 0;

        foreach ($list as $item)
        {
            $count++;
            $children = isset($item['children']);

            $result = $result . '<li>';
            $result = $result . '<span class="toggle-expand pull-left">';
            $result = $result . ($children ? '<i class="fa fa-caret-right"></i>' : '');//if has children
            $result = $result . '</span>';
            $result = $result . '<span>' . $number. (string) $count . ')  </span>';
            $result = $result . '<span><a href="#" class="menu-btn" id="' . $item['id'] . '" data-parent-id="' . (($number === '') ? '#' : $item['parent_id']) . '" data-item-id="'. $item['id'] .'" data-prev-id="' . $item['prev'] . '" data-next-id="' . $item['next'] . '">'.$item['text'].'</a></span>';
            $result = $result . ($children ? $this->makeList($item['children'], $number . (string) $count . '.') : ''); //if has children

            $result = $result . '</li>';
        }
        $result = $result . '</ul>';

        return $result;
    }

    public function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

    /**
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($course) {
        
        $course = Course::find($course);
        $course['template'] = ContentTemplates::find($course->template_id);
        $contents = Content::all();
        $latest_storyline = $course->latest_storyline();

        if ($latest_storyline !== null)
        {
            $storyline_id = $latest_storyline->id;
        } else {
            $storyline = new Storyline([
                'course_id' => $course->id,
                'creator_id' => auth()->user()->id,
                'version' => 1
            ]);

            $storyline->save();
            $storyline_id = $storyline->id;

            $root_item = new StorylineItem([
                'storyline_id' => $storyline_id,
                'name' => 'Root'
            ]);

            $root_item->save();
            $root_id = $root_item->id;
                
            for($i = 0; $i < 3; $i++){

                $new_details = [
                    'name' => "Topic " . ($i + 1),
                    'storyline_id' => $storyline_id,
                    'parent_id' => $root_id,
                    'root_parent' => $root_id
                ];

                $new =  new StorylineItem($new_details);

                $new->save();
                
                if ($new->makeChildOf($root_item)) {
                    $msg = 'success';
                } else {
                    $msg = 'failed';
                }

            }

            //$storyline->items()->save($storyline_item);

            $course->storylines()->save($storyline);
            
        }

        $categories = Category::all();
        $assets = Asset::all();

        $breadcrumbs = [
            'title' => 'Edit ' . $course['title'] . ' Storyline' //pass $course as param and load name here
        ];

        return view('eon.storyline2::lecturer.edit', [
            'course' => $course,
            'contents' => $contents,
            'storyline_id' => $storyline_id,
            'categories' => $categories,
            'assets' => $assets,
            'breadcrumbs' => $breadcrumbs
        ]);

    }

}
