<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 8:54 AM
 */

namespace EONConsulting\Storyline\Nav\Classes;


class RenderHTML {
    /**
     * Menu Items
     */
    protected $menu;
    /**
     * Htm Contents
     */
    protected $html;

    protected $items = array();
    /**
     * RenderHTML constructor.
     */
    public function __construct() {}

    function renderNode($node, $course)
    {
        $link = route('lti.courses.single.lectures.item', [$course->id, $node->id]);
        if($node->isLeaf())
        {
            return '<li><a href="' . $link . '">' . $node->name . '</a></li>';
        }
        else
        {
            $html =  '<li><a href="' . $link . '">' . $node->name . '</a>';

            $html .= '<ul>';
            foreach($node->getImmediateDescendants() as $child)
            {
                $html .= $this->renderNode($child, $course);
            }
            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }



//    public function buildhtmlMENU($data = [], $root = false, $page = false, $parent_config = false, $course = false) {
//        $html = '';
//        if(is_array($data) && array_key_exists(0, $data)) {
//            $html = '<ul class="mtree nix" id="eon-menu">';
//            for($i = 0; $i < count($data); $i++) {
//                $d = $data[$i];
//                $has_children = array_key_exists('children', $d);
//                $main_active = ($page && array_key_exists('config', $d) && $d['config'] == $page) ? 'blue' : '';
//                $main_link = route('lti.courses.single.lectures.item', [$course->id, $d['id']]);
//                $html .= ($root && array_key_exists('title', $d)) ? '<li><a class="" href="' . (($has_children) ? '#' : $main_link) . '" ' . (($has_children) ? 'data-toggle="dropdown"' : '') . '>' . $d['title'] . '</a>' : '';
//
//                $main_config = array_key_exists('config', $d) ? $d['config'] : '';
//
//                $parent_config = (!$parent_config && $root) ? $main_config : $parent_config;
//
//                //Children of Parent_Id == 0
//                if (array_key_exists('children', $d)) {
//                    $html .= '<ul class="mtree nix">';
//                    foreach ($d['children'] as $childs => $child) {
//                        $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
//                        $config = (array_key_exists('config', $child)) ? $child['config'] : '';
//
//                        if($course) {
//                            $link = route('lti.courses.single.lectures.item', [$course->id, $child['id']]);
//                        } else {
//                            $link = route('lti.courses.single.lectures.item', [0, $child['id']]);
//                        }
//
//
//                        if (array_key_exists('children', $child) && count($child['children']) > 0) {
//                            $html .= '<li>';
//                            $html .= '<a class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';
//                            $html .= $this->buildhtmlMENU($d['children'], false, $page, $parent_config, $course);
//                            $html .= '</li>';
//                        } else {
//                            $html .= '<li>';
//                            $html .= '<a class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';
//                        }
//
//                        $html .= '</li>';
//                    }
//                    $html .= '</ul>';
//                }
//
//                $html .= '</li>';
//            }
//            //$html .= $this->build($data[$i], false, $page, $parent_config);
//            $html .= '</ul>';
//        } else {
//            $html = '<ul class="mtree nix" id="eon-menu">';
//            $main_active = ($page && array_key_exists('config', $data) && $data['config'] == $page) ? 'blue' : '';
//            $html .= ($root && array_key_exists('title', $data)) ? '<a class=" ' . $main_active . ' " href="">' . $data['title'] . '</a>' : '';
//
//            $main_config = array_key_exists('config', $data) ? $data['config'] : '';
//
//            $parent_config = (!$parent_config && $root) ? $main_config : $parent_config;
//
//            if (array_key_exists('children', $data)) {
//                $html .= '<ul>';
//                foreach ($data['children'] as $child) {
//                    $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
//                    $config = (array_key_exists('config', $child)) ? $child['config'] : '';
//
//                    $link = route('lti.courses.single.lectures.item', [$child['storyline_id'], $child['id']]);
//
//                    if($course) {
//                        $link = route('lti.courses.single.lectures.item', [$course->id, $child['id']]);
//                    } else {
//                        $link = route('lti.courses.single.lectures.item', [0, $child['id']]);
//                    }
//
//                    if (array_key_exists('children', $child) && count($child['children']) > 0) {
//                        $html .= '<li>';
//                        $html .= '<a class="" href="' . $link . '">' . $child['title'] . '</a>';
//                        $html .= $this->buildhtmlMENU($child, false, $page, $parent_config, $course);
//                    } else {
//                        $html .= '<li>';
//                        $html .= '<a class="" href="' . $link . '">' . $child['title'] . '</a>';
//                    }
//
//                    $html .= '</li>';
//                }
//                $html .= '</ul>';
//            }
//
//
//        }
//        return $html;
//    }

    public function build($data = [], $root = false, $page = false, $parent_config = false, $course = false) {
        if(is_array($data) && array_key_exists(0, $data)) {
            $html = ($root) ? '<div id="tree-div"><ul>' : '<ul>';
            for($i = 0; $i < count($data); $i++) {
                $html .= $this->build($data[$i], false, $page, $parent_config, $course);
            }
            $html .= ($root) ? '</ul></div>' : '</ul>';
        } else {
//            $html = ($root) ? '<div id="tree-div"><ul>' : '<ul>';
            $html = '';
            $main_active = ($page && array_key_exists('config', $data) && $data['config'] == $page) ? 'blue' : '';
            $main_link = route('lti.courses.single.lectures.item', [$course->id, $data['id']]);
            $html .= ($root && array_key_exists('title', $data)) ? '<li><a class="waves-effect ' . $main_active . ' waves-light full-width" href="">' . $data['title'] . '</a></li>' : '<li><a class="" href="' . $main_link . '">' . $data['title'] . '</a></li>';

            $main_config = array_key_exists('config', $data) ? $data['config'] : '';

            $parent_config = (!$parent_config) ? $main_config : $parent_config;

            if (array_key_exists('children', $data)) {
                foreach ($data['children'] as $child) {
                    $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
                    $config = (array_key_exists('config', $child)) ? $child['config'] : '';

                    if($course) {
                        $link = route('lti.courses.single.lectures.item', [$course->id, $child['id']]);
                    } else {
                        $link = route('lti.courses.single.lectures.item', [0, $child['id']]);
                    }

                    if (array_key_exists('children', $child) && count($child['children']) > 0) {
                        $html .= '<li class="jstree-open">';
                        $html .= '<a class="waves-effect ' . $active . ' waves-light full-width" href="' . $link . '">' . $child['title'] . '</a>';
                        $html .= $this->build($child, false, $page, $parent_config, $course);
                    } else {
                        $html .= '<li>';
                        $html .= '<a class="waves-effect ' . $active . ' waves-light full-width" href="' . $link . '">' . $child['title'] . '</a>';
                    }

                    $html .= '</li>';
                }
            }
//            $html .= ($root) ? '</ul></div>' : '</ul>';
        }

        return $html;
    }

}