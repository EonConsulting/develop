<?php

namespace EONConsulting\TaoClient\Services;

use Tsugi\Util\LTI;
use EONConsulting\TaoClient\Exceptions\TaoOutcomeException;

class TaoOutcome
{
    /**
     * Hold the response from tao
     *
     * @var $response
     */
    protected $response;

    /**
     * Static method to allow access without having to instantiate class
     *
     * @return \EONConsulting\TaoClient\Services\TaoOutcome
     */
    static public function handle()
    {
        return (new static)->doRequest();
    }

    /**
     * Get the reply from tao's outcome call
     *
     * @return $this
     * @throws \EONConsulting\TaoClient\Exceptions\TaoOutcomeException
     */
    public function doRequest()
    {
        $oauth_consumer_key = config('tao-client.launch-options.key');
        $oauth_consumer_secret = config('tao-client.launch-options.secret');

        try {

            $xml = LTI::handleOAuthBodyPOST($oauth_consumer_key, $oauth_consumer_secret);

        } catch(\Exception $e)
        {
            throw new TaoOutcomeException($e->getMessage());
        }

        $this->response = $this->xmlDecode($xml);
        return $this;
    }

    /**
     * Convert xml string to array
     *
     * @param $xml
     * @return array
     */
    protected function xmlDecode($xml)
    {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json, true);
    }

    /**
     * Get the complete response array
     *
     * @return mixed
     */
    public function get()
    {
        return $this->response;
    }

    /**
     * Get the source id from the response array
     *
     * @return string
     */
    public function getSourcedId()
    {
        return array_get($this->response, 'imsx_POXBody.replaceResultRequest.resultRecord.sourcedGUID.sourcedId');
    }

    /**
     * Get the result from the response array
     *
     * @return string
     */
    public function getResult()
    {
        return array_get($this->response, 'imsx_POXBody.replaceResultRequest.resultRecord.result.resultScore.textString');
    }
}