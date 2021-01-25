<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'electronic_directory';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	if(!$conn) {
		echo 'Connected failure<br>';
	}

	mysqli_query($conn, 'SET COLLATION_CONNECTION="utf8_general_ci"');
	mysqli_query($conn, 'SET NAMES utf8_general_ci');
	mysqli_set_charset($conn, "utf8");
?>