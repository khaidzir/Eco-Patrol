<?php

require_once '/Swift-5.1.0/lib/swift_required.php';

/********* Fungsi - fungsi getter list ***********/
function getListKategori($conn) {
	$query = "SELECT * FROM kategori";
	$result = mysqli_query($conn, $query);
	return $result;
}

function getListPengaduan($conn) {
	$query = "SELECT * FROM pengaduan";
	$result = mysqli_query($conn, $query);
	return $result;
}

function getListTaman($conn) {
	$query = "SELECT * FROM taman";
	$result = mysqli_query($conn, $query);
	return $result;
}


/*********** Fungsi - fungsi getter ID **************/
function getIDKategori($conn, $kategori) {
	$result = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$kategori'");
	$id = mysqli_fetch_array($result);
	return $id["id"];
}

function getIDPengaduan($conn, $desc) {
	$result = mysqli_query($conn, "SELECT id FROM pengaduan WHERE deskripsi='$desc'");
	$id = mysqli_fetch_array($result);
	return $id["id"];
}

function getCurrentIDPengaduan($conn) {
	$result = mysqli_query($conn, "SELECT id_pengaduan FROM newest_id_pengaduan");
	$id = mysqli_fetch_array($result);
	return $id["id_pengaduan"];
}

function getIDTaman($conn, $nama) {
	$result = mysqli_query($conn, "SELECT id FROM taman WHERE nama='$nama'");
	$id = mysqli_fetch_array($result);
	return $id["id"];
}


/************* Fungsi - fungsi insert *****************/
function addPengaduan($conn, $idkategori, $idPelapor, $idTaman, $desc, $tanggal, $status, $foto) {
	$query = "INSERT INTO `pengaduan`(`id_kategori`, `id_pelapor`, `id_taman`, `deskripsi`, `tanggal`, `status`, `foto`)
				VALUES ('$idkategori','$idPelapor', '$idTaman', '$desc','$tanggal','$status', '$foto')";
	mysqli_query($conn, $query);
}

function addPelapor($conn, $id, $nama, $email) {
	$query = "INSERT INTO pelapor (id, nama, email) VALUES ('$id', '$nama', '$email')";
	mysqli_query($conn, $query);
}

/************* Fungsi lain - lain **************/
function deletePengaduan($conn, $idPengaduan) {
	$query = "DELETE FROM pengaduan WHERE id=$idPengaduan";
	mysqli_query($conn, $query);
}

function changeStatusPengaduan($conn, $idPengaduan, $status) {
	$query = "UPDATE pengaduan SET status=$status WHERE id=$idPengaduan";
	mysqli_query($conn, $query);
}

function submitPengaduan($conn, $idPelapor, $nama, $email, $taman, $kategori, $pengaduan) {
	addPelapor($conn, $idPelapor, $nama, $email);
	
	$idKategori = getIDKategori($conn, $kategori);
	$idTaman = getIDTaman($conn, $taman);
	
	date_default_timezone_set("Asia/Jakarta");
	$tanggal = date("Y-m-d H:i:s");
	$status = "Belum diselesaikan";
	$foto = "belum ada foto";
	
	addPengaduan($conn, $idKategori, $idPelapor, $idTaman, $pengaduan, $tanggal, $status, $foto);
}
// from dan to array
function sendEmail($username, $password, $subject, $from, $to, $body) {
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
	$transport->setUsername($username);
	$transport->setPassword($password);
	
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message->setSubject($subject);
	$message->setFrom($from);
	$message->setTo($to);
	$message->setBody($body);
	$mailer->send($message);
}

function sendEmailNotifications($conn, $kategori, $username, $password, $subject, $teks) {
	/*$query = "SELECT * FROM mengurus,kategori,pihak_berwenang WHERE mengurus.id_kategori = kategori.id AND pihak_berwenang.username = mengurus.pihak_berwenang_username";
	
	$hasil = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($hasil)) {
		$to = array($row["email"] => "Nama");
		$from = array($username => "Eco Patrol");
		sendEmail($username, $password, $subject, $from, $to, $teks);
	}
	mysqli_free_result($hasil);*/
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
	$transport->setUsername('bekantan.terbang@gmail.com');
	$transport->setPassword('bekantan');
	
	// Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message->setSubject('Tes Kirim Email');
	$message->setFrom(array('bekantan.terbang@gmail.com' => 'Bekantan'));
	$message->setTo(array('dzir.shhh@gmail.com' => 'Khaidzir'));
	$message->setBody('
	Hi, '.$username.'.
	konten
');
	$result = $mailer->send($message);
}

function changeDateFormat($date) {
	$daftar = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
					"Oktober", "November", "Desember");
	$tanggal = explode ("-", substr($date, 0, 10));
	$waktu = substr($date, 11, 8);
	$bulan = $daftar[(int)$tanggal[1]-1];
	$ret = $tanggal[2];
	$ret .= " ";
	$ret .= $bulan;
	$ret .= " ";
	$ret .= $tanggal[0];
	$ret .= " ";
	$ret .= $waktu;
	return $ret;
}

function countTodayPost(){
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('error');
	}
	mysql_select_db("eco_patrol",$con);
	$date = date("Y-m-d");
	$query = "SELECT COUNT(`id`) AS `jumlah` FROM pengaduan WHERE tanggal LIKE '$date%'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	mysql_close();
	return $row['jumlah'];
}

function countMonthPost(){
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('error');
	}
	mysql_select_db("eco_patrol",$con);
	$date = date("Y-m");
	$query = "SELECT COUNT(`id`) AS `jumlah` FROM pengaduan WHERE tanggal LIKE '$date%'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	mysql_close();
	return $row['jumlah'];	
}

function countAllPost(){
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('error');
	}
	mysql_select_db("eco_patrol",$con);
	$query = "SELECT COUNT(`id`) AS `jumlah` FROM pengaduan";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	mysql_close();
	return $row['jumlah'];	
}
?>