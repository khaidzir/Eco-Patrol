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
} else if ( isset($_POST["anama"]) && isset($_POST["adesc"]) && isset($_POST["alokasi"]) ) {	//Menambah data
	addTaman($conn, $_POST["anama"], $_POST["adesc"], $_POST["alokasi"]);
} else if (isset($_GET["done"])) {
	$id = $_GET["done"];
	changeStatusPengaduan($conn, $id, "Sudah selesai ditangani");
}

require_once("daftar-taman.php");

?>