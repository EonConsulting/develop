<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 12:09 PM
 */

namespace EONConsulting\Storyline\MindMap\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineMindMap extends Facade {

    protected static function getFacadeAccessor() {
        return 'storyline_mind_map';
    }

}