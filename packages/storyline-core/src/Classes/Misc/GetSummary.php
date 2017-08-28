<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 11:40 AM
 */

namespace EONConsulting\Storyline\Core\Classes;


class GetSummary {

    public function getSummaries($data) {
        $summaries = [];

        if(is_array($data)) {
            foreach($data as $item) {
                if (array_key_exists('summary', $item))
                    $summaries[] = $item['summary'];

                if (array_key_exists('children', $item) && count($item['children']) > 0) {
                    $summaries = array_merge($summaries, $this->getSummaries($item['children']));
                }
            }
        }

        return $summaries;
    }

}