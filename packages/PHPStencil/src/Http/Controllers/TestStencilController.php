<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\PHPStencil\Http\Controllers;


use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class TestStencilController extends LTIBaseController {

    protected $hasLTI = true;

    public function test() {
        echo 'test';
    }

}