<?php

if(isset($_REQUEST['submit']))
{

// get quote, author and subjects from from.
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
}

// check to see if subect / author is in DB, if it isn't add it.

$subjects = array($subject1, $subject2, $subject3);
$subject_IDs = array();

// Retrieve subject IDs and update "no results" subjects
foreach ($subjects as $subject) {

    // query DB to see if subject already exists
    $subjectID = get_item_ID($dbconnect, 'all_subjects', 'Subject', $subject, 'Subject_ID');

    if ($subjectID === "no results") {
        // Insert the subject into the database if it does not exist
        $insertQuery = "INSERT INTO `all_subjects` (`Subject_ID`, `Subject`) VALUES (NULL, '$subject'); ";
        $dbconnect->query($insertQuery);

        // Retrieve the auto-generated ID of the inserted subject
        $subjectID = $dbconnect->insert_id;
    }

    // Add the subject ID to the array
    $subject_IDs[] = $subjectID;
}


echo "subject 1 ID".$subject_IDs[0]."<br />";
echo "subject 2 ID".$subject_IDs[1]."<br />";
echo "subject 3 ID".$subject_IDs[2]."<br />";


// printing area


} // end isset if

?>