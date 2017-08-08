<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:06 AM
 */

namespace EONConsulting\PHPStencil\src\Factories;

use EONConsulting\PHPStencil\src\Factories\GUI\Adapters\FormAdapter;
use EONConsulting\PHPStencil\src\Factories\GUI\Adapters\ListAdapter;
use EONConsulting\PHPStencil\src\Factories\GUI\GUIEnum;
use EONConsulting\PHPStencil\src\Factories\Text\Adapters\JSONAdapter;
use EONConsulting\PHPStencil\src\Factories\Text\Adapters\XMLAdapter;
use EONConsulting\PHPStencil\src\Factories\Text\Adapters\CSVAdapter;
use EONConsulting\PHPStencil\src\Factories\Text\TextEnum;

/**
 * Class AdapterFactory
 * @package EONConsulting\PHPStencil\src\Factories
 */
class AdapterFactory {

    /**
     * @param $config -> Of type CONFIG or TEXTENUM
     * @return JSONAdapter|XMLAdapter|CSVAdapter|FormAdapter|ListAdapter
     */
    public function make($config) {

        if($config instanceof Config) {
            switch ($config->get('text.default')) {
                case 'json':
                    return new JSONAdapter;
                    break;
                case 'xml':
                    return new XMLAdapter;
                    break;
                case 'csv':
                    return new CSVAdapter;
            }
            switch ($config->get('gui.default')) {
                case 'form':
                    return new FormAdapter;
                    break;
                case 'list':
                    return new ListAdapter;
            }
        } else {
            switch ($config) {
                case TextEnum::JSON:
                    return new JSONAdapter;
                    break;
                case TextEnum::XML:
                    return new XMLAdapter;
                    break;
                case TextEnum::CSV:
                    return new CSVAdapter;
                case GUIEnum::FORM:
                    return new FormAdapter;
                case GUIEnum::UILIST:
                    return new ListAdapter;
            }
        }
    }

}