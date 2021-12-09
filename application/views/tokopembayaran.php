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
  <script src="https://cdn.tiny.cloud/1/r4dyiyun22qsy6tpoq2wlgzr8slfzojc35viha99t998l6hs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: '#textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name'
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


	<div class="main_slider">
	</div>
    	<div class="col-xl-12 order-xl-1">
	            	<div class="container">
		            	<div class="row">
		                	<div class="col-lg-3 order-xl-1" style="padding: 0">

										<!-- User Review -->
											<div class="user_review_container d-flex flex-column flex-sm-row">
											<div class="user">
												<div class="user_pic">
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
									?>" style="height: 100%;width: 100%;border-style: solid;">
												</div>
											</div>
											<div class="review">
											</div>
										</div>
										

							</div>
							<div class="col-lg-6 order-xl-1" style="border-style: solid;text-align: center;" style="padding: 0">
								<div class="section_title" style=" margin: auto; margin-top: 15%">
		        					<h2><?php echo $toko->nama_toko;?></h2>
		        				</div>
							</div>
							<div class="col-lg-3 order-xl-1" style="text-align: left;">
								<button style="margin-top: 80%; height: 20%" class="button-login" style="padding: 0"><a href="<?php echo base_url();?>Cont/ke_edit_toko">Edit Toko</a></button>
							</div>
		            	</div>
	            	</div>
            	<br>
			<div class="row">
                <div class="container">

                	<ul class="navbar_menu">
                		<li><a href="<?php echo base_url();?>Cont/ke_toko"  style="border-style: solid;">Jualan</a></li>
                		<li><a href="<?php echo base_url();?>Cont/ke_isi_toko" style="border-style: solid;">Isi toko</a></li>
                		<li><a class="actived" href="<?php echo base_url();?>Cont/ke_pembayaran_toko" style="border-style: solid;">List Pembayaran</a></li>
						<li><a href="<?php echo base_url();?>Toko/laporan_toko" style="border-style: solid;">Laporan Toko</a></li>
                	</ul>
                	<div class="card">
                		<div class="card-header">
                			<h2>Pembayaran</h2>
                		</div>
                		<div class="card-body">
                			<table class="table table-bordered">
                				<tr>
                					<th>User</th>
                					<th>Barang</th>
                					<th>Jumlah</th>
                					<th>Harga Satuan</th>
                					<th>Subtotal</th>
                					<th>Status Order</th>
                					<th>Aksi</th>
                				</tr>
                    <?php
                    	foreach ($trans as $key) {
                    		echo "<tr>";
                    		echo "<td>$key->Nama_user</td>";
                    		echo "<td><img src='".base_url('resource/').$key->foto_barang."' width='200px' height='200px'/> $key->barang_nama</td>";
                    		echo "<td>$key->Jumlah</td>";
                    		echo "<td>Rp.".number_format($key->harga_satuan,2,',','.')."</td>";
                    		echo "<td>Rp.".number_format($key->Subtotal,2,',','.')."</td>";
                    		if(!$key->tanggal_kirim){
                    			echo "<td>Belum dikirim</td>";
                    		}
                    		else{
                    			echo "<td>Sudah dikirim <br>(No Resi :". $key->no_resi.")</td>";
                    		}
                    		if($key->Status_pembayaran==1 ){
							?>
								<?php if(!$key->tanggal_kirim):?>
								<td>
									<form action="<?= base_url('Cont/kirimbarang/'.$key->dtrans_id)?>" method="post">
										<input type="text" class="form-control" name="no_resi" id='<?=$key->dtrans_id?>_resi' style="margin-bottom: 20px;" placeholder="Nomor Resi Pengiriman" >
										<input type='submit' class='button-login' id='<?=$key->dtrans_id?>_submit' value='Kirim Barang'>
									</form>
								</td>
								<?php else:?>
								<td>
									<form action="<?= base_url('Cont/kirimbarang/'.$key->dtrans_id)?>" method="post">
										<input type="text" class="form-control" name="no_resi" id='<?=$key->dtrans_id?>_resi' style="margin-bottom: 20px;" placeholder="Nomor Resi Pengiriman" >
										<input type='submit' class='button-login' id='<?=$key->dtrans_id?>_submit' value='Edit Resi'>
									</form>
								</td>
								<?php endif;?>
							<?php
                    		}
                    		else{
                    			echo "<td>Belum dibayar</td>";
                    		}
                    		echo "</tr>";
                    	}
	                ?>
                			</table>
	                	</div>
	            	</div>
	            	<div class="card" id="pembayaran">
	            		<div class="card-header">
                			<h2>Detail Order</h2>
	            		</div>
	            		<div class="card-body">
	            			<div id="detail_pembayaran">
			            		
			            	</div>
			            	<br><br>
			            	<div>
			            		<?php
			            		echo form_open('Toko/ubahstatusorder');
			            		echo form_label('Nomor Nota',"","class='form-control-label'")."<br>";
					            echo form_input('nota',"","id='input_nota'")."<br>";
			            		echo form_label('ID Barang',"","class='form-control-label'")."<br>";
					            echo form_input('barang_ganti',"","id='barang_ganti'");
					            echo "<br><br><input type='submit' name='dikirim' id='dikirim' class='button-login' value='Ubah Jadi Dikirim'>";
					            echo form_close();
			            		?>
			            	</div>
	            		</div>
	            	</div>
	            	
	            	
	            </div>
            </div>
                <br>
		  	<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<?php
					foreach ($barang as $key) {
						if($key->tampil_blog==1){
						?>
						<div class="col-lg-4 blog_item_col">
							<div class="blog_item">
								<div class="blog_background" style="background-image:url(<?php echo base_url();?>ikonblog/<?php echo $key->foto_blog;?>)"></div>
								<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
									<h4 class="blog_title"><?php echo $key->id_barang;?></h4>
									<a class="blog_more" href="<?php echo base_url();?>Cont/ke_blog_bawah/<?php echo $key->id_barang;?>">Read more</a>
								</div>
							</div>
						</div>
						<?php
							
						}
					}
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

	$(document).ready(function () {
		$("#pembayaran").hide();
		var id='';	
		$('input[type=button]').click(function(){
			id = $(this).attr('id');
			var nama = $(this).attr('name');
			if(nama=='detail') {
				// alert();
				var tampung = $(this).attr('id').split('-');
				var barang = tampung[0];
				var nota = tampung[1];
				var gambar = tampung[2];
				$.ajax({
					type:"POST",
					url:'<?php echo site_url('Toko/getdetailorder'); ?>',
					dataType :'json',
					data:{barang:barang,nota:nota},
					success: function(data) {
						var total=parseInt("0");
						html="<h4>List Barang:</h4><table class='table table-bordered'><tr><th>Nama Barang</th><th>Jumlah</th><th>Subtotal</th></tr>";
						// body...
						// alert(data);
						for (var i = 0; i < data.length; i++) {
							// html+="&nbsp&nbsp&nbsp-Nama: "+data[i].barang_nama+" -Jumlah: "+data[i].Jumlah+" -Subtotal: "+data[i].Subtotal+"<br>";
							html+="<tr><td>"+data[i].barang_nama+"</td><td>"+data[i].Jumlah+"</td><td>Rp. "+Intl.NumberFormat(['ban', 'id']).format(parseInt(data[i].Subtotal))+",00</td></tr>";
							total+=parseInt(data[i].Subtotal);
						}
						html+="<tr><td colspan='2'>Total</td><td>Rp. "+Intl.NumberFormat(['ban', 'id']).format(total)+",00</td></tr></table><br><h4>Bukti Pembayaran</h4><br><img src='<?php echo base_url('buktipembayaran');?>/"+gambar+"' width=400px height=400px>";
						$("#detail_pembayaran").html(html);
						$("#input_nota").val(nota);
						$("#barang_ganti").val(barang);
						$("#pembayaran").show();

					}
				});
			}
		});
	});
	$('#btnToTop').fadeOut();

	$( "#signUp" ).click(function() {
		$(".sign-in-container").hide();
		$(".sign-up-container").show();
		container.classList.add("right-panel-active");
	});

	$("#tampilkan_blog").click(function() {
		if($("#desain_blog").is(":visible")){
			$("#desain_blog").hide();	
			$("#hiddenblog").attr("value","0");
			tinyMCE.activeEditor.setContent('');

		}
		else{
			$("#hiddenblog").attr("value","1");
			$("#desain_blog").show();	
		}
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