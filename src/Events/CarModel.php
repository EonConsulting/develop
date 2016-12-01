<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 11:12 AM
 */

namespace EONConsulting\PHPStencil\src\Events;


class CarModel extends Event {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = "1975";
    }

}