<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EONConsulting\Notifications\Mail\SupportMail;
use EONConsulting\Notifications\Models\SupportMessages;
use Mail;


class NotificationsController {
    
    /**
     * 
     * @param Request $data
     * @return type
     */
    
    public function supportMail(Request $data) {
        
        $crud = new SupportMessages([
                'sender_id' => (int)auth()->user()->id,
                'subject' => $data->get('subject'),
                'message' => $data->get('message')
               
            ]);
        
        if($crud->save()){            
           Mail::to(env('SUPPORT_MAIL'))->send(new SupportMail($data));
           $msg = '200';
           }else{
           $msg = 'error';   
          }

        $response = array(
            'msg' => $msg
        );

        return \Response::json($response);
    }
    
}
