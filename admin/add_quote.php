<?php

// check user is logged on 
if (isset($_SESSION['admin'])) {

// get all subjects from database
$all_tags_sql = "SELECT * FROM all_subjects ORDER BY Subject ASC ";
$all_subjects = autocomplete_list($dbconnect, $all_tags_sql, 'Subject');

// initialise subject variables
$tag_1 = "";
$tag_2 = "";
$tag_3 = "";

// initialise tag ID's
$tag_1_ID = $tag_2_ID = $tag_3_ID = 0;

?>

<div class = "admin-form">

<h1>Add a Quote</h1>

<form action="index.php?page=../admin/quote_success" method="post" autocomplete="off">

<p><textarea name="quote" placeholder="Quote (Required)" required></textarea></p>

<p><input name="author" placeholder="Author Name (First Middle Last)"/></p>

<p><input name="middle" placeholder="Author Middle Name"/></p>
<p><input name="last" placeholder="Author Last Name"/></p>


<div class="autocomplete">
        <input class="add-field" id="subject1" type="text" name="Subject_1"  placeholder="Subject 1(Start Typing)...">
    </div>

<p><input name="subject2" placeholder="Subject 2" /></p>
<p><input name="subject3" placeholder="Subject 3" /></p>


<p><input class="form-submit" type="submit" name="Submit Quote" value="Log In" /></p>


</form>

<script>
<?php include("autocomplete.php"); ?>  

/* Arrays containing lists. */
var all_tags = <?php print("$all_subjects"); ?>;
autocomplete(document.getElementById("subject1"), all_tags);
// autocomplete(document.getElementById("subject2"), all_tags);
// autocomplete(document.getElementById("subject3"), all_tags);
</script> 

</div>

<?php
    } // end user logged on if

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>