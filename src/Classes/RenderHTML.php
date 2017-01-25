<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 8:54 AM
 */

namespace EONConsulting\Storyline\Nav\Classes;


class RenderHTML {

    protected $menu;
    protected $html;

    /**
     * RenderHTML constructor.
     */
    public function __construct() {}

    public function build($data = [], $root = false, $page = false, $parent_config = false) {
        $html = ($root) ? '<div class="tree-div"><ul>' : '<ul>';
        $main_active = ($page && array_key_exists('config', $data) && $data['config'] == $page) ? 'blue' : '';
        $html .= ($root && array_key_exists('title', $data)) ? '<li><a class="waves-effect ' . $main_active . ' waves-light full-width" href="">' . $data['title'] . '</a></li>' : '';

        $main_config = array_key_exists('config', $data) ? $data['config'] : '';

        $parent_config = (!$parent_config && $root) ? $main_config : $parent_config;

        if(array_key_exists('children', $data)) {
            foreach ($data['children'] as $child) {
                $active = ($page && array_key_exists('config', $child) && $child['config'] == $page && $main_active == '') ? 'blue' : '';
                $config = (array_key_exists('config', $child)) ? $child['config'] : '';

                $link = route('lti.single', [$parent_config, $config]);

                if(array_key_exists('children', $child) && count($child['children']) > 0) {
                    $html .= '<li class="jstree-open">';
                    $html .= '<a class="waves-effect ' . $active . ' waves-light full-width" href="' . $link . '">' . $child['title'] . '</a>';
                    $html .= $this->build($child, false, $page, $parent_config);
                } else {
                    $html .= '<li>';
                    $html .= '<a class="waves-effect ' . $active . ' waves-light full-width" href="' . $link . '">' . $child['title'] . '</a>';
                }

                $html .= '</li>';
            }
        }

        $html .= ($root) ? '</ul></div>' : '</ul>';
        return $html;
    }

}