<?php
    include('admin/inc/inc.php');

    $id = mysqli_real_escape_string($conn,$_GET['id']);
    mysqli_query($conn , "update tbl_user set status=1 where user_id='$id' ");

    header('location:thankyou.php');

?>