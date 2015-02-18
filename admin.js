function ajaxPost(filePhp) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("POST",filePhp, true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}

function ajaxGet(filePhp) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET",filePhp, true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}


/************** Fungsi-fungsi Pengaduan ******************/
function showComplains(flag, id, kategori, taman) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if (flag == 0) {
		ajaxPost("aduan.php", true);
	} else if (flag == 1) {	//Menghapus aduan
		ajaxGet("ubah-pengaduan.php?del="+id);
	} else if (flag == 2) {	//accept pengaduan
		ajaxGet("ubah-pengaduan.php?acc="+id+"&kat="+kategori+"&tmn="+taman);
	} else if (flag == 3) {	// pengaduan selesai ditangani
		ajaxGet("ubah-pengaduan.php?done="+id);
	}
}

function deletePengaduan(id) {
	var cek = confirm("Apakah anda yakin akan menghapus pengaduan ini?");
	if (cek == true) {
		return showComplains(1, id, 0, 0);
	}
	return false;
}

function acceptPengaduan(id, kategori, taman) {
	var cek = confirm("Apakah anda yakin akan menerima aduan ini?");
	if (cek) {
		return showComplains(2, id, kategori, taman);
	}
	return false;
}

function selesaiPengaduan(id) {
	var cek = confirm("Apakah anda yakin aduan ini telah diselesaikan?");
	if (cek) {
		return showComplains(3, id, 0, 0);
	}
	return false;
}

/********************* Fungsi-fungsi User ********************/
function showUsers(flag, username) {
	if (flag == 0)
		ajaxPost("daftar-pengguna.php");
	else if (flag == 1) {	// Delete user
		ajaxGet("ubah-pengguna.php?del="+username);
	}
}

function deleteUser(username) {
	var cek = confirm("Apakah anda yakin akan menghapus user " + username + "?");
	if (cek == true) {
		return showUsers(1, username);
	}
	return false;
}

function initEditUser(idBaris, user) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","init-edituser.php?row="+idBaris+"&user="+user, true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(idBaris).innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}

function editUser(username, nama, jabatan, email) {
	var name = document.getElementById(nama).value;
	var jab = document.getElementById(jabatan).value;
	var mail = document.getElementById(email).value;
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var params = "user="+username+"&nama="+name+"&jabatan="+jab+"&email="+mail;
	xmlhttp.open("POST","ubah-pengguna.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(params);
	return true;
}

function initAddUser() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","init-add-data.php?id=user", true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab2").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}

function addUser(iduser, idpass, idnama, idjabatan, idemail) {
	var username = document.getElementById(iduser).value;
	var password = document.getElementById(idpass).value;
	var nama= document.getElementById(idnama).value;
	var jabatan = document.getElementById(idjabatan).value;
	var email = document.getElementById(idemail).value;
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var params = "auser="+username+"&apassword="+password+"&anama="+nama+"&ajabatan="+jabatan+"&aemail="+email;
	xmlhttp.open("POST","ubah-pengguna.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(params);
	return true;
}


/****************** Fungsi-fungsi kategori ***********************/
function showKategori(flag, id) {
	if (flag == 0) {
		ajaxPost("daftar-kategori.php");
	} else if (flag == 1) {	// Menghapus kategori
		ajaxGet("ubah-kategori.php?del="+id);
	}
}

function deleteKategori(id) {
	var cek = confirm("Apakah anda yakin akan menghapus kategori ini?");
	if (cek == true) {
		return showKategori(1, id);
	}
	return false;
}

function initAddKategori() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","init-add-data.php?id=kategori", true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab2").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}

function addKategori(idkategori) {
	var kategori = document.getElementById(idkategori).value;
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var params = "akategori="+kategori;
	xmlhttp.open("POST","ubah-kategori.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(params);
	return true;
}


/******************** Fungsi-fungsi taman *****************************/
function showTaman(flag, id) {
	if (flag == 0) {
		ajaxPost("daftar-taman.php");
	} else if (flag == 1) {		// Menghapus taman
		ajaxGet("ubah-taman.php?del="+id);
	}
}

function deleteTaman(id) {
	var cek = confirm("Apakah anda yakin akan menghapus taman ini?");
	if (cek == true) {
		return showTaman(1, id);
	}
	return false;
}

function initAddTaman() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("POST","init-add-data.php?id=taman", true);
	//xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab2").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	return true;
}

function addTaman(idnama, iddesc, idlokasi) {
	var nama = document.getElementById(idnama).value;
	var deskripsi = document.getElementById(iddesc).value;
	var lokasi = document.getElementById(idlokasi).value;
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var params = "anama="+nama+"&adesc="+deskripsi+"&alokasi="+lokasi;
	xmlhttp.open("POST","ubah-taman.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("tab1").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(params);
	return true;
}

/******************** Validasi Email ***************************/
function hitungAt(email) {
	var i;
	var count=0;
	for (i=0; i<email.length; i++) {
		if (email.charAt(i) == '@') {
			count++;
		}
	}
	return count;
}
function cekEmail(email) {
	var at = email.indexOf("@");
	var dot = email.lastIndexOf(".");
	if (hitungAt(email)>1 || at<1 || dot<at+2 || dot+2 > email.length) {
		return false;
	}
	return true;
}
function validateEmail() {
	alert("OI");
	var email = document.getElementById(idemail).value;
	alert(email);
	if(email.length > 0) {
		return cekEmail(email);
	} else {
		return false;
	}
}