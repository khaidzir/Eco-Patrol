<?php

function getListUsers($conn) {
	$query = "SELECT * FROM pihak_berwenang";
	$result = mysqli_query($conn, $query);
	return $result;
}

function validate($conn, $username, $password) {
	$query = "SELECT * FROM pihak_berwenang WHERE username='$username' AND password='$password'";
	return mysqli_query($conn, $query);
}

function deleteUser($conn, $username) {
	$query = "DELETE FROM pihak_berwenang WHERE username='$username'";
	mysqli_query($conn, $query);
}

function addUser($conn, $username, $password, $nama, $jabatan, $email) {
	$query = "INSERT INTO pihak_berwenang(username, password, nama, jabatan, email)
				VALUES ('$username', '$password', '$nama', '$jabatan', '$email')";
	mysqli_query($conn, $query);
}

function updateUser($conn, $username, $nama, $jabatan, $email) {
	$query = "UPDATE pihak_berwenang SET nama='$nama', jabatan='$jabatan', email='$email'
				WHERE username = '$username'";
	mysqli_query($conn, $query);
}

?>