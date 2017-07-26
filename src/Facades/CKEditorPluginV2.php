<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:30 AM
 */

namespace EONConsulting\CKEditorPluginV2\Facades;


use Illuminate\Support\Facades\Facade;

class CKEditorPluginV2 extends Facade {
    protected static function getFacadeAccessor() {
        return 'ckeditorpluginv2';
    }
}