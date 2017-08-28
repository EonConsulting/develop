<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/26/2017
 * Time: 3:37 PM
 */

namespace EONConsulting\AppStore\Observers;


class UpdateAdminsIfExpired implements SplObserver
{
    public function update(SplSubject $event)
    {
        var_dump('Subscribe user to Mailchimp: ' . $event->user->email);
    }
}