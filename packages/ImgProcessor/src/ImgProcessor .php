<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/02/12
 * Time: 12:28 AM
 * I wrote this plugin specifically for Math and Iframes Support,
 * Most Common PDF Writers can not output Math and Iframes
 * *************************************************************
 */

namespace EONConsulting\ImgProcessor;
use App\Http\Controllers\Controller;
use EONConsulting\ImgProcessor\Http\Controllers\PDFImageType;

/**
 * Class ImgProcessor
 * @package EONConsulting\ImgProcessor
 */
class ImgProcessor extends Controller {
    /**
     * @var
     */
    protected $path;

    /**
     * @param PDFImageType $pdfImage
     * @return false|string
     */
    public function init(PDFImageType $pdfImage) {
        $this->path = $pdfImage->save_content();
        return $this->path;
    }

}
