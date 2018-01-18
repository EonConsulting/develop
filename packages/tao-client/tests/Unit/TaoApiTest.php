<?php

namespace EONConsulting\TaoClient\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EONConsulting\TaoClient\Services\TaoApi;

use GuzzleHttp\Psr7\Response;

class TaoApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var \GuzzleHttp\Handler\MockHandler
     */
    protected $handler;

    /**
     * @var \EONConsulting\TaoClient\Services\TaoApi
     */
    protected $tao_api;

    function setUp()
    {
        parent::setUp();

        $this->handler = new \GuzzleHttp\Handler\MockHandler();

        $client = new \GuzzleHttp\Client([
            'handler' => \GuzzleHttp\HandlerStack::create($this->handler)
        ]);

        $this->tao_api = new TaoApi($client, config('tao-client'));
    }

    /** @test */
    function it_can_get_the_results_for_a_completed_test_in_xml()
    {
        $content = $this->generateContent();

        $response = $this->tao_api->getLatestResults('fake-uri', 'fake-uri');

        $this->assertEquals($content, $response->toXml());
    }

    /** @test */
    function it_can_get_the_context_sourced_id()
    {
        $response = $this->generateLatestResultsResponseObject();

        $this->assertEquals('i1472806961552868263', $response->getSourcedId());
    }

    /** @test */
    function it_can_get_the_test_result_identifier()
    {
        $response = $this->generateLatestResultsResponseObject();

        $this->assertEquals('rdf#i1513600990615370344', $response->getResultIdentifier());
    }

    /** @test */
    function it_can_get_the_test_result_datestamp_as_string()
    {
        $response = $this->generateLatestResultsResponseObject();

        $datestamp = $response->getResultDatestamp(true);

        $this->assertEquals('2017-12-18T12:43:29.772', $datestamp);
    }

    /** @test */
    function it_can_get_the_test_result_datestamp_as_date_object()
    {
        $response = $this->generateLatestResultsResponseObject();

        $datestamp = $response->getResultDatestamp();

        $this->assertEquals('2017-12-18 12:43:29', $datestamp->format('Y-m-d h:i:s'));
    }

    /** @test */
    function it_can_get_the_outcome_identifier()
    {
        $response = $this->generateLatestResultsResponseObject();

        $this->assertEquals('SECTION_EXIT_CODE_assessmentSection-1', $response->getOutcomeIdentifier());
    }

    /** @test */
    function it_can_get_the_outcome_identifier_value()
    {
        $response = $this->generateLatestResultsResponseObject();

        $this->assertEquals('700', $response->getOutcomeIdentifierValue());
    }

    /** @test */
    function it_can_get_the_lti_outcome_value()
    {
        $response = $this->generateLatestResultsResponseObject();

        $this->assertEquals('0.6', $response->getLtiOutcomeValue());
    }



    protected function generateContent()
    {
        $content = implode("\n", file(__DIR__ . '/../Mock/getLatest.xml'));

        $this->handler->append(new Response(200, ['Content-Type' => 'application/xml'], $content));

        return $content;
    }

    protected function generateLatestResultsResponseObject()
    {
        $this->generateContent();

        $response = $this->tao_api->getLatestResults('fake-uri', 'fake-uri')
            ->toObject();

        return $response;
    }

}