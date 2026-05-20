<?php 
include 'admin/db.php';
$queryget = $mysqli->query("select * from registeruser where email = '".$_POST['emailid']."'");
$countreg = $queryget->num_rows;
if($countreg>0){
	echo $notification_message = 1;
	/*if($current_lang=='dutch'){
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Deze e-mailadres is al geregistreerd.</div></div></div>';
	
	} else { 
		$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Emailid already exit.</div></div></div>';
	}*/
} else {
echo $notification_message= 0;
}
?>