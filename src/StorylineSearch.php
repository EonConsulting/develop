<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 10:07 AM
 */

namespace EONConsulting\Storyline\Search;


use EONConsulting\Storyline\Search\Classes\IndexData;
use EONConsulting\Storyline\Search\Classes\SearchData;

class StorylineSearch {

    public function index($data, $id) {
        $item = new IndexData();
        return $item->index('unisa', 'storyline_search', $data, $id);
    }

    public function search($search_term) {
        $data = new SearchData();
        return $data->search('unisa', 'storyline_search', $search_term);
    }

    public function get_all_records() {
        $data = new SearchData();

        return $data->get_all('storyline_search');
    }

    public function most_common_words() {
        $data = new SearchData();
        $data = $data->get_all('storyline_search');

        $hits = $data->hits->hits;
        dd(json_encode($hits));
        return $data;
    }

}