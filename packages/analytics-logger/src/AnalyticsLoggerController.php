<?php
namespace EONConsulting\AnalyticsLogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\AnalyticsLogger\AnalyticsLog as Log;

class AnalyticsLoggerController extends Controller
{
    private $request;
    private $log;

    protected function index(Request $request, Log $log)
    {
        $this->request = $request;
        $this->log = $log;

        $payload = $this->request->all();

        $this->log['payload'] = json_encode($payload);

        $this->log->save();
    }
}
