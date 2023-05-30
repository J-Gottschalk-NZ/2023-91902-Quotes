<?php

$subjects = array($subject1, $subject2, $subject3);
$subject_IDs = array();

// Retrieve subject IDs and update "no results" subjects
foreach ($subjects as $subject) {
    $subjectID = get_item_ID($dbconnect, 'all_subjects', 'Subject', $subject, 'Subject_ID');

    if ($subjectID === null && $subject == "no results") {
        // Insert the subject into the database
        $insertQuery = "INSERT INTO all_subjects (Subject) VALUES ('add to database')";
        $dbconnect->query($insertQuery);

        // Retrieve the auto-generated ID of the inserted subject
        $subjectID = $dbconnect->insert_id;
    }

    // Add the subject ID to the array
    $subject_IDs[] = $subjectID;
}

?>