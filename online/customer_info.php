<?php
session_start();
include 'admin/db.php';
include 'admin/config.php';
include 'admin/phpqrcode/qrlib.php'; 
ob_start();
$ot_time =  date('H:i:s'); 
$current_lang = $_SESSION['current_lang'];
if ($current_lang == "en")  {
$finaltotal = 'Total';
$tiptext = 'Tip';	
$cutleryyes = 'Yes';
$Cutlery_charge = 'Cutlery Charge';
$palstbag = 'Statiegeld';	
	$subtotal = 'Subtotal';
} else { 
$cutleryyes = 'Ja';
$Cutlery_charge = 'Bestek';	
$finaltotal = 'Totaal';
$tiptext = 'Fooie';	
	$palstbag = 'Plastic Bak Toeslag';	
	$subtotal = 'Subtotaal';
}
$rest_qrcode = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='qrcheck'");
$rowqr = $rest_qrcode->fetch_array();
$qecheck = $rowqr['adm_set_vlu'];
if($qecheck=='yes'){
if($_POST['pick_or_del']!='pickup'){
$text = $_POST['cust_housenumber']. ' ' .$_POST['cust_postcode']. ' ' .$_POST['cust_2lettersofyourPostcode'];
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
} else { 
$file = '';		
}


$currency = '€';
$discount_percentage=($current_lang=="en")?"Discount":"Korting"; 
$plastic_charge=($current_lang=="en")?"Plastic charge":"Plastic Tas";
$delivery_charge=($current_lang=="en")?"Delivery charge":"Bezorgkosten";
$queryget = $mysqli->query("select * from tbl_user where regisid = '".$_SESSION['username']."' ");
$newuser = $_POST['newuser'];
if(isset($_SESSION['username'])){
	$countusr = $queryget->num_rows;
	$sessionemail = $_SESSION['username'];
} else { 
	$countusr = '0';
	if($_POST['saveaspass']=='1'){
		$sessionemail = $_POST['cust_emailaddress'];
		 $sessionemail = $_POST['cust_emailaddress'];
		$delchooseopt = $_POST['delchooseopt'];
	} else { 
		$sessionemail = '';
	}
}
if($countusr=='0'){
$insert_user_query="INSERT INTO `tbl_user`(`usr_first_name`, `usr_company`, `usr_streetaddress1`,  `usr_zipcode`, `usr_zipcode2letter`, `usr_order_city`, `usr_order_phone`, `usr_emailid`, `regisid`,`qrcode`,`login_type`) VALUES ('".$mysqli->escape_string($_POST['cust_firstname'])."','".$mysqli->escape_string($_POST['cust_companyname'])."','".$mysqli->escape_string($_POST['cust_housenumber'])."','".$mysqli->escape_string($_POST['cust_postcode'])."','".$mysqli->escape_string($_POST['cust_2lettersofyourPostcode'])."','".$mysqli->escape_string($_POST['cust_towncity'])."','".$mysqli->escape_string($_POST['cust_phone'])."','".$mysqli->escape_string($_POST['cust_emailaddress'])."','$sessionemail','$file','$delchooseopt')";
//echo $insert_user_query."<br/><br/>";
$insert_user_query_result = $mysqli->query($insert_user_query);
	$userid = mysqli_insert_id($mysqli);
}
else if($countusr != '0' && $newuser==1){
	$edit_gift_query = "UPDATE `tbl_user` SET   `usr_streetaddress1`='" .$_POST['cust_housenumber']. "',`usr_zipcode`='" . $_POST['cust_postcode'] . "',`usr_zipcode2letter`='" . $_POST['cust_2lettersofyourPostcode']. "',`usr_order_city`='" . $_POST['cust_towncity']. "'  WHERE `regisid`='" . $sessionemail ."'";
	$done=  $mysqli->query($edit_gift_query);
	$userid = $_POST['userdelid'];
} 
else {  $userid = $_POST['userdelid'];  }

$order_id=date("dy").substr(uniqid(mt_rand()), 0, 3);
$is_trxid='';
if($_POST['payment_option_selected']=="COD"){
	$is_trxid='COD';
	$ot_trx_status = 'Success';
	}
	else if($_POST['payment_option_selected']=="PIN"){
		$is_trxid='';
		$ot_trx_status = 'Success';
	}
	else {   $ot_trx_status = 'Processing';  }

if($_POST['saveaspass']=='1'){
$password =	md5($_POST['regpassword']);
	$query1231 = $mysqli->query("INSERT INTO registeruser set name='".$mysqli->escape_string($_POST['cust_firstname'])."',userid='$userid',email = '".$mysqli->escape_string($_POST['cust_emailaddress'])."', password = '".$password."',usr_company = '".$mysqli->escape_string($_POST['cust_companyname'])."',usr_streetaddress1 = '".$mysqli->escape_string($_POST['cust_housenumber'])."',postcode = '".$mysqli->escape_string($_POST['cust_postcode'])."',usr_zipcode2letter = '".$mysqli->escape_string($_POST['cust_2lettersofyourPostcode'])."',usr_order_city = '".$mysqli->escape_string($_POST['cust_towncity'])."',usr_order_phone = '".$mysqli->escape_string($_POST['cust_phone'])."',confirmpassword='".$_POST['regpassword']."' ");

if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }	
	
$_SESSION['username'] = $_POST['cust_emailaddress'];
	$_SESSION['curntpostcode'] = $_POST['cust_postcode'];
	 $From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
	if($current_lang=='en'){
$subject = 'Restaurant Kamasutra  - Registration Confirmation';
	} else { 
$subject = 'Restaurant Kamasutra  - registratie Bevestiging
';
	}
	if($current_lang=='en'){
$message = '<h3>Welcome '.$_POST['cust_firstname'].' </h3>

<p>Thank you for creating an account at Restaurant Kamasutra . Your account has been created. login details below<p>
<p><b>Usename :</b> '.$_POST['cust_emailaddress'].'</P>
<p><b>Password :</b> '.$_POST['regpassword'].'</P>

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.',<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
</p>
';
	} else { 
	$message = '<h3>Welkom '.$_POST['cust_firstname'].' </h3>

<p>Bedankt voor een account aanmaken bij Restaurant Kamasutra .Je account is aangemaakt. hieronder login gegevens.<p>
<p><b>Gebruikersnaam :</b> '.$_POST['cust_emailaddress'].'</P>
<p><b>Wachtwoord :</b> '.$_POST['regpassword'].'</P> 

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.',<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Tel: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'</p>
';
	}
$to_id = $_POST['cust_emailaddress'];

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
} else { 
	if(empty($_POST['saveaspass'])){
		 $notification_message="pass";
	}
	else{
			if($current_lang=='dutch'){
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Deze e-mailadres is al geregistreerd.</div></div></div>';
	
	} else { 
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Emailid already exit.</div></div></div>';
	}
	}
	


}
$querygetcop = $mysqli->query("select * from lostcustomercoupon where id = '1' ");
$rowcouponp = $querygetcop->fetch_array();
    if($rowcouponp['status']=='Active'){
        if(isset($_SESSION['username'])){
            $querygetorder = $mysqli->query("select * from tbl_orders where regisid = '".$_SESSION['username']."' ");
            $countorder = $querygetorder->num_rows;
            if($countorder=='0'){
                include'mailcouponorder.php';
                $querygetorder = $mysqli->query("update registeruser set qrcode = '".$rowcoupon['couponcode']."' where email = '".$_SESSION['username']."' ");
                }
            }
}

