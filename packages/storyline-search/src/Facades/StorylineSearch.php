<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 10:07 AM
 */

namespace EONConsulting\Storyline\Search\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineSearch extends Facade {
    protected static function getFacadeAccessor() {
        return 'storyline_search';
    }


}