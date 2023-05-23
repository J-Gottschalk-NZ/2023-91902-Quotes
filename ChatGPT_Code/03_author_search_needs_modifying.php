<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$author_first = $_GET['first'];

// Search the database for authors with matching first name
$sql = "SELECT * FROM authors WHERE author_first LIKE '%$author_first%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // For simplicity, just use first matching author
  $author = $result->fetch_assoc();
  $response = array('author' => array(
    'first' => $author['author_first'],
    'middle' => $author['author_middle'],
    'last' => $author['author_last'],
  ));
  echo json_encode($response);
} else {
  echo json_encode(array());
}

$conn->close();
?>