$product_name=($current_lang=="en")?"Name":"Naam";
$product_total=($current_lang=="en")?"Total":"Totaal";
$alldata = '<div class="table-responsive" id="order_table"><table class="table table-bordered table-striped"   style="word-wrap: break-word;width:100%"><tr><th align="left"  style="width:66%;word-wrap: break-word;">'.$product_name.'</th><th align="right">'.$product_total.'</th></tr>';
foreach($_SESSION["shopping_cart"] as $keys => $values){
   $totalsnew =  $values["product_quantity"] * $values["product_price"];
   $totalnews2 =  number_format($totalsnew, 2, ",", ".");
  $alldata.='<tr><td ><span  style="max-width:83%;display: inline-block;word-break: break-all;font-size:14px;"><span style="vertical-align:top;"  style="font-size:12px">'.$values["product_quantity"].'x</span> '.$values["product_name"].'</span></td><td align="right">'.$currency.' '.$totalnews2.'</td></tr>';

  }

$alldata .= '<tr ><td><b>'.$subtotal.'</b></td><td align="right">' . $currency .  " " .  number_format($_SESSION["order_session"]['base_total'], 2, ",", ".") .'</td></tr>';


// if delivery chareg is more then 0
if(isset($_SESSION["postcode_deli_chrg"]) && $_SESSION["postcode_deli_chrg"]>0.00){
 $alldata .= '<tr><td>'.$delivery_charge.'</td><td align="right" id="cart_delivery_charge_now">' . $currency .  " " . number_format($_SESSION["postcode_deli_chrg"], 2, ",", ".").'</td></tr>'; 
}

// If discount is added
if(isset($_SESSION["order_session"]['discount_amt']) && $_POST['couponchargene']==''){
 $alldata .= '<tr><td>'.$discount_percentage.'</td><td align="right">- ' . $currency .  " " .  number_format($_SESSION["order_session"]["discount_amt"], 2, ",", ".") . '</td></tr>'; 
}

