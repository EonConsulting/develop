<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 8:55 AM
 */

namespace EONConsulting\Storyline\Nav\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineNav extends Facade {
    protected static function getFacadeAccessor() {
        return 'storyline_nav';
    }


}