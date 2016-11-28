<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:02 AM
 */

namespace Packages\PHPStencil\src\Facades;


use Illuminate\Support\Facades\Facade;

class PHPStencil extends Facade {

    public static function getFacadeAccessor() {
        return 'phpstencil';
    }

}