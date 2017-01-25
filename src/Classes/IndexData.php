<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 10:15 AM
 */

namespace EONConsulting\Storyline\Search\Classes;


use Elasticsearch\ClientBuilder;

class IndexData {

    public function index($type, $index, $body, $id) {
        $data = [
            'body' => $body,
            'index' => $index,
            'type' => $type,
            'id' => $id,
        ];

        $client = ClientBuilder::create()->build();
        return $client->index($data);
    }

}