<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:46 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\WebService\Adapters;


use EONConsulting\PHPStencil\src\Factories\WebService\WebServiceAdapterInterface;

class SoapAdapter implements WebServiceAdapterInterface {

    public function output($data) {
        return $data;
    }

}