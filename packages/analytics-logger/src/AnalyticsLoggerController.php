<?php
namespace EONConsulting\AnalyticsLogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsLoggerController extends Controller
{
    private $request;

    protected function index(Request $request)
    {
        $this->request = $request;

        dd('Response is: '. $this->request->all());
    }
}
