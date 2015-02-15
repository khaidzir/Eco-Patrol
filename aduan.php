<?php

require_once("database_connection.php");
require_once("pengaduan.php");

echo "<table class='tablesorter' cellspacing='0'> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Isi Aduan</th>
    				<th>Taman</th> 
    				<th>Kategori</th> 
    				<th>Tanggal</th> 
    				<th>Aksi</th> 
				</tr> 
			</thead> 
			<tbody> ";
			
$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$query = 
"SELECT
	pengaduan.deskripsi, taman.nama as taman, kategori.nama as kategori, pengaduan.tanggal
FROM
	pengaduan, mengadu, taman, kategori
WHERE
	pengaduan.id = mengadu.pengaduan_id AND mengadu.taman_id = taman.id AND pengaduan.id_kategori = kategori.id
ORDER BY
	pengaduan.tanggal ASC";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
	$isiaduan = $row["deskripsi"];
	$taman = $row["taman"];
	$kategori = $row["kategori"];
	$tanggal = changeDateFormat($row["tanggal"]);
	echo "
	<tr> 
	<td><input type='checkbox'></td> 
	<td>$isiaduan</td>
	<td>$taman</td> 
	<td>$kategori</td> 
	<td>$tanggal</td> 
	<td><input type='image' src='images/icn_alert_success.png' title='Edit'><input type='image' src='images/icn_alert_error.png' title='Trash'></td> 
</tr> ";
}

echo "</tbody> 
			</table>";
			
mysqli_free_result($result);
close_connection($conn);
	
?>