<?php
/**
 * Created by PhpStorm.
 * User: bmmuffy
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\MindMap\Http\Controllers;


use EONConsulting\MindMap\src\Models\MindMapModel;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers;
use Illuminate\Http\Request;


class TestStencilController extends LTIBaseController
{

    protected $hasLTI = false;

    public function mindmap()
    {
       
        return view('ph::index');
    }

  
}