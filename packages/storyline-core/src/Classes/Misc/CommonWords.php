<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 11:40 AM
 */

namespace EONConsulting\Storyline\Core\Classes;


class CommonWords {

    public function getCommonWords($arr, $amount = 10) {

        $exclude = ['', '...', 'and', 'the', 'of', 'a', 'that', 'is', 'to', 'are', 'in', 'our', 'we', 'this', 'will', 'use', 'or', 'on', 'for', 'with', 'be', 'an', 'by', 'not', 'you', 'it', 'the...', 'do', 'as...', 'An', 'In', 'The', 'We', 'us', 'too', 'Too', 'To', 'A', 'can', 'Can', 'If', 'at'];

        $array2 = array_count_values(explode(' ', implode(' ', $arr)));

        for($i = 0; $i < count($exclude); $i++) {
            if(array_key_exists($exclude[$i], $array2)) {
                unset($array2[$exclude[$i]]);
            }
        }

        arsort($array2);

        $return_arr = [];
        $count = 0;
        foreach($array2 as $key => $value) {
            if($count >= $amount) {
                break;
            }
            $count++;

            $return_arr[$key] = $value;
        }

        return $return_arr;

    }

    function getCommon($array,$occurance = 3) {
        $array = array_reduce($array, function($a,$b) { $a = array_merge($a,explode(" ", $b)); return $a; },array());
        return array_keys(array_filter(array_count_values($array),function($var)use($occurance) {return $var > $occurance ;}));
    }

}