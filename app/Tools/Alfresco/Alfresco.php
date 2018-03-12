<?php

namespace App\Tools\Alfresco;

class Alfresco
{

    public function upload($data){

        $search = config('app.es_uri').'/api/upload';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
