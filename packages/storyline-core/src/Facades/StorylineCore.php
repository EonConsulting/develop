<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:24 AM
 */

namespace EONConsulting\Storyline\Core\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineCore extends Facade {

    protected static function getFacadeAccessor() {
        return 'storyline_core';
    }

}