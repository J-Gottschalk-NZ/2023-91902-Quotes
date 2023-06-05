<?php 
$quote = $_REQUEST['quote'];

$stmt = $dbconnect->prepare("INSERT INTO quotes (id,quote) VALUES (?,?)");
$stmt->bind_param("is", $id, $quote);
$stmt->execute();

$stmt->bind_param("is", $id2, $quote2);
$stmt->execute();


$stmt->close();

$find_query = mysqli_query($dbconnect,"INSERT INTO QUOTES (quote) 
VALUES ('".$quote."');

?>