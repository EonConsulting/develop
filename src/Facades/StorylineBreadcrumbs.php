<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/30
 * Time: 9:30 AM
 */

namespace EONConsulting\Storyline\Breadcrumbs\Facade;


use Illuminate\Support\Facades\Facade;

class StorylineBreadcrumbs extends Facade {
    protected static function getFacadeAccessor() {
        return 'storyline_breadcrumbs';
    }


}