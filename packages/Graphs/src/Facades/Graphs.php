<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:02 AM
 */

namespace Packages\Graphs\src\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class InteractiveGraphs
 * @package Packages\InteractiveGraphs\src\Facades
 */
class Graphs extends Facade {

    /**
     * @return string
     */
    public static function getFacadeAccessor() {
        return 'graphs';
    }

}