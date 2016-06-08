<?php
	session_start();
	$old_email = $_SESSION['valid_email'];
	$old_user = $_SESSION['username'];
	unset($_SESSION['valid_email']);
	session_destroy();
?>
<!DOCTYPE html>
<html>

	<head>
	<title>LOG OUT</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    </head>
    <body>
	<?php include 'header.php'; ?>
	<?php include 'nav.php'; ?>
	<h1> Log Out Page</h1>
	<?php
		if (!empty($old_email)) {
			echo 'User: '.$old_user.' is logged out';
		} else {
			echo 'You were not logged in!';
		}
	?>
	<?php include 'footer.php'; ?>

</body>
</html>