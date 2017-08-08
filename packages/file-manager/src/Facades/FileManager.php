<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/21
 * Time: 10:53 PM
 */

namespace EONConsulting\FileManager\Facades;


use Illuminate\Support\Facades\Facade;

class FileManager extends Facade {

    protected static function getFacadeAccessor() {
        return 'file_manager';
    }

}