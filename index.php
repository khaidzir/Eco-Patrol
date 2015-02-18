<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/

Modified by : EcoPatrol
-->
<!DOCTYPE html>
<html>
<head>
<title>EcoPatrol : Park that you can trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="EcoPatrol, Bandung, Park, Lapor, Taman" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<!--fonts-->
<!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
 --><!--//fonts-->
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
</head>
<body>
	<script type="text/javascript">
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
			alert("Email salah!");
			return false;
		}
		return true;
	}
	function validateEmail() {
		var email = document.getElementById("Email").value;
		if(email.length > 0) {
			return cekEmail(email);
		} else {
			alert("Email salah!");
			return false;
		}
	}
	</script>

	<!--start-banner-->
	<div class="header" id="home">
	<div class="header-top">
		<ul class="nav">
		    <li><img src="images/Pemkot-logo.png" alt=""/></li>
			<li><img src="images/Eco-logo.png" alt=""/></li>
			
		</ul>
		<h2>SELAMAT DATANG DI ECOPATROL</h2>
		<h1>Website penjaga taman di Bandung</h1>
		<div class="header-top-bottom">
			<a href="#lapor" class="scroll"><img src="images/logo-3.png" alt=""/></a>
		</div>
	</div>
	<div class="header-home">
	<div class="fixed-header">
	   <div class="h_menu4"><!-- start h_menu4 -->
	   	<div class="header-left">
	   		<div class="header-left-logo">
	   			<ul class="nav">
				    <li><a href="index.html"><img src="images/Pemkot-logo-kecil.png" alt=""/></a></li>
					<li><a href="index.html"><img src="images/Eco-logo-kecil.png" alt=""/></a></li>
				</ul>
	   		</div>
   			<div class="header-left-text">
				<a class="toggleMenu" href="#"><img src="images/menu-icon.png" alt=""/></a>
				<ul class="nav">
				    <li><a href="#home" class="scroll">HOME</a></li>
					<li><a href="#pengaduan" class="scroll">LIST PENGADUAN</a></li>
					<li><a href="#about" class="scroll">ABOUT US</a></li>
					<li><a href="#login" class="scroll">LOGIN</a></li>
				</ul>
			</div>
				<div class="clearfix"></div>
				<script type="text/javascript" src="js/nav.js"></script>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
					</script>		
				 <!--script-->
		<script>
			$(document).ready(function(){
				$(".nav li a").click(function(){
					$(this).parent().addClass("active");
					$(this).parent().siblings().removeClass("active");
				});
			});
		</script>
			<!--script-for-sticky-nav-->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-home").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-home").addClass("fixed");
				}else{
					$(".header-home").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!--/script-for-sticky-nav-->
		</div>
		<div class="header-right">
			<ul>
				<li><a href="https://www.facebook.com/RKbdg?fref=ts"><span class="fb"> </span></a></li>
				<li><a href="https://twitter.com/ridwankamil"><span class="twit"> </span></a></li>
				<li><a href="https://www.youtube.com/user/DiskominfoBdg"><span class="yt"> </span></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
        </div><!-- end h_menu4 -->
       </div>
     </div>
	</div>
	<!--end-banner-->

	<!--start-lapor-->
	<div class="touch" id="lapor">
		<div class="container">
			<div class="touch-main">
				<h3>Laporkan</h3>
				<div class="touch-top">
					<div class="col-md-6 touch-left">
						<p>Apa Pengaduanmu?</p>
						<form method="post" onsubmit="return validateEmail();" action="submit-pengaduan.php" >
							<input type="text" placeholder="KTP/SIM" name="ID" required="true">
							<input type="text" placeholder="Nama" required="true" name="Nama">
							<input type="text" placeholder="Email" required="true" name="Email" id="Email">
							<input type="text" list="taman" placeholder="Taman" required="" name="Taman">
							<datalist id="taman">
							    <?php
									require_once("taman.php");
								?>
							</datalist>
							<input type="text" list="kategori" placeholder="Kategori" required="" name="Kategori">
							<datalist id="kategori">
							    <?php
									require_once("kategori.php");
								?>
							</datalist>
							<textarea placeholder="Isi Pengaduan (Foto jika ada)" required="" name="Aduan"></textarea>
							<input type="file" placeholder="Foto" name="datafile" size="40">
							<div class="sub-button">
								<input type="submit" value="Kirimkan">
							</div>
						</form>	
					</div>
					<div class="col-md-6 touch-right">
						<div class="touch-right-top">
							<h2>Pengaduan anda, sangat berarti bagi kami</h2>
						</div>
						<div class="touch-right-bottom">
							<div class="touch-right-top">
								<span class="add"> </span>
								<h4>Jl. Wastukancana No. 2,<label>Bandung, Jawa Barat</label></h4>
							</div>
							<div class="touch-right-top">
								<span class="mail"> </span>
								<p><a href="emainto:diskominfo@andung.go.id">diskominfo[at]bandung.go.id</a></p>
							</div>
							<div class="touch-right-top">
								<span class="num"> </span>
								<p>+62-22-4234793</p>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--end-lapor-->

	<!--start-list pengaduan-->
	<div class="clients" id="pengaduan">
		<div class="container">
			<div class="clients-mian">
				<h3>List Pengaduan</h3>
				<div  id="top" class="callbacks_container">
			      	<ul class="rslides" id="slider4">
			        <?php 
						require_once("list-aduan.php");
					?>
			      </ul>
			    </div>
			    <div class="clearfix"> </div>
			</div>
			<div class="clients-bottom">
				<!-- <p>Suara Pembaca</p>
				<div class="col-md-6 clients-bottom-top-left">
						<form>
							<input type="text" class="active" placeholder="Nama" required="">
							<textarea maxlength="150" placeholder="Kesan (Max. 150 karakter)" required=""></textarea>
							<div class="sub-button">
								<input type="submit" value="Kirimkan">
							</div>
						</form>	
					</div> -->
				<!-- <div class="col-md-6 clients-bottom-top-right">
					<div class="clients-btm">
						<div  id="top" class="callbacks_container">
			      		<ul class="rslides" id="slider5">
			        	<li>
							<div class="clients-btm-one">
								<img src="images/clients-4.png" alt=""/>
								<h4>ANNA DOE</h4>
								<P>Bego dah walkot</P>
							</div>
						</li>
						<li>
							<div class="clients-btm-one">
								<img src="images/clients-5.png" alt=""/>
								<h4>INGA NORTH</h4>
								<P>Putang Ina mo</P>
							</div>
						</li>
						<li>
							<div class="clients-btm-one">
								<img src="images/clients-6.png" alt=""/>
								<h4>JACOB PARKER</h4>
								<P>Dor</P>
							</div>
						</li>
			      		</ul>
			    		</div>
			    	<div class="clearfix"> </div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!--end-list pengaduan-->

	<!--Slider-Starts-Here-->
				<script src="js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager: true,
			        nav: true,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
			  <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider5").responsiveSlides({
			        auto: true,
			        pager: true,
			        nav: false,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
			<!--End-slider-script-->

	<!--start-about-->
	<div class="about" id="about">
		<div class="container">
			<div class="about-main">
				<h3>ABOUT US</h3>
					<div class="about-top">
					<div class="col-md-2 about-left">
							<img src="images/abt-1.png" alt=""/>
							<h4>Riva Syafri</h4>
							<h5>Project Manager</h5>
							<ul>
								<li><a href="#"><span class="twit"> </span></a></li>
								<li><a href="#"><span class="sap"> </span></a></li>
							</ul>
						</div>
						<div class="col-md-2 about-left">
							<img src="images/abt-1.png" alt=""/>
							<h4>Teofebano</h4>
							<h5>Designer</h5>
							<ul>
								<li><a href="#"><span class="twit"> </span></a></li>
								<li><a href="#"><span class="sap"> </span></a></li>
							</ul>
						</div>
						<div class="col-md-2 about-left">
							<img src="images/abt-1.png" alt=""/>
							<h4>Yusuf Rahmatullah</h4>
							<h5>Programmer</h5>
							<ul>
								<li><a href="#"><span class="fb"> </span></a></li>
								<li><a href="#"><span class="sap"> </span></a></li>
							</ul>
						</div>
						<div class="col-md-2 about-left">
							<img src="images/abt-1.png" alt=""/>
							<h4>Khaidzir Muhammad</h4>
							<h5>Programmer</h5>
							<ul>
								<li><a href="#"><span class="fb"> </span></a></li>
								<li><a href="#"><span class="sap"> </span></a></li>
							</ul>
						</div>	
						<div class="col-md-2 about-left">
							<img src="images/abt-1.png" alt=""/>
							<h4>Adhika Sigit</h4>
							<h5>Designer</h5>
							<ul>
								<li><a href="#"><span class="fb"> </span></a></li>
								<li><a href="#"><span class="sap"> </span></a></li>
							</ul>
						</div>		
					<div class="clearfix"></div>
					</div>
			</div>
		</div>
	</div>
	<!--end-about-->
	
	<!--start-login-->
	<div class="login" id="login">
		<div class="container">
			<div class="login-main">
				<h3>Login</h3>
				<div class="col-md-6 login">
						<form method="post" action="login.php">
							<input type="text" class="active" placeholder="Username" required="true" name="Username">
							<input type="password" class="active" placeholder="Password" required="true" name="Password">
							<div class="sub-button">
								<input type="submit" value="Kirimkan">
							</div>
						</form>							
					</div>
			</div>
		</div>
	</div>
	<!--end-login-->
</body>
</html>