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

function addKategori($conn, $kategori) {
	$query = "INSERT INTO kategori (nama) VALUES ('$kategori')";
	mysqli_query($conn, $query);
}

function addTaman($conn, $nama, $deskripsi, $lokasi) {
	$query = "INSERT INTO taman (nama, deskripsi, lokasi) VALUES ('$nama', '$deskripsi', '$lokasi')";
	mysqli_query($conn, $query);
}

/**************** Fungsi-fungsi delete ********************/
function deletePengaduan($conn, $idPengaduan) {
	$query = "DELETE FROM pengaduan WHERE id=$idPengaduan";
	mysqli_query($conn, $query);
}

function deleteKategori($conn, $idKategori) {
	$query = "DELETE FROM kategori WHERE id=$idKategori";
	mysqli_query($conn, $query);
}

function deleteTaman($conn, $idTaman) {
	$query = "DELETE FROM taman WHERE id=$idTaman";
	mysqli_query($conn, $query);
}


/************* Fungsi lain - lain **************/
function changeStatusPengaduan($conn, $idPengaduan, $status) {
	$query = "UPDATE pengaduan SET status='$status' WHERE id=$idPengaduan";
	mysqli_query($conn, $query);
}

function submitPengaduan($conn, $idPelapor, $nama, $email, $taman, $kategori, $pengaduan) {
	addPelapor($conn, $idPelapor, $nama, $email);
	
	$idKategori = getIDKategori($conn, $kategori);
	$idTaman = getIDTaman($conn, $taman);
	
	date_default_timezone_set("Asia/Jakarta");
	$tanggal = date("Y-m-d H:i:s");
	$status = "Belum diverifikasi";
	$foto = "belum ada foto";
	
	addPengaduan($conn, $idKategori, $idPelapor, $idTaman, $pengaduan, $tanggal, $status, $foto);
}
// from dan to =  array
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

function sendEmailAdmin($conn, $pelapor, $emailPelapor, $taman, $kategori, $aduan) {
	$query = "SELECT * FROM pihak_berwenang WHERE username='admin'";
	$result = mysqli_query($conn, $query);
	$email;
	$nama;
	if ($row = mysqli_fetch_array($result)) {
		$email = $row["email"];
		$nama = $row["nama"];
	} else return;
	
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
	$transport->setUsername('bekantan.terbang@gmail.com');
	$transport->setPassword('bekantanterbang');
	
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message->setSubject('[Notifikasi] Eco Patrol');
	$message->setFrom(array('bekantan.terbang@gmail.com' => 'Bekantan'));
	$message->setTo(array($email => $nama));
	$message->setBody("Dari : $pelapor ($emailPelapor)
Lokasi : $taman
Kategori : $kategori
Isi aduan : $aduan");
	$mailer->send($message);
}

function sendEmailNotifications($conn, $namapelapor, $emailpelapor, $taman, $kategori, $aduan, $tanggal) {
	$query = "	SELECT 
					pihak_berwenang.*
				FROM 
					mengurus,kategori,pihak_berwenang 
				WHERE 
					mengurus.id_kategori = kategori.id AND pihak_berwenang.username = mengurus.pihak_berwenang_username AND kategori.nama = '$kategori'";
	
	$hasil = mysqli_query($conn, $query);
	
	$to; $from;
	
	$username = "bekantan.terbang@gmail.com";
	$password = 'bekantanterbang';
	$subject = "[Notifikasi] Eco Patrol";
	/*$body = "[Aduan baru]
Pelapoe : $namapelapor ($emailpelapor)
Lokasi : $taman
Kategori : $kategori
Isi aduan : $aduan
Tanggal : $tanggal";*/
	
	while($row = mysqli_fetch_array($hasil)) {
		$to = array($row["email"] => $row["nama"]);
		$from = array($username => "Eco Patrol");
		//sendEmail($username, $password, $subject, $from, $to, $body);
		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
		$transport->setUsername('bekantan.terbang@gmail.com');
		$transport->setPassword('bekantanterbang');
		
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance();
		$message->setSubject('[Notifikasi] Eco Patrol');
		$message->setFrom(array('bekantan.terbang@gmail.com' => 'Bekantan'));
		$message->setTo(array($row["email"] => $row["nama"]));
		$message->setBody("[Aduan baru]
Pelapor : $namapelapor ($emailpelapor)
Lokasi : $taman
Kategori : $kategori
Isi aduan : $aduan
Tanggal : $tanggal");
		$mailer->send($message);
	}
	mysqli_free_result($hasil);
}

function sendEmailPelapor($emailpelapor) {
	$username = "bekantan.terbang@gmail.com";
	$password = 'bekantanterbang';
	$subject = "[Notifikasi] Eco Patrol";
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
		$transport->setUsername('bekantan.terbang@gmail.com');
		$transport->setPassword('bekantanterbang');
		
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance();
		$message->setSubject('[Notifikasi] Eco Patrol');
		$message->setFrom(array('bekantan.terbang@gmail.com' => 'Bekantan'));
		$message->setTo(array($emailpelapor => "Pelapor"));
		$message->setBody("Pengaduan anda sudah diterima. Terima kasih atas partisipasinya.");
		$mailer->send($message);
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