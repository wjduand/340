<?php

  DEFINE ('DB_USER', 'cs340_duanyi');
  DEFINE ('DB_PASSWORD', '4333');
  DEFINE ('DB_HOST', 'mysql.cs.orst.edu');
  DEFINE ('DB_NAME', 'cs340_duanyi');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}
?>