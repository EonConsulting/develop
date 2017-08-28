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
     * @param $default
     * @return mixed
     */
    public function createImage($data, $default);

    /**
     * @param $data
     * @param $default
     * @return mixed
     */
    public function stream($data, $default);


}