<?php
include('admin/inc/inc.php');

$odrplce = !empty($_REQUEST['odr'])?$_REQUEST['odr']:"";

$msg = !empty($_REQUEST['msg'])?$_REQUEST['msg']:"";

if($odrplce!='')
{
  $usrid = @$_SESSION['userid'];
  if($usrid!='')
  {
    $chkcartdata =mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE  user_id='".$usrid."'");
    $_SESSION["shopping_cart"]=0;
    $_SESSION['totaldiscount']='0.00';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Grocery: Login</title>
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
  </head>
  <body class="goto-here">
		
  <?php include('inc/menu.php'); ?>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Thankyou</span></p>
            <h1 class="mb-0 bread">Thank You</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group text-center">
                <?php if($odrplce!=''){?>
                   Hi  <?php echo $_SESSION['username'];?>,<br>
                  Your order is placed successfully, Order no. <?php echo  @$_SESSION['odrno'];?> and your order will dispatch soon.  
                <?php } elseif($msg=='snd'){?>
                  Your query is successfully  send, Our team member will contact you soon.
                <?php } else { ?>
                      <a href="login.php"  class="btn btn-primary py-3 px-5">Login</a> &nbsp;&nbsp; <a href="registerd.php" class="btn btn-primary py-3 px-5" >Signup</a>      
                 <?php } ?>

              </div>
            
         
            </form>
          
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