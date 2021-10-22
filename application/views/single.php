<!DOCTYPE html>
<html lang="en">
<head>
<title>Single Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Legenda Batik">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.css">

<link href="<?php echo base_url();?>plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/animate.css">

<link rel="stylesheet" href="<?php echo base_url();?>plugins/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/single_responsive.css">

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
<script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.scrollUp.min.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
<script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
<script src="<?php echo base_url('asset/js/main.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function () {	
		$("#addtocart").click(function(){
			var id=$("#idbarang").val();
			var jumlah = $("#quantity_value").html();
			var size = $(".product_size").val();
			var login_sess= "<?php echo $this->session->userdata('login');?>";
			// alert(login_sess);
			if(login_sess==""){
				showLoginModal();
			}
			else{
			$.post("<?php echo base_url(); ?>"+'index.php/Cont/cart',{id:id,jumlah:jumlah,size:size},function(value){
						window.location = "<?php echo site_url("Cont/showdetail"); ?>";
						});	
			}
		});
		$("#review_submit").click(function() {
			var login_sess= "<?php echo $this->session->userdata('login');?>";
			var rate=$("#rate").val();
			var message=$("#review_message").val();
			var user=$("#user").val();
			// alert(user);
			if(login_sess==""){
				showLoginModal();
			}
			else{
			$.post("<?php echo base_url(); ?>"+'index.php/Cont/addRating',{rate:rate,user:user,message:message},function(value){
						window.location = "<?php echo site_url("Cont/showdetail"); ?>";
						});	
			}
		});
		$(".fa-star-o").hover(function() {
			//hover down function
			var value=$(this).attr("value");
			// alert(value);
			for (var i = 0; i < value; i++) {
				// alert(i);
				var click=$(".star"+""+(i+1)).attr("click");
				if(click=="false"){
					$(".star"+""+(i+1)).addClass("fa-star");
					$(".star"+""+(i+1)).removeClass("fa-star-o");
				}
			}
		}, function(){
			//hover up function
			var value=$(this).attr("value");
			for (var i = 0; i < value; i++) {
				var click=$(".star"+""+(i+1)).attr("click");
				if(click=="false"){
					$(".star"+""+(i+1)).addClass("fa-star-o");
					$(".star"+""+(i+1)).removeClass("fa-star");
				}
			}	
		});

		$(".fa-star-o").click(function(){
			var ctr=$(this).attr("value");
			$("#rate").attr("value",ctr);
			for (var i = 1; i <=5; i++) {
				if(i<=ctr){
				// alert("true");
					$(".star"+""+(i)).addClass("fa-star");
					$(".star"+""+(i)).removeClass("fa-star-o");
					var click=$(".star"+""+(i)).attr("click","true");
				}
				else{
				// alert("false");
					$(".star"+""+(i)).removeClass("fa-star");
					$(".star"+""+(i)).addClass("fa-star-o");
					var click=$(".star"+""+(i)).attr("click","false");
				}
			}

			
		});
	});


	function showLoginModal(){
		$("#signIn").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
	
	function showRegisterModal(){
		$("#signUp").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
</script>
</head>

<body>
<div class="super_container">


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

	<div class="container single_product_container">
		<!-- <div class="row">
			<div class="col">

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="categories.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Men's</a></li>
						<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product</a></li>
					</ul>
				</div>

			</div>
		</div> -->
		<input type="hidden" id="idbarang" value="<?php echo $barang->barang_id?>">
		<div class="row">
			<div class="col-lg-7">
				<div class="single_product_pics">
					<div class="row">
						<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
							<div class="single_product_thumbnails">
								<ul>
									<!--data-image="images/single_1.jpg"-->
									<li class="active"><img src="<?php echo '../resource/'.str_replace(' ', '%20', $barang->foto).' ';?>" data-image="<?php echo '../resource/'.str_replace(' ', '%20', $barang->foto).' ';?>" alt="" style="height: 100%;width: 100%;"></li>
									<?php
										foreach ($detail_foto as $key) {
											?>
											<li><img src="../detail/<?php echo $key->nama_gambar?>" alt="" data-image="../detail/<?php echo $key->nama_gambar?>" style="height: 100%;width: 100%;"></li>
											<?php
										}
									?>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 image_col order-lg-2 order-1">
							<div class="single_product_image">
								<div class="single_product_image_background" style="background-image:url(../resource/<?php echo str_replace(' ', '%20', $barang->foto);?>);background-size: 100% auto"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="product_details">
					<div class="product_details_title">
						<h2><?php echo $barang->barang_nama;?></h2>
						<p><?php echo $barang->deskripsi;?></p>
					</div>
					<div class="free_delivery d-flex flex-row align-items-center justify-content-center" style="margin: 0">
						<span><a href="<?=site_url('Cont/detail_toko/'.$barang->id_toko)?>">Kunjungi Toko</a></span>
					</div>
					<div class="product_price">Rp. <?php echo number_format($barang->harga_satuan,2,'.',',')?></div>
					<div class="product_color">
						<span>Select Size:</span>
						<select class="product_size">
							<option>XS</option>
							<option>S</option>
							<option>M</option>
							<option>L</option>
							<option>XL</option>
						</select>
					</div>
					<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
						<span>Quantity:</span>
						<div class="quantity_selector">
							<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
							<span id="quantity_value">1</span>
							<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
						</div>
						<!-- <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div> -->
						<!-- <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div> -->
					</div>
					<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
						<span>Left: <?php echo $barang->barang_stok;?></span>
					</div>
					<br><a href="#" class="button-login" id="addtocart">Add To Cart</a>
				</div>
			</div>
		</div>

	</div>

	<!-- Tabs -->

	<div class="tabs_section_container">

		<div class="container">
			<div class="row">
				<div class="col">
 <!-- Tab Description -->

					<!-- Tab Reviews -->

						<div class="row">

							<!-- User Reviews -->

							<div class="col-lg-6 reviews_col">
								<div class="tab_title reviews_title">
									<h4>Reviews</h4>
								</div>

								<!-- User Review -->
								<?php
								foreach ($komentar as $key) {
									?>
									<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic"><?php
											if($key->foto_user!=null){
												?>
												<img src="<?php echo base_url('fotouser/'.$user->foto_user);?>" style="height: 100%;width: 100%">
												<?php
											}
										?></div>
										<div class="user_rating">
											<ul class="star_rating">
												<?php
												switch ($key->star) {
													case 0:
												        echo "
											        	<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
												        ";
												        break;
												    case 1:
												        echo "
											        	<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
												        ";
												        break;
												    case 2:
												    	echo "
											        	<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
												        ";
												        break;
												    case 3:
												        echo "
											        	<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
												        ";
												        break;
												    case 4:
												        echo "
											        	<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star-o' aria-hidden='true'></i></li>
												        ";
												        break;
												    case 5:
												        echo "
											        	<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
														<li><i class='fa fa-star' aria-hidden='true'></i></li>
												        ";
												        break;
												}
												?>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date"><?php echo $key->date;?></div>
										<div class="user_name"><?php echo$key->nama_user;?></div>
										<p><?php echo $key->komentar;?></p>
									</div>
								</div>
								<?php
								}
								?>
								

							</div>

							<!-- Add Review -->

							<div class="col-lg-6 add_review_col">

								<div class="add_review">
									<?php
										echo form_open('Cont/addRating', '', "id='review_form");
									?>
										<div>
											<h1>Add Review</h1>
										</div>
										<div>
											<h1>Your Rating:</h1>
											<input type="hidden" name="user" id="user" value="<?php echo $this->session->userdata('id_login');?>">
											<input type="hidden" name="rate" value="0" id="rate">
											<ul class="user_star_rating">
												<li><i class="fa fa-star-o star1" value=1 aria-hidden="true" click="false"></i></li>
												<li><i class="fa fa-star-o star2" value="2" aria-hidden="true" click="false"></i></li>
												<li><i class="fa fa-star-o star3" value="3" aria-hidden="true" click="false"></i></li>
												<li><i class="fa fa-star-o star4" value="4" aria-hidden="true" click="false"></i></li>
												<li><i class="fa fa-star-o star5" value="5" aria-hidden="true" click="false"></i></li>
											</ul>
											<textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
										</div>
										<div class="text-left text-sm-right">
											<button id="review_submit" type="button" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
										</div>
									</form>
								</div>

							</div>

						</div>

				</div>
			</div>
		</div>

	</div> -->

	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
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

</div>

<script src="<?php echo base_url();?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url();?>js/single_custom.js"></script>
</body>

</html>
