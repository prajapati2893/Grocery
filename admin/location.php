<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}
$gtdel = !empty($_REQUEST['del'])?$_REQUEST['del']:"";
if($gtdel!='')
{
    $sql=mysqli_query($conn,"SELECT * FROM tbl_location where loc_id='".$gtdel."'");
    $row=mysqli_fetch_array($sql);
   $title = $row['state_name'];
   unlink('../upload/'.$title);
   $sql=mysqli_query($conn,"DELETE FROM `tbl_location` WHERE `tbl_location`.`loc_id` = '".$gtdel."'");

   header('location:location.php?delss=del');

}
 $sql=mysqli_query($conn,"SELECT * FROM tbl_location Order By loc_id ASC");

$delss = !empty($_REQUEST['delss'])?$_REQUEST['delss']:"";

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
                            <li class="breadcrumb-item"><a href="addlocation.php">+ Add Location</a></li>
                            
                        </ol>
                     <?php if($delss!=''){?> <center style="color:#048219;"> Deleted Successfully </center> <?php } ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Location 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Location</th>
                                                <th>State</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Location</th>
                                                <th>State</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $sr=1; while($row=@mysqli_fetch_array($sql)){ ?>
                                                            
                                            <tr>
                                                <td><?php echo $sr;?></td>
                                                <td><?php echo $row['location_name'];?></td>
                                                <td><?php echo $row['state_name'];?></td>
                                                 <td><a href="addlocation.php?ofrid=<?php echo $row['loc_id'];?>">Edit</a><br/><a href="location.php?del=<?php echo $row['loc_id'];?>" onclick="return confirm('Are you sure ?')">Delete</a></td>
                                            </tr>

                                              <?php $sr++; } ?>
                                        </tbody>
                                    </table>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
