<?php

namespace EONConsulting\CKEditorPluginV2\Http\Controllers;
use Symfony\Component\Validator\Constraints\False;

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 3/17/2017
 * Time: 5:43 PM
 */

/*
 * @param string $point The String to Search fot
 * @param $arr the array to search in
 */

class PartialMatch
{
    public static function objArrSearch($needle, array $array) {

        foreach ($array as $key => $value) {

            if (false !== strpos($value, $needle))

                return $key;
        }

        return false;

    }


}