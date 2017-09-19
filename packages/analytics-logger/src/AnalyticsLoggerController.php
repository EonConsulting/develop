<?php
namespace EONConsulting\AnalyticsLogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\AnalyticsLogger\AnalyticsLog as Logger;

class AnalyticsLoggerController extends Controller
{
    private $request;
    private $logger;

    public function __construct(Request $request, Logger $logger)
    {
        $this->request = $request;
        $this->logger = $logger;
    }

    public function store(Request $request)
    {
        $this->request = $request;
        $payload = $this->request->all();

        $this->logger['payload'] = json_encode($payload);

        $this->logger->save();
    }
}
