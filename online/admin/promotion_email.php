<?php 
include 'db.php';
include 'config.php';

$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;


if(isset($_POST)){

$action=$_POST['action'];
$subject=$_POST['subject'];
$newslettertext=$_POST['newslettertext'];

if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }
	
if($action=='reg_users'){


	
$sql=mysqli_query($mysqli,"select email from registeruser");

if(mysqli_num_rows($sql) > 0){

 while($arrays=mysqli_fetch_assoc($sql)){

    
	$subject =$subject;
	$message =' '.$newslettertext.'
		
		
	<br/>
<br/>

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.' <br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
</p>
';
		;	
	 
	$to_id=$arrays['email'];

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	 mail($to_id,$subject,$message,$headers);
	 
		 
  }
  echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Mail Send to all registered users successfully.</div></div></div>';
	}
	exit();
}
elseif ($action=='imp_users'){


$sql=mysqli_query($mysqli,"select email from email_import");

if(mysqli_num_rows($sql) > 0){

 while($arrays=mysqli_fetch_assoc($sql)){

    
	$subject =$subject;
	$message =' '.$newslettertext.'

<br/>
<br/>

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
</p>
';

		
		;
	 
	$to_id=$arrays['email'];

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	mail($to_id,$subject,$message,$headers);
		
	
  }
  echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Mail Send to all Import users successfully.</div></div></div>';
	}
	exit();
}	
	
elseif ($action=='res_users'){


$sql=mysqli_query($mysqli,"select email from reservation_tbl");

if(mysqli_num_rows($sql) > 0){

 while($arrays=mysqli_fetch_assoc($sql)){

    
	$subject =$subject;
	$message =' '.$newslettertext.'

<br/>
<br/>

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
</p>
';

		
		;
	 
	$to_id=$arrays['email'];

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	mail($to_id,$subject,$message,$headers);
		
	
  }
  echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Mail Send to all Import users successfully.</div></div></div>';
	}
	exit();
}	
	
	
	else{

	



$sqls=mysqli_query($mysqli,"select email from promotion_tbl");

	if(mysqli_num_rows($sqls) > 0){

 while($array=mysqli_fetch_assoc($sqls)){

    
	$subject =$subject;
	$message =' '.$newslettertext.'
	
	<br/>
<br/>

<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.' <br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
</p>
';
		;
	
	 
	$to_id=$array['email'];

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	mail($to_id,$subject,$message,$headers);
		
	
  }
  echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Mail Send to all promotion users successfully.</div></div></div>';
	}
}


}

?>