// If plastick cahrgee is added
if(isset($_SESSION["order_session"]['plast_charge'])){
 $alldata .= '<tr><td>'.$plastic_charge.'</td><td align="right">' . $currency .  " " .  number_format($_SESSION["order_session"]["plast_charge"], 2, ",", ".") . '</td></tr>'; 
}

	 
//setlocale(LC_ALL, 'nl_NL');
$aa = $_POST['totalamount'];
$aa22 = $_POST['cutlerycharges'];
if($_POST['cutlery']=='yes'){
	if($_POST['cutlerycharges']!=''){
$alldata .= '<tr ><td>'.$Cutlery_charge.'</td><td align="right">' . $currency .  " " .  number_format($aa22, 2, ",", ".") . '</td></tr>';
	}  else {

	}
}


if($_POST['couponchargene']!=''){
	$alldata .= '<tr ><td>Coupon: '.$_POST['couponcodetext'].'</td><td align="right">- ' . $currency .  " " .  number_format($_POST['couponchargene'], 2, ",", ".") . '</td></tr>';
 
} else {

}


// if delivery chareg is more then 0
if(isset($_SESSION["order_session"]['plast_bag']) && $_SESSION["order_session"]['plast_bag']>0.00){
 $alldata .= '<tr><td>'.$palstbag.'</td><td align="right" id="cart_delivery_charge_now">' . $currency .  " " . number_format($_SESSION["order_session"]['plast_bag'], 2, ",", ".").'</td></tr>'; 
}
 

$tipamt = $_POST['tip_amt'];
if(empty($tipamt) || $tipamt=='' || $tipamt==NULL){
	$alldata .= '<tr ><td><b>'.$finaltotal.'</b></td><td align="right" >' . $currency .  " " .  number_format($aa, 2, ",", ".") .'</td></tr>';
}
else{
$alldata .= '<tr><td><b>'.$tiptext.'</b></td><td align="right">' . $currency . " " . number_format($tipamt, 2, ",", ".")    .'</td></tr><tr ><td><b>'.$finaltotal.'</b></td><td align="right">' . $currency .  " " .  number_format($aa, 2, ",", ".") .'</td></tr>';
}

if(!empty($_POST['cust_freeitem']) || $_POST['cust_freeitem']!='' || $_POST['cust_freeitem']!=NULL){
	$_SESSION['free_item'] = $_POST['cust_freeitem'];
}

 




$alldata .= '</table></div>';

 $insert_order_query="INSERT INTO `tbl_orders`(`ot_id`,`ot_trxid`,`ot_UserId`, `ot_order_details`, `ot_subTotal`, `ot_deliveryCharge`, `ot_discount`, `ot_TotalAmount`, `ot_giftitem`,`ot_odrnote`,`ot_pick_del`, `ot_paymentoption`,`ot_OrderDate`, `ot_status`,`ot_trx_status`,`ot_time`,`del_time`,`cutlery`,`cutlerycharges`,`alldata`,`clang`,`regisid`,`couponcode`,`couponcharge`,`tip_amt`,`total_plstc_bg`) VALUES ('".$order_id."','".$is_trxid."','".$userid."','','".$_SESSION['order_session']['base_total']."','". $_SESSION['postcode_deli_chrg']."','".$_SESSION['discount_amt']."','".$mysqli->escape_string($_POST['totalamount'])."','".$mysqli->escape_string($_POST['cust_freeitem'])."','".$mysqli->escape_string($_POST['cust_ordernotes'])."','".$_POST['pick_or_del']."','".$_POST['payment_option_selected']."','".date("Y-m-d h:m:i")."','Pending','".$ot_trx_status."','".$ot_time."','".$mysqli->escape_string($_POST['del_time'])."','".$mysqli->escape_string($_POST['cutlery'])."','".$mysqli->escape_string($_POST['cutlerycharges'])."','".$alldata."','".$_SESSION['current_lang']."','".$sessionemail."','".$_POST['couponcodetext']."','".$_POST['couponchargene']."','".$mysqli->escape_string($_POST['tip_amt'])."','".$mysqli->escape_string($_POST['plastic_charge'])."')";
//echo $insert_order_query;

$insert_order_query_result = $mysqli->query($insert_order_query);


if($insert_order_query_result) {
	 foreach($_SESSION["shopping_cart"] as $keys => $values){
		 $proinsert = $mysqli->query("insert into order_product_details set ot_id = '".$order_id."',product_id='".$_SESSION["shopping_cart"][$keys]['product_id']."',product_name='".$_SESSION["shopping_cart"][$keys]['product_name']."',product_price='".number_format($_SESSION["shopping_cart"][$keys]['product_price'],2)."',product_quantity='".$_SESSION["shopping_cart"][$keys]['product_quantity']."' ");
}
mysqli_commit($mysqli);
if(mysqli_commit($mysqli)){$notification_message="pass";}else{$notification_message="fail";}	
}else{
  ///  mysqli_total_pricerollback($mysqli);
    $notification_message="fail";
}
 

$data = array(
 'order_id'  => $order_id,
 'order_time'  => date("Y-m-d"),
 'payment_method'  => $_POST['payment_option_selected'],
 'pass_or_fail'=>$notification_message,   
 'total_payable_amt'=>$_POST['totalamount'] 
); 
echo json_encode($data);