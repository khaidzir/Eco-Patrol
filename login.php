<?php

require_once("database_connection.php");
require_once("pengguna.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$user = $_POST["Username"];
$pass = $_POST["Password"];
$result = validate($conn, $user, $pass);
if ($row = mysqli_fetch_array($result)) {
	session_start();
	$_SESSION["username"] = $row["username"];
	header("location:admin.php");
}

?>