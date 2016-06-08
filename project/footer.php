<?php
    session_start();
    $color = $_SESSION['color'];
    echo "    <div> ";
	echo "		<footer style = 'background-color: $color'> ";
	echo "			FacelessBook <br/> ";
	echo "	    </footer>";
	echo "    </div> ";
?>