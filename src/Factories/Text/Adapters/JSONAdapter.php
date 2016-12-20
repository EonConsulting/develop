<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:11 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\Text\Adapters;

use EONConsulting\PHPStencil\src\Factories\Text\TextAdapterInterface;

/**
 * Class JSONAdapter
 * @package EONConsulting\PHPStencil\src\Factories\Text\Adapters
 */
class JSONAdapter implements TextAdapterInterface {

    /**
     * Output the data in JSON
     * @param $data
     * @return string
     */
    public function output($data) {
        return json_encode($data);
    }

}