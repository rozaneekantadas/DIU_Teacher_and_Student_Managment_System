<?php

$serverName = "localhost";
$userName = "root";
$password = "";

$conn = mysqli_connect($serverName, $userName, $password);

if ($conn) {
	$sql = "CREATE DATABASE webproject01";
	if (mysqli_query($conn, $sql)) {
		echo "Create Database Successfully";
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}
}
else{
	echo "Failed. Error: ".mysqli_connect_error();
}



?>