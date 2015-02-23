<?php

require_once("database_connection.php");

$user = $_GET["user"];

$server = "localhost";
$username = "root";
$password = "";
$dbname = "eco_patrol";
$conn = connect_database($server, $username, $password, $dbname);

$query = "SELECT * FROM pihak_berwenang WHERE username='$user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$nama = $row["nama"];
$jabatan = $row["jabatan"];
$email = $row["email"];

echo "
<td><input type='checkbox'></td>
<td>$user</td>
<td><input type='text' value='$nama' name='nama' id='nama'></td> 
<td><input type='text' value='$jabatan' name='jabatan' id='jabatan'></td> 
<td><input type='text' value='$email' name='email' id='email'></td> 
<td><input type='image' src='images/icn_alert_success.png' title='OK' onclick='return editUser(\"$user\", \"nama\", \"jabatan\", \"email\");'>
<input type='image' src='images/icn_alert_error.png' title='Cancel' onclick='return showUsers(0,0);'></td> ";



?>