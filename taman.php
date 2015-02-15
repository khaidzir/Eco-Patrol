<?php

require_once("database_connection.php");
require_once("pengaduan.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);
$listTaman = getListTaman($conn);
//if ($listTaman->num_rows > 0) {
if (mysqli_num_rows($listTaman) > 0) {
    while($row = mysqli_fetch_array($listTaman)) {
		$nama = $row["nama"];
		echo "<option value='$nama'>";
    }
}
mysqli_free_result($listTaman);
close_connection($conn);

?>