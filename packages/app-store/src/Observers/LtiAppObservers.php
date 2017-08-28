<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/26/2017
 * Time: 2:58 PM
 */
namespace EONConsulting\AppStore\Observers;

class AppStoreStatus extends EventDispatcher
{

    public $user;

    protected $contextId;

    protected $errors;

    public function __construct($user, LTIContext $context)
    {
        parent::__construct();
        $this->user = $user;
        $this->contextId;

        $key = ($context->key) ? $context->key->key_key : '';
        $secret = ($context->key) ? $context->key->secret : '';
        $launch_url = ($context->domain) ? $context->domain->domain : false;

        if (!$launch_url) {
            throw new Exception('No Launch URL Found');
        }

        try {

            if (laravel_lti()->launch($launch_url, $key, $secret)) {
                    if($_SESSION["success"] = "Logged in.");
            }

        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage();
        }
    }
}
