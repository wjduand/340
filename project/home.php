<?php
 session_start();
 DEFINE ('DB_USER', 'cs340_duanyi');
 DEFINE ('DB_PASSWORD', '4333');
 DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
 DEFINE ('DB_NAME', 'cs340_duanyi');
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $query1 = "SELECT * FROM Post";
 $res1 = mysqli_query($dbc, $query1);
 $rowsnum = mysqli_num_rows($res1);
 $query2 = "SELECT * FROM Comment";
 $res2 = mysqli_query($dbc, $query2);
 $rowsnum2 = mysqli_num_rows($res2);
 $email = $_SESSION['valid_email'];
 $user = $_SESSION['username'];
 $posttext = $_POST['posttext'];
 $postid = $rowsnum + 1;
 $commentid = $rowsnum2 + 1;
 $postcommenttext = $_POST['postcommenttext'];
 $commentpostid = $_POST['commentpostid'];
 $color = $_SESSION['color'];
 $query3 = "SELECT PostUserEmail FROM Post WHERE PostID = $commentpostid";
 $res3 = mysqli_query($dbc, $query3);
 $commentpostemail = mysqli_fetch_row($res3);
 $like = $_POST['like'];
 $query4 = "SELECT PostUserEmail FROM Post WHERE PostID = $like";
 $res4 = mysqli_query($dbc, $query4);
 $likepostemail = mysqli_fetch_row($res4);
 $query5 = "SELECT * FROM PostLike";
 $res5 = mysqli_query($dbc, $query5);
 $rowsnum5 = mysqli_num_rows($res5);
 $likeid = $rowsnum5 + 1;
 //$commentpostemail = mysql_fetch_row($res3);
 if($posttext)
 	$sql = "INSERT INTO `Post` (`PostID`, `Content`, `PostUserEmail`) VALUES ('$postid', '$posttext', '$email');";
 if($postcommenttext){
 	 if (!(mysqli_num_rows($res3))){
	 	echo '<p class="error">The post doesnt exit, please input correct post id.</p>';
	        $postcommenttext = "";
	 }
	 else{
	 	$sql = "INSERT INTO `Comment` (`CommentID`, `CommentContent`, `CommentPostID`, `CommentDate`, `CommentPostEmail`, `CommentUserEmail`) 
	 VALUES ('$commentid', '$postcommenttext', '$commentpostid', now(), '$commentpostemail[0]', '$email');";
	 echo "Success!";
	 }
 }
 	
 mysqli_query($dbc, $sql);
 if($like)
 	$sql = "INSERT INTO `PostLike`(`LikeID`, `LikePostID`, `LikeDate`, `LikePostEmail`, `LikeUserEmail`) 
 VALUES ('$likeid', '$like', now(), '$likepostemail[0]', '$email');";
 mysqli_query($dbc, $sql);
?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
	<script type = "text/JavaScript" src = "javas.js"> </script>
	<style>
	table {
    	border-collapse: collapse;
    	width: 100%;
	}

	th, td {
    	padding: 8px;
    	text-align: center;
    	border-bottom: 1px solid #ddd;
	}
	</style>
</head>
<body> 
	<?php include 'header.php'; ?>
	<?php include 'nav.php'; ?>

   

    <?php 
    if(isset($email))
    {
    	echo " <textarea maxlength='1000' rows='20' cols='50' id='posttext' name='posttext' form='usrform'></textarea>";
    	echo "<form method='post' action='home.php' id='usrform'>";	
    	echo "<div>";
    	echo "Characters(including trails, 1000 Characters at most): <span id='totalChars'>0</span><br/>";
    	echo "</div>";
	    echo "<input type='submit' class='postbutton' value='Submit' name='submit'/><br/><br/>";
	    echo "</form>";
    }
	
	?>


	<?php
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = $_POST['table'];
	$query = "SELECT PostID, Content, Username FROM `Post`, `Users` WHERE PostUserEmail = Users.Email ORDER BY RAND() LIMIT 10";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	echo "<p class='others'> See other's posts </p>";
	$fields_num = mysqli_num_fields($result);
	echo "<table><tr style = 'nth-child(even) background-color: $color'>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($result);	
		echo "<td><b>{$field->name}</b></td>";
	}
	echo "<td> <td>";
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			{
				echo "<td>$cell</td>";
			}
		echo "<td><form method='post' action= 'home.php' name = 'likee'>";
		echo "<button type='submit' value=$row[0] name = 'like'>&#x2661</button>";
		echo "</form></td>";
		echo "</tr>\n";
	}
	echo "</table>";
	mysqli_free_result($result);
	mysqli_free_result($res1);
	mysqli_free_result($res2);
	mysqli_free_result($res3);
	mysqli_free_result($res4);
	mysqli_free_result($res5);
	mysqli_close($conn);
?>

    <?php 
    if($email){
    	echo "<p class='others'> Comment </p>";
    	echo "<form method='post' action='home.php' name = 'comment'>";	
    	echo "<div>";
    	echo "Post ID:";
    	echo "<input type='text' name='commentpostid'><br>";
    	echo "Comment:<br>";
    	echo " <textarea maxlength='100' rows='10' cols='50' id='postcommenttext' name='postcommenttext'></textarea>";
    	echo "</div>";
	    echo "<input type='submit' value='Submit' name='submit'/><br/><br/>";
	    echo "</form>";
    }
   
    	
   
	
	?>

    <?php include 'footer.php'; ?>	
</body>
</html>