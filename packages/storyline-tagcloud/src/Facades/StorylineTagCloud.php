<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 12:09 PM
 */

namespace EONConsulting\Storyline\TagCloud\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineTagCloud extends Facade {

    protected static function getFacadeAccessor() {
        return 'storyline_tag_cloud';
    }

}