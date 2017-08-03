<?php
/*
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_score FROM wb_pages WHERE page_id = " . PAGE_ID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row['user_score'] == '' || $row['user_score'] == NULL){
		  include WB_URL . '/components/lti/lms.php?delivery_url=' . $url . '&page_id=' . PAGE_ID;
		} else {
		  if(isset($_GET['redo'])) {
			   include WB_URL . '/components/lti/lms.php?delivery_url=' . $url . '&page_id=' . PAGE_ID;
			} else {
		    include WB_URL . '/components/lti/tao_return.php?pageid=' . PAGE_ID;
			}
		}
	}
} else {
  echo "0 results";
}
*/

header("Location: lms.php?delivery_url=" . $_GET['delivery_url'] . "&height=" . $_GET['height']);
die();
