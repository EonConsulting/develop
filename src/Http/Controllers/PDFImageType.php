<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/12/2017
 * Time: 2:18 PM
 */

namespace EONConsulting\ImgProcessor\Http\Controllers;


use App\Http\Controllers\Controller;
use EONConsulting\ImgProcessor\Http\Contracts\ImageInterface;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;
use Illuminate\Support\Facades\Storage;

class PDFImageType extends Controller implements ImageInterface
{
    /**
     * @var
     */
    protected $request;

    /**
     * PDFImageType constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function createImage($data)
    {
        if($this->request->session()->has('_token')) {
            $data = $this->request->get('data');
        }

        $client = Client::getInstance();
        $client->getEngine()->setPath(__DIR__ . '/bin/phantomjs.exe');
        $client->isLazy();
        $getClient = $client->getMessageFactory()->createPdfRequest($data);
        $response = $client->getMessageFactory()->createResponse();
        $getClient->setOutputFile(public_path() . '/vendor/imgprocessor/' . $this->request->session()->token(). 'pdf');
        $client->send($getClient, $response);

    }

    /**
     * @param $request
     * @return mixed|void
     */
    public function getImage($request)
    {
        return $this->createImage('http://www.unisa.ac.za');
    }

    /**
     * @return false|string
     */
    public function save_content()
    {
        $file_name = $this->request->user()->id . '_' . time() . '.' . 'html';
        $file = @fopen(public_path() . '/temp/storyline/' . $file_name, "w");
        fwrite($file, $this->request->get('content'));
        fclose($file);
        return response()->json(['success' => true, 'success_message' => 'Page saved.']);
    }

}