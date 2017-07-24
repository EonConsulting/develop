<?php
/**
 * Created by PhpStorm.
 * User: Moshakes
 * Date: 7/21/2017
 * Time: 3:31 PM
 */

namespace EONConsulting\Storyline\Table;


Interface ReaderInterface{

    public function open($delimiter = null, $enclosure = null, $escape = null);

    public function close();

}