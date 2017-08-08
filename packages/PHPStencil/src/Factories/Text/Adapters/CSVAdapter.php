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
 * Class CSVAdapter
 * @package EONConsulting\PHPStencil\src\Factories\Text\Adapters
 */
class CSVAdapter implements TextAdapterInterface {

    /**
     * Output the data in CSV file and download the file
     * @param $data
     */
    public function output($data) {
        // send the headers to return a file
        $this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");

        // enter the data
        echo $this->arrayToCsv($data, ',');
    }

    /**
     * Convert an array to CSV
     *
     * @param array $fields
     * @param string $delimiter
     * @param string $enclosure
     * @param bool $encloseAll
     * @param bool $nullToMysqlNull
     * @return string
     */
    function arrayToCsv( array $fields, $delimiter = ';', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false ) {
        $delimiter_esc = preg_quote($delimiter, '/');
        $enclosure_esc = preg_quote($enclosure, '/');

        $outputString = "";
        foreach($fields as $tempFields) {
            $output = array();
            foreach ( $tempFields as $field ) {
                // ADDITIONS BEGIN HERE
                if (gettype($field) == 'integer' || gettype($field) == 'double') {
                    $field = strval($field); // Change $field to string if it's a numeric type
                }
                // ADDITIONS END HERE
                if ($field === null && $nullToMysqlNull) {
                    $output[] = 'NULL';
                    continue;
                }

                // Enclose fields containing $delimiter, $enclosure or whitespace
                if ( $encloseAll || preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ) {
                    $field = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
                }
                $output[] = $field." ";
            }
            $outputString .= implode( $delimiter, $output )."\r\n";
        }
        return $outputString;
    }

    /**
     * Download the CSV file
     * @param $filename
     */
    function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}