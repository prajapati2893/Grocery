<?php
include('admin/inc/inc.php');
session_destroy();
$_SESSION['userid'] = '';
$_SESSION['usermail'] = '';
$_SESSION['username'] = '';
$_SESSION["shopping_cart"] =0;

header('location:login.php');
?>