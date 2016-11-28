<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:11 AM
 */

namespace EONConsulting\PHPSaasWrapper\src\Factories;


class AdapterFactory {

    /**
     * @param $config -> Of type CONFIG
     * @return
     */
    public function make($config) {

        if($config instanceof Config) {
            switch ($config->get('text.default')) {

            }
            switch ($config->get('gui.default')) {

            }
        } else {
            switch ($config) {

            }
        }
    }

}