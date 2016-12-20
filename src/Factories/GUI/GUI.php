<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:21 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\GUI;

/**
 * Class GUI
 * @package EONConsulting\PHPStencil\src\Factories\GUI
 */
class GUI {

    protected $adapter;

    /**
     * GUI constructor.
     * @param $adapter
     */
    public function __construct($adapter) {

        // get the set adapter for the different type of view needed
        $this->adapter = $adapter;
    }

    /**
     * Output the data with the correct view
     * @param $data
     * @return mixed
     */
    public function render($data) {
        return view($this->adapter->getGUIName(), $data);
    }

}