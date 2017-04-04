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