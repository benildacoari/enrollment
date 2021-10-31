<?php

$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="enei_mat";

$link = new mysqli($db_host, $db_user, $db_password,$db_name);
if ($link -> connect_errno) {
	echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

@mysqli_query ($link, "SET CHARSET 'utf8'"); 

?>
