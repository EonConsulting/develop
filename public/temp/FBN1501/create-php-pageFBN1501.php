
<?php

$servername = "localhost";
//$servername = "dev.unisaonline.net";
$port="3306";
$username = "root";
$password = "e@n~un^";
$dbname = "FBN1501";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 $sql = "SELECT page_id, content FROM wb_mod_wysiwyg WHERE content is not null or content !='' ";
 $result = $conn->query($sql) or die("can't execute querry");
 
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {

     $ext = 'html';
    
         $file_name = '10' . $row["page_id"] . '.' . $ext;

         $file = fopen($file_name, 'w') or die("can't open file: " . $file_name);

         //fwrite($file, "<html><body>") or die("can't write header to file: " . $file_name);

         fwrite($file, "<html><body>\xA" . $row["content"] . "\xA</body></html>") or die("can't write content to file: " . $file_name);
         //fwrite($file, "</body></html>") or die("can't write footer to file: " . $file_name);
         fclose($file) or die("can't close file: " . $file_name);

     }
 }
 else {
 	echo "0 results";
 }
  echo "files created: " . $result->num_rows . "\xA";
$conn->close();
echo "connection closed ";
?>

