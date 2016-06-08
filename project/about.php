<!DOCTYPE html>

	<head>
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    </head>
    <body>
	<?php include 'header.php'; ?>
	<?php include 'nav.php'; ?>
	<h1> About Page </h1>
	<p>Any suggestions contact me via email: duanyi@oregonstate.edu</p>
	<p>Users have to use email to sign up, when user clicks on the “Get username”, 
		user will be assigned a 6-digit hex number as username, and a hex color, after user login in 
		the background color of header and footer will change colors. Users could only post stuffs after login, 
		and there will be other people’s posts on Home page randomly, 10 posts every time, maxlength of each post is 1000 characters.
		Add friends by input friend's email, search by input key word. You can like or comment a post in home page
		and all the posts you wrote, liked, and your friends would be showed in my page.
    </p>
	<p>Student project, any resemblance herein is purely coincidental.</p>
	<p>
	<p>
	<a href="logout.php">Logout</a>
	<?php include 'footer.php'; ?>
</body>
</html>	