<?php

/*********** Daftar pengaduan di halaman admin *********************/

require_once("database_connection.php");
require_once("pengaduan.php");

session_start();
$admin = $_SESSION["username"] == "admin";

echo "<table class='tablesorter' cellspacing='0'> 
			<thead> 
				<tr> ";
   					if ($admin) echo "<th></th>";
					echo "<th>Taman</th> ";
    				if ($admin) echo "<th>Aksi</th>";
				echo"</tr> 
			</thead> 
			<tbody> ";
			
$server = "localhost";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$listTaman = getListTaman($conn);

while($row = mysqli_fetch_array($listTaman)) {
	$id = $row['id'];
	$taman = $row["nama"];
	$deskripsi = $row["deskripsi"];
	$lokasi = $row["lokasi"];
	echo "
	<tr> ";
	if($admin) echo "<td><input type='checkbox'></td> ";
	echo "<td>$taman</td> ";
	if ($admin) echo"<td><input type='image' src='images/icn_alert_success.png' title='Setujui'>
		<input type='image' src='images/icn_alert_error.png' title='Hapus' onclick='return deleteTaman($id);'></td>";
echo "</tr> ";
}

echo "</tbody> 
			</table>";

echo "<div id=\"tab2\">
	<input type='button' value='Tambah' onclick='initAddTaman();'></input>
	</div>";
			
mysqli_free_result($listTaman);
close_connection($conn);
	
?>