<?php
	session_start();
	include 'connectvar.php';
	function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$co = "#";
	if ((isset($_POST['email'])) && (isset($_POST['password'])) ){
		
	
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		if (!$dbc) {
			die('Could not connect');
		}
	
		$query = "SELECT * FROM Users WHERE Email='$email' and Password='$password'";
		$result = mysqli_query($dbc, $query);
	
		if (mysqli_num_rows($result) == 1) {
	
			// The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
			  $row = mysqli_fetch_array($result);
			  $_SESSION['valid_email'] = $row['Email'];
			  $_SESSION['username'] = $row['Username'];
			  $usname = $row['Username'];
			  $_SESSION['color'] = "$co$usname";
			  setcookie("valid_email", $row['Email'], time() + 3600, "/");    // expires in 30 days
		      setcookie("username", $row['Username'], time() + 3600, "/");  // expires in 30 days
		      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php?email='.$email;
		header('Location: ' . $home_url); 
			}
		else {
          // The username/password are incorrect so set an error message
			echo "Sorry, you must enter a valid email and password to log in.";
		}

		mysqli_free_result($result);
		mysqli_close($dbc);

	
}


?>
<!DOCTYPE html>
<head>
	<title>lOG IN</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<script type = "text/JavaScript" src = "javas.js"> </script>	
</head>
<body>
	<?php include 'header.php'; ?>
	<?php include 'nav.php'; ?>
<h1> Log in Page </h1>

<?php
if(!isset($_SESSION['valid_email']))
{
	echo "<form method='post' action='login.php' > ";
	echo "<fieldset>";
	echo "<legend>Log in</legend>";
	echo "<label for='email'>Email </label>";
	echo "<input type='text' id ='email' name='email'  size = '30' onblur = 'checkemail(this.value)' /> <br />";  
	echo "<label for='password'> Password </label>";
	echo "<input type='password' id = 'password' name='password'  size = '30' /> <br />";
	echo "<input type='submit' value='Log In' name='submit' />";
	echo "<input type='reset' value='Reset'><br>";
	echo "</fieldset>";
    echo "</form>";
}
if(isset($_SESSION['valid_email']))
{
	echo " <h3> You are logged in as </h3><p> User: ".$_SESSION['username']; 
	echo "<p> <a href='logout.php'>Log out </a><br />";
}


?>
	<a href="signup.php">Sign Up Section </a>

	<?php include 'footer.php'; ?>
</body>
</html>	