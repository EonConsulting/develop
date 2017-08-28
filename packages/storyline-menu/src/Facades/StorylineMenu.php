<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/22
 * Time: 12:57 PM
 */

namespace EONConsulting\Storyline\Menu\Facades;


use Illuminate\Support\Facades\Facade;

class StorylineMenu extends Facade {

    protected static function getFacadeAccessor() {
        return 'storyline_menu';
    }

}