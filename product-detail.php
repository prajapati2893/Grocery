<?php include('admin/inc/inc.php');
$prodid = !empty($_REQUEST['id'])?$_REQUEST['id']:"";
if($prodid=="")
{
    header('location:index.php');
}
$proid = str_replace("=","",str_replace("'","", $prodid));

 $prodtl=mysqli_query($conn, "SELECT * FROM tbl_products where pid='".$proid."' and  prod_status='1' order by pid DESC");
$row=mysqli_fetch_array($prodtl);
 $featured=mysqli_query($conn, "SELECT * FROM tbl_products where  prd_type='Featured' and  prod_status='1' order by rand() limit 4");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>grocery: Products</title>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row">

<div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="img-responsive" alt="Responsive image" width="400" src="upload/<?php echo $row['pimage'];?>" alt="">
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $row['pname'];?></h3>
                       
                        <div class="product__details__price">Rs.<?php echo $row['pprice'];?></div>
                        <p><?php $out = strlen($row['details']) > 100 ? substr($row['details'],0,100)."..." : $row['details']; echo $out;?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                            <input type="text" name="qty" id="qty" value="1"> &nbsp;
                      <?php if(@$_SESSION['userid']!=''){?>
                    <a class="btn btn-primary" onclick="adcrt('<?php echo $row['pid'];?>',document.getElementById('qty').value);" style="cursor: pointer;">ADD TO CART</a>
                  <?php } else { ?>
                     <a href="login.php?lgn=lgn" class="btn btn-primary" style="cursor: pointer;">ADD TO CART<</a>
                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                       
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping.</li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p><?php echo $row['details'];?></p>
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div> 
      </div>
    </section>

<!-- Related Product Section Begin -->
    <section class="ftco-section features">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            
            <h2 class="mb-4">Featured Products</h2>
           
          </div>
        </div>      
      </div>
      <div class="container">
        <div class="row">

<?php while($row=mysqli_fetch_array($featured)){ ?>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="product-detail.php?id=<?php echo $row['pid'];?>" class="img-prod"><img class="img-fluid" src="upload/<?php echo $row['pimage'];?>" alt="image loading...">  
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="product-detail.php?id=<?php echo $row['pid'];?>"><?php echo $row['pname'];?></a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price">
                        <?php if($row['poldprice']!=$row['pprice']){?>
                      <span class="mr-2 price-dc">Rs.<?php echo $row['poldprice'];?><?php } ?></span><span class="price-sale">Rs.<?php echo $row['pprice'];?></span></p>
                  </div>
                  <?php if(@$_SESSION['userid']!=''){?>
                  <b onclick="adcrt('<?php echo $row['pid'];?>');" style="cursor: pointer;">Cart</b>
                  <?php } else { ?>
                     <a href="login.php?lgn=lgn" style="cursor: pointer;">Cart</a>
                  <?php } ?>
                </div>
              
              </div>
            </div>
          </div>
<?php } ?>

          

          
        </div>
      </div>
    </section>
    <!-- Related Product Section End -->

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