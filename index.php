<?php
include('admin/inc/inc.php');
 $sql1=mysqli_query($conn, "SELECT * FROM tbl_topbanner order by bid Asc");
 $featured=mysqli_query($conn, "SELECT * FROM tbl_products where prd_type='Featured' and prod_status='1' order by pid Asc limit 4");
 $grocery=mysqli_query($conn, "SELECT * FROM tbl_products where prd_type='Combo' and prod_status='1' order by rand() limit 4");
 $sql4=mysqli_query($conn, "SELECT * FROM tbl_offerbaner order by offer_id desc");
 $sql5=mysqli_query($conn, "SELECT * FROM `tbl_category` ORDER BY catid ASC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Grocery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .product .text .d-flex a {
    width: 133px;
        }
    </style>
  </head>
  <body class="goto-here">
	


    <?php include('inc/menu.php'); ?>
    <!-- END nav -->

    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
         <?php while($row=mysqli_fetch_array($sql1)){ ?>
	      <div class="slider-item" style="background-image: url(upload/<?php echo $row['bimgname'];?>);">
	      	<div class="overlay"></div>
	        
	      </div>
        <?php } ?>
	    </div>
    </section>

  
<br>
<br>
		<section class="ftco-section ftco-category ftco-no-pt catersr">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
               <?php while($row=mysqli_fetch_array($sql5)){ ?>
							<div class="col-md-3 order-md-last align-items-stretch d-flex">
                <a href="category-products.php?typ=<?php echo strtolower($row['catid']);?>&ctg=<?php echo strtolower($row['catname']);?>">
								<img src="upload/<?php echo $row['catimage'];?>" width="100%"/>
							</a>
            </div>
            <?php } ?>
							</div>
					</div>

					
				</div>
			</div>
		</section>

    <section class="ftco-section features">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	
            <h2 class="mb-4">Featured Products</h2>
           
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">

<?php while($row=mysqli_fetch_array($featured)){ $pric='';?>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="product-detail.php?id=<?php echo $row['pid'];?>" class="img-prod"><img class="img-fluid" src="upload/<?php echo $row['pimage'];?>" alt="Colorlib Template">	
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-2 pb-4 px-2 text-center">
    						<h3><a href="product-detail.php?id=<?php echo $row['pid'];?>"><?php echo $row['pname'];?></a></h3>
    						<div class="d-flex">
    							<div style="margin-right: 5px; float:left;">
                  <?php if($row['discount_percent']!=0){?>  <?php echo  $row['discount_percent'];?>% discount 
                  <?php $pric= $row['pprice']- ($row['pprice']*$row['discount_percent'])/100; } else { $pric= $row['pprice']; } ?>
		    						<p class="price">
                     
                      <span class="mr-2 price-dc"><?php if($row['poldprice']!=$row['pprice'] && $row['discount_percent']==0){ echo 'Rs.'.$row['poldprice'];  } else if($row['discount_percent']!=0){ echo 'Rs.'.number_format($row['pprice'],2); }?></span>
                      <span class="price-sale" >Rs.<?php echo number_format($pric,2); ?></span></p>
		    					</div>
                  <div style="margin-right: 5px; float:left;"><br><br>
                  <?php if(@$_SESSION['userid']!=''){?>
                  <b onclick="adcrt('<?php echo $row['pid'];?>');" style="cursor: pointer;">ADD TO CART</b>
                  <?php } else { ?>
                     <a href="login.php?lgn=lgn" style="cursor: pointer;">ADD TO CART</a>
                  <?php } ?>
</div>
	    					</div>
	    				
    					</div>
    				</div>
    			</div>
<?php } ?>

    			

    			
    		</div>
    	</div>
    </section>
		 <section class="ftco-section features">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	
            <h2 class="mb-4">Combo Products</h2>
           
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			
          <?php  while($row=mysqli_fetch_array($grocery)){ $pric='';?>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="product-detail.php?id=<?php echo $row['pid'];?>"  class="img-prod"><img class="img-fluid" src="upload/<?php echo $row['pimage'];?>" alt="Colorlib Template">  
                <div class="overlay"></div>
              </a>
              <div class="text py-2 pb-4 px-2 text-center">
                <h3><a href="product-detail.php?id=<?php echo $row['pid'];?>"><?php echo $row['pname'];?></a></h3>
                <div  class="d-flex">
                  <div style="margin-right: 5px; float:left;">
                  <?php if($row['discount_percent']!=0){?>  <?php echo  $row['discount_percent'];?>% discount 
                  <?php $pric= $row['pprice']- ($row['pprice']*$row['discount_percent'])/100; } else { $pric= $row['pprice']; } ?>
                    <p class="price">
                     
                      <span class="mr-2 price-dc"><?php if($row['poldprice']!=$row['pprice'] && $row['discount_percent']==0){ echo 'Rs.'.$row['poldprice'];  } else if($row['discount_percent']!=0){ echo 'Rs.'.number_format($row['pprice'],2); }?></span>
                      <span class="price-sale" >Rs.<?php echo number_format($pric,2); ?></span></p>
                  </div>
                  <div style="margin-right: 5px; float:left;"><br><br>
                  <?php if(@$_SESSION['userid']!=''){?>
                  <b onclick="adcrt('<?php echo $row['pid'];?>');" style="cursor: pointer;">ADD TO CART</b>
                  <?php } else { ?>
                     <a href="login.php?lgn=lgn" style="cursor: pointer;">ADD TO CART</a>
                  <?php } ?>
</div>
                </div>
              
              </div>
            </div>
          </div>
<?php } ?>



    			
    		</div>
    	</div>
    </section>
		 <?php $row1=mysqli_fetch_array($sql4); ?>
		<section class="ftco-section img offerse" style="background-image: url(upload/<?php echo $row1['offer_image'];?>);">
    	<div class="container">
				<div class="row justify-content-end">
         <?php echo $row1['offer_text'];?>
        </div>   		
    	</div>
    </section>

      <section class="ftco-section">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over Rs.100</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Always Fresh</h3>
                <span>Product well package</span>
              </div>
            </div>    
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

  
   <?php include('inc/footer.php');?>
    
  

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
   
  </body>
</html>