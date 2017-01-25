<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 12:07 PM
 */

namespace EONConsulting\Storyline\TagCloud;


class StorylineTagCloud {

    public function getStyles() {
        return ['/vendor/storyline/tagcloud/jqcloud.css'];
    }

    public function getScripts() {
        return ['/vendor/storyline/tagcloud/jqcloud-1.0.4.js'];
    }

    public function getCustomStyles() {
        return "div.jqcloud span.vertical { -webkit-writing-mode: vertical-rl; writing-mode: tb-rl; }";
    }

    public function getCustomScripts($word_list) {
        return "$('#tag-cloud').jQCloud(" . json_encode($word_list) . ");";
    }

    public function getHTML() {
        return '<div id="tag-cloud" style="width: 100%; height: 350px;"></div>';
    }

    public function generateWordList($word_list) {

        $return = [];
        foreach($word_list as $word => $count) {

            $data = [
                'text' => $word,
                'weight' => $count,
            ];

            if(rand() % 2 == 0)
                $data['html'] = ['class' => 'vertical'];

            $return[] = $data;
        }

        return $return;
    }
}