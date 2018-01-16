<?php

namespace EONConsulting\TaoClient\Services;

use Carbon\Carbon;

class TaoApiResponse
{
    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getSourcedId()
    {
        return array_get($this->response, 'context.@attributes.sourcedId');
    }

    public function getResultIdentifier()
    {
        return array_get($this->response, 'testResult.@attributes.identifier');
    }

    public function getResultDatestamp($as_string = false)
    {
        $datestamp = array_get($this->response, 'testResult.@attributes.datestamp');

        if($as_string == true)
        {
            return $datestamp;
        }

        return Carbon::parse($datestamp);
    }

    public function getOutcomeIdentifier()
    {
        $outcome = array_get($this->response, 'testResult.outcomeVariable');

        if( ! isset($outcome[0]))
        {
            return false;
        }

        return array_get($outcome[0], '@attributes.identifier');
    }

    public function getOutcomeIdentifierValue()
    {
        $outcome = array_get($this->response, 'testResult.outcomeVariable');

        if( ! isset($outcome[0]))
        {
            return false;
        }

        return array_get($outcome[0], 'value');
    }

    public function getLtiOutcomeValue()
    {
        $outcome = array_get($this->response, 'testResult.outcomeVariable');

        if( ! isset($outcome[1]))
        {
            return false;
        }

        return array_get($outcome[1], 'value');
    }



}