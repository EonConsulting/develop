<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:09 AM
 */

namespace EONConsulting\PHPSaasWrapper\src\Facades;


use Illuminate\Support\Facades\Facade;

class PHPSaasWrapper extends Facade {

    public static function getFacadeAccessor() {
        return 'phpsaaswrapper';
    }

}