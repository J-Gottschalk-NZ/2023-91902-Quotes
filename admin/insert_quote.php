<?php

if(isset($_REQUEST['submit']))
{

// get quote, author and subjects from from.

// We don't clean the data because we'll use a prepared statement to insert it into the database.

$quote = $_REQUEST['quote'];

$author_full = $_REQUEST['author_full'];
$subject1 = $_REQUEST['subject1'];
$subject2 = $_REQUEST['subject2'];
$subject3 = $_REQUEST['subject3'];

$first = "";
$middle = "";
$last = "";

// Initialise IDs
$subject_ID_1 = $subject_ID_2 = $subject_ID_3 = $author_ID = "";

// handle blank fields
if ($author_full == "") {
    $first = "Anonymous";
}

if ($subject2 == "") {
    $subject2 = "n/a";
}

if ($subject3 == "") {
    $subject3 = "n/a";
}

// check to see if subect / author is in DB, if it isn't add it.

$subjects = array($subject1, $subject2, $subject3);
$subject_IDs = array();

// prepare statement to insert subject/s
$stmt = $dbconnect -> prepare("INSERT INTO `all_subjects` (`Subject_ID`, `Subject`) VALUES (NULL, ?)");

// Retrieve subject IDs and update "no results" subjects
foreach ($subjects as $subject) {

    // query DB to see if subject already exists
    $subjectID = get_item_ID($dbconnect, 'all_subjects', 'Subject', $subject, 'Subject_ID');

    if ($subjectID === "no results") {
        // Insert the subject into the database if it does not exist (using prepared statement)      
        $stmt -> bind_param("s", $subject);
        $stmt -> execute();

        // Retrieve the auto-generated ID of the inserted subject
        $subjectID = $dbconnect->insert_id;
    }

    // Add the subject ID to the array
    $subject_IDs[] = $subjectID;
}

// retrieve subject ids
$subject_ID_1 = $subject_IDs[0];
$subject_ID_2 = $subject_IDs[1];
$subject_ID_3 = $subject_IDs[2];

// check to see if author exists
$find_author_id = "SELECT * FROM author a WHERE CONCAT(a.First, ' ', a.Middle, ' ', a.Last) LIKE '%$author_full%'";
$find_author_query = mysqli_query($dbconnect, $find_author_id);
$find_author_rs = mysqli_fetch_assoc($find_author_query);
$author_count = mysqli_num_rows($find_author_query);

// retrieve author ID if author exists
if ($author_count == 1) {
    $author_ID = $find_author_rs['Author_ID'];
}

// split author name into first, middle and last and add to DB
else {
    // split name if it is not blank
    if ($first != "Anonymous")
    {
    // Splitting the full name
    $names = explode(' ', $author_full);

    // check to see if we have a middle / last name

    // names has more than 1 item, split into first and last
    // ignore middle for now
    if(count($names) > 1) {
    $first = $names[0];
    $last = $names[count($names) - 1];}

    // names has one item, set this as first name 
    // (ie: no last name)
    elseif (count($names) == 1) {
        $first = $names[0];
        }

    // Check if a middle name exists
    if (count($names) > 2) {
        $middle = implode(' ', array_slice($names, 1, -1));
    } 
    }  // end splitting of author name

    $stmt = $dbconnect -> prepare("INSERT INTO `author` (`First`, `Middle`, `Last`) VALUES (?, ?, ?); ");
    $stmt -> bind_param("sss", $first, $middle, $last);
    $stmt -> execute();

    $author_ID = $dbconnect -> insert_id;

} // end author else (adding new author to DB)

// Once we have all the ID's we need, we can update the quote
$stmt = $dbconnect -> prepare("INSERT INTO `quotes` (`Author_ID`, `Quote`, `Subject1_ID`, `Subject2_ID`, `Subject3_ID`) VALUES (?, ?, ?, ?, ?); ");
$stmt -> bind_param("isiii", $author_ID, $quote, $subject_ID_1, $subject_ID_2, $subject_ID_3);
$stmt -> execute();

// get id of quote for success page!
$quote_ID = $dbconnect -> insert_id;

// Close stmt once everything has been inserted
$stmt -> close();

$heading = "Quote Success";
$sql_conditions = "WHERE ID = $quote_ID";

include("content/results.php");

} // end isset if

?>