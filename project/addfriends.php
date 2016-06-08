<?php
 session_start();
 DEFINE ('DB_USER', 'cs340_duanyi');
 DEFINE ('DB_PASSWORD', '4333');
 DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
 DEFINE ('DB_NAME', 'cs340_duanyi');
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $email = $_SESSION['valid_email'];
 $user = $_SESSION['username'];
 $friendemail = $_POST['friendemail'];
 $query1 = "SELECT * FROM Relationship";
 $res1 = mysqli_query($dbc, $query1);
 $rowsnum = mysqli_num_rows($res1);
 $relationshipid = $rowsnum+1;
 $query2 = "SELECT Username FROM `Users` WHERE Email = '$friendemail';";
 $res2 = mysqli_query($dbc, $query2);
 #$query3 = "SELECT DISTINCT R1.relationshipID FROM Relationship R1, Relationship R2 
 #WHERE R1.userEmail1 = '$friendemail' OR R1.userEmail2 = '$friendemail' 
 #AND R2.userEmail1 = '$email' OR R2.userEmail2 = '$email' AND R1.relationshipID = R2.relationshipID;";
 #$res3 = mysqli_query($dbc, $query3);
?>
<!DOCTYPE html>
<head>
	<title>Add Friends</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body> 
	 <?php include 'header.php'; ?>
     <?php include 'nav.php'; ?>

     <?php 
    	echo "<form method='post' action='addfriends.php'>";	
    	echo "<div>";
    	echo "Input Friend's Email:";
    	echo "</div>";
    	echo "<input type='text' class='postbutton' name ='friendemail'/><br/><br/>";
	    echo "<input type='submit' class='postbutton' value='Add' name='submit'/><br/><br/>";
	    echo "</form>";
	
	?>
 
 <?php
 include 'connectvar.php'; 
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = $_POST['table'];
	if(isset($friendemail)){
		if(!(mysqli_num_rows($res2))){
			echo '<p class="error">The email is not validate, please input correct email.</p>';
			
		}
		else {
			if($friendemail == $email)
				echo '<p class="error">You cannot add yourself as friend~</p>';
			else{
				#if(!(mysqli_num_rows($res3))){
					$query = "INSERT INTO `Relationship`(`relationshipID`, `userEmail1`, `userEmail2`) 
					VALUES ('$relationshipid', '$email', '$friendemail');";
					$result = mysqli_query($conn, $query);
					if (!$result) {
						die("Query to show fields from table failed");
					}
					else echo "Add friend success!";
				#}
				#else 
				#	echo '<p class="error">You are already friends!</p>';
			}
			
		}
	}
	




	mysqli_free_result($result);
	#mysqli_free_result($res3);
	mysqli_free_result($res2);
	mysqli_free_result($res1);
	mysqli_close($conn);
?>
     <?php include 'footer.php'; ?>
</body>
</html>	