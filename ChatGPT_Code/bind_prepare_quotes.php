<?php 
$quote = $_REQUEST['quote'];

$stmt = $dbconnect->prepare("INSERT INTO quotes (quote) VALUES (?)");
$stmt->bind_param("s", $quote);
$stmt->execute();
$stmt->close();

?>