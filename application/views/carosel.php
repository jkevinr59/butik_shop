
  <!-- <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/prettyPhoto.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/animate.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/main.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/responsive.css');?>">
  <script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
  <script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('asset/js/jquery.scrollUp.min.js');?>"></script>
    <script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
    <script src="<?php echo base_url('asset/js/jquery.prettyPhoto.js');?>"></script>
    <script src="<?php echo base_url('asset/js/main.js');?>"></script> -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style type="text/css">
      
      .container{
        width: 100%;
        text-align: center;
      }

     .carousel-inner > .item > img{ 
      width:100%; 
      height:auto; 
     } 
     
    </style>

<section id="slider"><!--slider-->
    <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
          <?php
            /*
              for $i=0 to jumlah carousel item:
                if($i==0){
              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active">';
                }
                else{
              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'">';
                }
                
              next i

            */
              $ctr=0;
              foreach ($gambar_blog as $key) {
                if($ctr==0){
                  echo '<li data-target="#myCarousel" data-slide-to="'.$ctr.'" class="active">';
                }
                else{
                  echo '<li data-target="#myCarousel" data-slide-to="'.$ctr.'">';
                }
                $ctr++;
              }
          ?>
        </ol>
        <div class="carousel-inner">
        <?php
            $ctr=0;
            foreach ($gambar_blog as $key) {
              if($ctr==0){
                echo '<div class="item active">';
                echo "<img src='".base_url()."detail_blog/".$key->gambar."'>";
                echo '</div>';
              }
              else{
                echo '<div class="item">';
                echo "<img src='".base_url()."detail_blog/".$key->gambar."'>";
                echo '</div>';
              } 
              $ctr++;
            }
        ?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
          
        </div>
      </div>
    </div>
  </section>