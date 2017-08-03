<?php
$url = 'components/TAO/TAO_3.0.0_build/ltiDeliveryProvider/DeliveryTool/launch/eyJkZWxpdmVyeSI6Imh0dHA6XC9cL3VuaXNhdGVzdC5jbG91ZGFwcC5uZXRcL0ZCTjE1MDJcL2NvbXBvbmVudHNcL1RBT1wvVEFPXzMuMC4wX2J1aWxkXC9GQk4xNTAyLnJkZiNpMTQzNDcwNzk2ODczMTYxOSJ9';
$answers_url = '/pages/other-test-pages/tao_page/asnwers_version2.php';

$url = $_GET['url'];

//dont touch anything below this line
$assessment = 'http://unisatest.cloudapp.net/FBN1502/' . $url;
$answers_url = 'http://unisatest.cloudapp.net/FBN1502/' . WB_URL . $answers_url;

$pageid = 79;
//do not change the this line
//send the answers url to the over.tmpl file
echo '<script> localStorage.setItem("answer_url", "' . $answers_url . '");
localStorage.setItem("page_url", ' . $pageid . ');
</script>';

require 'http://unisatest.cloudapp.net/cw-econ/lti-inline/lti/lms.php?delivery_url=' . $url;
