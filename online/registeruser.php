<?php 
include 'admin/db.php';
include 'admin/phpqrcode/qrlib.php';
$email = $_POST['email'];
$name = $_POST['name'];
$cname = $_POST['cname'];
$postcode = $_POST['postcode'];
$twoletter = $_POST['twoletter'];
$streetaddress = $_POST['streetaddress'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
$queryget = $mysqli->query("select * from registeruser where email = '$email'");
$countreg = $queryget->num_rows;
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
session_start();
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
if($countreg==0){
$query = $mysqli->query("INSERT INTO tbl_user set usr_first_name='$name',regisid = '$email',usr_emailid = '$email',usr_company = '$cname',usr_streetaddress1 = '$streetaddress',usr_zipcode = '$postcode',usr_zipcode2letter = '$twoletter',usr_order_city = '$city',usr_order_phone = '$phone',qrcode='$file' ");
$userid = $mysqli -> insert_id;
$query11 = $mysqli->query("INSERT INTO registeruser set name='$name',userid='$userid',email = '$email', password = '$password',usr_company = '$cname',usr_streetaddress1 = '$streetaddress',postcode = '$postcode',usr_zipcode2letter = '$twoletter',usr_order_city = '$city',usr_order_phone = '$phone',confirmpassword='".$_POST['password']."' ");

$_SESSION['username'] = $email;
	$_SESSION['curntpostcode'] = $postcode;
	$notification_message = '1';
           $From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
$rest_title= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_title'")->fetch_object()->adm_set_vlu;
$rest_addrss= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_addrss'")->fetch_object()->adm_set_vlu;
$rest_postcode= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode'")->fetch_object()->adm_set_vlu;
$rest_postcode_two= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode_two'")->fetch_object()->adm_set_vlu;
$rest_city= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_city'")->fetch_object()->adm_set_vlu;
$rest_cont= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_cont'")->fetch_object()->adm_set_vlu;

	if($current_lang=='en'){
$subject = $rest_rest_title.'- Registration Confirmation';
	} else { 
$subject = $rest_rest_title.'- registratie Bevestiging';
	}
	
if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }
	
	if($current_lang=='en'){
$message = '<h3>Welcome '.$name.' </h3>

<p>Thank you for creating an account at '.$rest_rest_title.' Your account has been created. login details below<p>
<p><b>Usename :</b> '.$email.'</P>
 

<br/><br/>
'.$rest_title.'<br/>
'.$rest_addrss.',<br/>
'.$rest_postcode.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Telephone: '.$rest_cont.'<br/>
'.$From_Email_Address.'<br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
';
	} else { 
	$message = '<h3>Welkom '.$name.' </h3>

<p>Bedankt voor een account aanmaken bij '.$rest_rest_title.' .Je account is aangemaakt. hieronder login gegevens.<p>
<p><b>Gebruikersnaam :</b> '.$email.'</P>
 

'.$rest_rest_title.'<br/>
'.$rest_addrss_main.',<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Telephone: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
';	
	}
$to_id = $email;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);

} else { 
	if($current_lang=='dutch'){
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Deze e-mailadres is al geregistreerd.</div></div></div>';
	
	} else { 
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Emailid already exit.</div></div></div>';
	}
}
echo $notification_message;
?>