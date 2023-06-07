<?php

// check user is logged on 
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))
{

// retrieve data from form and get Author / Subject IDs
// if author / subject don't exist, add them to the DB
include("process_form.php");

// insert quote
$stmt = $dbconnect -> prepare("INSERT INTO `quotes` (`Author_ID`, `Quote`, `Subject1_ID`, `Subject2_ID`, `Subject3_ID`) VALUES (?, ?, ?, ?, ?); ");
$stmt -> bind_param("isiii", $author_ID, $quote, $subject_ID_1, $subject_ID_2, $subject_ID_3);
$stmt -> execute();

$quote_ID = $dbconnect -> insert_id;

// Close stmt once everything has been inserted
$stmt -> close();


// Make heading blank here (it is set up in results.php)
$heading = "";
$heading_type = "quote_success";

// Retrieve quote and display it.
$sql_conditions = "WHERE ID = $quote_ID";

include("content/results.php");

} // end submit button pushed


} // end user logged on it

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}



?>