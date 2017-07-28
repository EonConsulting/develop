<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:28 AM
 */

namespace EONConsulting\AppStore;


use EONConsulting\AppStore\Http\Controllers\AppsMetaClass;

class AppStore {

    public function get_store() {
        return view('eon.appstore::store');
    }

}