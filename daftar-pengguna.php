<?php

require_once("database_connection.php");
require_once("pengguna.php");

$server = "";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$result = getListUsers($conn);

echo "<table class='tablesorter' cellspacing='0'> 
		<thead> 
			<tr> 
				<th></th> 
				<th>Username</th>
				<th>Nama</th> 
				<th>Jabatan</th> 
				<th>Email</th>
				<th>Aksi</th>
			</tr> 
		</thead> 
		<tbody> ";

while($row = mysqli_fetch_array($result)) {
	$user = $row["username"];
	$nama = $row["nama"];
	$jabatan = $row["jabatan"];
	$email = $row["email"];
	echo "
	<tr> 
	<td><input type='checkbox'></td> 
	<td>$user</td>
	<td>$nama</td> 
	<td>$jabatan</td> 
	<td>$email</td> 
	<td><input type='image' src='images/icn_alert_success.png' title='Edit'><input type='image' src='images/icn_alert_error.png' title='Trash'></td> 
	</tr> ";
}

echo "</tbody> 
			</table>";
			
mysqli_free_result($result);
close_connection($conn);

	
?>