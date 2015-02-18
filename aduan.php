<?php

/*********** Daftar pengaduan di halaman admin *********************/

require_once("database_connection.php");
require_once("pengaduan.php");

echo "<table class='tablesorter' cellspacing='0'> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th width='300'>Isi Aduan</th>
    				<th>Taman</th> 
    				<th>Kategori</th> 
    				<th>Tanggal</th> 
					<th>Status</th>
    				<th>Aksi</th> 
				</tr> 
			</thead> 
			<tbody> ";
			
$server = "localhost";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

session_start();
$user = $_SESSION["username"];

$query;
if ($user == "admin") {
	$query = 
	"SELECT
		pengaduan.id, pengaduan.deskripsi, taman.nama as taman, kategori.nama as kategori, tanggal, pengaduan.status
	FROM 
		pengaduan, taman, kategori 
	WHERE
		pengaduan.id_kategori = kategori.id and pengaduan.id_taman = taman.id
	ORDER BY
		pengaduan.tanggal ASC";
} else {
	$query = 
	"select
	taman_adu.idpengaduan as id, taman_adu.deskripsi, taman_adu.nama as taman, taman_adu.kategori, tanggal, taman_adu.status
from
	(select pihak_berwenang.username, nama, id_kategori from pihak_berwenang, mengurus where pihak_berwenang.username = '$user' and mengurus.pihak_berwenang_username = '$user') as pengurus,
	(select pengaduan.id as idpengaduan, taman.nama, taman.id as idtaman, kategori.id  as idkategori, kategori.nama as kategori, tanggal, pengaduan.deskripsi, status, foto
	from taman, pengaduan, kategori where taman.id = pengaduan.id_taman and kategori.id = pengaduan.id_kategori) as taman_adu
where
	taman_adu.idkategori = pengurus.id_kategori and (status = 'Dalam proses' or status = 'Sudah selesai ditangani')";
}

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
	$id = $row['id'];
	$isiaduan = $row["deskripsi"];
	$taman = $row["taman"];
	$kategori = $row["kategori"];
	$status = $row["status"];
	$tanggal = changeDateFormat($row["tanggal"]);
	echo "
	<tr> 
	<td><input type='checkbox'>
	</td> 
	<td>$isiaduan</td>
	<td>$taman</td> 
	<td>$kategori</td> 
	<td>$tanggal</td>
	<td>$status</td>";
	if ($user == "admin") {
		if($status=="Belum diverifikasi"){
			echo"<td><input type='image' src='images/icn_alert_success.png' title='Setujui' 
				onclick='return acceptPengaduan($id, \"$kategori\", \"$taman\");'>";
		} else {
			echo"<td>";
		}
		echo"<input type='image' src='images/icn_alert_error.png' title='Hapus' onclick='return deletePengaduan($id);'></td>";
	} else {
		if ($status=="Dalam proses") {
			echo "<td><input type='image' src='images/icn_alert_success.png' title='Selesai' onclick='return selesaiPengaduan($id)'></td>";
		}
	}
echo "</tr> ";
}

echo "</tbody> 
			</table>";
			
mysqli_free_result($result);
close_connection($conn);
	
?>