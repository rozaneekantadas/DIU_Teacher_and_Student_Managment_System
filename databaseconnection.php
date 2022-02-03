<?php

$serverName = "sql212.epizy.com";
$userName = "epiz_30978443";
$password = "27cCzAZWvB9pFxW";
$databaseName = "epiz_30978443_db1";

$conn = mysqli_connect($serverName, $userName, $password, $databaseName);

if ($conn) {
	//connect
}
else{
	echo "Failed. Error: ".mysqli_connect_error();
}

?>