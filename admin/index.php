<?php
include('inc/inc.php');
    if(@$_SESSION['loggedin']!= '')
    {

        header('location:dashboard.php');
    }

  if(isset($_POST['submit'])!=''){
   $email =  str_replace("=","",str_replace("'","",$_POST['email']));
   $password =  str_replace("=","",str_replace("'","",$_POST['password']));
    $sql1=mysqli_query($conn,"SELECT * FROM tbl_lgnadm where username='".$email."' and passwrd='".md5($password)."' and status='1'");
    if(mysqli_num_rows($sql1)>0)
    {
        $_SESSION['loggedin'] = 1;
        header('location:dashboard.php');
    }
    else
    {
        $error = "Please try again";
        $_SESSION['loggedin'] = '';
    }

  } 
 

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Login</h3></div>
                                    <center style="color:#900;"><?php echo $error;?></center>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                  <input type="submit" name="submit" class="btn btn-primary btn-block" value="Login" />
                                            </div>

                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
