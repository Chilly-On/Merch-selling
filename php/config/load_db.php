<?php
	$db_server = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "mywebsite";
	$conn = "";
	try {
		$conn = mysqli_connect($db_server,
				$db_user,
				$db_pass,
				$db_name);
	}
	catch (Exception $e){
		echo `<alert>Failed to connect to the database</alert>`;
	}
?>