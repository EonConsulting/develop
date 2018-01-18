<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SupportMail;
use Mail;


class NotificationsController {
    
    public function supportMail(Request $request) {
               
        Mail::to(env('SUPPORT_MAIL'))->send(new SendMail());

        $response = array(
            'msg' => '200'
        );

        return \Response::json($response);
    }
    
}
