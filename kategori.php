<?php

require_once("database_connection.php");
require_once("pengaduan.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);
$listKategori = getListKategori($conn);
if ($listKategori->num_rows > 0) {
    while($row = mysqli_fetch_array($listKategori)) {
		$nama = $row["nama"];
		echo "<option value='$nama'>";
    }
}
mysqli_free_result($listKategori);
close_connection($conn);
?>