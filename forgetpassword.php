<?php 
include('admin/inc/inc.php'); 
require_once "functions.php";

$error='';
  if(@$_SESSION['userid']!= '')
    {

        header('location:index.php');
    }

  if(isset($_POST['submit'])!=''){
    require 'PHPMailerAutoload.php';
    $email =  str_replace("=","",str_replace("'","",$_POST['email']));
  
    $sql1=mysqli_query($conn,"SELECT * FROM tbl_user where user_email='".$email."' and status='1' ");
   
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    
    if (mysqli_num_rows($sql1)>0) {

      $token = generateNewString();

      $conn->query("UPDATE tbl_user SET token='$token', 
                  token_expire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                  WHERE user_email='$email'
        ");

    // if(mysqli_num_rows($sql1)>0)
    // {
        $dta = mysqli_fetch_array($sql1);
    //     $pasword = $dta['password'];
        $name = $dta['user_name']; 
        $email_id = $dta['user_email']; 
    //     $mobile_no = $dta['user_phone'];
    //     // $to = $email_id; 
        $subject = $name." reset password :";
    //     $message ="
    //     <html>
    //         <body>
    //             <table style='width:600px;'>
    //                 <tbody>
    //                     <tr>
    //                         <td style='width:150px'><strong>Name: </strong></td>
    //                         <td style='width:400px'>$name</td>
    //                     </tr>
    //                     <tr>
    //                         <td style='width:150px'><strong>Email ID: </strong></td>
    //                         <td style='width:400px'>$email_id</td>
    //                     </tr>
    //                     <tr>
    //                         <td style='width:150px'><strong>Mobile No: </strong></td>
    //                         <td style='width:400px'>$mobile_no</td>
    //                     </tr>
    //                     <tr>
    //                         <td style='width:150px'><strong>Password </strong></td>
    //                         <td style='width:400px'>$pasword</td>
    //                     </tr>
                        
    //                 </tbody>
    //             </table>
    //         </body>
    //     </html>
    //     ";

        

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'rahulanandprog@gmail.com';                 // SMTP username
        $mail->Password = '9835477598';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('rahulanandprog@gmail.com', 'Grocery');
        $mail->addAddress($email_id);     // Add a recipient           // Name is optional

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        // $mail->Body    = $message;
        // //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->Body = "
            Hi,<br>
            ".$name."<br>
            In order to reset your password, please click on the link below:<br>
            <a href='
            http://localhost/grocery/resetPassword1.php?email=$email&token=$token
            '>http://localhost/grocery/resetPassword1.php?email=$email&token=$token</a><br><br>
            
            Kind Regards,<br>
            Grocery 
        ";

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        
     }
     else{
        	$error = "Please try again";
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>forget password</span></p>
            <h1 class="mb-0 bread">Retrieve your password</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container"><?php if($error!=''){ ?>
      <center style="color:#900;">Please try again!</center> <?php } ?>
      
        <div class="row block-9">
          <div class="col-md-12 order-md-last d-flex"> 
            <form action="#" class="bg-white p-5 contact-form" method="POST">
              <div class="row">
               <div class="col-md-12">
               <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required="required">
              </div>

            </div>
             
            </div>
              <div class="form-group text-center">
                <input type="submit" name="submit" value="Reset Password" class="btn btn-primary py-3 px-5"> &nbsp;&nbsp; <br> <br>
                <a href="login.php"  >Login</a> | <a href="registerd.php"  >Signup</a> 
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