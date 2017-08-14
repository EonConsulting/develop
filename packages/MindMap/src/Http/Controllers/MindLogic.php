<?php

namespace EONConsulting\MindMap;

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 4/11/2017
 * Time: 11:33 AM
 */

use EONConsulting\MindMap\Http\Controllers\TestStencilController;
use EONConsulting\MindMap\src\Models\MindMapModel;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers;
use Illuminate\Http\Request;


class MindLogic extends LTIBaseController
{

    protected $hasLTI = true;

    public static function mindmap_key($key) {
        return $key;
    }
    public static function mindmap_secret($secret) {
        return $secret;

    }
    public static function init_view()
    {

//        $key = MindLogic::mindmap_key('12345');
//        return $key;
        return TestStencilController::index();

    }


}