<?php
//Database connection
include 'db.php';
//insert into database

//user fields insert//

if(!empty($_POST['expire'])) {

 $expire_time = date('Y-m-d H:i:s', strtotime('+'.$_POST["expire"].' day',strtotime(date('Y-m-d H:i:s'))));

	mysqli_query($mysqli,"UPDATE promotion_discount_code_tbl SET expire_at='" . $expire_time . "',expire_in_days='" .$_POST['expire'] ."'"); 


	 echo '<div class="alert alert-success" role="alert">Expiry successfully updated for Coupon code!</div>';
      
}


?>