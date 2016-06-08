<?php
 session_start();
 DEFINE ('DB_USER', 'cs340_duanyi');
 DEFINE ('DB_PASSWORD', '4333');
 DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
 DEFINE ('DB_NAME', 'cs340_duanyi');
 $email = $_SESSION['valid_email'];
 $user = $_SESSION['username'];
 $search = $_POST['search'];
?>
<!DOCTYPE html>
<head>
	<title>Search</title>
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
    	echo "<form method='post' action='search.php'>";	
    	echo "<div>";
    	echo "Input key word:";
    	echo "</div>";
    	echo "<input type='text' class='postbutton' name = 'search'/><br/><br/>";
	    echo "<input type='submit' class='postbutton' value='Search' name='submit'/><br/><br/>";
	    echo "</form>";
	
	?>
 
 <?php
 include 'connectvar.php'; 
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = $_POST['table'];
	if(isset($search)){
		$query = "SELECT Content FROM `Post` WHERE Content LIKE '%$search%';";

		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		
		$fields_num = mysqli_num_fields($result);
		echo "<table><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++) {	
			$field = mysqli_fetch_field($result);	
			echo "<td><b>Search Results</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {	
			echo "<tr>";	
			// $row is array... foreach( .. ) puts every element
			// of $row to $cell variable	
			//foreach($row as $cell)		
				//echo "<td>$cell</td>";	
			echo "<td>$row[0]</td>";	
			echo "</tr>\n";
		}
		 echo "</table>";
	}

	mysqli_free_result($result);
	mysqli_close($conn);
?>
     <?php include 'footer.php'; ?>
</body>
</html>	