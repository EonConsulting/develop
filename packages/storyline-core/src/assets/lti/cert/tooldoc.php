<?php
session_start();

require "../common/header.php";
require_once("official.php");
?>
<h1>IMS LTI Tool Test Detail</h1>
<p>
This describes the tests which are used in the IMS
Learning Tools Interoperability Tool Tests.
</p><p>
<?    echo(gmDate("Y-m-d\TH:i:s\Z").' '); ?>
<br clear="all"/>
</p>
<?php

require_once("../util/lti_util.php");
require_once("cert_util.php");

// Print out the list
$idno = 100;
$count = 0;
$good = 0;

foreach($tool_tests as $test => $testinfo ) {
    echo("<p><b>\n");
    echo($test);
    echo(': ');
    echo($testinfo["doc"]."</b></p>\n");
    $extra = "";
    if ( array_key_exists('detail', $testinfo) ) {
        $extra = $extra . "<p>Detail:\n".$testinfo["detail"]. "</p>\n";
    }
    if ( array_key_exists('result', $testinfo) ) {
        $extra = $extra . "<p>Expected Result:\n".$testinfo["result"]. "</p>\n";
    }
    echo($extra);
  echo("<p>Actual Result: Pass / Fail</p>\n");
  echo("<p><b><i>Notes</i></b><br/>&nbsp;<br/></p>\n");
}
echo("</table>\n");
include "../common/footer.php";
?>
