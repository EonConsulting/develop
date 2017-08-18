<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/30
 * Time: 9:29 AM
 */

namespace EONConsulting\Storyline\Breadcrumbs;
use App\Models\StorylineItem;
use EONConsulting\Storyline\Breadcrumbs\Classes\ParentKeysIterator;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class StorylineBreadcrumbs {

    protected $found = false;
    protected $next_id;
    Protected $next_found = false;

    // data requires the following structure:
    //  [
    //      'config' => 'parent config',
    //      'title' => 'parent',
    //      'href'  => 'parent link',
    //      'children' => [
    //          [
    //              'config' => 'item config',
    //              'title' => 'child 1',
    //              'href' => 'child 1 link',
    //              'children' => []
    //          ],
    //          [
    //              'config' => 'item config',
    //              'title' => 'child 2',
    //              'href' => 'child 2 link',
    //              'children' => [
    //                  [
    //                      'config' => 'item config',
    //                      'title' => 'sub child 1',
    //                      'href' => 'sub child link',
    //                      'children' => []
    //                  ]
    //              ]
    //          ],
    //          ...
    //      ],
    //      ...
    //  ]

    public function generateBreadcrumbs($config, $data = [], $original_config = false, $root = true, $parent = []) {
        $breadcrumbs = [];
        for($i = 0; $i < count($data); $i++) {

            if($root && count($breadcrumbs) > 0)
                return $breadcrumbs;

            if(array_key_exists('children', $data[$i]) && count($data[$i]['children']) > 0) {
                $arr = $this->generateBreadcrumbs($config, $data[$i]['children'], $original_config, false, ['config' => $data[$i]['config'], 'title' => $data[$i]['title']]);
                if(count($arr) > 0) {
                    if(count($parent) > 0) {
//                        $breadcrumbs = array_merge($breadcrumbs, [$parent]);
                    }
                    $breadcrumbs = array_merge($breadcrumbs, [['config' => $data[$i]['config'], 'title' => $data[$i]['title']]], $arr);
                }
            }

            if(array_key_exists('config', $data[$i]) && $config == $data[$i]['config']) {
                $breadcrumbs[] = ['config' => $config, 'title' => $data[$i]['title']];

                if($data[$i]['config'] == $original_config) {
                    $this->found = true;
                    return $breadcrumbs;
                }
            }
        }
        return $breadcrumbs;
    }

    //Get Next using DB taxonomy :: Peace Implementation
    public function getNextStoryLineItem($id, StorylineItem $storylineItem)
    {

         $nextStorylineItem = $storylineItem->next($id);


        return $nextStorylineItem;
    }
    public function getPrevStoryLineItem($id, StorylineItem $storylineItem)
    {

         $prevStorylineItem = $storylineItem->previous($id);


        return $prevStorylineItem;
    }


    public function getBreadcrumbs($config, $parent_config = false) {
        $data = storyline_core()->prepareForBreadcrumbs();
        if(!$parent_config)
            $parent_config = $config;

        $return = storyline_breadcrumbs()->generateBreadcrumbs($config, $data, $parent_config, true);

        $html = '<ul class="breadcrumbs">';

        for($i = 0; $i < count($return); $i++) {
            $item = $return[$i];
            $title = $item['title'];
            $link = '';
            if($i == 0) {
                $link = route('lti.config', $item['config']);
            } else {
                $link = route('lti.single', [$parent_config, $item['config']]);
            }

            $active = ($config == $item['config']) ? 'class="active"' : '';
            $html .= '<li><a ' . $active . ' href="' . $link . '">' . $title . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

    public function getStyles() {
        return [
            '/vendor/storyline/breadcrumbs/css/style.css'
        ];
    }

    public function getCategoryTreeIDs($catID) {

        $html = '';
//       $row = DB::getInstance()->query("SELECT parent FROM categories WHERE ID = '$catID'")->fetch();
        //$row = DB::table('storyline_items')->select('parent_id')->where('id', $catID)->first();
        $row = array();
        $row = StorylineItem::where('id', $catID)->select('parent_id')->first()->toArray();
        $path = array();
        if (!$row['parent_id'] == '') {
            $path[] = $row['parent_id'];
            $path = array_merge($this->getCategoryTreeIDs($row['parent_id']), $path);
        }
        return $path;

    }

    public function showCatBreadCrumb($catID, $data=[], $course) {
        $d = $data;
        $base = route('lti.courses.single.lectures.item', [$course->id, $d['id']]);
        $array = $this->getCategoryTreeIDs($catID);
        $html = '';
        //$html .= '<ul class="breadcrumbs">';
        $numItems = count($array);
        for ($i = 0; $i<=$numItems-1; $i++) {
            //$html .= '<li><a href="' . $base . '"></a></li>';
            $html .= '<li>' . $this->getNameLink($array[$i], $data, $course) . '&raquo' . '</li>';


        }
        //$html .= '</ul>';
        return $html;
    }

    public function getNameLink($catID, $data=[], $course) {
        $catID = (int) $catID;
        $d = $data;
        //$check = DB::getInstance()->query("SELECT ID, Name FROM categories WHERE ID = '$catID' LIMIT 1")->fetch();
//        $check = DB::table('storyline_items')->select('id, name')->where('id', $catID)->first();
        $check= StorylineItem::where('id', $catID)->select('id','name', 'file_url')->first()->toArray();
        $html = '<a href=' . route('lti.courses.single.lectures.item', [$course->id, $check['id']]) .'> '. $check['name'] .' </a>';
        return $html;

    }


}
