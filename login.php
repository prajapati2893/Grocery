<?php
include('admin/inc/inc.php');

  $error = !empty($_REQUEST['error']) ? $_REQUEST ['error']: "";
  $lgn = !empty($_REQUEST['lgn']) ? $_REQUEST['lgn'] : "";
 
if(!empty($_REQUEST['submit']))
  {
   
    $email = strtolower($_REQUEST['email']);

    if(strpos(explode("@",$email)[1],"gmail")!== false){
      $arr = explode("@",$email);
      $first = $arr[0];
      $second = $arr[1];
      $count;
      $first = str_replace(".","",$first,$count);
      $newStr=$first.="@";
      $email=$newStr.=$second;
      //echo $email;
      // echo "\nCount: ".$count;
    }
    else{
        $email=$email;
    }

    $hashqry = mysqli_query($conn, "SELECT password FROM `tbl_user` where  `user_email`='".$email."' and `status`='1'");
    $arr = mysqli_fetch_array($hashqry);
    $hash = $arr[0];
    echo $hash;
    if (password_verify($_REQUEST['password'],$hash)) {
      echo 'Password is valid!';

      //$password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
      $prodta=mysqli_query($conn, "SELECT * FROM `tbl_user` where `user_email`='".$email."' ");
    
      if(mysqli_num_rows($prodta)!=0)
      {
        $datauser = mysqli_fetch_array($prodta);
        $_SESSION['userid'] = $datauser['user_id'];
        $_SESSION['usermail'] = $datauser['user_email'];
        $_SESSION['username'] = $datauser['user_name'];
        $usrid = $_SESSION['userid'];
        $chkcartdata =mysqli_query($conn, "SELECT * FROM tbl_cart  WHERE user_id='".$usrid."'");
        $crtdtl =mysqli_num_rows($chkcartdata); 
        $_SESSION["shopping_cart"] = $crtdtl;
        header('location:index.php');
      }
      else
      {
        header('location:login.php?error=error');
      }

    } else {
      echo 'Invalid password.';
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
            <h1 class="mb-0 bread">Login</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container"><?php if($error!=''){ ?>
      <center style="color:#900;">wrong credentials or email does'nt exist</center> <?php } ?>

      <?php if($lgn!=''){ ?>
      <center style="color:#900;">Please login first to buy products.</center> <?php } ?>
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex"> 
            <form action="#" class="bg-white p-5 contact-form" method="POST">
              <div class="row">
               <div class="col-md-6">
               <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required="required">
              </div>

            </div>
             <div class="col-md-6">
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
              </div>
              </div>
            </div>
              <div class="form-group text-center">
                <input type="submit" name="submit" value="Login" class="btn btn-primary py-3 px-5"> &nbsp;&nbsp; <a href="registerd.php" class="btn btn-primary py-3 px-5" >Signup</a><br><br>
                <a href="forgetpassword.php"  >Forget password</a>
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