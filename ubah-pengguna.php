<?php
require_once("database_connection.php");
require_once("pengguna.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$user;
if (isset($_GET["del"])) {
	$user = $_GET["del"];
	deleteUser($conn, $user);
} else if ( isset($_POST["user"]) && isset($_POST["nama"]) && isset($_POST["jabatan"]) && isset($_POST["email"]) ) {
	updateUser($conn, $_POST["user"], $_POST["nama"], $_POST["jabatan"], $_POST["email"]);
} else if ( isset($_POST["auser"]) && isset($_POST["apassword"]) && isset($_POST["anama"]) && isset($_POST["ajabatan"]) && isset($_POST["aemail"]) ) {
	addUser($conn, $_POST["auser"], $_POST["apassword"], $_POST["anama"], $_POST["ajabatan"], $_POST["aemail"]);
}

require_once("daftar-pengguna.php");

?>