<?php
 session_start();
 DEFINE ('DB_USER', 'cs340_duanyi');
 DEFINE ('DB_PASSWORD', '4333');
 DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
 DEFINE ('DB_NAME', 'cs340_duanyi');
 $email = $_SESSION['valid_email'];
 $user = $_SESSION['username'];
 $posttext = $_POST['posttext'];
 $deletepo = $_POST['deletepo'];
?>
<!DOCTYPE html>
<head>
	<title>My Page</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<style>
	table {
    	border-collapse: collapse;
    	width: 100%;
	}

	th, td {
    	padding: 8px;
    	text-align: left;
    	border-bottom: 1px solid #ddd;
	}
	</style>
</head>
<body> 
	 <?php include 'header.php'; ?>
     <?php include 'nav.php'; ?>
 
 <?php
 include 'connectvar.php'; 
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = $_POST['table'];
	$query = "SELECT PostID, Content FROM `Post` WHERE PostUserEmail = '$email'";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$query1 = "SELECT userEmail1, userEmail2 FROM `Relationship` WHERE userEmail1 = '$email' OR userEmail2 = '$email';";
	$result1 = mysqli_query($conn, $query1);
	$fields_num1 = mysqli_num_fields($result1);

	$query3 = "SELECT PostID, Content FROM `PostLike`, `Post` WHERE LikePostID = PostID AND LikeUserEmail = '$email';";
	$result3 = mysqli_query($conn, $query3);
	$fields_num3 = mysqli_num_fields($result3);


	$query6 = "DELETE FROM `Post` WHERE PostID = $deletepo";
	$result6 = mysqli_query($conn, $query6);


	$fields_num = mysqli_num_fields($result);	
	echo "<b class = 'friends'>My Posts</b>";
	echo "<table><tr>";
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		//foreach($row as $cell)		
			//echo "<td>$cell</td>";	
		echo "<td>$row[1]</td>";
		$query4 = "SELECT LikePostID, COUNT(*) FROM `PostLike` WHERE LikePostID = '$row[0]' GROUP BY LikeID;";
		$result4 = mysqli_query($conn, $query4);	
		$row4 = mysqli_fetch_row($result4);
		if($row4[1]){
			echo "<td>$row4[1] likes</td>";
		}
		else echo "<td>0 likes</td>";
		#echo "<td><form method='post' action= 'mypage.php' name = 'deletepo'>";
		#echo "<button type='submit' value=$row[0] name = 'deletepo'>&#x2613</button>";
		#echo "</form></td>";
		echo "</tr>\n";
		$query5 = "SELECT CommentContent, CommentDate FROM `Comment` WHERE CommentPostID = '$row[0]';";
		$result5 = mysqli_query($conn, $query5);
		while($row5 = mysqli_fetch_row($result5)){
			echo "<tr>";
			echo "<td class='comment'>  	---------------- $row5[0]        --Comment on: $row5[1]<td>";
			echo "</tr>";
		}
	}
	 echo "</table>";


	echo "<b class='friends'>My Likes</b>";
	echo "<table><tr>";
	 //printing table headers
	for($i=0; $i<$fields_num3; $i++) {	
		$field3 = mysqli_fetch_field($result3);	
		echo "<td><b>{$field3->name}</b></td>";
	}
	echo "</tr>\n";
	while($row3 = mysqli_fetch_row($result3)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		//foreach($row as $cell)		
			//echo "<td>$cell</td>";	
		echo "<td>$row3[0]</td>";
		echo "<td>$row3[1]</td>";	
		echo "</tr>\n";
	}
	 echo "</table>";

	echo "<b class = 'friends'>My Friends</br></b>";
	while($friends = mysqli_fetch_row($result1)) {	
		if($friends[0] == $email)	
			$friendemail = $friends[1];
		elseif ($friends[1] == $email) {
			$friendemail = $friends[0];
		}
		$query2 = "SELECT Username FROM `Users` WHERE Email = '$friendemail';";
		$result2 = mysqli_query($conn, $query2);
		$friendusername = mysqli_fetch_row($result2);
		echo "$friendusername[0] &#x2661 ";	

	}

	mysqli_free_result($result);
	mysqli_close($conn);
?>
     <?php include 'footer.php'; ?>
</body>
</html>	