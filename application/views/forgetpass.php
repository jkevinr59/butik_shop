<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Legenda Batik</title>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Legenda Batik">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--
	Favicon
-->
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>favicon/favicon-16x16.png">
<!-- <link rel="manifest" href="/manifest.json"> -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--
	selanjut nya
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.css">
<link href="<?php echo base_url();?>plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/additional_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/preloader.css">
<script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.scrollUp.min.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
<script src="<?php echo base_url('asset/js/main.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function () {	
	    $('a').click(function(){
			var temp = $(this).prop('name');
			var id = $(this).prop('id');
			if(temp=="cart"){
				var login_sess= "<?php echo $this->session->userdata('login');?>";
				if(login_sess!=null){
					showLoginModal();
				}
				else{
					$.post("<?php echo base_url(); ?>"+'index.php/Cont/getcart',{id:id},function(value){
							
							});
				}
			}
			else if(temp=="detail") {
				  	$.post("<?php echo base_url(); ?>"+'index.php/Cont/getdetail',{id:id},function(value){
						window.location = "<?php echo site_url("Cont/showdetail"); ?>";
						});
				}
		});
	});
</script>
</head>

<body>
<!-- <div class="preloader-full-height" id="preloading">
	<img id="me" src="<?php echo base_url();?>images/logo-icon.png">
	<h4>LOADING ...</h4>
</div> -->

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<!-- <div class="logo"></div> -->
							<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.jpg" width="150px"></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="<?php echo base_url();?>" class="actived">Home</a></li>
								<li><a href="#">Region Setting</a></li>
								<li><a href="#">Term & Condition</a></li>
								<li><a href="contact.html">contact</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true" onclick="onFocusSearch()"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li> -->
								<li class="account">
									<a>
										<i class="fa fa-user" aria-hidden="true"></i>
									</a>
									<?php
										
									?>
									<ul class="account_selection">
										<?php
										if($this->session->userdata('login')==""){
										?>
										<div class="widgets_div" onclick="showLoginModal()">
											<div class="icon_div">
												<span><i class="fa fa-sign-in"></i></span>
											</div>
											<div class="text_div">
												<span>Sign In</span>
											</div>
										</div>
										<div class="widgets_div" onclick="showRegisterModal()">
											<div class="icon_div">
												<span><i class="fa fa-user-plus"></i></span>
											</div>
											<div class="text_div">
												<span>Register</span>
											</div>
										</div>
										<?php
										}
										else{
											?>
											<div class="widgets_div">
											<div class="icon_div">
												<span><i class="fa fa-user"></i></span>
											</div>
											<div class="text_div">
												<span><a href="<?php echo site_url("Cont/showeditprofile")?>"><?php echo $this->session->userdata('login');?></a></span>
											</div>
											</div>
											<div class="widgets_div"><div class="icon_div">
												<span><i class="fa fa-shopping-bag"></i></span>
											</div>
											<div class="text_div">
												<span><a href="<?php echo site_url('Cont/ke_toko');?>">Toko</a></span>
											</div>
											</div>
											<div class="widgets_div">
												<div class="icon_div">
													<span><i class="fa fa-sign-out"></i></span>
												</div>
												<div class="text_div">
													
													<span><a href="<?php echo site_url("Cont/logout")?>">Logout</a></span>
													
												</div>
											</div>
											<?php
										}
										?>
									</ul>
								</li>
								<li class="checkout" 
								<?php if($this->session->userdata('login')==""){?>
								onclick="showLoginModal()"
								<?php
								    }
								    ?>
								>
									<a href="
									<?php
									if($this->session->userdata('login')!=""){
									    $tmp = $this->Model->getIdUser($this->session->userdata('login'));
                                		$id='';
                                		foreach($tmp as $row)
                                		{
                                			$id = $row->Id_user;
                                		}
                                		$temp = $this->Model->ceksudahbayar($id);
                                		$cek = false;
                                		foreach($temp as $row)
                                		{
                                			if($row->Status_pembayaran == 0)
                                			{
                                				$cek=true;
                                			}
                                		}
                                		if($cek){
									        echo site_url('Cart/checkout');    
                                		}
                                		else{
									        echo site_url('Cont/viewcart');      
                                		}
									}
									else{
									    echo "#";
									}
									    ?>
									">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									</a>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>

			<hr class="hr-brown">
			<hr class="hr-red">
			<hr class="hr-brown">
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						My Account
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a onclick="showLoginModal()">Sign In&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
						<li><a onclick="showRegisterModal()">Register&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
					</ul>
				</li>
				<li class="menu_item has-children">
					<a href="#">
						Region Setting
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#">Indonesia</a></li>
						<li><a href="#">Singapore</a></li>
					</ul>
				</li>
				<li class="menu_item"><a href="#">Term & Condition</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
		<div class="hamburger_footer"><img src="<?php echo base_url();?>images/logo.jpg" width="160px"></div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
		<div class="main_slider_banner">
			<?php
				echo form_open('Cont/forget_pass',"class='form-login' id='form_login'");
				echo "<h3>Forgot Password</h3>";
				echo form_input("email","","placeholder='Email Address'");
				if(isset($email_error)){
				?>
					<p><font color="red">*<?php echo $email_error;?></font></p>
				<?php	
				}
		        echo "<button class='button-login' form='form_login' name='login'>Send new Password</button>";
				echo form_close();
			?>
		</div>
	</div>


	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="contact.html">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">??2019 <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Legenda Batik</a></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="btn-group-fab" role="group" aria-label="FAB Menu" onclick="scrollToTop()" id="btnToTop">
		<div>
			<button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="Menu"> <i class="fa fa-arrow-up"></i> </button>
		</div>
	</div>

	<!-- The social media icon bar -->
	<div class="icon-bar">
		<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
		<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
		<a href="#" class="google"><i class="fa fa-google"></i></a>
		<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
		<a href="#" class="youtube"><i class="fa fa-youtube"></i></a>
	</div>

