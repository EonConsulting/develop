<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:30 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\WebService;

/**
 * Class WebService
 * @package EONConsulting\PHPStencil\src\Factories\WebService
 */
class WebService {

    protected $adapter;

    /**
     * Text constructor.
     * @param $adapter
     */
    public function __construct($adapter) {

        // get the set adapter for the different type of format needed
        $this->adapter = $adapter;
    }

    /**
     * Output the data with the correct format
     * @param $data
     * @return mixed
     */
    public function output($data) {
        return $this->adapter->output($data);
    }

}