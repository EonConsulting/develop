<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/30
 * Time: 9:29 AM
 */

namespace EONConsulting\Storyline\Breadcrumbs;


class StorylineBreadcrumbs {

    protected $found = false;

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

}