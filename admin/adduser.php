<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}

if(isset($_POST['submit'])=="Add")
{
   $name =$_POST['name'];
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $zip = $_POST['zip'];
   $address = $_POST['address'];
   $state = $_POST['state'];
   $city = $_POST['city'];
   $password = $_POST['password'];
   $tid = $_POST['tid'];
   $date = date('Y-m-d H:i:s');
   if($tid!='')
   {
      $imgs ='';
      $pswrd = '';
       
       if($password!=''){ $pswrd = ", password='".$password."'"; }
       
        $sql=mysqli_query($conn,"UPDATE `tbl_user` SET `user_name` = '".$name."', `user_phone` = '".$mobile."', `user_email` = '".$email."', `user_address` = '".$address."', `user_pincode` = '".$zip."', `user_state` = '".$state."', `user_city` = '".$city."' ".$pswrd."  WHERE `user_id` = '".$tid."'");
        $row=mysqli_fetch_array($sql);
   }
   else
   {

       $sql=mysqli_query($conn,"INSERT INTO `tbl_user` (`user_id`, `user_email`, `password`, `user_name`, `user_phone`, `user_address`, `user_pincode`, `user_state`, `user_city`, `create_date`) VALUES (NULL, '".$email."', '".$password."', '".$name."', '".$mobile."', '".$address."', '".$zip."', '".$state."', '".$city."', '".$date."')");
       $row=mysqli_fetch_array($sql);
   }
header('location:userlist.php');
}

$gtid = !empty($_REQUEST['id'])?$_REQUEST['id']:"";
if($gtid!=''){
$sql=mysqli_query($conn,"SELECT * FROM tbl_user where user_id='".$gtid."'");
$row=mysqli_fetch_array($sql);

  $name =$row['user_name'];
  $email = $row['user_email'];
  $mobile = $row['user_phone'];
  $address = $row['user_address'];
  $city = $row['user_city'];
  $state = $row['user_state'];
  $zip = $row['user_pincode'];
  
}
else
{
  
   $name ='';
   $email = '';
   $mobile = '';
   $address = '';
   $city = '';
   $state = '';
   $zip = '';
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
        <title>Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
             
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                      
                         <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
           <div id="layoutSidenav_nav">
                 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                             <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Category
                            </a>
                           
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Banner
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="topbanner.php">Top Banner</a>
                                    <a class="nav-link" href="offer.php">Offer Banner</a>
                                </nav>
                            </div>
                              <a class="nav-link" href="userlist.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Register User
                            </a>
                              <a class="nav-link" href="productlist.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Product List
                            </a>
                           <a class="nav-link" href="order.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                New Order
                            </a>
                            
                           <a class="nav-link" href="boy.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Delivery boy
                            </a>
                            <a class="nav-link" href="enquery.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Enquery
                            </a>
                             <a class="nav-link" href="shipment.php"><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>Shipment</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                       
                    grocery
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                       
                        <ol class="breadcrumb mb-4">
                           
                            
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                User Details
                            </div>
                            <div class="card-body">
                                     <form method="post" enctype="multipart/form-data" action="" >
                                        <input type="hidden" name="tid" value="<?php echo $gtid;?>">
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName"> Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" name="name" value="<?php echo $name;?>" placeholder="Enter name" required="required">
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">Email</label>
                                                        <input class="form-control py-4" id="email" type="email" name="email" value="<?php echo $email;?>" placeholder="Enter email" <?php if($email==""){?> required="required" <?php } else {?>readonly <?php } ?> onblur="chkmal();">
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="password">Password</label>
                                                        <input class="form-control py-4"  type="password" name="password" id="password" value="" placeholder="Enter password" <?php if($gtid==''){?>required="required" <?php } ?>>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="confirm_password">Confirm Password</label>
                                                        <input class="form-control py-4" type="Password" name="confirm_password" id="confirm_password" value="" placeholder="Enter confirm password" <?php if($gtid==''){?>required="required" <?php } ?>>
                                                    </div>
                                                </div>
                                                 
                                                 
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="address">Address</label>
                                                        <textarea class="form-control py-4" id="address" type="text" name="address" placeholder="Enter address" style="min-height: 150px !important;" ><?php echo $address;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="city">City</label>
                                                       <input class="form-control py-4" id="city" type="text" name="city" value="<?php echo $city;?>" placeholder="Enter city" ><br>
                                                        <label class="small mb-1" for="mobilr">Mobile</label>
                                                        <input class="form-control py-4" id="mobile" type="text" name="mobile" value="<?php echo $mobile;?>" placeholder="Enter mobile" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="state">State</label>
                                                       <input class="form-control py-4" id="state" type="text" name="state" value="<?php echo $state;?>" placeholder="Enter state" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="zip">Zip</label>
                                                       <input class="form-control py-4" id="zip" type="text" name="zip" value="<?php echo $zip;?>" placeholder="Enter zip" >
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                           
                                            <div class="form-group mt-4 mb-0"><input type="submit" name="submit" id="submit" class="btn btn-primary btn-block" value="Add" onclick="validatePassword();" /></div>
                                        </form>
                                    </div>
                        </div>
                    </div>
                </main>
               
            </div>
        </div>
        <script type="text/javascript">
            var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function chkmal()
{
	var emil = document.getElementById('email').value;
    atpos = emil.indexOf("@");
    dotpos = emil.lastIndexOf(".");
	if(emil=="")
	{
		alert('Please enter email');
		document.getElementById('submit').style.display='none';
		
	}
	else  if (atpos < 1 || ( dotpos - atpos < 2 ))
	{
		alert('Please enter valid email');
		document.getElementById('submit').style.display='none';
	
	}
	else{
		document.getElementById('submit').style.display='';
	}
}
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
