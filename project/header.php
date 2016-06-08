<?php
session_start();
$color = $_SESSION['color'];		
echo"		<header style = 'background-color: $color'>";
echo"			<h1> FacelessBook</h1>";
echo"		</header>";
?>