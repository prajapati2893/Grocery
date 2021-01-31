<?php
include('inc/inc.php');
if($_SESSION['loggedin']!=1)
{
    header('location:index.php');
}
$ordnm = !empty($_REQUEST['id']) ? $_REQUEST['id'] : "";
$ordnum = str_replace("=",'',str_replace("'",'',$ordnm));
 $sql1=mysqli_query($conn,"SELECT * FROM `tbl_order` where order_number='".$ordnum."' order by orderid asc limit 1");
 $getadrss = mysqli_fetch_array($sql1); 

 
 
 $sql=mysqli_query($conn,"SELECT * FROM `tbl_order` where order_number='".$ordnum."'");

$delss = !empty($_REQUEST['delss'])?$_REQUEST['delss']:"";
function locnam($ids,$conn)
{
    $locid = $ids;
    $sqlloc = mysqli_query($conn,"SELECT * FROM tbl_location WHERE  FIND_IN_SET(loc_id, '".$locid."')");
    $locnams='';
    while($rows = mysqli_fetch_array($sqlloc))
    {
        $locnams.= $rows['location_name'].' - '.$rows['state_name'].',';
    }
    return $locnams = rtrim($locnams,',');
}
$shpsql=mysqli_query($conn,"SELECT * FROM tbl_shipment Order By id ASC");
$shipmentdta = mysqli_fetch_array($shpsql); 

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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
    <div class="container">
        <div class="card" id="invoicedta">
            <div class="card-header">
                Invoice
                <strong><?php echo date('d-m-Y');?></strong>
               
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>Grocery</strong>
                        </div>
                        <div>Grocery, Tezpur university</div>
                        <div>CMH, 224</div>
                        <div>Email: rahulanandprog@gmail.com</div>
                        <div>Phone: +91 7480003003</div>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong><?php echo $getadrss['cust_name'];?></strong>
                        </div>
                        <div><?php echo $getadrss['cust_address'];?></div>
                        <div><?php echo $getadrss['cust_city'];?>, <?php echo $getadrss['cust_state'];?> - <?php echo $getadrss['cust_pincode'];?></div>
                        <div>Email: <?php echo $getadrss['cust_email'];?></div>
                        <div>Phone: <?php echo $getadrss['cust_phone']; ?></div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $r=1;  $prdpric; $z=''; $prodtot; $finalamount=0; $dlvry=''; 
                            while($rows = mysqli_fetch_array($sql)){ ?>
                            <tr>
                                <td class="center"><?php echo $r;?></td>
                                <td class="left strong"><?php echo $rows['prodname'];?></td>
                                <td class="left"><?php $prdpric =  $rows['procust_amount']; echo number_format($prdpric,2); ?></td>
                                <td class="right"><?php $qunati = ((int)$rows['qunatity']); echo $qunati; ?></td>
                                <td class="center"><?php $prodtot= ((float)$prdpric)*$qunati;  echo number_format($prodtot,2); $finalamount += $prodtot;?></td> 
                            </tr>
                           <?php $r++; }  ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">Rs. <?php echo number_format($finalamount,2);?></td>
                                </tr>
                                
                                <tr>
                                    <td class="left">
                                        <strong>Shipment Charges</strong>
                                    </td>
                                    <td class="right">Rs.<?php if($finalamount<=$shipmentdta['less_amount']) {echo $shipmentdta['shiment_charges']; $dlvry = $shipmentdta['shiment_charges'];} else {echo '0.00'; $dlvry =0;}?>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>Rs. <?php echo number_format(($finalamount+$dlvry),2);?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</main>
</div>
</div>
<!-- <script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();
     printDiv("dk");

     document.body.innerHTML = originalContents;
}

</script> -->
</body>
</html>