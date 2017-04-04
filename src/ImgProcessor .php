<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:28 AM
 */

namespace EONConsulting\ImgProcessor;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use EONConsulting\ImgProcessor\Http\Controllers\ImgDetail;
use Symfony\Component\Process\Process;


class ImgProcessor {

    protected $image_detail;
    protected $pdf;

    public function __construct(Request $request) {

        $this->image_detail = new ImgDetail($request);

    }

    public function load() {

        $image_detail = $this->image_detail->html2PDF($data ='');
        $this->pdf = $this->captureImage($image_detail);
    }

    public function captureImage($image_detail) {

        $path = $this->writeFile($image_detail);
        $this->phantomProcess($path)->setTimeout(10)->mustRun();

    }

    public function writeFile($image_detail) {
//        $page = $page = md5(uniqid());
//        $ext = 'html';
//        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
//        $file = @fopen(public_path($file_name), "w");
//        fwrite($file, $dataobj);
//        fclose($file);$ext = 'html';
//        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
//        $file = @fopen(public_path($file_name), "w");
//        fwrite($file, $dataobj);
//        fclose($file);
        file_put_contents($path = public_path() . '\\' . md5(uniqid()) . '.pdf', $image_detail);

        return $path;
    }

    protected function phantomProcess($path) {
        $capture_resource = resource_path('assets\js\capture.js');

//        dd($capture_resource);
        return new Process('phantomjs.exe capture.js' . $path);

    }



}