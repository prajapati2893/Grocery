<?php
include('admin/inc/inc.php');
$msg='';
if(!empty($_REQUEST['submit']))
  {
    // echo "hello";
    $name =  $_REQUEST['name'];
    $phone =  $_REQUEST['phone'];
    $city =  $_REQUEST['city']; 
    $pincode =  $_REQUEST['pincode']; 
    $email = strtolower($_REQUEST['email']); 
    $adress = $_REQUEST['address']; 
    $state = $_REQUEST['state']; 
    $password = password_hash($_REQUEST['Password'], PASSWORD_BCRYPT);
    $subject = $name."registration confermation link";
    $message ="click here for mail verification";

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

    $check = mysqli_num_rows( mysqli_query($conn , " select * from tbl_user where user_email = '$email' "));
    if ($check>0){
      $msg = "Email id already present";
    }

    else{
      $prodta=mysqli_query($conn, "INSERT INTO tbl_user (user_name, password, user_address, user_city, user_state, user_pincode, user_email, user_phone) VALUES ( '$name', '$password', '$adress', '$city', '$state', '$pincode', '$email', '$phone')");
      //header('location:thankyou.php');

      require 'PHPMailerAutoload.php';
      $mail = new PHPMailer(true);

      //$mail->SMTPDebug = 4;  
      $id= mysqli_insert_id($conn);
      $mailmessageverification = "click here for mail verification : <a href = 'http://localhost/grocery/verifymail.php?id=$id'> http://localhost/grocery/verifymail.php?id=$id </a>";

      try {
          //Server settings
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'rahulanandprog@gmail.com';                 // SMTP username
          $mail->Password = '9835477598';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('rahulanandprog@gmail.com', 'Grocery');
          $mail->addAddress($email);     // Add a recipient           // Name is optional
            
          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = $subject;
          $mail->Body    = $mailmessageverification;

          $mail->send();
          $msg = "we've just send a verification link to your email id. check your mail for email verification";
        } catch (Exception $e) {
          $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
      }
    }
  } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Grocery: Register</title>
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
            <h1 class="mb-0 bread">Register</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
       
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex">
            <form class="bg-white p-5 contact-form" method="POST">
              <div class="row">
               <div class="col-md-6">
               <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Full Name" required="required">
              </div>
               <div class="form-group">
                <input type="text" name="phone" maxlength=10 minlength=10 class="form-control" placeholder="Your phone" required="required">
              </div>
              <div class="form-group">
                <input type="text" name="city" class="form-control" placeholder="City" required="required">
              </div>
              <div class="form-group">
                <input type="text" name="pincode" minlength=6 maxlength=6 class="form-control" placeholder="Pincode" required="required">
              </div>

            </div>
             <div class="col-md-6">
              <div class="form-group">
               <input type="email" name="email" pattern="[A-Za-z0-9.]+@(gmail|yahoo|aol|outlook|zoho|mail|proton|icloud|gmx|mozilla|yandex|GMAIL|YAHOO|AOL|OUTLOOK|ZOHO|MAIL|PROTON|ICLOUD|GMX|MOZILLA|YANDEX|).com" class="form-control" placeholder="abc@email.com" required="required"> 
              </div>
               <div class="form-group">
                <input type="text" name="address" class="form-control" placeholder="Address" required="required">
              </div>
               <div class="form-group">
                <input type="text" name="state" class="form-control" placeholder="State" required="required">
              </div>
               <div class="form-group">
                <input type="password" name="Password" minlength=6 class="form-control" placeholder="Password" required="required">
              </div>
            </div>

            </div>
              <div class="form-group text-center">
                <input type="submit" name="submit" value="Register" class="btn btn-primary py-3 px-5"> &nbsp;&nbsp; <a href="login.php" class="btn btn-primary py-3 px-5" >Login</a><br><br>
                <a href="forgetpassword.php"  >Forget password</a>
                <p><?php echo $msg ?></p>
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