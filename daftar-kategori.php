<?php

/****************** Daftar kategori di halaman admin ********************/

require_once("database_connection.php");
require_once("pengaduan.php");

$server = "localhost";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

session_start();
$user = $_SESSION["username"];
$admin = $user == "admin";

echo "<table class='tablesorter' cellspacing='0'> 
			<thead> 
				<tr>"; 
   					if ($admin) echo"<th></th> ";
    				echo"<th>Kategori</th>";
if ($admin) {
	echo		"<th>Aksi</th>";
}
echo			"</tr> 
			</thead> 
			<tbody> ";

$listKategori = getListKategori($conn);

while($row = mysqli_fetch_array($listKategori)) {
	$id = $row['id'];
	$kategori = $row["nama"];
	echo "
	<tr> ";
	if($admin) echo "<td><input type='checkbox'></td> ";
	echo "<td>$kategori</td>";
	
	if ($admin) {
		echo"<td><input type='image' src='images/icn_alert_error.png' title='Hapus' onclick='return deleteKategori($id);'></td> 
	</tr> ";
	}
}

echo "</tbody> 
			</table>";
			
mysqli_free_result($listKategori);
close_connection($conn);



?>
