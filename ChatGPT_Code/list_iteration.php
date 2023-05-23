<?php
$subject1 = "Math";
$subject2 = "Science";
$subject3 = "n/a";

$subjects = array($subject1, $subject2, $subject3);

echo "<ul>";
foreach ($subjects as $subject) {
  if ($subject != "n/a") {
    echo "<li>$subject</li>";
  }
}
echo "</ul>";
?>
