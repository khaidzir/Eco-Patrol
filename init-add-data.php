<?php

require_once("database_connection.php");
require_once("pengguna.php");

$server = "localhost";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

if ($_GET["id"] == "user") {
	echo "
		<table>
			<tr>
				<td><label>Username</label></td>
				<td><input type='text' name='username' id='username'></td>
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type='text' name='password' id='password'></td>
			</tr>
			<tr>
				<td><label>Nama</label></td>
				<td><input type='text' name='nama' id='nama'></td>
			</tr>	
			<tr>
				<td><label>Jabatan</label></td>
				<td><input type='text' name='jabatan' id='jabatan'></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type='text' name='email' id='email'></td>
			</tr>
			<tr>
				<td><input type='button' value='OK' onclick='addUser(\"username\", \"password\", \"nama\", \"jabatan\", \"email\");'></td>
				<td><input type='button' value='Batal' onclick = 'showUsers(0,0);'></td>
			</tr>
		</table>";
} else if ($_GET["id"] == "taman") {
	echo "
		<table>
			<tr>
				<td><label>Taman</label></td>
				<td><input type='text' name='taman' id='taman'></td>
			</tr>
			<tr>
				<td><label>Deskripsi</label></td>
				<td><input type='text' name='deskripsi' id='deskripsi'></td>
			</tr>
			<tr>
				<td><label>Lokasi</label></td>
				<td><input type='text' name='lokasi' id='lokasi'></td>
			</tr>	
			<tr>
				<td><input type='button' value='OK' onclick='addTaman(\"taman\", \"deskripsi\", \"lokasi\");'></td>
				<td><input type='button' value='Batal' onclick = 'showTaman(0,0);'></td>
			</tr>
		</table>";
} else if ($_GET["id"] == "kategori") {
	echo "
		<table>
			<tr>
				<td><label>Kategori</label></td>
				<td><input type='text' name='kategori' id='kategori'></td>
			</tr>
				<td><input type='button' value='OK' onclick='addKategori(\"kategori\");'></td>
				<td><input type='button' value='Batal' onclick = 'showKategori(0,0);'></td>
			</tr>
		</table>";
}
?>