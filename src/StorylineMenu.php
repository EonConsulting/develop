<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/22
 * Time: 12:53 PM
 */

namespace EONConsulting\Storyline\Menu;


use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\Storyline\Menu\Classes\RenderHTML;

class StorylineMenu {

    public function getMenu($config = false) {
        return $this->get_menu($config);
    }

    public function getMenuHTML($config = false, $page = false) {
        $menu = $this->get_menu($config);
        $html_obj = new RenderHTML();
        $html = $html_obj->build($menu, true, $page);

        return $html;
    }

    public function getMenuHTMLFromCourse(Course $course, $config = false, $page = false) {
//        $data = storyline_core()->getIndex($course);
//
//        $html_obj = new RenderHTML();
//        $html = $html_obj->build($data, true, $page, false, $course);
//
//        return $html;
//        $storyline = $course->latest_storyline();
//        $node = StorylineItem::where('id', '=', '616')->first();
//        //dd($node);
//        $html_obj = new RenderHTML();
//        $html = $html_obj->renderNode($node);
//        dd($html);
        $storyline = $course->latest_storyline()->items->first();
        $node = StorylineItem::where('id', '=', $storyline->id)->first();
        $html_obj = new RenderHTML();
        $html = $html_obj->renderNode($node, $course);
        return $html;
    }


    private function get_menu($config = false) {
        $menu = storyline_core()->getMenu();
        if($config) {
            for($i = 0; $i < count($menu); $i++) {
                $m = $menu[$i];
                if($m['config'] == $config) {
                    $menu = $m;
                    break;
                }
            }
        }
        return $menu;
    }

}