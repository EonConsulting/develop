<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 12:07 PM
 */

namespace EONConsulting\Storyline\TagCloud;


class StorylineTagCloud {
    /**
     * @return array
     */
    public function getStyles() {
        return ['/vendor/storyline/tagcloud/jqcloud.css'];
    }

    /**
     * @return array
     */
    public function getScripts() {
        return ['/vendor/storyline/tagcloud/jqcloud-1.0.4.js'];
    }

    /**
     * @return string
     */
    public function getCustomStyles() {
        return "div.jqcloud span.vertical { -webkit-writing-mode: vertical-rl; writing-mode: tb-rl; }";
    }

    /**
     * @param $word_list
     * @return string
     */
    public function getCustomScripts($word_list) {
        return "$('#tag-cloud').jQCloud(" . json_encode($word_list) . ");";
    }

    /**
     * @return string
     */
    public function getHTML() {
        return '<div id="tag-cloud" style="width: 100%; height: 350px;"></div>';
    }

    /**
     * @param $word_list
     * @return array
     */
    public function generateWordList($word_list) {

        $return = [];

        if($word_list[0] != "") {
            foreach($word_list as $count => $word) {

                $data = [
                    'text' => $word,
                    'weight' => $count,
                ];

                if(rand() % 2 == 0)
                    $data['html'] = ['class' => 'vertical']; //what does this do?

                $return[] = $data;
            }
        } else {
            $return = null;
        }

        return $return;
    }
}
