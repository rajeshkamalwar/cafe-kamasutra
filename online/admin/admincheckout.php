<?php
session_start();
include 'db.php';
include 'config.php';
ob_start();
$ot_time =  date('H:i:s');  
 
 
$insert_user_query="INSERT INTO `tbl_user`(`usr_first_name`, `usr_last_name`, `usr_company`, `usr_streetaddress1`, `usr_zipcode`, `usr_order_city`, `usr_order_phone`, `usr_emailid`) VALUES ('".$mysqli->escape_string($_POST['usr_first_name'])."','".$mysqli->escape_string($_POST['usr_last_name'])."','".$mysqli->escape_string($_POST['usr_company'])."','".$mysqli->escape_string($_POST['usr_streetaddress1'])."','".$mysqli->escape_string($_POST['usr_zipcode'])."','".$mysqli->escape_string($_POST['usr_order_city'])."','".$mysqli->escape_string($_POST['usr_order_phone'])."','".$mysqli->escape_string($_POST['usr_emailid'])."')";
//echo $insert_user_query."<br/><br/>";
$insert_user_query_result = $mysqli->query($insert_user_query);
$ot_trx_status = 'Success';
$is_trxid='COD';
$order_id=date("dmy").substr(uniqid(mt_rand()), 0, 3);
$is_trxid='';


$order_details = $_SESSION["cart_details_for_odrtbl"]['cart_details']; 
$total_price_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['total_price']);
$discount_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['discount']); 
$delivery_charge_js = $_SESSION["cart_details_for_odrtbl"]['delivery_charge'];
$finalbill_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['finalbill']);

$insert_order_query="INSERT INTO `tbl_orders`(`ot_id`,`ot_trxid`,`ot_UserId`, `ot_order_details`, `ot_subTotal`, `ot_deliveryCharge`, `ot_discount`, `ot_TotalAmount`, `ot_giftitem`,`ot_pick_del`, `ot_OrderDate`, `ot_status`,`ot_trx_status`,`ot_time`,`ot_paymentoption`,`ot_odrnote`) VALUES ('".$order_id."','".$is_trxid."','".mysqli_insert_id($mysqli)."','".$order_details."','".$mysqli->escape_string($total_price_js)."','".$mysqli->escape_string($delivery_charge_js)."','".$mysqli->escape_string($discount_js)."','".$mysqli->escape_string($finalbill_js)."','".$_POST['cust_freeitem']."','".$_POST['pick_or_del']."','".date("Y-m-d h:m:i")."','Success','".$ot_trx_status."','".$ot_time."','".$_POST['paymenttype']."','".$_POST['remarks']."')";    
$insert_order_query_result = $mysqli->query($insert_order_query);
///include'mailbyadmin.php';
unset ($_SESSION["cop_cart_details"]);
unset ($_SESSION["product_cart"]);
header("location:customerinfo.php?oid=$order_id");

?>
