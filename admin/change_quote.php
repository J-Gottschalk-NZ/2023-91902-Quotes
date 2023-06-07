<?php

// check user is logged on 
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))
{

// retrieve quote and author ID from form
// check they are integers (in case someone edits the URL)
$quote_ID = filter_var($_REQUEST['ID'], FILTER_SANITIZE_NUMBER_INT);
$old_author = filter_var($_REQUEST['authorID'], FILTER_SANITIZE_NUMBER_INT);
    
// retrieve data from form and get Author / Subject IDs
// if author / subject don't exist, add them to the DB
include("process_form.php");

// delete author if there are no quotes associated 
// with that author!
if ($old_author != $author_ID) {
    delete_ghost($dbconnect, $old_author);
} // end check author changed

// update quote
$stmt = $dbconnect -> prepare("UPDATE `quotes` SET `Author_ID` = ?, `Quote` = ?, `Subject1_ID` = ?, `Subject2_ID` = ?, `Subject3_ID` = ? WHERE `ID` = ?;");
$stmt -> bind_param("isiiii", $author_ID, $quote, $subject_ID_1, $subject_ID_2, $subject_ID_3, $quote_ID);
$stmt -> execute();

// Close stmt once everything has been updated
$stmt -> close();

// Set up blank heading and heading type
// Heading added in 'results.php'
$heading = "";
$heading_type = "edit_success";

// retrieve quote and display it
$sql_conditions = "WHERE ID = $quote_ID";

include("content/results.php");

} // end submit button pushed


} // end user logged on it

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}



?>