<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}

if(isset($_POST['submit'])=="Add")
{
    $imgpath='';
    if(!empty($_FILES['catimg']['name'])){
 //if(isset($_FILES['profile_photo']['name'])!=''){
      $errors= array();
      $banerimg= $file_name = $_FILES['catimg']['name'];
       $file_size =$_FILES['catimg']['size'];
      $file_tmp =$_FILES['catimg']['tmp_name'];
      $file_type=$_FILES['catimg']['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES['profile_photo']['name'])));
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

   $title = $_POST['title'];
   $catid = $_POST['catid'];

   if($catid!='')
   {
      $imgs ='';
      if($imgpath!=''){ $imgs = ", catimage='".$imgpath."'"; }
       
        $sql=mysqli_query($conn," UPDATE `tbl_category` SET `catname` = '".$title."' ".$imgs." WHERE `catid` = '".$catid."'");
        $row=mysqli_fetch_array($sql);
   }
   else
   {

       
    $sql=mysqli_query($conn,"INSERT INTO `tbl_category` (`catid`, `catname`, `catimage`, `adddate`) VALUES (NULL, '".$title."', '".$imgpath."', CURRENT_TIMESTAMP)");
    $row=mysqli_fetch_array($sql);
   }
header('location:category.php');
}

$gtcatid = !empty($_REQUEST['ofrid'])?$_REQUEST['ofrid']:"";
if($gtcatid!=''){
$sql=mysqli_query($conn,"SELECT * FROM tbl_category where catid='".$gtcatid."'");
$row=mysqli_fetch_array($sql);
$title = $row['catname'];
}
else
{
   $title ='';
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
                                Category
                            </div>
                            <div class="card-body">
                                     <form method="post" enctype="multipart/form-data" action="" >
                                        <input type="hidden" name="catid" value="<?php echo $gtcatid;?>">
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Title</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" name="title" value="<?php echo $title;?>" placeholder="Enter title" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Image</label>
                                                        <input class="form-control py-4" id="inputLastName" type="file"  name="catimg" placeholder="Select image" <?php if($gtcatid=='') { ?>required="required" <?php } ?> >
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
