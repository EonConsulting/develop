<?php

namespace EONConsulting\CKEditorPluginV2\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use mPDF;
include_once "pdfcrowd.php";
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 3/15/2017
 * Time: 2:38 PM
 */
class CKEditorSaveController extends LTIBaseController {

    protected $hasLTI = false;
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    //.Parse Parameters

    public function update(Request $request) {

        $page = md5('eonunisafile');
        if(!$page) {
            return redirect()->back();
        }

        $ext = 'html';
        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
        $file = @fopen(public_path($file_name), "w");
        fwrite($file, "<html><body>");
        fwrite($file, $request->get('data'));
        fwrite($file, "</body></html>");
        fclose($file);


        return response()->json(['success' => true, 'success_message' => 'Page saved.' . $file_name]);

    }
    //Html to PDF - Print PDF from Supplied Data

    public function htmltoPDF($data = '') {
            //Init
        if($this->request->has('data')) {
            $data = $this->request->get('data');
        }else{
            return false;
        }

//        dd($data);
        //Generate the PDF
//        $pdf = PDF::loadHTML($data);
//        $pdf = App::make('dompdf.wrapper');
        $pdf = new \mPDF('');
        $pdf->debug = true;
        $data = urldecode($data);
//        dd($data);
        $dataobj = '<!DOCTYPE html>';
        $dataobj .= '<html>';
        $dataobj .= '<head>';
        $dataobj .= '<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG"></script>' ;
		$dataobj .= '</head>';
        $dataobj .= '<body>';
        $dataobj .= $data;
        $dataobj .= '</body>';
        $dataobj .= '</html>';

        $page = md5('eonunisafile');
        $ext = 'html';
        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
        $file = @fopen(public_path($file_name), "w");
        fwrite($file, $dataobj);
        fclose($file);

        $html = file_get_contents(public_path($file_name));

        preg_match('/<svg[^>]*>\s*(<defs.*?>.*?<\/defs>)\s*<\/svg>/',$html,$m);
        $defs = $m[1];
        $html = preg_replace('/<svg[^>]*>\s*<defs.*?<\/defs>\s*<\/svg>/','',$html);
        $html = preg_replace('/(<svg[^>]*>)/',"\\1".$defs,$html);
        preg_match_all('/<svg([^>]*)style="(.*?)"/',$html,$m);
        for ($i=0;$i<count($m[0]);$i++) {

            $style = $m[2][$i];

            preg_match('/width: (.*?);/', $style, $wr);

            $w = $pdf->ConvertSize($wr[1], 0, $pdf->FontSize) * $pdf->dpi / 25.4;

            preg_match('/height: (.*?);/', $style, $hr);

            $h = $pdf->ConvertSize($hr[1], 0, $pdf->FontSize) * $pdf->dpi / 25.4;

            $replace = '<svg' . $m[1][$i] . ' width="' . $w . '" height="' . $h . '" style="' . $m[2][$i] . '"';

            $html = str_replace($m[0][$i], $replace, $html);
        }

            $stylesheet = '

            /* This helps alignment for inline equations */

            img { vertical-align: middle; }

            /* This sets padding for display equations (but not in-line ones) */
            
            .MathJax_SVG_Display { padding: 1em 0; }
            
            /* This prevents the Create PDF button being reproduced in the PDF document */
            
            /* Use this method to suppress other parts of the web-page from displaying */
            
            #mpdf-create { display: none; }
            
            /* Add any other CSS styling here for the rest of the document */
            
            /* The CSS/stylesheet information from the original page is not accessible here */
            
            ';

            $pdf->WriteHTML($stylesheet,1);
            $pdf->WriteHTML($html);
            $pdf->Output();

            exit;

        }


        //return $pdf->stream('document.pdf');
        //Dom PDF Parser
//        $pdf      = PDF::loadHTML($dataobj);
//        $type = 'text/html';
//        return $pdf->download('file.pdf')->header('Content-Type', $type);


//        try {
//            //Create an API Client Instance [Put your CrowdPDF Username and API Key Here
//            $client = new \PdfCrowd("peacengara", "2115adcd9644460c636d12cb06876884");
//            $pdf = $client->convertHtml($dataobj);
////            $pdf = $client->convertURI('http://7643fa2e.ngrok.io/unisaappWamp/public/6b81a21e3c7e04d2e5eb0a8e52fada67-1490709780.html');
//            // set HTTP response headers
//            header("Content-Type: application/pdf");
//            header("Cache-Control: max-age=0");
//            header("Accept-Ranges: none");
//            header("Content-Disposition: attachment; filename=\"mydomain.pdf\"");
//            return $pdf;
//
//        }
//        catch(\PdfcrowdException $why)
//        {
//            echo "PDF Generation Error:" . $why;
//        }





}