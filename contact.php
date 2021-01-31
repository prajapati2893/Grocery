<?php
include('admin/inc/inc.php');
if(isset($_REQUEST['submit'])!='')
{
   

    $name = $_REQUEST['name'];  
    $email = $_REQUEST['email'];  
    $subject = $_REQUEST['subject'];
    $phone = $_REQUEST['phone']; 
    $message = mysqli_real_escape_string($conn,$_REQUEST['message']);  
    $msgsv =mysqli_query($conn, "INSERT INTO `tbl_inquiry` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES (NULL, '".$name."', '".$email."', '".$phone."', '".$subject."', '".$message."')");
header('location:thankyou.php?msg=snd');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>grocery</title>
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
            <h1 class="mb-0 bread">Contact us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-4 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> 	Tezpur univesity North Eastern state of Assam, India</p>
	          </div>
          </div>
          <div class="col-md-4 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://7480003003">+91 7480003003</a></p>
	          </div>
          </div>
          <div class="col-md-4 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:rahulanandprog@gmail.com">mca5thsem@gmail.com</a></p>
	          </div>
          </div>

        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="#" class="bg-white p-5 contact-form" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Your Name" required="required">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="required">
              </div>
              <div class="form-group">
                <input type="phone" class="form-control" name="phone" placeholder="Your Phone" required="required">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required="required">
              </div>
              <div class="form-group">
                <textarea cols="30" rows="7" name="message" class="form-control" placeholder="Message" required="required"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14257.521069748447!2d92.8307601!3d26.7002961!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28a60e3c5515613b!2sTezpur%20University!5e0!3m2!1sen!2sin!4v1608746406607!5m2!1sen!2sin" width="600" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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