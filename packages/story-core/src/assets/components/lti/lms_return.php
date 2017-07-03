<?php

$message = '[None]';
if (isset($_GET['lti_msg'])) {
  $message = htmlentities($_GET['lti_msg']);
}
$error = '[None]';
if (isset($_GET['lti_errormsg'])) {
  $error = htmlentities($_GET['lti_errormsg']);
}
$log = '[None]';
if (isset($_GET['lti_log'])) {
  $log = htmlentities($_GET['lti_log']);
}
$log_error = '[None]';
if (isset($_GET['lti_errorlog'])) {
  $log_error = htmlentities($_GET['lti_errorlog']);
}

?>
<p>
Return from tool provider:
</p>
<ul>
  <li>message: "<?php echo $message; ?>"</li>
  <li>error message: "<?php echo $error; ?>"</li>
  <li>log message: "<?php echo $log; ?>"</li>
  <li>log error message: "<?php echo $log_error; ?>"</li>
</ul>