</div>
<div class="box">
    <div class="navbox"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-body">
			<div class="container-login" id="container-login">
				<div class="form-container sign-up-container">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<?php
						echo form_open('Cont/register',"class='form-login' id='form_register' ");
						echo "<h3>Register</h3>";
						echo form_input("nama","","placeholder='Name' style='margin:0 0'");
						echo "<div style='margin:0 0'>";
						echo form_error("nama", '', '',"");
						echo "</div>";
						echo form_input("email","","placeholder='Email Address' style='margin:0 0'");
						echo "<div style='margin:0 0'>";
						echo form_error("email");
						echo "</div>";
						echo form_password("password","","placeholder='Password' style='margin:0 0'");	
						echo "<div style='margin:0 0'>";
						echo form_error("password", '', '');
						echo "</div>";
						echo form_password("conpass","","placeholder='Confirm Password' style='margin:0 0'");
						echo "<div style='margin:0 0'>";
						echo form_error("conpass", '', '');
						echo "</div>";
				        echo "<button class='button-login' form='form_register' name='register'>Register</button>";
						echo "
						<div class='social-container'>
							<a href='#' class='social'><i class='fa fa-facebook-f'></i></a>
							<a href='#' class='social'><i class='fa fa-google'></i></a>
						</div>
						<a href='#'>Forgot your password?</a>";
						echo form_close();
					?>
				</div>
				<div class="form-container sign-in-container">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<?php
						echo form_open('Cont/login',"class='form-login' id='form_login'");
						echo "<h3>Sign in</h3>";
						echo form_input("email","","placeholder='Email Address'");
						if(isset($email_error)){
						?>
							<p><font color="red">*<?php echo $email_error;?></font></p>
						<?php	
						}
						echo form_password("password","","placeholder='Password'");	
						if(isset($pass_salah)){
						?>
							<p><font color="red">*<?php echo $pass_salah;?></font></p>
						<?php	
						}
				        echo "<button class='button-login' form='form_login' name='login'>Login</button>";
						echo "<span>or use your account for login</span>
						<div class='social-container'>
							<a href='#' class='social'><i class='fa fa-facebook-f'></i></a>
							<a href='#' class='social'><i class='fa fa-google'></i></a>
						</div>
						<br>
						<a href='#'>Forgot your password?</a>";
						echo form_close();
					?>
				</div>
				<div class="overlay-container">
					<div class="overlay">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="overlay-panel overlay-left">
							<p>Keep connected with us</p>
							<button class="button-login ghost" id="signIn">Sign In</button>
						</div>
						<div class="overlay-panel overlay-right">
							<h1></h1>
							<p>Enter your personal details and start journey with us</p>
							<button class="button-login ghost" id="signUp">Register</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>js/custom.js"></script>
<script src="<?php echo base_url();?>js/preload.js"></script>
</body>

</html>


<script>
	const container = document.getElementById('container-login');

	$('#btnToTop').fadeOut();

	$( "#signUp" ).click(function() {
		$(".sign-in-container").hide();
		$(".sign-up-container").show();
		container.classList.add("right-panel-active");
	});

	$( "#signIn" ).click(function() {
		$(".sign-in-container").show();
		$(".sign-up-container").hide();
		container.classList.remove("right-panel-active");
	});

	$(window).scroll(function() {
		if ($(this).scrollTop()) {
			$('#btnToTop:hidden').stop(true, true).fadeIn();
		} else {
			$('#btnToTop').stop(true, true).fadeOut();
		}
	});

	function scrollToTop(){
		$('html, body').animate({scrollTop: '0px'}, 300);
	}
	
	function onFocusSearch() {
		$("#searching").focus();
	}

	function showLoginModal(){
		$("#signIn").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
	
	function showRegisterModal(){
		$("#signUp").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
</script>

<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5dedcbe1d96992700fcb5cbd/1drnchuei';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
</script>