<?php
include 'db.php';
include 'config.php';
$link1 = $_GET['link'];
if($link1=='dashboardorder.php'){
	$link = 'dashboard.php';
} else { 
		$link = 'current_month_orders.php';

}
$edit_query = "UPDATE `tbl_orders` SET `print_status`='1',`comment_status`='1' WHERE `ot_id`='" . $_GET['oid'] . "'";
       $edit_gift_query_result11 = $mysqli->query($edit_query);
	   header("location:$link");
?>