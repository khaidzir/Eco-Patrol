<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Dashboard Admin EcoPatrol</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>
	
	<script type="text/javascript" src="admin.js"></script>
	
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="admin.php">Halaman Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="logout.php">Logout</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<?php 
				session_start();
				if(isset($_SESSION["username"]))
					$user = $_SESSION["username"]; 
				else
					header("location:index.php");
			?>
			<p>Admin <?php echo $user ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="admin.php">Halaman Admin</a> <div class="breadcrumb_divider"></div> </article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="#" onclick="return showComplains();" >Daftar Pengaduan</a></li>
			<li class="icn_categories"><a href="#">Daftar Kategori</a></li>
			<li class="icn_categories"><a href="#">Daftar Taman</a></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="#" onclick="return showUsers();">Lihat semua pengguna</a></li>
		</ul>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<h4 class="alert_info">Welcome Admin Page of EcoPatrol</h4>
		<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content">
				<article class="stats_graph">
					<p class="overview_today">Total Pengaduan : 
					<?php 
						require_once('pengaduan.php');
						echo countAllPost();
					?>
					</p>
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Hari ini</p>
						<p class="overview_count">
							<?php 
								echo countTodayPost();
							?>
						</p>
						<p class="overview_type">Pengaduan</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">Bulan ini</p>
						<p class="overview_count">
							<?php 
								echo countMonthPost();
							?>
						</p>
						<p class="overview_type">Pengauduan</p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Content Manager</h3>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content"> 
				<script type ="text/javascript">
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET", "aduan.php", true);
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("tab1").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.send();
				</script>
			</div><!-- end of #tab1 -->	
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		

		<!-- <article class="module width_quarter">
			<header><h3>Suara Pembaca</h3></header>
			<div class="message_list">
				<div class="module_content">
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
					<div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
				</div>
			</div>
			<footer>
				<form class="post_message">
					<input type="text" value="Message" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
					<input type="submit" class="btn_post_message" value=""/>
				</form>
			</footer>
		</article> --><!-- end of messages article -->
		

		<div class="clear"></div>
			<!-- <h4 class="alert_warning">A Warning Alert</h4>
			<h4 class="alert_error">An Error Message</h4>
			<h4 class="alert_success">A Success Message</h4> -->
		<div class="spacer"></div>
	</section>
</body>
</html>