<?php

namespace EONConsulting\Core\Services;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Log;

class HttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /*
     * Amount of time allowed for the client to run before timing out
     *
     * @var $timeout
     */
    protected $timeout = 360;

    /*
     * Connection Timeout
     *
     * @var $connection_timeout
     */
    protected $connection_timeout = 360;

    /*
     * Store the options for each request sent
     *
     * @var array
     */
    protected $request_options = [];

    /**
     * HttpClient constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;

        $this->setRequestOptions(['timeout' => $this->timeout]);
    }

    /*
     * Helper function to download file into a temp file and return the content
     *
     * @return string
     */
    public function download($url)
    {
        $response = $this->run($url, 'GET');

        return $response->getBody();
    }

    /*
     * Helper method to get the content of a url
     *
     * @return string
     */
    public function get($url, $params = [])
    {
        $this->setRequestOptions($params);

        return $this->run($url, 'GET', $params)->getBody();
    }

    /*
     * Helper method to post to get the content of a url
     *
     * @return string
     */
    public function post($url, $params = [])
    {
        $this->setRequestOptions($params);

        return $this->run($url, 'POST')->getBody();
    }
    
    /*
     * Helper method to put to a url
     *
     * @return string
     */
    public function put($url, $params = [])
    {
        $this->setRequestOptions($params);

        return $this->run($url, 'PUT')->getBody();
    }



    /**
     * Run the request
     *
     * @param \GuzzleHttp\Psr7\Request $request
     * @return bool|string
     * @throws \Exception
     */
    protected function run($url, $method = 'GET')
    {
        try {

             $response = $this->client->request($method, $url, $this->getRequestOptions());

        } catch (RequestException $e) {

            Log::debug($e->getMessage() . " URL: [{$url}]");

            throw new \Exception($e->getMessage());

            if ($e->hasResponse())
            {
                Log::debug(Psr7\str($e->getResponse()) . " URL: [{$url}]");

                throw new Exception(Psr7\str($e->getResponse()));
            }

        } catch (\Exception $e) {

            Log::debug(Psr7\str($e->getMessage() . " URL: [{$url}]"));

            throw new Exception($e->getMessage());
        }

        if($response->getStatusCode() != 200)
        {
            Log::debug("Failed with status code [{$response->getStatusCode()} with reason [{$response->getReasonPhrase()}] URL: [{$url}]");

            throw new Exception("Failed with status code [{$response->getStatusCode()} with reason [{$response->getReasonPhrase()}]");
        }

        return $response;
    }

    /**
     * Enable debugging
     *
     * @return $this
     */
    public function enableDebug()
    {
        $this->setRequestOptions(['debug' => true]);
        return $this;
    }

    /**
     * Get the timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set the timeout
     *
     * @param int $timeout
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Get the connection timeout
     *
     * @return int
     */
    public function getConnectionTimeout()
    {
        return $this->connection_timeout;
    }

    /**
     * Set the connection timeout
     *
     * @param int $connection_timeout
     */
    public function setConnectionTimeout(int $connection_timeout)
    {
        $this->connection_timeout = $connection_timeout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestOptions()
    {
        return $this->request_options;
    }

    /**
     * @param mixed $request_options
     */
    public function setRequestOptions($request_options)
    {
        $this->request_options = array_merge($this->request_options, $request_options);
        return $this;
    }
}