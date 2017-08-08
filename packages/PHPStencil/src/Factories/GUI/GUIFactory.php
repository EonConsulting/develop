<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:23 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\GUI;


use EONConsulting\PHPStencil\src\Factories\AdapterFactory;
use EONConsulting\PHPStencil\src\Factories\Factory;

/**
 * Class GUIFactory
 * @package EONConsulting\PHPStencil\src\Factories\GUI
 */
class GUIFactory implements Factory {

    protected $adapter;

    /**
     * GUIFactory constructor.
     * @param AdapterFactory $adapter
     */
    public function __construct(AdapterFactory $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Return a new Text object with the correct adapter
     * @param $config
     * @return GUI
     */
    public function make($config) {
        return new GUI($this->adapter->make($config));
    }

}