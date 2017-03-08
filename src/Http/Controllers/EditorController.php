<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 3/1/2017
 * Time: 4:24 AM
 */

namespace EONConsulting\CKEditorPlugin\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\LaravelLTI\LaravelLTI;
use EONConsulting\LaravelLTI\Models\LTIDomain;
use Illuminate\Http\Request;
use Tsugi\Config\ConfigInfo;
use Tsugi\Laravel\LTIX;
use Tsugi\Util\LTI;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

/*
  * @package CKEditorPlugin
  */

class EditorController extends LTIBaseController
{

    protected $hasLTI = false;
    /**
     * Launch LTI Parameters
     *
     * @return mixed
     *
     * @param array $launch
     */

    public function index () {

        return view('plugin');

    }
}


