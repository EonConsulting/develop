<?php
/**
 * Created by PhpStorm.
 * User: Dario.Alfredo
 * Date: 8/17/2017
 * Time: 9:57 AM
 */

namespace App\Tools\Elasticsearch;

class Elasticsearch
{
    public function search($query, $from = 0, $size = 10)
    {
        $from = $from === null ? 0 : $from;
        $size = $size === null ? 10 : $size;

        $search = config('app.es_uri') . '/u-index/courses/_search?from=' . $from . '&size=' . $size;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($query)
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
