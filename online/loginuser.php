<?php 
include 'admin/db.php';
$username = $_POST['username'];
$userpassword = md5($_POST['userpassword']);
$queryget = $mysqli->query("select * from registeruser where email = '$username' and password = '$userpassword' ");
$countreg = $queryget->num_rows;
session_start();
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
if($countreg>0){
$row = $queryget->fetch_assoc();
$postcode11 = $row['postcode'];
$_SESSION['curntpostcode'] = $postcode11;
$_SESSION['username'] = $username;
	$notification_message = '1';
           
} else { 
	if($current_lang == "dutch"){
	$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Verkeerde gebruikersnaam wachtwoord ... probeer het opnieuw.</div></div></div>';
	
	} else { 
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Wrong username password...try again.</div></div></div>';
		}
           
}
echo $notification_message;
?>