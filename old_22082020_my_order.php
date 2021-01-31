<?php
include('admin/inc/inc.php');
//session_destroy();
$usrid = @$_SESSION['userid'];
$crtemp = !empty($_REQUEST['crt'])?$_REQUEST['crt']:"";
$empty = !empty($_REQUEST['empty'])?$_REQUEST['empty']:"";
if($crtemp=="emty")
{
  $chkcartdata =mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE user_id='".$usrid."'");
  $_SESSION["shopping_cart"]=0;
  header('location:cart.php?empty=empty');
}
function getorgianlprice($ids,$conn)
{
  $prodQry=mysqli_query($conn,"SELECT pprice FROM `tbl_products` where pid='".$ids."'");
  $realamount =mysqli_fetch_array($prodQry); 
  return $realamount['pprice'];
}
function getorgianldiscount($ids,$conn)
{
  $prodQry=mysqli_query($conn,"SELECT discount_percent FROM `tbl_products` where pid='".$ids."'");
  $realamount =mysqli_fetch_array($prodQry); 
  return $realamount['discount_percent'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>grocery</title>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>My Orders</span></p>
            <h1 class="mb-0 bread">Order History</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
           
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
                    <th>Order Number</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Product Price</th>
                     <th>Discount%</th>
                    <th>Discounted Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>
                  <?php
                   
                    if(!empty($usrid)){
                       $crtdata = mysqli_query($conn,"SELECT * FROM tbl_order where userid='".$usrid."'");
                      $sl=1;
                      $totalpric ='';
                     
                   while ($product =  mysqli_fetch_array($crtdata)){ 
                      $prodid =  $product["pricuct_id"]; 
                    $realpric = getorgianlprice($prodid,$conn); 
                    $prodprce = $product["procust_amount"];
                    $quantity = $product["qunatity"];
                   
                    ?>
						      <tr class="text-center">
                   
                   <td class="product-remove"><?php echo $product["order_number"];?></td>

						        <td class="product-remove"><?php echo $product["delivery_status"];?></td>

                     <td class="product-remove"><?php echo date('d-m-Y',strtotime($product["datetime"]));?></td>
						        
						        <td class="image-prod"><div class="img" style="background-image:url(upload/<?php echo $product["prod_img"]; ?>);" width="90"></div></td>
						        
						        <td class="product-name">
						        	<h3><?php echo $product["prodname"]; ?></h3>
						        	
						        </td>
                   
                    
						        <td class="price">Rs.<span id="prodpr<?php echo $sl;?>"><?php echo $realpric; 

                    if($realpric!=$prodprce)
                    {
                        // $totaldiscount=($realpric-$prodprce)* $quantity;
                    } ?>
                      
                    </span></td>

                    <td class="price"><?php echo getorgianldiscount($prodid,$conn); ?>%</td>
						          <td class="price">Rs.<span id="prodpr<?php echo $sl;?>"><?php echo $product["procust_amount"]; ?></span></td>

                    <td class="price"><span id="prodpr<?php echo $sl;?>"><?php echo  $qunty =  $product["qunatity"]; ?></span></td>
						        
						        <td class="total"><span id="sumtot<?php echo $sl;?>"><?php echo number_format($qunty*$product["procust_amount"],2);?></span></td>
						      </tr>

                  <!-- END TR-->
                  <?php $sl++; } } ?>

                   
						     
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    	<?php /*	<div class="row justify-content-end">
    			
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span>Rs. <?php echo $totalpric;?></span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						<span>Rs.0.00</span>
    					</p>
    					<p class="d-flex">
    						<span>Discount</span>
    						<span>Rs.0.00</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>Rs. <?php echo $totalpric;?></span>
    					</p>
    				</div> <form action="checkout.php" method="post">
            <input type="hidden" id="ttlprice" name="ttlprice" value="<?php echo $totalpric;?>">
    				<p><input type="submit" class="btn btn-primary py-3 px-4" value="Proceed to Checkout" /></p>
          </form>

    			</div>
    		</div> */ ?>
			</div>
		</section>

		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
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