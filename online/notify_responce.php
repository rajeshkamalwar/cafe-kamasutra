<?php


$status=$_GET['status'];
$sha1=$_GET['sha1'];
$trxid=$_GET['trxid'];
///$payment=$_GET['payment'];

$ec=$_GET['ec'];
$output='';
$date_time=date("d M, Y H:i:s");
session_start();
include 'admin/db.php';
include 'admin/config.php';
include 'res.php';
ob_start();

$current_lang = $_SESSION['current_lang'];
$PostcodePageURL = "postcodelist.php";
define('UTF8_ENABLED', '');
 
define('UTF8_ENABLED', '');    
$insert_order_query="INSERT INTO `notify_status`(`orderid`,`transid`,`status`) VALUES ('".$ec."','".$trxid."','".$status."')";    
$insert_order_query_result = $mysqli->query($insert_order_query);

$query="UPDATE `tbl_orders` SET  `ot_trx_status`='".$status."', `ot_trxid`='".$trxid."' WHERE ot_id='".$ec."'";
$result_query = $mysqli->query($query);

 
if($status=='Success'){
	 $order_no = $ec;
	 include 'mail.php';
}

 
?>