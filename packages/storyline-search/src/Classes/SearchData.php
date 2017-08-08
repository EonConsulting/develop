<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 10:35 AM
 */

namespace EONConsulting\Storyline\Search\Classes;


use Elasticsearch\ClientBuilder;

class SearchData {

    public function search($type, $index, $search_term) {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                'query' => [
                    'match' => [
                        '_all' => $search_term
                    ]
                ]
            ],
            'from' => 0,
            'size' => 10000
        ];

        $client = ClientBuilder::create()->build();
        $response = $client->search($params);

        return $response;
    }

    public function get_all($index) {

        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, "localhost:9200/" . $index . "/_search?q=*:*&size=10000");
        // Execute
        $response=curl_exec($ch);
        // Closing
        curl_close($ch);

        $response = json_decode($response);

        return $response;
    }

    public function get_common_words($type, $index) {

        $fields = [
            'aggs' => [
                'data' => [
                    'terms' => [
                        'field' => 'summary'
                    ]
                ]
            ]
        ];
        $fields_string = json_encode($fields);

        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, "localhost:9200/" . $index . "/_search?size=10000");
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        // Execute
        $response=curl_exec($ch);
        // Closing
        curl_close($ch);

        $response = json_decode($response);

        return $response;
    }

}