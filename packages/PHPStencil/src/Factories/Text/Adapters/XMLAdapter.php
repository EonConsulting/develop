<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:11 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\Text\Adapters;

use EONConsulting\PHPStencil\src\Factories\Text\TextAdapterInterface;

/**
 * Class XMLAdapter
 * @package EONConsulting\PHPStencil\src\Factories\Text\Adapters
 */
class XMLAdapter implements TextAdapterInterface {

    /**
     * Output the data in XML
     * @param $data
     * @return string
     */
    public function output($data) {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data></data>');
        $this->arrayToXml($data, $xml);
        return htmlentities($xml->asXML());
    }

    /**
     * Convert the array into XML.
     * @param $data
     * @param $xml_data
     */
    function arrayToXml( $data, &$xml_data) {
        foreach( $data as $key => $value ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

}