<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webproject01";

$conn = mysqli_connect($serverName, $userName, $password, $databaseName);

if ($conn) {
	// $sql = "CREATE TABLE userinfo(
	// name VARCHAR(250) NOT NULL,
	// userName varchar(50) NOT NULL unique,
	// password varchar(50) NOT NULL,
	// stdId varchar(30) not null unique,
	// email varchar(50) not null unique,
	// phoneNumber varchar(50) not null,
	// address text not null
	// )";

	// $sql = "CREATE TABLE teacherinfo(
	// initial VARCHAR(10) NOT NULL unique,
	// name varchar(50) NOT NULL,
	// designation varchar(50) NOT NULL,
	// department varchar(30) not null,
	// email varchar(50) not null unique,
	// phone varchar(50) not null,
	// image longtext not null
	// )";

	// $sql = "CREATE TABLE contribution(
	// initial VARCHAR(10) NOT NULL,
	// name varchar(50) NOT NULL,
	// designation varchar(50) NOT NULL,
	// department varchar(30) not null,
	// email varchar(50) not null,
	// phone varchar(50) not null,
	// image longtext not null
	// )";

	// $sql = "CREATE TABLE authorityInfo(
	// employeeId int NOT NULL unique,
	// password varchar(50) not null,
	// name varchar(50) NOT NULL,
	// designation varchar(50) NOT NULL,
	// email varchar(50) not null unique,
	// phone varchar(50) not null
	// )";


	if (mysqli_query($conn, $sql)) {
		echo "Table created";
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}
}
else{
	echo "Failed. Error: ".mysqli_connect_error();
}



?>