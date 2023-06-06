
<?php
// check user is logged on 
if (isset($_SESSION['admin'])) {

// retrieve subjects and authors to populate combo box
include("sub_author.php");

 ?>

<div class = "admin-form">
    <h1>Add a Quote</h1>

    <form action="index.php?page=../admin/insert_quote" method="post">
        <p>
            <textarea name="quote" placeholder="Quote (Required)" required></textarea>
        </p>

        <div class="autocomplete">
            <p><input name="author_full" id="author_full"  placeholder="Author Name (First Middle Last)"/></p>
        </div>

        <div class="autocomplete">
            <input name="subject1" id="subject1" placeholder="Subject 1 (reqiured)" required />
        </div>

        <br /><br />

        <div class="autocomplete">
            <input name="subject2" id="subject2" placeholder="Subject 2" />
        </div>

        <br /><br />

        <div class="autocomplete">
            <input name="subject3" id="subject3" placeholder="Subject 3" />
        </div>

        <br /><br />

        <p><input class="form-submit" type="submit" name="submit" value="Submit Quote" /></p>

    </form>


    <script>
        <?php include("autocomplete.php"); ?>  

        <?php include("list_arrays.php"); ?>
      
    </script>

</div>

<?php 
    } // end user logged on it

    else {
        $login_error = 'Please login to access this page';
        header("Location: index.php?page=../admin/login&error=$login_error");
    }
?>