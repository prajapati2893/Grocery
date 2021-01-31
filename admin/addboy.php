
<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}

if(isset($_POST['submit'])=="Add")
{
    $imgpath='';
    if(!empty($_FILES['boyimage']['name'])){
      $errors= array();
      $banerimg= $file_name =strtotime("now").$_FILES['boyimage']['name'];
      $file_size =$_FILES['boyimage']['size'];
      $file_tmp =$_FILES['boyimage']['tmp_name'];
      $file_type=$_FILES['boyimage']['type'];
      $ext = strtolower(pathinfo($banerimg, PATHINFO_EXTENSION));
     $extensions= array("jpeg","jpg","png","xlsx","pptx");
      
      if(in_array($ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG or pdf or docx or xlsx or pptx file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../upload/".$file_name);
          $imgpath =$file_name;
      }else{
      //   print_r($errors);
      }
   }

        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $location_id = implode(',',$_POST['location']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        
        $pids = $_REQUEST['pids'];

   if($pids!='')
   {

      $imgs ='';
      if($imgpath!=''){ $imgs = ", Cerifecate='".$imgpath."'"; }

  
      $sql=mysqli_query($conn,"UPDATE `tbl_delivery_boy` SET `location_id` = '".$location_id."', `name` = '".$name."', `email` = '".$email."', `phone` = '".$phone."', `address` = '".$address."', `status`='1' ".$imgs." WHERE `tbl_delivery_boy`.`delry_id` = '".$pids."'");
        $row=mysqli_fetch_array($sql);
   }
   else
   {

      $sql=mysqli_query($conn,"INSERT INTO `tbl_delivery_boy` (`delry_id`, `location_id`, `name`, `email`, `phone`, `address`, `Cerifecate`, `status`) VALUES (NULL, '".$location_id."', '".$name."', '".$email."', '".$phone."', '".$address."', '".$imgpath."', '1')");
       $row=mysqli_fetch_array($sql);
   }
     header('location:boy.php');
}

$gtpid = !empty($_REQUEST['id'])?$_REQUEST['id']:"";
if($gtpid!=''){
$sql=mysqli_query($conn,"SELECT * FROM tbl_delivery_boy where delry_id='".$gtpid."'");
$row=mysqli_fetch_array($sql);
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$locationid = explode(",",$row['location_id']);
$address = $row['address'];
}
else
{
$name ='';
$email ='';
$phone ='';
$locationid = array();
$address ='';
}


 $sql=mysqli_query($conn,"SELECT * FROM tbl_location");

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
                       
                        Obscure
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
                                Boy Detail
                            </div>
                            <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" action="" >
                                            <input type="hidden" name="pids" value="<?php echo $gtpid;?>">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputproducts">Name</label>
                                                        <input class="form-control py-4" id="inputproducts" type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Products name" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputImage">Certificate Image</label>
                                                        <input class="form-control py-4" id="inputImage" type="file"  name="boyimage" placeholder="Image" <?php if($gtpid==''){?>  required="required" <?php } ?>>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputprice">Email</label>
                                                        <input class="form-control py-4" id="inputprice" type="email"  name="email" placeholder="example@exmple.com" value="<?php echo $email;?>"  required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">phone</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text"  name="phone" placeholder="phone" value="<?php echo $phone;?>"  required="required">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputcategory">Location</label>
                                                        <Select multiple class="form-control py-4" id="inputcategory"   name="location[]" required="required">
                                                        <?php while($row1=mysqli_fetch_array($sql)){ 
                                                           ?>

                                                            <option value="<?php echo $row1['loc_id'];?>" <?php  if (in_array($row1['loc_id'], $locationid)){ echo 'selected="selected"'; }  ?>><?php echo $row1['location_name'];?></option>
                                                          <?php } ?>
                                                        </Select>
                                                    </div>
                                                </div>
                                               
                                              
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputdetails">Address</label>
                                               <textarea class="form-control py-4" id="inputdetails" placeholder="Detail"  name="address" required="required"><?php echo $address;?></textarea>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group mt-4 mb-0"><input type="submit" name="submit" class="btn btn-primary btn-block" value="Add" /></div>
                                        </form>
                                    </div>
                        </div>
                    </div>
                </main>
               
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
