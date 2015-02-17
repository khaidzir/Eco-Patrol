<?php
require_once("database_connection.php");
require_once("pengaduan.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);


$id;

if (isset($_GET["del"])) {
	$id = $_GET["del"];
	deleteTaman($conn, $id);
} else if (isset($_GET["acc"])) {
	$id = $_GET["acc"];
	changeStatusPengaduan($conn, $id, "Dalam proses");
	//sendEmailNotifications($conn, $kategori, $username, $password, $subject, $teks);
} else if (isset($_GET["done"])) {
	$id = $_GET["done"];
	changeStatusPengaduan($conn, $id, "Sudah selesai ditangani");
}

require_once("daftar-taman.php");

?>