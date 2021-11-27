<!DOCTYPE html>
<html lang="en">
<head>
<title>Legenda Batik</title>

<meta charset="utf-8">
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
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
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

<style>
* {box-sizing: border-box;}

.container-foto {
  position: relative;
  width: 50%;
  max-width: 300px;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute; 
  bottom: 0; 
  left: 0;
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  height: 30%;
  transition: .5s ease;
  opacity:0;
  color: white;
  font-size: 20px;
  padding: 20px;
  text-align: center;
}

.container-foto:hover .overlay {
  opacity: 1;
}
</style>
</head>

<body>
<div class="preloader-full-height" id="preloading">
	<img id="me" src="<?php echo base_url();?>images/logo-icon.png">
	<h4>LOADING ...</h4>
</div>

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
				</li>
				<li class="menu_item"><a href="#">Term & Condition</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
		<div class="hamburger_footer"><img src="<?php echo base_url();?>images/logo.jpg" width="160px"></div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
	</div>

	

	<!-- Blogs -->

	<div class="blogs">
		<div class="container">
<?php 
	if($toko->nama_toko!=""){
?>
                	<ul class="navbar_menu">
                		<li><a href="<?php echo base_url();?>Cont/ke_toko" style="border-style: solid;">Jualan</a></li>
                		<li><a href="<?php echo base_url();?>Cont/ke_isi_toko" style="border-style: solid;">Isi Toko</a></li>
                		<li><a href="<?php echo base_url();?>Cont/ke_pembayaran_toko" style="border-style: solid;">List Pembayaran</a></li>
                		<li><a href="<?php echo base_url();?>Toko/laporan_toko" style="border-style: solid;">Laporan Toko</a></li>
                	</ul>
<?php
	}
