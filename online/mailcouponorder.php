<?php
$userid = $userid;
$queryget1 = $mysqli->query("select * from tbl_user where usr_id = '".$userid."' ");
$rowget = $queryget1->fetch_array();
$querygetco = $mysqli->query("select * from lostcustomercoupon where id = '1' ");
$rowcoupon = $querygetco->fetch_array();
$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
$rest_title= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_title'")->fetch_object()->adm_set_vlu;
$rest_addrss= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_addrss'")->fetch_object()->adm_set_vlu;
$rest_postcode= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode'")->fetch_object()->adm_set_vlu;
$rest_postcode_two= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode_two'")->fetch_object()->adm_set_vlu;
$rest_city= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_city'")->fetch_object()->adm_set_vlu;
$rest_cont= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_cont'")->fetch_object()->adm_set_vlu;

	if($current_lang=='en'){
$subject = $rest_rest_title.'- Coupon';
	} else { 
$subject = $rest_rest_title. '- Korting';
	}

if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }

	if($current_lang=='en'){
$message = '<h3>Welcome '.$rowget['usr_first_name'].' </h3>
<p>'.$rowcoupon['restra_holi_en'].'</p>
<p>Use this coupon code : '.$rowcoupon['couponcode'].'</p>

'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Telephone: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'<br/>
';
	} else { 
	$message = '<h3>Welkom '.$rowget['usr_first_name'].' </h3>
<p>'.$rowcoupon['restra_holi_nl'].'</p>
<p>Use this coupon code : '.$rowcoupon['couponcode'].'</p>
<br/><br/>
'.$rest_title.'<br/>
'.$rest_addrss.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Telephone: '.$rest_cont.'<br/>
'.$From_Email_Address.'<br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'<br/>
';	
	}
$to_id = $_POST['cust_emailaddress'];

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
?>