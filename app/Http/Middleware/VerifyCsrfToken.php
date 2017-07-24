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
        '/eon/lti/*', '/eon/*', '/lti/*', '/lti', '/html2PDF', '/getEditorView', 'ajaxresponse', 'login', 'mindmap', 'savetodatabase', '/ajaxresponse/*', '/lecturer',
        '/launchtransport/', '/xmltransport/', '/img-processor/*', '/img-processor','/lecturer/courses*','/lecturer*'
    ];
}
