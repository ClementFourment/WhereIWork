<?php
	$host = "localhost";
	$user = "root";
	$pass = "";

	try {
		$connect = new PDO("mysql:host=$host;port=3308;dbname=workshop;charset=utf8mb4", $user, $pass);
	}
	catch(PDOException $e) {
	    echo $e->getMessage();
	}
?>
