<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/02/12
 * Time: 12:28 AM
 * I wrote this plugin specifically for Math and Iframes Support,
 * Most Common PDF Writers can not output Math and Iframes
 * Use it the way you wish ..
 */

namespace EONConsulting\ImgProcessor;
use EONConsulting\ImgProcessor\Http\Controllers\ImgDetail;
use JonnyW\PhantomJs\Client;

/**
 * Class ImgProcessor
 * @package EONConsulting\ImgProcessor
 */
class ImgProcessor extends ImgDetail{
    /**
     * @var
     */
    protected $newImgRequest;

    public function load_process_image() {
        //dd($this->get_process_image());
        $client = Client::getInstance();
        $client->getEngine()->setPath(__DIR__ . '/bin/phantomjs.exe');
        $client->isLazy();
        $request  = $client->getMessageFactory()->createPdfRequest("http://localhost:8000");
        $response = $client->getMessageFactory()->createResponse();
        $request->setOutputFile(public_path() . '/vendor/imgprocessor/3.pdf');
        $client->send($request, $response);
    }

    //Todo:: Abstract the Function

    public function generatePDF() {}
    public function captureScreen() {}

    public function tmp_processor_route_gen() {
        //Save to a temporary file and access as route
    }

    //Todo: Write Tests

//    protected function write_to_image($request, $file = '') {
//        $request->setOutputFile($file);
//    }

}
