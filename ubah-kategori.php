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
	deleteKategori($conn, $id);
} else if (isset($_GET["edit"])) {
	$id = $_GET["edit"];
}

require_once("daftar-kategori.php");

?>