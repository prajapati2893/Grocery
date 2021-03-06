<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}

$getselData = mysqli_query($conn,"SELECT DISTINCT(order_number) FROM `tbl_order`"); 
$idsgt = '';
while($ordts =mysqli_fetch_array($getselData))
{
   $ordnm = $ordts['order_number'];
   $sql11 = mysqli_query($conn, "SELECT * FROM `tbl_order` WHERE order_number='".$ordnm."' order by orderid desc limit 1");
   $allorderid = mysqli_fetch_array($sql11);

   $idsgt .= $allorderid['orderid'].',';
   
}
$idsgt = rtrim($idsgt,',');




 $sql=mysqli_query($conn,"SELECT * FROM `tbl_order` WHERE FIND_IN_SET(orderid,'".$idsgt."') Order By orderid DESC");


 //$sql=mysqli_query($conn,"SELECT * FROM tbl_order Order By orderid DESC");

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
                       
                       <!--  <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="addproduct.php">+ Add Product</a></li>
                            
                        </ol> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Order
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                 <th>ID</th>
                                                <th>Order id</th>
                                                <th>Order Date-Time</th>
                                                 <th>Order Number</th>
                                                <th>Order Amount</th>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Customer Phone</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <th>Delivery Status</th>
                                                 <th>View Invoice</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>ID</th>
                                                <th>Order id</th>
                                                  <th>Order Date-Time</th>
                                                <th>Order Number</th>
                                                <th>Order Amount</th>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Customer Phone</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <th>Delivery Status</th>
                                                 <th>View Invoice</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                             <?php $sr=1; while($row=@mysqli_fetch_array($sql)){ ?>
                                            <tr>


                                                <td><?php echo $sr; ?></td>
                                                <td><a href="viewinvoice.php?id=<?php echo $row['order_number'];?>"><?php echo $row['orderid'];?></a></td>
                                                 <td><a href="viewinvoice.php?id=<?php echo $row['order_number'];?>"><?php echo $row['order_number'];?></a></td>
                                                 <td><?php echo date('d-m-Y h:i:s', strtotime($row['datetime']));?></td>
                                                <td><?php echo $row['total_amount'];?></td>
                                                 <td><?php echo $row['cust_name'];?></td>
                                                 <td><?php echo $row['cust_email'];?></td>
                                                 <td><?php echo $row['cust_phone'];?></td>
												 <td><?php echo $row['cust_address'];?></td>
												 <td><?php echo $row['cust_city'];?></td>
                                                 <td><?php echo $row['cust_state'];?></td>
                                                 <td><?php echo $row['cust_pincode'];?></td>
                                                 <td><?php echo $row['delivery_status'];?></td>
												 <td><a href="viewinvoice.php?id=<?php echo $row['order_number'];?>">View Invoice</a></td>
                                                 
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
