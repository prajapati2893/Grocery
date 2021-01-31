<?php
include('admin/inc/inc.php'); 
require_once "functions.php";

	if (isset($_GET['email']) && isset($_GET['token'])) {
		        
        $email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		$sql = $conn->query("SELECT user_id FROM tbl_user WHERE
			user_email='$email' AND token='$token' AND token<>'' AND token_expire > NOW()
		");

		if ($sql->num_rows > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;
		}else
            redirectToLoginPage();
	} else {
        //echo $_SESSION['email'].'  '.$_SESSION['token'];
        if(!empty($_REQUEST['recover-submit']) && !empty($_SESSION['email']) && !empty($_SESSION['token']))
        {
            $email = $_SESSION['email'];
            $password1 =  $_REQUEST['password1'];
            $password2 =  $_REQUEST['password2'];

            if($password2==$password1){
                $newPassword = $password2;
                $newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
                $conn->query("UPDATE tbl_user SET token='', password = '$newPasswordEncrypted'
                    WHERE user_email='$email'
                ");
                // remove all session variables
                session_unset();
                // destroy the session
                session_destroy();
                redirectToLoginPage();
            }else{
                echo "Password not matched";
            }
        }else
            redirectToLoginPage();
	}
?>

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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <style>
        #pnl{
            margin-top: 25px;
        }

        #pswd2{
            margin-top: 15px;
        }

    </style>
    
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


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div id="pnl" class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="resetPassword1.php">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="password1" placeholder="set new password" class="form-control" minlength=6 type="password" required="required">
                        </div>
                        <!-- <br> -->
                        <div id="pswd2" class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="password2" placeholder="re-enter your password" class="form-control" minlength=6 type="password" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

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