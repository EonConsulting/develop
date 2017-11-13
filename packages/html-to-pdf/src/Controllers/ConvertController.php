<?php

namespace EONConsulting\HtmlToPdf\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;

class ConvertController extends Controller
{
    /**
     * ConvertController constructor.
     *
     * Disable debugbar when generatoring PDF files
     */
    public function __construct()
    {
        \Debugbar::disable();
    }

    public function store(Request $request)
    {
        if( ! $content = $request->get('html_content'))
        {
            return null;
        }

        $pdf = new Pdf;

        $pdf->setOptions(
            config('html-to-pdf')
        );

        $html = view('html-to-pdf::pdf-template')->withContent(urldecode($content))->render();

        $pdf->addPage($html);

        return $pdf->send('store.pdf');
    }
}