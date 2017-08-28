<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/12/2017
 * Time: 2:18 PM
 */

namespace EONConsulting\ImgProcessor\Http\Controllers;


use App\Http\Controllers\Controller;
use EONConsulting\ImgProcessor\Classes\PDFImageType;
use EONConsulting\ImgProcessor\Http\Contracts\ImageInterface;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function process(PDFImageType $type, Request $request) {
        $data = $request->get('data');
        $type->stream($data, 'https://dev.unisaonline.net/e-content');
    }
}