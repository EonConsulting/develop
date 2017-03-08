<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 11:11 AM
 */

namespace EONConsulting\CKEditorPlugin\src\Observers;

/**
 * Class CarModelObserver
 * @package EONConsulting\PHPStencil\src\Observers
 */
class CarModelObserver implements \SplObserver {

    /**
     * @param \SplSubject $event
     */
    public function update(\SplSubject $event) {
        echo 'The car model is: ' . $event->model;
    }

}