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

function showTaman() {
	ajaxPost("daftar-taman.php");
}

function showKategori() {
	ajaxPost("daftar-kategori.php");
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
		ajaxGet("hapus-pengguna.php?user="+username);
	}
}

function deleteUser(username) {
	var cek = confirm("Apakah anda yakin akan menghapus user " + username + "?");
	if (cek == true) {
		return showUsers(1, username);
	}
	return false;
}