<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "class registration database";

$connection =new mysqli($host, $user, $pass, $database);

if ($connection === false)
	{
		die("Unable to connect to database: " . mysqli_connect_error());
	}

?>