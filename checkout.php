<?php
include('admin/inc/inc.php');
$usrid = @$_SESSION['userid'];
if($usrid=="")
{
	echo "<script>window.location='index.php';</script>";
  header('location:index.php');
}
 $usrdata=mysqli_query($conn, "SELECT * FROM `tbl_user` where user_id='".$usrid."'");
 $usrdtl =mysqli_fetch_array($usrdata); 
 $crtdata=mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE `user_id` ='".$usrid."'");
$crtdtl =mysqli_fetch_array($crtdata); 
$shpmnt=mysqli_query($conn, "SELECT * FROM tbl_shipment");
$shipmentdta =mysqli_fetch_array($shpmnt); 
$total_cartprice = $_SESSION['Final_total'];
$name =  $usrdtl['user_name'];
$address =  $usrdtl['user_address'];
$city =  $usrdtl['user_city'];
$state =  $usrdtl['user_state']; 
$pincode =  $usrdtl['user_pincode'];
$email =  $usrdtl['user_email'];
$phone =  $usrdtl['user_phone'];
$name =  $usrdtl['user_name'];


if(isset($_REQUEST['submit'])!='')
{
	 $num = 'ODR-10001';
	 $name = $_REQUEST['name'];
     $email = $_REQUEST['email']; 
     $phone = $_REQUEST['phone']; 
     $address = $_REQUEST['address']; 
     $city = $_REQUEST['city']; 
     $state = $_REQUEST['state']; 
     $pincode = $_REQUEST['pincode']; 
     $country= $_REQUEST['country']; 
  	 
     $odrdata=mysqli_query($conn, "SELECT * FROM `tbl_order` ORDER BY orderid DESC");
     $crtdata=mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE `user_id` ='".$usrid."'");
     $shpmnt=mysqli_query($conn, "SELECT * FROM tbl_shipment");
	 $shipmentdta =mysqli_fetch_array($shpmnt); 
	 if($total_cartprice<=$shipmentdta['less_amount']) {$shiipric = $shipmentdta['shiment_charges'];}else {$shiipric = 0;}
	 $total_cartprice = $_SESSION['Final_total']+$shiipric; 
     $numcart = mysqli_num_rows($crtdata);
     if(mysqli_num_rows($odrdata)>0)
     {
       $odrdtl =mysqli_fetch_array($odrdata);
       $mkodr = explode("-",$odrdtl['order_number']);
       $getnmbr = $mkodr[1]+1;
        $num= 'ODR-'.$getnmbr; 
	 }
	 $_SESSION['odrno'] = $num;
   
     $sr=0;
  $sql = "INSERT INTO `tbl_order` (`orderid`, `order_number`, `pricuct_id`, `prodname`, `prod_img`, `qunatity`, `total_amount`, `without_tax_amount`, `cust_name`, `cust_address`, `cust_city`, `cust_state`, `cust_pincode`, `cust_email`, `cust_phone`, `procust_amount`, `delivery_status`, `userid`) VALUES ";
  $sql2='';
     while($crtdtl = mysqli_fetch_array($crtdata))
     {

     	$prodid = $crtdtl['prodid'];
     	$pprice =$crtdtl['pprice'];
     	$prod_img = $crtdtl['pimage'];
     	$quantity = $crtdtl['quantity'];
     	$pname = $crtdtl['pname'];
     	$sql2.="(NULL, '".$num."', '".$prodid."', '".$pname."', '".$prod_img."', '".$quantity."', '".$total_cartprice."', '0.00', '".$name."', '".$address."', '".$city."', '".$state."', '".$pincode."', '".$email."', '".$phone."', '".$pprice."', 'pending', '".$usrid."'),";
		$sr++;
     } 

    if($numcart==$sr){
    	$sql2 = rtrim($sql2,",");
    	$sql1 = $sql.$sql2;
    	$crtdata2=mysqli_query($conn,$sql1);
       header('location:thankyou.php?odr=plc'); 
   	}	

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
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
<form action="" class="billing-form" method="POST">
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
						
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Full Name</label>
	                  <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="" required="required">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Email</label>
	                  <input type="text" name="email" class="form-control" value="<?php echo $email;?>" placeholder="" required="required">
	                </div>
                </div>
                 <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Phone</label>
	                  <input type="phone" name="phone" class="form-control" value="<?php echo $phone;?>" placeholder="" required="required">
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Address</label>
	                  <input type="text" name="address" id="address" class="form-control" value="<?php echo $address;?>" placeholder="" required="required">
	                </div>
                </div>
                 <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">City</label>
	                  <input type="text" class="form-control" id="city" name="city" value="<?php echo $city;?>" placeholder="" required="required">
	                </div>
		            </div>
		             <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">State</label>
	                  <input type="text" class="form-control" id="state" name="state" value="<?php echo $state;?>" placeholder="" required="required">
	                </div>
		            </div>
               
               
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="streetaddress">Pincode</label>
	                  <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $pincode;?>" placeholder="" required="required">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Country</label>
	                  <select name="country" class="form-control">
	                  	   <option value="india" selected="selected">India</option>
		                  </select>
	                </div>
		            </div>
		           
		                      
                <div class="w-100"></div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
										<div class="radio">
										  <label><input type="checkbox" name="difadrss" id="difadrss"> Ship to different address</label>
										</div>
									</div>
                </div>
	            </div>
	          <!-- END -->
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>Rs. <?php echo $total_cartprice+ $_SESSION['totaldiscount']; //$total_cartprice;?></span>
		    					</p>

		    					<p class="d-flex">
		    						<span>Discounted Amount</span>
		    						<span>Rs.<?php if(@$_SESSION['totaldiscount']!=0 || $_SESSION['totaldiscount']!='0.00') { echo $_SESSION['totaldiscount']; } else { echo '0.00'; }?></span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
		    						<span>Rs.<?php if(@$total_cartprice!=0) { if($total_cartprice<=$shipmentdta['less_amount']) {echo $shipmentdta['shiment_charges']; $shiipric = $shipmentdta['shiment_charges'];} else {echo '0.00'; $shiipric =0;} } else { echo '0.00'; }?></span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>Rs.  <?php echo $total_cartprice+$shiipric;?></span>
		    					</p>
								</div>
	          	</div>

	          	 <?php if($total_cartprice>0){?>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2" required="required" checked>Case on Delivery</label>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" name="terms" value="" class="mr-2" required="required"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									
									<p><input type="submit" name="submit" class="btn btn-primary py-3 px-4" value="Place an order" /></p>
								
								</div>
	          	</div>
<?php } ?>

	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
</form>
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

  <script>
		$(document).ready(function(){

		
		   $('#difadrss').change(function(e){
		        
		       if(this.checked==true)
		       {

				$('#address').val(''); 
				$('#city').val(''); 
				$('#state').val(''); 
				$('#pincode').val(''); 

		       }
		       else
		       {

		       	$('#address').val("<?php echo $address;?>"); 
				$('#city').val("<?php echo $city;?>");  
				$('#state').val("<?php echo $state;?>"); 
				$('#pincode').val("<?php echo $pincode;?>"); 

		       }
		        
		    });

		    
		    
		});
	</script>
    
  </body>
</html>