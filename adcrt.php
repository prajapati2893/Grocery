<?php
include('admin/inc/inc.php');
if($_SESSION['userid']!=''){
  $usrid = $_SESSION['userid'];
$prodid =  str_replace("'","",str_replace("=","",str_replace('"',"",str_replace('*',"",$_GET["cid"]))));
$quantity = !empty($_REQUEST['qnty']) ? $_REQUEST['qnty'] : "1"; 
if($prodid !='')
{
   $prodta=mysqli_query($conn, "SELECT * FROM tbl_products where pid='".$prodid."'");

  
   if(mysqli_num_rows($prodta)!=0){
     $proddtl =mysqli_fetch_array($prodta); 
  $item_name  = mysqli_real_escape_string($conn,$proddtl["pname"]);
  //$item_price = $proddtl["pprice"];
  if($proddtl['discount_percent']!=0){
 $item_price = $proddtl['pprice']- ($proddtl['pprice']*$proddtl['discount_percent'])/100;
} else {
  $item_price = $proddtl["pprice"];
}
  $item_img = $proddtl["pimage"];
  $item_desc  = mysqli_real_escape_string($conn,$proddtl["details"]);
  $item_quantity  = $quantity;
  $price = $item_price * $quantity;
  $actualprice = number_format($price,2);

       $prodta1=mysqli_query($conn, "SELECT * FROM tbl_cart where prodid='".$prodid."' and user_id='".$usrid."'");

       if(mysqli_num_rows($prodta1)>0)
       {
          $crtdtl =mysqli_fetch_array($prodta1); 
        
      //$prodta1=mysqli_query($conn, "UPDATE `tbl_cart` SET `quantity` = '".$qunaty."', `total_price` = '".$actualprice."' WHERE  prodid='".$prodid."' and user_id='".$usrid."'");
      //$_SESSION["shopping_cart"] = $_SESSION["shopping_cart"]+1;
         // echo 1;
      echo '<span style="background: #900;padding: 2px 10px;">Product already in cart</span>';
       }
       else
       {
            $dtnow = date('Y-m-d');
              $prodta=mysqli_query($conn, "INSERT INTO `tbl_cart` (`id`, `prodid`, `pprice`, `pimage`, `details`, `quantity`, `user_id`, `cartdatetime`, `pname`,`total_price`) VALUES (NULL, '".$prodid."', '".$item_price."', '".$item_img."', '".$item_desc."', '".$quantity."', '".$usrid."', '".$dtnow."', '".$item_name."','".$actualprice."')");
               $_SESSION["shopping_cart"] = $_SESSION["shopping_cart"]+1;
              echo 1;
       }

      
  }

  }
}

?>


<?php
/*
include('admin/inc/inc.php');
if($_SESSION['userid']!=''){
	$usrid = $_SESSION['userid'];
$prodid =  str_replace("'","",str_replace("=","",str_replace('"',"",str_replace('*',"",$_GET["cid"]))));
$quantity = !empty($_REQUEST['qnty']) ? $_REQUEST['qnty'] : "1"; 
if($prodid !='')
{
   $prodta=mysqli_query($conn, "SELECT * FROM tbl_products where pid='".$prodid."'");

	
   if(mysqli_num_rows($prodta)!=0){
   	 $proddtl =mysqli_fetch_array($prodta); 
	$item_name	=	mysqli_real_escape_string($conn,$proddtl["pname"]);
	$item_price	=	$proddtl["pprice"];
	$item_img	=	$proddtl["pimage"];
	$item_desc	=	mysqli_real_escape_string($conn,$proddtl["details"]);
	$item_quantity	=	$quantity;
   	

       $prodta1=mysqli_query($conn, "SELECT * FROM tbl_cart where prodid='".$prodid."' and user_id='".$usrid."'");

       if(mysqli_num_rows($prodta1)>0)
       {
       	  $crtdtl =mysqli_fetch_array($prodta1); 
       	  $qunaty = $crtdtl['quantity']+1;
       	  $price = $item_price * $qunaty;
		  $actualprice = number_format($price,2);
		  //$prodta1=mysqli_query($conn, "UPDATE `tbl_cart` SET `quantity` = '".$qunaty."', `total_price` = '".$actualprice."' WHERE  prodid='".$prodid."' and user_id='".$usrid."'");
		  //$_SESSION["shopping_cart"] = $_SESSION["shopping_cart"]+1;
         // echo 1;
		  echo '<span style="background: #900;padding: 2px 10px;">Product already in cart</span>';
       }
       else
       {
       			$dtnow = date('Y-m-d');
       		    $prodta=mysqli_query($conn, "INSERT INTO `tbl_cart` (`id`, `prodid`, `pprice`, `pimage`, `details`, `quantity`, `user_id`, `cartdatetime`, `pname`,`total_price`) VALUES (NULL, '".$prodid."', '".$item_price."', '".$item_img."', '".$item_desc."', '".$quantity."', '".$usrid."', '".$dtnow."', '".$item_name."','".$item_price."')");
       		     $_SESSION["shopping_cart"] = $_SESSION["shopping_cart"]+1;
       		    echo 1;
       }

   	  
	}

	}
}
 */
?>