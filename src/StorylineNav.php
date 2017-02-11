<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/23
 * Time: 11:51 AM
 */

namespace EONConsulting\Storyline\Nav;


use EONConsulting\Storyline\Nav\Classes\RenderHTML;

class StorylineNav {

    public function getNavHTML($config = false, $page = false) {
        $menu = $this->get_nav($config);
        $html_obj = new RenderHTML();
        $html = $html_obj->build($menu, true, $page);

        return $html;
    }

    public function getNavView($config = false, $page = false) {
        $menu = $this->get_nav($config);
        $html_obj = new RenderHTML();
        $html = $html_obj->build($menu, true, $page);

        return view('eon.nav::nav', ['html' => $html]);
    }

    public function getStyles() {
        return [
            '/vendor/storyline/nav/themes/default/style.min.css'
        ];
    }

    public function getScripts() {
        return [
            '/vendor/storyline/nav/jstree.min.js'
        ];
    }

    public function getCustomScripts() {
        return "$('.tree-div').jstree({expanded: true}).on('select_node.jstree', function(node, selected, event) { console.log(selected); window.location.href = selected.node.a_attr.href; }); $('.jstree-icon.jstree-themeicon').remove();";
    }

    private function get_nav($config = false) {
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