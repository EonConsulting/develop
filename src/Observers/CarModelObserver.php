<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 11:11 AM
 */

namespace EONConsulting\PHPStencil\src\Observers;


class CarModelObserver implements \SplObserver {

    public function update(\SplSubject $event) {
        echo 'The car model is: ' . $event->model;
    }

}