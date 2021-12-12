<html>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<script type='text/javascript' src='<?php echo base_url('asset/js/jquery.js');?>'></script>
<script type='text/javascript' src='<?php echo base_url('asset/js/jquery.min.js');?>'></script>
<script type='text/javascript' src='<?php echo base_url('asset/js/bootstrap.min.js');?>'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#persendiskon').attr("disabled", "disabled");  
       $('#kodepromo').removeAttr("disabled");
       $('#update').hide();
      $('#jenispromo').change(function(){
          var temp = $(this).val();
          if(temp==1)
          {
              $('#persendiskon').removeAttr("disabled")
              $('#persendiskon').val("");
          }
          else
          {
            $('#persendiskon').attr('disabled','disabled');
          }
      });
        var id='';  
      $('input[type=button]').click(function(){
          id = $(this).attr('id');
          var nama = $(this).attr('name');
              if(nama=='ganti')
            {

                 $.post("<?php echo base_url(); ?>"+'index.php/Admin/getgantistatus',{id:id},function(value){
                    window.location = "<?php echo site_url("Admin/gantistatus"); ?>";
                 });
            }
      });

      $('#logout').click(function(){
    
             window.location= "<?php echo site_url('Admin/logout');?>";
      });
  });

</script>
<style type="text/css">
@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 300;
  src: local('Lato Light'), local('Lato-Light'), url(https://fonts.gstatic.com/s/lato/v14/S6u9w4BMUTPHh7USSwiPHA.ttf) format('truetype');
}
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 400;
  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v14/S6uyw4BMUTPHjx4wWw.ttf) format('truetype');
}
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 700;
  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v14/S6u9w4BMUTPHh6UVSwiPHA.ttf) format('truetype');
}
*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
body {
  background: #f5f5f5;
  padding: 0;
  margin: 0;
  font-family: 'Lato', sans-serif;
}
i.fa {
  font-size: 16px;
}
p {
  font-size: 16px;
  line-height: 1.42857143;
}
.header {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  background: #3498DB;
  width: 100%;
  height: 50px;
  line-height: 50px;
  color: #fff;
}
.header .logo {
  text-transform: uppercase;
  letter-spacing: 1px;
}
.header #menu-action {
  display: block;
  float: left;
  width: 60px;
  height: 50px;
  line-height: 50px;
  margin-right: 15px;
  color: #fff;
  text-decoration: none;
  text-align: center;
  background: rgba(0, 0, 0, 0.15);
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action i {
  display: inline-block;
  margin: 0 5px;
}
.header #menu-action span {
  width: 0px;
  display: none;
  overflow: hidden;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action:hover {
  background: rgba(0, 0, 0, 0.25);
}
.header #menu-action.active {
  width: 250px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.header #menu-action.active span {
  display: inline;
  width: auto;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar {
  position: fixed;
  overflow: scroll;
  z-index: 10;
  left: 0;
  top: 50px;
  height: 100%;
  width: 60px;
  background: #fff;
  border-right: 1px solid #ddd;
  text-align: center;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar:hover,
.sidebar.active,
.sidebar.hovered {
  width: 300px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
.sidebar ul li {
  display: block;
}
.sidebar ul li a {
  display: block;
  position: relative;
  white-space: nowrap;
  overflow: hidden;
  border-bottom: 1px solid #ddd;
  color: #444;
  text-align: left;
}
.sidebar ul li a i {
  display: inline-block;
  width: 60px;
  height: 60px;
  line-height: 60px;
  text-align: center;
  -webkit-animation-duration: 0.7s;
  -moz-animation-duration: 0.7s;
  -o-animation-duration: 0.7s;
  animation-duration: 0.7s;
  -webkit-animation-fill-mode: both;
  -moz-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both;
}
.sidebar ul li a span {
  display: inline-block;
  height: 60px;
  line-height: 60px;
}
.sidebar ul li a:hover {
  background-color: #eee;
}
.sidebar ul li a:hover i {
  -webkit-animation-name: swing;
  -moz-animation-name: swing;
  -o-animation-name: swing;
  animation-name: swing;
}
.main {
  position: relative;
  display: block;
  top: 50px;
  left: 0;
  padding: 15px;
  padding-left: 75px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.main.active {
  padding-left: 275px;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.main .jumbotron {
  background-color: #fff;
  padding: 30px !important;
  border: 1px solid #dfe8f1;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.main .jumbotron h1 {
  font-size: 24px;
  margin: 0;
  padding: 0;
  margin-bottom: 12px;
}
@-webkit-keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }
  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }
  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }
  100% {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
@keyframes swing {
  20% {
    -webkit-transform: rotate3d(0, 0, 1, 15deg);
    -ms-transform: rotate3d(0, 0, 1, 15deg);
    transform: rotate3d(0, 0, 1, 15deg);
  }
  40% {
    -webkit-transform: rotate3d(0, 0, 1, -10deg);
    -ms-transform: rotate3d(0, 0, 1, -10deg);
    transform: rotate3d(0, 0, 1, -10deg);
  }
  60% {
    -webkit-transform: rotate3d(0, 0, 1, 5deg);
    -ms-transform: rotate3d(0, 0, 1, 5deg);
    transform: rotate3d(0, 0, 1, 5deg);
  }
  80% {
    -webkit-transform: rotate3d(0, 0, 1, -5deg);
    -ms-transform: rotate3d(0, 0, 1, -5deg);
    transform: rotate3d(0, 0, 1, -5deg);
  }
  100% {
    -webkit-transform: rotate3d(0, 0, 1, 0deg);
    -ms-transform: rotate3d(0, 0, 1, 0deg);
    transform: rotate3d(0, 0, 1, 0deg);
  }
}
.swing {
  -webkit-transform-origin: top center;
  -ms-transform-origin: top center;
  transform-origin: top center;
  -webkit-animation-name: swing;
  animation-name: swing;
}

</style>

<meta charset="UTF-8">
<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Admin Page
	<input type='submit' name='logout' id='logout' class='btn btn-default' value='Log Out'>
  </div>
</div>
<div class="sidebar">
  <ul>
    <li id='master'><a href="<?php echo site_url('Admin/user'); ?>"><i class="fa fa-desktop"></i><span> Master User</span></a></li>
    <!-- <li id='order'><a href="<?php echo site_url('Admin/slider'); ?>"><i class="fa fa-desktop"></i><span>Slider</span></a></li> -->
    <li id='master_admin'><a href="<?php echo site_url('Admin/masteradmin'); ?>"><i class="fa fa-desktop"></i><span>Master Admin</span></a></li>
    <li id='toko'><a href="<?php echo site_url('Admin/view_toko'); ?>"><i class="fa fa-truck"></i><span>Toko</span></a></li>
    <!-- <li><a href="<?php echo site_url('Admin/halamanpromo'); ?>"><i class="fa fa-money"></i><span>Promo</span></a></li> -->
    <li><a href="<?php echo site_url('Admin/transaksipending'); ?>"><i class="fa fa-bar-chart"></i><span>Transaksi Pending</span></a></li>
    <li><a href="<?php echo site_url('Admin/report_pembayaran'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan Transaksi Terbayar</span></a></li>
    <li><a href="<?php echo site_url('Admin/report_retur'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan Transaksi Retur</span></a></li>
    <li><a href="<?php echo site_url('Admin/kategoribarang'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan Kategori Barang</span></a></li>
    <li><a href="<?php echo site_url('Admin/midtrans_transaction'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan Midtrans</span></a></li>
    <li><a href="<?php echo site_url('Admin/report_blog'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan Blog</span></a></li>
    <li><a href="<?php echo site_url('Admin/verified_user'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan User</span></a></li>
    <li><a href="<?php echo site_url('Admin/report_toko'); ?>"><i class="fa fa-bar-chart"></i><span>Laporan UMKM</span></a></li>
    <li><a href="<?php echo site_url('Admin/halamanreport'); ?>"><i class="fa fa-bar-chart"></i><span>Report</span></a></li>
    <li><a href="<?php echo site_url('Admin/ke_master_blog'); ?>"><i class="fa fa-bar-chart"></i><span>List Blog</span></a></li>
    <li><a href="<?php echo site_url('Admin/ke_buat_blog'); ?>"><i class="fa fa-bar-chart"></i><span>Buat Blog</span></a></li>
  </ul>
</div>

<!-- Content -->
<div class="main">
  <div class="hipsum">
    <div class="jumbotron">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                  <th>Nama Toko</th>
                  <th>Pemilik</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php foreach($toko as $row): ?>
                    <tr>
                      <td><?= $row->nama_toko?></td>
                      <td><?= $row->Nama_user?></td>
                      <td><?= $row->alamat_toko?></td>
                      <td><?= $row->telp_toko?></td>
                      <td>
                        <a class="btn btn-primary" href="<?= site_url('Admin/toko_detail/'.$row->id_toko)?>">Detail</a>
                      </td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
                
            </table>
          </div>
        </div>
      </div>
      
  </div>
</div>



</html>