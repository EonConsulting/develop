<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:02 AM
 */

namespace Packages\MindMap\src\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class MindMap
 * @package Packages\MindMap\src\Facades
 */
class MindMap extends Facade {

    /**
     * @return string
     */
    public static function getFacadeAccessor() {
        return 'mindmap';
    }

}