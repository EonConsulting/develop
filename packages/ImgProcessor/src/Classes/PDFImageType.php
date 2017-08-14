<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/12/2017
 * Time: 2:18 PM
 */

namespace EONConsulting\ImgProcessor\Classes;

use Dropbox\Exception;
use EONConsulting\ImgProcessor\Http\Contracts\ImageInterface;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;

class PDFImageType implements ImageInterface
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $data;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function createImage($data, $default = null)
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(__DIR__ . '/bin/phantomjs.exe');
        $client->isLazy();
        $getClient = $client->getMessageFactory()->createPdfRequest($data);
        $response = $client->getMessageFactory()->createResponse();
        $getClient->setOutputFile(public_path() . '/vendor/imgprocessor/' . $this->request->session()->token(). 'pdf');
        $client->send($getClient, $response);

    }

    /**
     * @return false|string
     */
    public function stream($data, $default = null)
    {
        $this->data = $data;
        $this->image_creation_check();
            if(file_exists(public_path() . '/vendor/imgprocessor/' . $this->request->session()->token(). 'pdf')) {
                try {
                    $file = @fopen(public_path() . '/vendor/imgprocessor/' . $this->request->session()->token() . 'pdf', 'r');
                    $this->stream($file);
                } catch (Exception $e) {
                    die('Streaming Failed');
                }
            }
    }

    protected function image_creation_check() {
        if(!$this->createImage($this->data, 'https:dev.unisaonline.net')) {
            throw new \Exception('Could Not Create Image');
        }
    }

}