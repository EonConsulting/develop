<?php

namespace EONConsulting\TaoClient\Services;

use EONConsulting\TaoClient\Exceptions\TaoOutcomeException;

use \Tsugi\OAuth\TrivialOAuthDataStore;
use \Tsugi\OAuth\OAuthServer;
use \Tsugi\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use \Tsugi\OAuth\OAuthSignatureMethod_HMAC_SHA256;
use \Tsugi\OAuth\OAuthRequest;
use \Tsugi\OAuth\OAuthUtil;

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

            $xml = $this->handleOAuthBodyPOST($oauth_consumer_key, $oauth_consumer_secret);

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

    /**
     * Make sure content-type header does not have x-form set
     *
     * @param $request_headers
     * @return bool
     */
    protected function validateContentType($request_headers)
    {
        return array_key_exists('Content-Type', $request_headers) && $request_headers['Content-Type'] == 'application/x-www-form-urlencoded';
    }

    /**
     * Make sure header has Auth key
     *
     * @param $request_headers
     * @return bool
     */
    protected function hasAuthHeader($request_headers)
    {
        return array_key_exists('Authorization', $request_headers) && @substr($request_headers['Authorization'], 0, 6) == "OAuth ";
    }

    /**
     * Split header into two parts
     *
     * @param $request_headers
     * @return array
     * @throws \Exception
     */
    protected function splitAuthHeader($request_headers)
    {
        if( ! $this->hasAuthHeader($request_headers))
        {
            throw new \Exception("Request does not have a oAuth header");
        }

        $header_parameters = OAuthUtil::split_header($request_headers['Authorization']);

        if( ! array_key_exists('oauth_body_hash', $header_parameters))
        {
            throw new \Exception("OAuth request body signing requires oauth_body_hash body");
        }

        $oauth_body_hash = $header_parameters['oauth_body_hash'];

        if( ! array_key_exists('oauth_signature_method', $header_parameters))
        {
            throw new \Exception("OAuth request body signing requires oauth_signature_method body");
        }

        $oauth_signature_method = $header_parameters['oauth_signature_method'];

        return [$oauth_body_hash, $oauth_signature_method];
    }

    /**
     * Validate hash
     *
     * @param $oauth_body_hash
     * @param $oauth_signature_method
     * @return bool|string
     */
    protected function validateHash($oauth_body_hash, $oauth_signature_method)
    {
        $postdata = file_get_contents('php://input');

        if ( $oauth_signature_method == 'HMAC-SHA256' )
        {
            $hash = base64_encode(hash('sha256', $postdata, TRUE));
        }

        $hash = base64_encode(sha1($postdata, TRUE));

        if ( $hash != $oauth_body_hash )
        {
            return false;
        }

        return $postdata;
    }

    /**
     * Handle to outcome post back
     *
     * @param $oauth_consumer_key
     * @param $oauth_consumer_secret
     * @return bool|string
     * @throws \Exception
     */
    protected function handleOAuthBodyPOST($oauth_consumer_key, $oauth_consumer_secret)
    {
        $request_headers = OAuthUtil::get_headers();

        if($this->validateContentType($request_headers))
        {
            throw new \Exception("OAuth request body signing must not use application/x-www-form-urlencoded");
        }

        list($oauth_body_hash, $oauth_signature_method) = $this->splitAuthHeader($request_headers);

        if ( ! $retval = $this->verifyKeyAndSecret($oauth_consumer_key, $oauth_consumer_secret))
        {
            throw new \Exception("OAuth signature failed: " . $retval[0]);
        }

        if( ! $postdata = $this->validateHash($oauth_body_hash, $oauth_signature_method))
        {
            throw new \Exception("OAuth oauth_body_hash mismatch");
        }

        return $postdata;
    }

    /**
     * Validate key and secret for oAuth
     *
     * @param $key
     * @param $secret
     * @param null $http_url
     * @param null $parameters
     * @param null $http_method
     * @return array|bool
     */
    protected function verifyKeyAndSecret($key, $secret, $http_url = NULL, $parameters = null, $http_method = NULL)
    {
        if ( ! ($key && $secret) )
        {
            return ["Missing key or secret", ""];
        }

        $store = new TrivialOAuthDataStore();
        $store->add_consumer($key, $secret);

        $server = new OAuthServer($store);

        $method = new OAuthSignatureMethod_HMAC_SHA1();
        $server->add_signature_method($method);

        $method = new OAuthSignatureMethod_HMAC_SHA256();
        $server->add_signature_method($method);

        $request = OAuthRequest::from_request($http_method, $http_url, $parameters);

        $LastOAuthBodyBaseString = $request->get_signature_base_string();

        try {
            $server->verify_request($request);
            return true;
        } catch (\Exception $e) {
            return [$e->getMessage(), $LastOAuthBodyBaseString];
        }
    }
}