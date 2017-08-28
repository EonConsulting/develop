<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:02 AM
 */

namespace Packages\CKEditorPlugin\src\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class CKEditorPlugin
 * @package Packages\CKEditorPlugin\src\Facades
 */
class CKEditorPlugin extends Facade {

    /**
     * @return string
     */
    public static function getFacadeAccessor() {
        return 'phpstencil';
    }

}