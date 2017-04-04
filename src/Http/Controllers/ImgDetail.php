<?php

namespace EONConsulting\ImgProcessor\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;


/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 4/3/2017
 * Time: 5:04 AM
 */
class ImgDetail extends LTIBaseController {

    protected $hasLTI = false;
    protected $request;

    public function __construct(Request $request) {

        $this->request = $request;

    }

    public function html2PDF($data = '')
    {
        //Validates Check if Data is Valid
        if ($this->request->has('data')) {
            $data = $this->request->get('data');
        }

        $data = urldecode($data);

        return $data;

    }

}