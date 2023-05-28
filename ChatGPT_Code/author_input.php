<div class = "admin-form">

  <h1>Add a Quote</h1>
  
  <form action="index.php?page=../admin/quote_success" method="post">
  
  <p><input name="quote" placeholder="Quote (Required)" required/></p>
  
  <p><input name="first" placeholder="Author First Name"/></p>
  
  <!-- Chat GPT Code:
  Search for full author name based on first few letters of first name -->
  <script>
    const authorFirstInput = document.getElementById('first');
  
    // Listen for changes to the input field
    authorFirstInput.addEventListener('input', handleAuthorFirstInput);
  </script>
  
  
  <p><input name="middle" placeholder="Author Middle Name"/></p>
  <p><input name="last" placeholder="Author Last Name"/></p>
  
  <p><input name="subject1" placeholder="Subject 1 (Required)" required/></p>
  <p><input name="subject2" placeholder="Subject 2" /></p>
  <p><input name="subject3" placeholder="Subject 3" /></p>
  
  
  <p><input class="form-submit" type="submit" name="Submit Quote" value="Log In" /></p>
  
  
  </form>
  
  </div>