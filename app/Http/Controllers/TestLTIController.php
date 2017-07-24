<?php

namespace App\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;

class TestLTIController extends LTIBaseController {

    protected $hasLTI = true;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = laravel_lti()->get_domains();
        dd($domains);
//        return view('eon.appstore::store', ['tools' => $domains]);
    }
}
