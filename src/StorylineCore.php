<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline\Core;

use EONConsulting\Storyline\Core\Classes\CommonWords;
use EONConsulting\Storyline\Core\Classes\GetSummary;
use EONConsulting\Storyline\Core\Flow\XMLTaxonomy;

class StorylineCore {

    public function getIndex() {
        $taxonomy = new XMLTaxonomy;
        return $taxonomy->index();
    }

    public function getMenu($config = false) {
        $taxonomy = new XMLTaxonomy;
        return $taxonomy->getMenu($config);
    }

    public function getPrevious($config = false, $page = false) {
        $taxonomy = new XMLTaxonomy;

        if($config || $config && $page) {
            return $taxonomy->getPreviousPage($config, $page);
        }
    }

    public function getNext($config = false, $page = false) {
        $taxonomy = new XMLTaxonomy;

        if($config || $config && $page) {
            return $taxonomy->getNextPage($config, $page);
        }
    }

    public function getMostCommonWords($amount = 10) {
        $taxonomy = new XMLTaxonomy;
        $data = $taxonomy->index();

        $get_summaries = new GetSummary();
        $summaries = $get_summaries->getSummaries($data);

        $common_words_obj = new CommonWords();
        $words = $common_words_obj->getCommonWords($summaries, $amount);

        return $words;
    }

    public function indexForSearch() {
        if(function_exists('storyline_search')) {
            $data = storyline_core()->getIndex();
            foreach ($data as $config => $item) {
                storyline_search()->index($item, $config);
            }
            return true;
        }

        return false;
    }

}