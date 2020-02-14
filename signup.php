<?php
require "header.php";
?>

<main>
  <div class="Wrapper-main">
  <section class="section-default">
  
  <h1>Signup</h1>


  <?php

  if (isset($_GET['error'])) {

 if ($_GET['error'] == "emptyfields") {


  echo '<p>Fill in all fields!</p>';


 }

 else if ($_GET['error'] == "invaliduidmail") {

  echo '<p>Invalid username and E-mail!</p>';

}

else if ($_GET['error'] == "invaliduid") {

  echo '<p>Invalid username!</p>';

}
  
else if ($_GET['error'] == "invalidmail") {

  echo '<p>Invalid E-mail!</p>';

}

else if ($_GET['error'] == "passwordcheck") {

  echo '<p>Your passwords do not match!</p>';

}

else if ($_GET['error'] == "usertaken") {

  echo '<p>Username is already taken!</p>';

 }






}

if (isset($_GET['signup'])) {


  if ($_GET['signup'] == "success") 

  echo '<p>signup successful!</p>';

}



  ?>
  
  <form action="includes/signup.inc.php" method="post">
  
  <input type="text" name="uid" placeholder="Username">
  <input type="text" name="mail" placeholder="E-mail">
  <input type="Password" name="pwd" placeholder="Password">
  <input type="Password" name="pwd-repeat" placeholder="Repeat password">
  <button type="submit" name="signup-submit">Signup</button>

  </form>
  
  
  </section>

  </div>

  </main>

<?php
require "footer.php";
?>
