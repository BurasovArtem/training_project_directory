<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'electronic_directory';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
	
	if(!$conn) {
		echo 'Connected failure<br>';
	}
	
	echo 'Connected successfully\n';
	$sql = "DROP DATABASE IF EXISTS electronic_directory";
	mysqli_query($conn, $sql);

	$sql = "DROP DATABASE IF EXISTS vk_api";
	mysqli_query($conn, $sql);

	$sql = "CREATE DATABASE IF NOT EXISTS electronic_directory CHARACTER SET UTF8";

	if (mysqli_query($conn, $sql)) {
		mysqli_close($conn);
		
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		mysqli_set_charset($conn, "UTF8");
		echo "Database created successfully";

		$sql = "CREATE TABLE IF NOT EXISTS concepts(
					id INT AUTO_INCREMENT,
					title VARCHAR(40) NOT NULL,
					description VARCHAR(2000) NOT NULL,
					discipline_section VARCHAR(200) NOT NULL,
					formula VARCHAR(200) NOT NULL,
					examples VARCHAR(200) NOT NULL,
					illustrations_examples BLOB NOT NULL,
					PRIMARY KEY (id)
				)";
		mysqli_query($conn, $sql);
		importFromCSV($conn, "01_concepts.csv", "concepts");

		mysqli_close($conn);
	} 
	else {
		echo "Error creating database: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	function importFromCSV($link, $fileName, $tableName) {
		$sql = "LOAD DATA INFILE '../../htdocs/training_project_directory/php/tables/".$fileName."'
				INTO TABLE ".$tableName." 
				FIELDS TERMINATED BY ',' 
				ENCLOSED BY '\"'";
		
		mysqli_query($link, $sql);
	}

?>