?>
			<div class="row">
				<div class="col-xl-6 order-xl-1">
				  <div class="card">
					<div class="card-header">
					  <div class="row align-items-center">
						<div class="col-8">
						  <h3 class="mb-0">Detail Toko </h3>
						</div>
					  </div>
					</div>
					<div class="card-body">
						<?php
							echo form_open_multipart("Cont/update_toko","method='post' id='form-update'");
							echo form_hidden('id_toko', $toko->id_toko);
						?>
					  <!-- <form method="post" action="<?php echo base_url("index.php/Cont/update_toko");?>" id="form-update"> -->
						<h6 class="heading-small text-muted mb-4">Informasi Toko</h6>
						<div class="col-lg-12 center">

						  <div type="file" class="form-group container-foto" >
							<img src="
							<?php
								if($toko->foto_toko!="" && $toko->foto_toko!=null){
									echo base_url('ikontoko/'.$toko->foto_toko);
								}
								else{
							?>
									https://www.w3schools.com/howto/img_avatar.png
							<?php
								}
							?>" 
							id="blah"  style="cursor: pointer;" class="image">
							<?php
								echo form_upload('foto_toko','',"id='imgInp' class='overlay'");
							?>
							<!-- <input type="file" name="foto_toko" id="imgInp" class="overlay"> -->
						  </div>

						</div>
						<div class="pl-lg-4">
						  <div class="row">
							<div class="col-lg-6">
							  <div class="form-group">
								<label class="form-control-label" for="input-username">Domain Toko</label>
								<input type="text" id="input-username" name="input-link" class="form-control" value="<?php echo $toko->link;?>">
								<?php echo form_error('input-link'); ?>
							  </div>
							</div>
							<div class="col-lg-6">
							  <div class="form-group">
								<label class="form-control-label" for="input-nama">Nama Toko</label>
								<input type="text" id="input-username" name="input-nama" class="form-control" value="<?php echo $toko->nama_toko;?>">
								<?php echo form_error('input-nama'); ?>
							  </div>
							</div>
						  </div>
						  <div class="row">
							<div class="col-lg-6">
							  <div class="form-group">
								<label class="form-control-label" for="input-first-name">Telp Toko</label>
								<input type="text" id="input-first-name" name="input-telp" class="form-control" placeholder="Telp Toko" value="<?php echo $toko->telp_toko;?>">
								<?php echo form_error('input-telp'); ?>
							  </div>
							</div>
							<div class="col-lg-6">
							  <div class="form-group">
								<label class="form-control-label" for="input-first-name">Slogan Toko</label>
								<input type="text" id="input-first-name" class="form-control" placeholder="Slogan Toko" name="input-slogan" value="<?php echo $toko->slogan;?>">
								<?php echo form_error('input-slogan'); ?>
							  </div>
							</div>
						  </div>
						</div>
						<div class="pl-lg-4">
						  <div class="form-group">
							<label class="form-control-label">About Me</label>
							<textarea rows="4" class="form-control" name ="input-about"form="form-update" placeholder="A few words about you ..."><?php echo $toko->about?></textarea>
						  </div>
						</div>
					</div>
				  </div>
				</div>
				<div class="col-xl-6 order-xl-1">
				  <div class="card">
					<div class="card-header">
					  <div class="row align-items-center">
						<div class="col-8">
						  <h3 class="mb-0">Lokasi</h3>
						</div>
					  </div>
					</div>
					<div class="card-body">
						<h6 class="heading-small text-muted mb-4">Lokasi Toko</h6>
						<div class="pl-lg-4">
						  <div class="row">
							<div class="col-lg-12">
							  <div class="form-group">
								<label class="form-control-label" for="input-username">Provinsi</label>
								<input type="text" id="input-username" name="input-provinsi"class="form-control" placeholder="Provinsi" value="<?php echo $toko->provinsi;?>">
								<?php echo form_error('input-provinsi'); ?>
							  </div>
							</div>
							<div class="col-lg-12">
							  <div class="form-group">
								<label class="form-control-label" for="input-username">Kota</label>
								<input type="text" id="input-username" name="input-kota" class="form-control" placeholder="Kota" value="<?php echo $toko->kota;?>">
								<?php echo form_error('input-kota'); ?>
							  </div>
							</div>
							<div class="col-lg-12">
							  <div class="form-group">
								<label class='form-control-label' for="input-username">Kecamatan</label>
								<input type="text" id="input-username" name="input-kecamatan"class="form-control" placeholder="Kecamatan" value="<?php echo $toko->kecamatan;?>">
								<?php echo form_error('input-kecamatan'); ?>
							  </div>
							</div>
							<div class="col-lg-12">
							  <div class="form-group">
								<label class="form-control-label" for="input-username">Kode Pos</label>
								<input type="text" id="input-username" name="input-kodepos"class="form-control" placeholder="Kode Pos" value="<?php echo $toko->kodepos;?>">
								<?php echo form_error('input-kodepos'); ?>
							  </div>
							</div>
						  </div>
						</div>
						<hr class="my-4">
						<h6 class="heading-small text-muted mb-4">Lokasi Pickup</h6>
						<div class="pl-lg-4">
						  <div class="row">
							<div class="col-md-12">
							  <div class="form-group">
								<label class="form-control-label" for="input-address">Alamat Toko</label>
								<input id="input-address" name="input-alamat"class="form-control" placeholder="Alamat toko" value="<?php echo $toko->alamat_toko;?>" type="text">
								<?php echo form_error('input-alamat')."<br>"; ?>
								<?php echo form_submit("register","Save","class='button-login'");?>
							  </div>
							</div>
						  </div>
						</div>
					  </form>
					</div>
				  </div>
				</div>
			  </div>
            </div></div>
                <br>
			  <div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(<?php echo base_url();?>images/blog_jambi.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Batik Jambi</h4>
							<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(<?php echo base_url();?>images/blog_madura.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Batik Madura</h4>
							<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(<?php echo base_url();?>images/blog_sumatra.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Batik Sumatra</h4>
							<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
			</div>
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
						<div class="cr">©2019 <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Legenda Batik</a></div>
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
					<form action="#" class="form-login">
						<h3>Create Account</h3>
						<br>
						<input type="text" placeholder="Name" />
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<input type="password" placeholder="Confirm Password" />
						<br>
						<button class="button-login">Register</button>
						<br>
						<span>or use your account for login</span>
						<div class="social-container">
							<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
							<a href="#" class="social"><i class="fa fa-google"></i></a>
						</div>
					</form>
				</div>
				<div class="form-container sign-in-container">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<form action="#" class="form-login">
						<h3>Sign in</h3>
						<br>
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<br>
						<button class="button-login">Sign In</button>
						<br>
						<span>or use your account for login</span>
						<div class="social-container">
							<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
							<a href="#" class="social"><i class="fa fa-google"></i></a>
						</div>
						<br>
						<a href="#">Forgot your password?</a>
					</form>
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
	
	function showLoginModal(){
		$("#signIn").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
	
	function showRegisterModal(){
		$("#signUp").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
	function myFunction() {
 		 var x = document.getElementById("upload");
 		 x.disabled = true;
	}

	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#imgInp").change(function(){
	    readURL(this);
	});

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