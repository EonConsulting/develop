<?php
namespace EONConsulting\AnalyticsLogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\AnalyticsLogger\AnalyticsLog as Logger;

class AnalyticsLoggerController extends Controller
{
    private $request;
    private $logger;

    protected function index(Request $request, Logger $logger)
    {
        $this->request = $request;
        $this->logger = $logger;

        $payload = $this->request->all();

        $this->logger['payload'] = json_encode($payload);

        $this->logger->save();
    }
}
