<?php
include 'db.php';
include 'config.php';
$userid = $_GET['id'];
$page = $_GET['m'];
$otid = $_GET['otid'];
$usr_detal_query="Select * from tbl_user where usr_id='$userid'";
$result_usr_detal_query = $mysqli->query($usr_detal_query);
$row_usr = $result_usr_detal_query->fetch_assoc();

$usr_detal_query11="Select * from tbl_orders where ot_id='$otid'";
$result_usr_detal_query11 = $mysqli->query($usr_detal_query11);
$row_usr11 = $result_usr_detal_query11->fetch_assoc();

$usr_detal_query21="Select * from gspmail ";
$result_usr_detal_query21 = $mysqli->query($usr_detal_query21);
$row_usr21 = $result_usr_detal_query21->fetch_assoc();
if($row_usr11['clang']=='en'){
$gpsmail = $row_usr21['rh_msg_en'];
} else { 
$gpsmail = $row_usr21['rh_msg_nl'];	
}

$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
$rest_title= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_title'")->fetch_object()->adm_set_vlu;
$rest_addrss= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_addrss'")->fetch_object()->adm_set_vlu;
$rest_postcode= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode'")->fetch_object()->adm_set_vlu;
$rest_postcode_two= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode_two'")->fetch_object()->adm_set_vlu;
$rest_city= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_city'")->fetch_object()->adm_set_vlu;
$rest_cont= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_cont'")->fetch_object()->adm_set_vlu;

if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }

$subject = $rest_rest_title;
$message = ' 
<h3>Dear '.$row_usr['usr_first_name'].' </h3>
<p>Your order #'.$otid.' is on the way<p>
'.$gpsmail.' 

<br/><br/>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Telephone: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
';
$to_id=$row_usr['usr_emailid'];
//$to_id='jyoti@digipanda.co.in';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
$edit_gift_query = "UPDATE `tbl_orders` SET `gpsstatus`='1' WHERE `ot_id`='" . $otid . "'";
        $edit_gift_query_result = $mysqli->query($edit_gift_query);
if($page=='1'){
header("location:online-orders.php?n=1");
}
elseif($page=='2')
{
header("location:current_month_orders.php?n=1");
}
else
{
header("location:all-order.php?n=1");
}
?>