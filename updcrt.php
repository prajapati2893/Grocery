<?php
include('admin/inc/inc.php');
$update = !empty($_REQUEST['updt']) ? $_REQUEST['updt'] : ""; 
$delete = !empty($_REQUEST['del']) ? $_REQUEST['del'] : ""; 
 $keyval = !empty($_REQUEST['kid']) ? $_REQUEST['kid'] : "0"; 
 $usrid = @$_SESSION['userid'];

if(!empty($update))
{
    $quantity = !empty($_REQUEST['qty']) ? $_REQUEST['qty'] : "1"; 

   $chkcartdata =mysqli_query($conn, "SELECT * FROM tbl_cart  WHERE  id='".$keyval."' AND user_id='".$usrid."'");
	$crtdtl =mysqli_fetch_array($chkcartdata); 
	$prodid= $crtdtl['prodid'];
	$prodta=mysqli_query($conn, "SELECT * FROM tbl_products where pid='".$prodid."'");
    $proddtl =mysqli_fetch_array($prodta); 

	//$item_price = $proddtl['pprice'];
	 if($proddtl['discount_percent']!=0){
		 $item_price = $proddtl['pprice']- ($proddtl['pprice']*$proddtl['discount_percent'])/100;
		} else {
		  $item_price = $proddtl["pprice"];
		}
	$price =   $item_price*$quantity;
    $actualprice = number_format($price,2);

	$prodta1=mysqli_query($conn, "UPDATE `tbl_cart` SET `quantity` = '".$quantity."', `total_price` = '".$actualprice."', `pprice`='".$item_price."'  WHERE  id='".$keyval."' and user_id='".$usrid."'");


}

if(!empty($delete))
{
	$chkcartdata =mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE  id='".$keyval."' AND user_id='".$usrid."'");
	
 $_SESSION["shopping_cart"] = $_SESSION["shopping_cart"]-1;
}



		

?>