<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/22
 * Time: 7:44 PM
 */

namespace EONConsulting\Storyline\Menu\Classes;


class RenderHTML {

    protected $menu;
    protected $html;
    protected $child;

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
            $html =  '<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown" href="' . $link . '">' . $node->name . '</a>';

            $html .= '<ul class="dropdown-menu" role="menu">';
            foreach($node->getImmediateDescendants() as $child)
            {
                $html .= $this->renderNode($child, $course);
            }
            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }


//    public function renderNode($node) {
//
//        $html = '<ul>';
//        foreach ($node as $node)
//        if( $node->isLeaf() ) {
//            $html .= '<li>' . $node->name . '</li>';
//        } else {
//            $html .= '<li>' . $node->name;
//
//            $html .= '<ul>';
//
//            foreach($node->children as $child)
//                $html .= $this->renderNode($child);
//
//            $html .= '</ul>';
//
//            $html .= '</li>';
//        }
//
//        $html .= '</ul>';
//
//        return $html;
//    }


    public function build($data = [], $root = true, $page = false, $parent_config = false, $course = false) {
        $html = '';
        if(is_array($data) && array_key_exists(0, $data)) {
            $html = '<ul class="dropdown-menu" role="menu">';
            for($i = 0; $i < count($data); $i++) {
                $d = $data[$i];
                $has_children = array_key_exists('children', $d);
                $main_active = ($page && array_key_exists('config', $d) && $d['config'] == $page) ? 'blue' : '';
                $main_link = route('lti.courses.single.lectures.item', [$course->id, $d['id']]);
                $html .= ($root && array_key_exists('title', $d)) ? '<li class="dropdown-submenu"><a class=" ' . $main_active . ' ' . (($has_children) ? 'ddropdown-toggle' : '') . '" href="' . (($has_children) ? '#' : $main_link) . '" ' . (($has_children) ? 'data-toggle="dropdown"' : '') . '>' . $d['title'] . '</a>' : '';

                $main_config = array_key_exists('config', $d) ? $d['config'] : '';

                $parent_config = (!$parent_config && $root) ? $main_config : $parent_config;

                if (array_key_exists('children', $d)) {
                    $html .= '<ul class="dropdown-menu pull-right" role="menu">';

                    foreach ($d['children'] as $child) {

//                        dd($d['children']);
                        $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
                        $config = (array_key_exists('config', $child)) ? $child['config'] : '';

                        if($course) {
                            $link = route('lti.courses.single.lectures.item', [$course->id, $child['id']]);
                        } else {
                            $link = route('lti.courses.single.lectures.item', [0, $child['id']]);
                        }

                        if (array_key_exists('children', $child) && count($child['children']) > 0) {
                            $html .= '<li class="dropdown parent dropdown-submenu">';
                            $html .= $this->build($d['children'], true, $page, $parent_config, $course);
                            $html .= '<a data-toggle="dropdown" class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';


                        } else {
                            $html .= '<li>';
                            $html .= '<a class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';
                        }

                        $html .= '</li>';

                    }
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
//            $html .= $this->build($data[$i], false, $page, $parent_config);
            $html .= '</ul>';
        } else {
            $html = '<ul class="dropdown-menu" role="menu">';
            $main_active = ($page && array_key_exists('config', $data) && $data['config'] == $page) ? 'blue' : '';
            $html .= ($root && array_key_exists('title', $data)) ? '<a class="dropdown-toggle" data-toggle="dropdown" class=" ' . $main_active . ' " href="">' . $data['title'] . '</a>' : '';

            $main_config = array_key_exists('config', $data) ? $data['config'] : '';

            $parent_config = (!$parent_config && $root) ? $main_config : $parent_config;

            if (array_key_exists('children', $data)) {
                $html .= '<ul class="dropdown-menu pull-right" role="menu">';
                foreach ($data['children'] as $child) {
                    $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
                    $config = (array_key_exists('config', $child)) ? $child['config'] : '';

                    $link = route('lti.courses.single.lectures.item', [$child['storyline_id'], $child['id']]);

                    if($course) {
                        $link = route('lti.courses.single.lectures.item', [$course->id, $child['id']]);
                    } else {
                        $link = route('lti.courses.single.lectures.item', [0, $child['id']]);
                    }

                    if (array_key_exists('children', $child) && count($child['children']) > 0) {
                        $html .= '<li class="dropdown parent dropdown-submenu">';
                        $html .= '<a class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';
                        $html .= $this->build($child, false, $page, $parent_config, $course);
                    } else {
                        $html .= '<li>';
                        $html .= '<a class="' . $active . ' " href="' . $link . '">' . $child['title'] . '</a>';
                    }

                    $html .= '</li>';
                }
                $html .= '</ul>';
            }


        }
        return $html;
    }

}