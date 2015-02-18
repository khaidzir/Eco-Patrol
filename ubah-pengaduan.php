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
	deletePengaduan($conn, $id);
} else if (isset($_GET["acc"])) {
	$id = $_GET["acc"];
	changeStatusPengaduan($conn, $id, "Dalam proses");
	$query = "	select pelapor.nama, pelapor.email, taman.nama as taman, kategori.nama as kategori, pengaduan.deskripsi, tanggal
				from pengaduan, pelapor, kategori, taman
				where pengaduan.id=$id and pengaduan.id_pelapor = pelapor.id and kategori.id = pengaduan.id_kategori and taman.id = pengaduan.id_taman";
	$result = mysqli_query($conn, $query);
	$namapelapor; $emailpelapor; $tanggal;
	if ($row = mysqli_fetch_array($result)) {
		$namapelapor = $row["nama"];
		$emailpelapor = $row["email"];
		$tanggal = $row["tanggal"];
		$teks = $row["deskripsi"];
		$kategori = $row["kategori"];
		$taman = $row["taman"];
		sendEmailNotifications($conn, $namapelapor, $emailpelapor, $taman, $kategori, $teks, $tanggal);
	}
	
} else if (isset($_GET["done"])) {
	$id = $_GET["done"];
	changeStatusPengaduan($conn, $id, "Sudah selesai ditangani");
}

require_once("aduan.php");

?>