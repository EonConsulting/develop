<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:07 AM
 */

if(!function_exists('phpsaaswrapper')) {
    function phpsaaswrapper() {
        return app('phpsaaswrapper');
    }
}

if(!function_exists('base64UrlEncode')) {
    function base64UrlEncode($inputStr) {
        return strtr(base64_encode($inputStr), '+/=', '-_,');
    }
}

if(!function_exists('base64UrlDecode')) {
    function base64UrlDecode($inputStr) {
        return base64_decode(strtr($inputStr, '-_,', '+/='));
    }
}