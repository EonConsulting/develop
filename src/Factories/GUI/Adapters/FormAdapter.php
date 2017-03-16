<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:24 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\GUI\Adapters;


use EONConsulting\PHPStencil\src\Factories\GUI\GUIAdapterInterface;

/**
 * Class FormAdapter
 * @package EONConsulting\PHPStencil\src\Factories\GUI\Adapters
 */
class FormAdapter implements GUIAdapterInterface {

    /**
     * Get the name of the view
     * @return string
     */
    public function getGUIName() {
        return 'phpstencil::form';
    }

}