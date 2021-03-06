<?php
/**
 * User: Dario.Alfredo
 * Date: 8/17/2017
 * Time: 9:57 AM
 */

namespace App\Tools\Elasticsearch;

class Elasticsearch
{
    public function search($index, $query, $from = 0, $size = 12)
    {
       /* $from = $from === null ? 0 : $from;
        $size = $size === null ? 12 : $size;*/

        $search = config('app.es_uri') . '/'. $index .'/_search?from=' . $from . '&size=' . $size;
        
        return $this->execQueryWithCurl($search,$query);
    }

    public function searchAll($index,$query){

        $search = config('app.es_uri') . '/'. $index .'/_search?from=0&size=50';

        return $this->execQueryWithCurl($search,$query);

    }

    public function execQueryWithCurl($search, $query){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($query)
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
