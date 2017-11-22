<?php

namespace EONConsulting\AnalyticsLogger;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\AnalyticsLogger\Models\AnalyticsLog as Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalyticsLoggerController extends Controller {

    private $request;
    private $logger;

    public function __construct(Request $request, Logger $logger) {
        $this->request = $request;
        $this->logger = $logger;
    }

    public function store() {
        // get the request
        $payload = $this->request->all();
        // set values for payload
        $payload_json = json_encode($payload);
        $this->logger['payload'] = $payload_json;
        // get the user_id
        if ($payload) {
            $mailto = $payload["actor"]["mbox"];
            // XAPI spec appends mailto: before mailbox addy
            $email = str_replace("mailto:", "", $mailto);
            $user = User::where('email', $email)->first();
            $this->logger['user_id'] = $user->id;

            // save
            $this->logger->save();
        } else {
            Log::error("Unable to decode XAPI packet");
        }
    }

}
