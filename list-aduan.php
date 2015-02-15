<?php
	require_once("database_connection.php");
	require_once("pengaduan.php");
	
	$server = "";
	$username = "root";
	$password = "";
	$db = "eco_patrol";
	$conn = connect_database($server, $username, $password, $db);
	
	$query = "SELECT pengaduan.deskripsi, taman.nama FROM pengaduan, taman
				WHERE pengaduan.id_taman = taman.id
				ORDER BY pengaduan.tanggal DESC";
	
	$result = mysqli_query($conn, $query);
	$counter = 0;
	$i = 0;
	while ($i < mysqli_num_rows($result)) {
		echo "
		<li>
			<div class='clients-top'>";
			for (;;) {
				if ($counter == 3)
					break;
				$row = mysqli_fetch_array($result);
				if ($row) {
					$taman = $row["nama"];
					$aduan = $row["deskripsi"];
					echo "
					<div class='clients-left'>
						<h1>$taman</h1>
						<p>$aduan</p>
					</div>";
					$counter++;
					$i++;
				} else
					break;
			}
		echo "
				<div class='clearfix'></div>
			</div>
		</li>";
		$counter = 0;
	}
?>