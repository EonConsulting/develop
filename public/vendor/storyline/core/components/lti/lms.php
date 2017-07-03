<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');
//include '../../config.php';
session_start();

define('WB_DOMAIN', 'https://unisaonline.net/');
?>
<html>
<head>
  <title>IMS Learning Tools Interoperability</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script>window.onload = function(){  document.forms['ltiLaunchForm'].submit()}</script>
</head>
<body style="font-family:sans-serif;">
<?php
require_once("util/lti_util.php");

  $cur_url = curPageURL();
  $key = trim($_REQUEST["key"]);
  if ( ! $key ) $key = "unisa";
  $secret = trim($_REQUEST["12345"]);
  if ( ! $secret ) $secret = "12345";
  $endpoint = trim($_REQUEST["endpoint"]);
  $b64 = base64_encode($key.":::".$secret);
  //the endpoint must be delivered on the page itself by appending ?delviery_url<variable url> onto the end of the included file in CMS
  if ( ! $endpoint ) $endpoint = WB_DOMAIN . $_GET['delivery_url'];
	$vheight = $_GET['height'];
  $cssurl = str_replace("lms.php","lms.css",$cur_url);
  $returl = str_replace("lms.php","lms_return.php",$cur_url);
  
  $lmsdata = array(
    "resource_link_id" => "120988f929-274612",
    "resource_link_title" => "Weekly Blog",
    "resource_link_description" => "A weekly blog.",
    "user_id" => "292832126",
    "roles" => "Learner",  // or Learner
    "lis_person_name_full" => 'Jane Q. Public',
    "lis_person_name_family" => 'Public',
    "lis_person_name_given" => 'Given',
    "lis_person_contact_email_primary" => "user@school.edu",
    "lis_person_sourcedid" => "school.edu:user",
    "context_id" => "456434513",
    "context_title" => "Design of Personal Environments",
    "context_label" => "SI182",
    "tool_consumer_info_product_family_code" => "ims",
    "tool_consumer_info_version" => "1.1",
    "tool_consumer_instance_guid" => "lmsng.school.edu",
    "tool_consumer_instance_description" => "UNISA",
    'launch_presentation_locale' => 'en-US',
    'launch_presentation_document_target' => 'frame',
    'launch_presentation_width' => '750px',
    'launch_presentation_height' => $vheight . 'px',
	'custom_skip_thankyou' => 'true',
	'custom_force_restart' => 'true',
    );
  $lmsdata['launch_presentation_css_url'] = $cssurl;

  foreach ($lmsdata as $k => $val ) {
      if ( isset($_POST[$k]) ) {
          $lmsdata[$k] = $_POST[$k];
      }
  }

  $custom = '';
  if ( isset($_POST['custom']) ) {
      $custom = $_POST['custom'];
  }

  $outcomes = trim($_REQUEST["outcomes"]);
  if ( ! $outcomes ) {
      $outcomes = str_replace("lms.php","common/tool_consumer_outcome.php",$cur_url);
	  $page_id = $_GET['page_id'];
	  //$outcomes = 'https://unisaonline.net/FBN1502/score_return.php?page_url=' . $page_id;
	  
	  //Send out page Id to unlock the next page
	   $form_url = WB_URL . '/page_referrer.php?page_url=' . $page_id;
	   //$form_url = 'https://unisaonline.net/FBN1502/page_referrer.php?page_url=' . $page_id;
	   // This is the data to POST to the form. The KEY of the array is the name of the field. The value is the value posted.
		$data_to_post['page_url'] = $_GET['page_id'];
		// Initialize cURL
		$curl = curl_init();
		// Set the options
		curl_setopt($curl,CURLOPT_URL, $form_url);
		// This sets the number of fields to post
		curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
		// This is the fields to post in the form of an array.
		curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
		//execute the post
		$result = curl_exec($curl);
		//close the connection
		curl_close($curl);
     //$outcomes .= "?b64=" . htmlentities($b64);
  }
  $tool_consumer_instance_guid = $lmsdata['tool_consumer_instance_guid'];
  $tool_consumer_instance_description = $lmsdata['tool_consumer_instance_description'];

  $parms = $lmsdata;
  // Cleanup parms before we sign
  foreach( $parms as $k => $val ) {
    if (strlen(trim($parms[$k]) ) < 1 ) {
       unset($parms[$k]);
    }
  }

  // Add oauth_callback to be compliant with the 1.0A spec
  $parms["oauth_callback"] = "about:blank";
  if ( $outcomes ) {
    $parms["lis_outcome_service_url"] = $outcomes;
    $parms["lis_result_sourcedid"] = "feb-123-456-2929::28883";
  }

  $parms['launch_presentation_return_url'] = WB_DOMAIN .  'cw-econ/components/lti/lms.php?delivery_url=' . $_GET['delivery_url'];

  $custom = explode("\n", $custom);
  foreach ($custom as $line) {
      $line = trim($line);
      if (strlen($line) > 0) {
          $entry = explode('=', $line, 2);
          $name = strtolower($entry[0]);
          $name = preg_replace('/[^a-z0-9]/', '_', $name);
          $value = '';
          if (count($entry) > 1) {
              $value = $entry[1];
          }
          $parms["custom_{$name}"] = $value;
      }
  }

  $parms = signParameters($parms, $endpoint, "POST", $key, $secret, $tool_consumer_instance_guid, $tool_consumer_instance_description);
  
  $content = postLaunchHTML($parms, $endpoint, " ", true,
     "width=\"750px\" height=\"" . $vheight . "px\" scrolling=\"yes\" frameborder=\"0\" transparency");
  print($content);