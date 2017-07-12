<?php

namespace EONConsulting\ImgProcessor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;


/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 4/3/2017
 * Time: 5:04 AM
 */
class ImgDetail extends Controller {
    /**
     * @var Request
     */
    protected $newImgRequest;

    /**
     * ImgDetail constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {

        $this->newImgRequest = $request;

    }

    /**
     * @param $data
     * @return bool
     */
    public function process_image($data)
    {
        if(empty($this->request)) {
            return false;
        }

        $this->newImgRequest = $data;

    }

    /**
     * @return array
     */
    public function get_process_image() {
        return $this->newImgRequest->all();
    }


}