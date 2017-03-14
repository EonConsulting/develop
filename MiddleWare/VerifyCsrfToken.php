<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'launchUrlEditor', 'launchUrlEditor/*',
        'postUrlEditor', 'postUrlEditor/*',
        'listDomains', 'listDomains/*',
        'ltiCKEditor', 'ltiCKEditor',
        'ckeditorstore', 'ckeditorstore',
        'getEditorView', 'getEditorView',
        'ckresponse', 'ckresponse',
        'connection', 'connection',
        'ajresponse', 'ajresponse',
        'xmltransport', 'xmltransport',
        'launchtransport', 'launchtransport'
    ];
}
