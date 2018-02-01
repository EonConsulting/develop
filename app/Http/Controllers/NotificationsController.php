<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EONConsulting\Notifications\Mail\SupportMail;
use Mail;


class NotificationsController {
    
    /**
     * 
     * @param Request $data
     * @return type
     */
    
    public function supportMail(Request $data) {
        
        var_dump(env('SUPPORT_MAIL'));
        exit();
               
        Mail::to(env('SUPPORT_MAIL'))->send(new SupportMail($data));

        $response = array(
            'msg' => '200'
        );

        return \Response::json($response);
    }
    
}
