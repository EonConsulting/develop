<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/25/2017
 * Time: 11:18 AM
 */

namespace EONConsulting\AppStore\Http\Controllers;

use EONConsulting\AppStore\Models\LTIDomainMeta;
use EONConsulting\LaravelLTI\Models\LTIDomain;
use Exception;

class AppsMetaClass
{
    protected $contextId;

    protected $request;

    public function __construct() {
        if(!$this->checkAppHasContext()) {
            throw new Exception('The Application Id is Uknown');
        }
        $context = '';
        try {
            $meta_info = new LTIDomainMeta;
            $meta_info->user_id = $this->request->user()->id;
            $meta_info->lti_user_id = $this->request->user()->id;
            $meta_info->lti_version = $context->context_id;
            $meta_info->lti_version = '';
            $meta_info->category = '';
            $meta_info->privacy_level = '';
            $meta_info->user_agent = '';
            $meta_info->display_type = '';

            $meta_info->save();

        } catch(Exception $e) {
            return 'Message :' . $e->getMessage();
        }
    }

    public static function read_from_str($str = false) {
        // check if a url was provided
        if(!$str)
            return false;

        // get into xml string
        $xmlstr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $str);

        // create xml object from string
        $xmlobj = simplexml_load_string($xmlstr);

        return $xmlobj;
    }


    static function read_str_from_url($url = false) {
        // check if a url was provided
        if(!$url)
            return false;

        // get xml from URL
        $xmlstr = file_get_contents($url);

        // get into xml string
        $xmlstr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xmlstr);

        // create xml object from string
        $xmlobj = simplexml_load_string($xmlstr);

        return $xmlobj;
    }


}