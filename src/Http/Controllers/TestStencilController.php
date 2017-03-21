<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\Graphs\Http\Controllers;


use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers;


class TestStencilController extends LTIBaseController {

    protected $hasLTI = false;

    public function test() {    



        $link = mysqli_connect("localhost", "root", "", "interactivegraph");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$code = mysqli_real_escape_string($link, $_REQUEST['textareaCode']);
$gname = mysqli_real_escape_string($link, $_REQUEST['graphName']);
// $school = mysqli_real_escape_string($link, $_REQUEST['school']);

// $programme = mysqli_real_escape_string($link, $_REQUEST['programme']);
// $location = mysqli_real_escape_string($link, $_REQUEST['location']);
// $notes = mysqli_real_escape_string($link, $_REQUEST['notes']);

// $profile_pic = mysqli_real_escape_string($link, $_REQUEST['profilepic']);
 
// attempt insert query execution





$sql = "INSERT INTO graphs (code,name) VALUES ('$code','$gname')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    return redirect()->back();

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
         return view('ph::lecturer');
    }

     public function tested() {
     //   echo 'test';
    	 return view('ph::goodbye');

    }
     public function testing() {
     //   echo 'test';
    	 return view('ph::lecturer');

    }

    public function insert() {

     //   echo 'test';



    }
}