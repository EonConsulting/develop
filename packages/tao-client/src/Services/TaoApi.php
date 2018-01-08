<?php

namespace EONConsulting\TaoClient\Services;

use GuzzleHttp\Client;

class TaoApi
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Holds the config
     *
     * @var $config
     */
    protected $config;

    /**
     * Hold the response from the api call
     *
     * @var $response
     */
    protected $response;

    /**
     * TaoApi constructor.
     *
     * @param \GuzzleHttp\Client $client
     * @param $config
     */
    public function __construct(Client $client, $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /*
     * Get the latest QTI result for a test taker and a delivery.
     *
     * Api endpoint [Get /taoResultServer/QtiRestResults/getLatest]
     *
     * @param string $testtaker Test taker identifier in URI format.
     * @param string $delivery Delivery identifier in URI format.
     */
    public function getLatestResults($testtaker, $delivery)
    {
        $this->response = $this->callApi('taoResultServer/QtiRestResults/getLatest', [
            'testtaker' => $testtaker,
            'delivery' => $delivery
        ], 'GET');

        return $this;
    }

    /*
     * Get a QTI result by its identifier.
     *
     * Api endpoint [Get /taoResultServer/QtiRestResults/getQtiResultXml]
     *
     * @param string $delivery Delivery identifier in URI format.
     * @param string $result Result identifier (by default same as delivery execution id).
     */
    public function getResultById($delivery, $result)
    {
        $this->response = $this->callApi('taoResultServer/QtiRestResults/getQtiResultXml', [
            'delivery' => $delivery,
            'result' => $result
        ], 'GET');

        return $this;
    }

    /*
     * Generate a LTI Launch URL for a valid delivery identifier
     *
     * Api endpoint [Get /ltiDeliveryProvider/DeliveryRestService/getUrl]
     */
    public function generateLtiLaunchUrl($deliveryId)
    {
        $this->response = $this->callApi('ltiDeliveryProvider/DeliveryRestService/getUrl', [
            'deliveryId' => $deliveryId,
        ], 'GET');

        return $this;
    }

    /**
     * Convert xml to Array
     *
     * @param $response
     * @return array
     */
    public function toArray()
    {
        return $this->xmlDecode((string) $this->response);
    }

    /**
     * Convert response to json
     *
     * @return \stdClass
     * @throws \Exception
     */
    public function toJson()
    {
        return $this->jsonDecode((string) $this->response);
    }

    /**
     * Convert response to xml
     *
     * @return string
     */
    public function toXml()
    {
        return $this->response;
    }

    /**
     * Call the API and return the results in a object
     *
     * @param $endpoint
     * @param string $api_version
     * @throws \Exception
     */
    protected function callApi($endpoint, $params)
    {
        try {

            $res = $this->client->request('GET', $this->config['api_url'] . '/' . $endpoint, [
                'query' => $params,
                'auth' => [$this->config['api_user'], $this->config['api_pass']]
            ]);

        } catch(\Exception $e)
        {
            return $e->getMessage();
        }

        if($res->getStatusCode() != 200)
        {
            throw new \Exception('Unable to fetch content!');
        }

        return ((string) $res->getBody());
    }

    /**
     * Convert json string to object
     *
     * @param $json
     * @param bool $assoc
     * @return \stdClass
     */
    protected function jsonDecode($json, $assoc = false)
    {
        $ret = json_decode($json, $assoc);

        if ($error = json_last_error())
        {
            $errorReference = [
                JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
                JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
                JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
                JSON_ERROR_SYNTAX => 'Syntax error.',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
                JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
                JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
                JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
            ];

            $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";

            throw new \Exception("JSON decode error ($error): $errStr");
        }

        return $ret;
    }

    /**
     * Convert xml string to array
     *
     * @param $xml
     * @return array
     */
    protected function xmlDecode()
    {
        $xml = simplexml_load_string($this->response, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return $this->jsonDecode($json, true);
    }
}