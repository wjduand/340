<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css"> 
    <!-- Script for the event handlers    -->
	<script type = "text/javascript"  src = "javas.js" > </script>	
</head>
<body>
  <script type="text/javascript" src="javas.js"></script>
  <?php include 'header.php'; ?>
  <?php include 'nav.php'; ?>
  <h3>Sign Up</h3>

<?php

  DEFINE ('DB_USER', 'cs340_duanyi');
  DEFINE ('DB_PASSWORD', '4333');
  DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
  DEFINE ('DB_NAME', 'cs340_duanyi');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $icon = $_POST['icon'];
    $match =0;
    if($password1 == $password2){
      echo "Password match!";
      $match = 1;
    }
    else if($password1!=$password2){
      echo "Password doesn't match!";
      $match=0;
    }
 
    if (!empty($email) && !empty($password1) && $match) {
      // Make sure someone isn't already registered using this email, password1=password2
       $sql = "SELECT * FROM Users WHERE Email = '$email'";
     
      $data = mysqli_query($dbc, $sql);
      if (mysqli_num_rows($data) == 0) {
        // The email is unique, so insert the data into the database
        $sql = "INSERT INTO `Users`(`Username`, `Password`, `Email`) VALUES('$username', '$password1', '$email');";
        mysqli_query($dbc, $sql);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to log in.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this email, so display an error message
        echo '<p class="error">An account already exists for this email. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data and check the password</p>';
    }

  }

  mysqli_close($dbc);
?>

  <p>Please enter your username and desired password to sign up for an account.</p>
  <form method="post" action="signup.php" onsubmit="return pswcheck()">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="email">Email:         </label>
      <input type="email" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
      <label for="password1">Password:      </label>
      <input type="password" id="password1" name="password1" placeholder= "8-16 characters"/><br />
      <label for="password2">Repeat password:</label>
      <input type="password" id="password2" name="password2" /><br />

      <input type="button" onclick="setusername();" value="Get Username"/>
      <input type="text" id="username" name="username" value=""/>

      <p>Your color is:</p>
      <input type="color" id="icon" name="icon" value="">
        	

    </fieldset>
    <input type="submit" value="Sign Up" name="submit"  />
  </form>
  <?php include 'footer.php'; ?>
</body> 
</html>