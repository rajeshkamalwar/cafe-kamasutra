<?php
include 'admin/db.php';
session_start();
include 'admin/phpqrcode/qrlib.php';

$email = $_POST['email'];
$name = $_POST['name'];
$cname = $_POST['cname'];
$postcode = $_POST['postcode'];
$twoletter = $_POST['twoletter'];
$streetaddress = $_POST['streetaddress'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$rest_qrcode = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='qrcheck'");
$rowqr = $rest_qrcode->fetch_array();
$qecheck = $rowqr['adm_set_vlu'];
if($qecheck=='yes'){
$text = $streetaddress. ' ' .$postcode. ' ' .$twoletter;
$path = 'images/'; 
$file = $path.uniqid().".png"; 
  
// $ecc stores error correction capability('L') 
$ecc = 'L'; 
$pixel_Size = 10; 
$frame_Size = 10; 
  
// Generates QR Code and Stores it in directory given 
QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size); 
} else { 
$file = '';		
}

$query = $mysqli->query("insert into tbl_user set usr_first_name = '$name', usr_company = '$cname', usr_streetaddress1 = '$streetaddress', usr_zipcode = '$postcode', usr_zipcode2letter = '$twoletter', usr_order_city = '$city', usr_order_phone = '$phone', usr_emailid = '$email', regisid = '".$_SESSION['username']."',qrcode='$file' ");
			$notification_message = "1";
echo $notification_message;
?>