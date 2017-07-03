<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/01/19
 * Time: 9:24 AM
 */

namespace EONConsulting\StoryCore\Facades;


use Illuminate\Support\Facades\Facade;

class StoryCore extends Facade {

    protected static function getFacadeAccessor() {
        return 'storycore';
    }

}