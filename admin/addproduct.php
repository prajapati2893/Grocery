
<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}

if(isset($_POST['submit'])=="Add")
{
    $imgpath='';
    if(!empty($_FILES['productimage']['name'])){
 //if(isset($_FILES['profile_photo']['name'])!=''){
      $errors= array();
      $banerimg= $file_name =strtotime("now").str_replace(" ","-",$_FILES['productimage']['name']);
       $file_size =$_FILES['productimage']['size'];
      $file_tmp =$_FILES['productimage']['tmp_name'];
      $file_type=$_FILES['productimage']['type'];
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

        $productname = mysqli_real_escape_string($conn,$_POST['productname']);
        $catid = implode(',',$_POST['productcat']);
        $productprice = $_POST['productprice'];
        $productold_price = $_POST['productold_price'];
        $productdetails = mysqli_real_escape_string($conn,$_POST['productdetails']);
        $unittype = $_POST['unittype'];
        $pids = $_REQUEST['pids'];
        $prd_type = $_REQUEST['prd_type'];
        $prdiscount = $_REQUEST['prdiscount'];

   if($pids!='')
   {

      $imgs ='';
      if($imgpath!=''){ $imgs = ", pimage='".$imgpath."'"; }
     $sql=mysqli_query($conn,"UPDATE `tbl_products` SET `pname` = '".$productname."', `pprice` = '".$productprice."', `poldprice` = '".$productold_price."', `pcatid` = '".$catid."', `unit_type` = '".$unittype."', `details` ='".$productdetails."', prd_type='".$prd_type."', `discount_percent`='".$prdiscount."', `prod_status` = '1' ".$imgs." WHERE `tbl_products`.`pid` = '".$pids."'");
        $row=mysqli_fetch_array($sql);
   }
   else
   {

      $sql=mysqli_query($conn,"INSERT INTO `tbl_products` (`pid`, `category_id`, `pname`, `pprice`, `pimage`, `poldprice`, `pcatid`, `unit_type`, `details`, `prod_status`,`prd_type`,`discount_percent`) VALUES (NULL, '0', '".$productname."', '".$productprice."', '".$imgpath."', '".$productold_price."', '".$catid."', '".$unittype."', '".$productdetails."', '1', '".$prd_type."','".$prdiscount."')");
       $row=mysqli_fetch_array($sql);
   }
   echo "<script>window.location='productlist.php';</script>";
   header('location:productlist.php');
}





$gtpid = !empty($_REQUEST['pid'])?$_REQUEST['pid']:"";
if($gtpid!=''){
$sql=mysqli_query($conn,"SELECT * FROM tbl_products where pid='".$gtpid."'");
$row=mysqli_fetch_array($sql);
$pname = $row['pname'];
$pprice = $row['pprice'];
$poldprice = $row['poldprice'];
$pcatid = explode(",",$row['pcatid']);
$unittype = $row['unit_type'];
$details = $row['details'];
$prd_type = $row['prd_type'];
$prdiscount = $row['discount_percent'];
}
else
{
$pname ='';
$pprice ='';
$poldprice ='';
$pcatid = array();
$unittype ='';
$details ='';
$prd_type ='';
 $prdiscount = '';
}


 $sql=mysqli_query($conn,"SELECT * FROM tbl_category");

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
                                Product
                            </div>
                            <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" action="" >
                                            <input type="hidden" name="pids" value="<?php echo $gtpid;?>">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputproducts">Product Name</label>
                                                        <input class="form-control py-4" id="inputproducts" type="text" name="productname" value="<?php echo $pname;?>" placeholder="Enter Products name" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputImage">Image</label>
                                                        <input class="form-control py-4" id="inputImage" type="file"  name="productimage" placeholder="Image" <?php if($gtpid==''){?>  required="required" <?php } ?>>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputprice">Price</label>
                                                        <input class="form-control py-4" id="inputprice" type="text"  name="productprice" placeholder="0.00" value="<?php echo $pprice;?>"  required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Old Price</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text"  name="productold_price" placeholder="0.00" value="<?php echo $poldprice;?>"  required="required">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputcategory">Category</label>
                                                        <Select multiple class="form-control py-4" id="inputcategory"   name="productcat[]" required="required">
                                                        <?php while($row1=mysqli_fetch_array($sql)){ 
                                                           ?>

                                                            <option value="<?php echo $row1['catid'];?>" <?php  if (in_array($row1['catid'], $pcatid)){ echo 'selected="selected"'; }  ?>><?php echo $row1['catname'];?></option>
                                                          <?php } ?>
                                                        </Select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputunit">Unit</label>
                                                        <Select  class="form-control " id="inputunit"   name="unittype" required="required">
                                                            <option value="" <?php if($unittype==""){ echo 'selected="selected"'; } ?>>Select</option>
                                                            <option value="50 Grm" <?php if($unittype=="50 Grm"){ echo 'selected="selected"'; } ?>>50 Grm</option>
                                                            <option value="100 Grm" <?php if($unittype=="100 Grm"){ echo 'selected="selected"'; } ?>>100 Grm</option>
                                                             <option value="125 Grm" <?php if($unittype=="125 Grm"){ echo 'selected="selected"'; } ?>>125 Grm</option>
                                                            <option value="150 Grm" <?php if($unittype=="150 Grm"){ echo 'selected="selected"'; } ?>>150 Grm</option>
                                                             <option value="200 Grm" <?php if($unittype=="200 Grm"){ echo 'selected="selected"'; } ?>>200 Grm</option>
                                                            <option value="250 Grm" <?php if($unittype=="250 Grm"){ echo 'selected="selected"'; } ?>>250 Grm</option>
                                                            <option value="500 Grm" <?php if($unittype=="500 Grm"){ echo 'selected="selected"'; } ?>>500 Grm</option>
                                                            <option value="1 Kg" <?php if($unittype=="1 Kg"){ echo 'selected="selected"'; } ?>>1 Kg</option>
                                                            <option value="5 Kg." <?php if($unittype=="5 Kg."){ echo 'selected="selected"'; } ?>>5 Kg.</option>
                                                            <option value="10 Kg." <?php if($unittype=="10 Kg."){ echo 'selected="selected"'; } ?>>10 Kg.</option>
                                                             <option value="1 Piece" <?php if($unittype=="1 Piece"){ echo 'selected="selected"'; } ?>>1 Piece</option>
                                                             <option value="6 Piece" <?php if($unittype=="6 Piece"){ echo 'selected="selected"'; } ?>>6 Piece</option>
                                                             <option value="1 Dogen" <?php if($unittype=="1 Dogen"){ echo 'selected="selected"'; } ?>>1 Dogen</option>
                                                              <option value="50 ml" <?php if($unittype=="50 ml"){ echo 'selected="selected"'; } ?>>50 ml</option>
                                                            <option value="100 ml" <?php if($unittype=="100 ml"){ echo 'selected="selected"'; } ?>>100 ml</option>
                                                             <option value="150 ml" <?php if($unittype=="150 ml"){ echo 'selected="selected"'; } ?>>150 ml</option>
                                                            <option value="200 ml" <?php if($unittype=="200 ml"){ echo 'selected="selected"'; } ?>>200 ml</option>
                                                             <option value="400 ml" <?php if($unittype=="400 ml"){ echo 'selected="selected"'; } ?>>400 ml</option>
                                                            <option value="500 ml" <?php if($unittype=="500 ml"){ echo 'selected="selected"'; } ?>>500 ml</option>
                                                            <option value="1 ltr." <?php if($unittype=="1 ltr."){ echo 'selected="selected"'; } ?>>1 ltr.</option>
                                                            <option value="5 ltr." <?php if($unittype=="5 ltr."){ echo 'selected="selected"'; } ?>>5 ltr.</option>
                                                            <option value="10 ltr." <?php if($unittype=="10 ltr."){ echo 'selected="selected"'; } ?>>10 ltr.</option>
                                                            <option value="pack" <?php if($unittype=="pack"){ echo 'selected="selected"'; } ?>>Pack</option>
                                                             <option value="bottle" <?php if($unittype=="bottle"){ echo 'selected="selected"'; } ?>>Bottle</option>
 
                                                          </Select>
                                                    </div>

                                                     <div class="form-group">
                                                        <label class="small mb-1" for="inputunit">Product Type</label>
                                                        <Select  class="form-control " id="inputunit"   name="prd_type" required="required">
                                                            <option value="" <?php if($prd_type==""){ echo 'selected="selected"'; } ?>>Select</option>
                                                            <option value="Featured" <?php if($prd_type=="Featured"){ echo 'selected="selected"'; } ?>>Featured Products</option>
                                                            <option value="Grocery" <?php if($prd_type=="Grocery"){ echo 'selected="selected"'; } ?>>Grocery Products</option>
                                                            <option value="Combo" <?php if($prd_type=="Combo"){ echo 'selected="selected"'; } ?>>Combo Products</option>
                                                            <option value="Combo" <?php if($prd_type=="Vegetables"){ echo 'selected="selected"'; } ?>>Vegetables Products</option>
                                                            <option value="Combo" <?php if($prd_type=="Fruits"){ echo 'selected="selected"'; } ?>>Fruits Products</option>
                                                        </Select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="small mb-1" for="inputunit">Product Discount in Percent</label>
                                                         <input class="form-control py-4" id="prdiscount" type="number"  name="prdiscount" placeholder="0" value="<?php echo $discount_percent;?>"  required="required">
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputdetails">Detail</label>
                                               <textarea class="form-control py-4" id="inputdetails" placeholder="Detail"  name="productdetails" required="required"><?php echo $details;?></textarea>
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
