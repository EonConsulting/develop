<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/12/2017
 * Time: 2:00 PM
 */

namespace EONConsulting\ImgProcessor\Http\Contracts;

/**
 * Interface ImageInterface
 * @package EONConsulting\ImgProcessor\Http\Controllers\Classes
 */
Interface ImageInterface {
    /**
     * @param $data
     * @return mixed
     */
    public function createImage($data);

    /**
     * @param $ouputtype
     * @return mixed
     */
    public function getImage($ouputtype);

    /**
     * @return mixed
     */
    public function save_content();

}