<?php

require_once("database_connection.php");
require_once("pengaduan.php");

$idPelapor = $_POST["ID"];
$nama = $_POST["Nama"];
$email = $_POST["Email"];
$taman = $_POST["Taman"];
$kategori = $_POST["Kategori"];
$aduan = $_POST["Aduan"];

$server = "";
$username = "root";
$password = "";
$db = "eco_patrol";
$conn = connect_database($server, $username, $password, $db);

submitPengaduan($conn, $idPelapor, $nama, $email, $taman, $kategori, $aduan);

$subject = "[Notifikasi] Eco Patrol";
$user = "bekantan.terbang@gmail.com";
$pass = "bekantanterbang";
sendEmailNotifications($conn, $kategori, $user, $pass, $subject, $aduan);

close_connection($conn);
header("location:index.php");

?>