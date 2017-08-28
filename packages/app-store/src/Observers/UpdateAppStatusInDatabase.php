<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/26/2017
 * Time: 3:06 PM
 */

namespace EONConsulting\AppStore\Observers;


class UpdateAppStatusInDatabase implements SplObserver {
    public function update(SplSubject $event) {

        var_dump('Update in db');

    }
}