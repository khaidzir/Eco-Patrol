<?php
/********* Fungsi - fungsi koneksi database **************/
function connect_database($server, $username, $password, $dbname) {
	$conn=mysqli_connect($server, $username, $password, $dbname) or die ("Error connecting to mysql server: ".mysql_error());
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		return ;
	} else {
		return $conn;
	}
}

function close_connection($conn) {
	mysqli_close($conn);
}
?>