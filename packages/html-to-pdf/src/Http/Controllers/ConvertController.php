<?php

namespace EONConsulting\HtmlToPdf\Http\Controllers;

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

    /**
     * Receive html content and convert it to PDF
     *
     * @param \Illuminate\Http\Request $request
     * @return pdf|null
     */
    public function store(Request $request)
    {
        if( ! $content = $request->get('html_content'))
        {
            \Log::debug('Error printing PDF!');
            return response()->json(['message' => 'Error printing PDF!'], 500);
        }

        $pdf = new Pdf;

        $pdf->setOptions(
            config('html-to-pdf')
        );

        $html = view('html-to-pdf::pdf-template')->withContent(urldecode($content))->render();

        $pdf->addPage($html);

        $content = $pdf->send('storyline-item.pdf');

        if ($content === false)
        {
            \Log::debug($pdf->getError());
            return response()->json(['message' => $pdf->getError()], 500);
        }

        return response($content, 200)
            ->header('Set-Cookie', 'fileDownload=true; path=/');
    }
}