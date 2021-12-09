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
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/cart.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/cart_responsive.css">
<!-- <link rel="manifest" href="/manifest.json"> -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--
	selanjut nya
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.css">
<link href="<?php echo base_url();?>plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/bootstrap-4.1.2/bootstrap.min.css">
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
	<script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('asset/js/jquery.scrollUp.min.js');?>"></script>
    <script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
    <script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
    <script src="<?php echo base_url('asset/js/main.js');?>"></script>
    <script>
	 $(document).ready(function () {	
	 	var id='';
	 		$('input[type=button]').click(function(){
 				id = $(this).attr('id');
 				var nama = $(this).attr('name');
 				if(nama=="delete")
 				{
 					$.post("<?php echo base_url(); ?>"+'index.php/Cont/deletecart',{id:id},function(value){
						window.location = "<?php echo site_url("Cont/viewcart"); ?>";
					});

 				}
	 		});
	 		$(".button_clear").click(function() {
	 			$.post("<?php echo base_url(); ?>"+'index.php/Cont/deleteallcart',{},function(value){
						window.location = "<?php echo site_url("Cont/viewcart"); ?>";
					});
	 		});
	 		$('#promo').change(function() {
 				if(this.checked)
 				{
 					 $('#inputkode').removeAttr("disabled")
 				}
 				else
 				{
 					$('#inputkode').attr("disabled", "disabled");  
 				}
	 		});

	 		$('.qty_button').click(function(){
 				var id = $(this).attr('id');
	 			var jumlah = $("#jml_brg_".concat(id)).html();
	 			var size=$("#size_brg_".concat(id)).html();
	 			if($(this).attr("class")[4]=="s"){
	 				jumlah--;
	 			}
	 			else{
	 				jumlah++;
	 			}
 				$.post("<?php echo base_url(); ?>"+'index.php/Cont/getpricecart',{id:id,jumlah:jumlah,size:size},function(value){
						window.location = "<?php echo site_url("Cont/updatecart"); ?>";
					});
	 		});
	 		$(".shipping_radio").change(function() {
				console.log($(this));
	 			var radio_id= $(this).attr('id')
	 			var harga_antar;
	 			if(radio_id=="radio_1"){
	 				harga_antar = $(".shipping_price_1").attr("harga");
	 			}
	 			else if(radio_id=="radio_2"){
	 				harga_antar = $(".shipping_price_2").attr("harga");
	 			}
	 			else{
	 				harga_antar = 0;
	 			}
	 			$(".cart_extra_total_value_shipping").html("Rp. "+Intl.NumberFormat(['ban', 'id']).format(harga_antar)+",00");
	 			var Subtotal = $(".cart_extra_total_value").attr("harga");
	 			var grandtotal = parseInt(Subtotal)+parseInt(harga_antar);
	 			$(".cart_extra_total_value_gt").html("Rp. "+Intl.NumberFormat(['ban', 'id']).format(grandtotal)+",00");
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
				</li>
				<li class="menu_item"><a href="#">Term & Condition</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
		<div class="hamburger_footer"><img src="images/logo.jpg" width="160px"></div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
			<div class="row">
					<div class="col text-center">
						<div class="section_title">
							<h2>Shopping Cart </h2>
						</div>
					</div>
			</div>	
	</div>
	<!-- cart-->
	<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="cart_container">

							<table class="cart" width="100%">
								<thead>
									<tr>
										<td style="width: 5%;">#</td>
										<td style="width: 45%;">Product</td>
										<td style="width: 10%;">Size</td>
										<td style="width: 10%;">Price</td>
										<td style="width: 10%;">Quantity</td>
										<td style="width: 10%;">Total</td>
										<td style="width: 5%;"></td>
									</tr>
								</thead>
								<tbody>
									<?php
									$ctr=0;
										foreach ($barang as $items) {
									?>
									<tr>
										<td><?php echo ++$ctr;?></td>
										<td>
											<div class="row">
												<div class="col-lg-2">
													<img src="<?php echo base_url('resource/').$items->foto;?>" alt="">
												</div>
												<div class="col-lg-10">
													<div class="product_name"><a href="product.html"><?php echo $items->nama;?></a></div>
												</div>
											</div>
										</td>
										<td id="size_brg_<?php echo $items->id_cart;?>"><?php echo $items->size;?></td>
										<td>Rp.<?php echo number_format($items->subtotal,2,",",".");?></td>
										<td><div class="product_quantity ml-lg-auto mr-lg-auto text-center">
											<span class="product_text product_num" id="jml_brg_<?php echo $items->id_cart;?>"><?php echo $items->jumlah;?></span>
											<div class="qty_sub qty_button trans_200 text-center"id="<?php echo $items->id_cart;?>"><span>-</span></div>
											<div class="qty_add qty_button trans_200 text-center" id="<?php echo $items->id_cart;?>"><span>+</span></div>
										</div></td>
										<td>Rp.<?php echo (number_format($items->subtotal*$items->jumlah,2,",","."));?></td>
										<?php
											echo "<td class='cart_delete'>";
											echo "<input type='button' value='X' name='delete' id='".$items->id_cart."' class='btn btn-fefault cart'>";
											echo "</td>";
										?>
									</tr>
									<?php

										}
									?>
								</tbody>
							</table>
							
							<div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
								<div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
									<div class="button button_clear trans_200"><a href="#">clear cart</a></div>
									<div class="button button_continue trans_200"><a href="<?php echo site_url('Cont/index');?>">continue shopping</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row cart_extra_row">
					<div class="col-lg-6">
						<div class="cart_extra cart_extra_1">
							<div class="cart_extra_content cart_extra_coupon">
								<div class="cart_extra_title">Coupon code</div>
								<div class="coupon_form_container">
									<form action="<?php echo site_url('Cart/cekpromo');?>" id="coupon_form" class="coupon_form" method="post">
										<input type="text" class="coupon_input" required="required" name="inputkode">
										<input type="submit" class="coupon_button" name="apply" value="apply"></button>
									</form>
								</div>
								<div class="coupon_text">Phasellus sit amet nunc eros. Sed nec congue tellus. Aenean nulla nisl, volutpat blandit lorem ut.</div>
								<div class="shipping">
									<div class="cart_extra_title">Shipping Method</div>
									<br>
									<h4>Daerah Pengiriman</h4>
									<select name="address" class="form-control" id="address_input">
										<?php foreach($kota as $row){?>
											<option value="<?= $row['id'] ?>"> <?= $row['name'] ?> </option>
										<?php }?>
									</select>
									<textarea type="text" class="form-control mt-2" name="alamat" id="alamat_input" placeholder="Alamat lengkap..."></textarea>
									<ul class="pengiriman" id="pengiriman_option">
										<!-- <li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_1" name="shipping_radio" class="shipping_radio">
												<span class="radio_mark"></span>
												<span class="radio_text">Next day delivery</span>
											</label>
											<div class="shipping_price_1 ml-auto" harga="25000">Rp. 25.000,00</div>
										</li>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_2" name="shipping_radio" class="shipping_radio">
												<span class="radio_mark"></span>
												<span class="radio_text">Standard delivery</span>
											</label>
											<div class="shipping_price_2 ml-auto" harga="5000">Rp. 5.000,00</div>
										</li> -->
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_3" name="shipping_radio" class="shipping_radio" checked>
												<span class="radio_mark"></span>
												<span class="radio_text">Personal Pickup</span>
											</label>
											<div class="shipping_price_3 ml-auto" harga="0">Gratis</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 cart_extra_col">
						<div class="cart_extra cart_extra_2">
							<div class="cart_extra_content cart_extra_total">
								<div class="cart_extra_title">Cart Total</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Subtotal</div>
										<div class="cart_extra_total_value ml-auto" harga="<?php 
										if(isset($total[0])){
										    echo $total[0]->total;   
										}
										else{
										    echo 0;
										}
										?>"><?php
										if(isset($total[0])){
											echo "<span>Rp ".number_format($total[0]->total,2,",",".")."</span>";
										}
										else{
										    echo "<span>Rp ".number_format(0,2,",",".")."</span>";
										}
										?></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Shipping</div>
										<div class="cart_extra_total_value_shipping ml-auto">Gratis</div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Total</div>
										<div class="cart_extra_total_value_gt ml-auto"><?php
										if(isset($total[0])){
											echo "<span>Rp ".number_format($total[0]->total,2,",",".")."</span>";
										}
										else{
										    echo "<span>Rp ".number_format(0,2,",",".")."</span>";
										}
										?></div>
									</li>
								</ul>
								<!-- <div class="checkout_button trans_200"><a href="<?php echo site_url('Cart/checkout');?>">proceed to checkout</a></div> -->
								<form action="<?php echo site_url('Cart/checkout');?>" method="post">
										<input type="hidden" name="alamat" id="alamat" value="0">
										<input type="hidden" name="ongkos_kirim" id="ongkos_kirim" value="0">
										<!-- <div class=""> -->
											<input class="checkout_button trans_200" type="submit" value="Checkout">
										<!-- </div> -->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

	<!-- Blogs -->

	<div class="blogs">
		<div class="container">
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
						<div class="blog_background" style="background-image:url(images/blog_jambi.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Batik Jambi</h4>
							<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blog_madura.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Batik Madura</h4>
							<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
							<a class="blog_more" href="#">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blog_sumatra.jpg)"></div>
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
<script src="<?php echo base_url();?>styles/bootstrap-4.1.2/popper.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url();?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url();?>plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url();?>plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url();?>plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url();?>plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url();?>plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url();?>plugins/easing/easing.js"></script>
<script src="<?php echo base_url();?>plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url();?>js/cart.js"></script>
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

	function addDeliverCost(service_name,service_value,id)
	{
		var element = '<li class="shipping_option dynamic_option d-flex flex-row align-items-center justify-content-start">'+
							'<label class="radio_container">'+
								'<input type="radio" id="radio_:service_id:" name="shipping_radio" class="shipping_radio" onclick="set_harga(:service_value:)">'+
								'<span class="radio_mark"></span>'+
								'<span class="radio_text">:service_name:</span>'+
							'</label>'+
							'<div class="shipping_price_2 ml-auto" harga=":service_value:">Rp. :service_formal_value:,00</div>'+
						'</li>';
		element = element.replaceAll(":service_id:",id);
		element = element.replace(":service_name:",service_name);
		element = element.replaceAll(":service_value:",service_value);
		element = element.replace(":service_formal_value:",formal_number(service_value));
		console.log(element);
		$('#pengiriman_option').append(element);
	}
	function set_harga(harga){
		console.log(harga);

		var radio_id= $(this).attr('id')
		var harga_antar = harga;
		$(".cart_extra_total_value_shipping").html("Rp. "+Intl.NumberFormat(['ban', 'id']).format(harga_antar)+",00");
		var Subtotal = $(".cart_extra_total_value").attr("harga");
		var grandtotal = parseInt(Subtotal)+parseInt(harga_antar);
		$('#ongkos_kirim').val(harga);
		$(".cart_extra_total_value_gt").html("Rp. "+Intl.NumberFormat(['ban', 'id']).format(grandtotal)+",00");
	}
	function formal_number(x) {
    	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
	$(document).ready(function(){
		
		var base_url = "<?php echo base_url();?>";
		console.log(base_url+"/ThirdParty/rajaongkir_cost/444/444");
		
		$('#address_input').change(function(event){
			console.log(this.value);
			getCostList(this.value);
		});
		$('#alamat_input').change(function(event){
			$("#alamat").val($(this).val());
		});
	});

	function getCostList(destination_id)
	{
		var base_url = "<?php echo base_url();?>";
		var origin_id = 444;
		var url = base_url+"/ThirdParty/rajaongkir_cost/"+origin_id+"/"+destination_id;
		console.log(url);
		$.post(url,function(data){
			console.log(data);
			var shipping_id = 4; 
			$('.dynamic_option').remove();
			data.forEach(element => {
				addDeliverCost(element.name,element.value,shipping_id);
				shipping_id++;
			});
		});
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