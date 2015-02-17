<?php
	require_once("database_connection.php");
	require_once("pengaduan.php");

	$tahun = $_GET['tahun'];
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "eco_patrol";
	$conn = connect_database($server, $username, $password, $dbname);

	$str = "[";

	//$tahun = '2015';
	for($i=1; $i<=12; $i++){
		if($i<10)
			$bulan = '0'.$i;
		else
			$bulan = $i;
		$query = 
		"SELECT COUNT(`id`) AS `jumlah` 
		FROM `pengaduan` 
		WHERE `tanggal` LIKE '$tahun-$bulan%' AND `status` NOT LIKE '%Belum diverifikasi%'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		if($i!=12)
			$str .= $row['jumlah'] . ", ";
		else
			$str .= $row['jumlah'] . "]";
	}

	mysqli_free_result($result);
	close_connection($conn);
?>
	<script src="ChartJS/Chart.js"></script>
	<div style="width:50%">
		<canvas id="canvas" height="300" width="450"></canvas>
	</div>
	<script type="text/javascript">
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

		var barChartData = {
			labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : <?php echo $str; ?>
				}
			]

		}
		window.onload = function(){
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myBar = new Chart(ctx).Bar(barChartData, {
				responsive : true
			});
		}
	</script>';