<?php
session_start();
require_once 'admin/db.php';
require_once 'common_mail.php';

 //set timezone//
///date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'nl_NL');
error_reporting(0);

//language start//

 if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
           $current_lang = $_SESSION['current_lang'];

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reservation form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style> 
body{ background:transparent; }
h1, h2, h3, h4, h5, h6,a, p, div,td,th,input,textarea,button {
    font-family: 'Poppins', sans-serif;
    letter-spacing: 0.2px; 
    -webkit-text-size-adjust: none;
} 
</style>	
</head>
<body> 
<div class="container  reservation-box">
   <div class="right_div reservation-form">
      <?php  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>    
        </div>	
	<?php
	 if(isset($_GET['resid'])){ 
		$resid = $_GET['resid']; 
		 
	 $checreserv=mysqli_query($mysqli,"select * from reservation_tbl where res_id='$resid'");	 
		 $chkifsecus=mysqli_fetch_assoc($checreserv);   
		  $status =$chkifsecus['res_status']; 	
		 if($status!='complete'){
		 
 $person_data2=mysqli_query($mysqli,"select * from reservation_tbl where res_id='$resid'");
          $resdate=mysqli_fetch_assoc($person_data2);   
		  $name =$resdate['name']; 	
		  $email =$resdate['email'];
		  $person =$resdate['person'];
		  $phone =$resdate['phone'];
		  $date =$resdate['date'];
		  $time =$resdate['time'];
		 
		 
   if(isset($_GET['langca']) && $_GET['langca']==1){                  
                   $email_query = "select * from email_templete where type='3'";
              }else{
                  $email_query = "select * from email_templete where type='8'";
    }
		 
			 
				 
    $email_results= mysqli_query($mysqli,$email_query);
$email_result=mysqli_fetch_assoc($email_results);	 sendapprovalMAilToUser($name,$email,$email_result['form'],$email_result['subject'],$email_result['content'],$email_result['footer'],$person,$date,$time,$phone,$lang,$msg,$opt_field_name,$custom_field_opt);
 	 
///	mysqli_query($mysqli,"UPDATE reservation_tbl SET res_status='complete' WHERE res_id='" . $resid . "'"); 	
			 
			 
			 
			 
	?>
  <h2 class="text-center">
	  <?php  if(isset($_GET['langca']) && $_GET['langca']==1){ ?>
	  This reservation is approved of <?php echo $name;echo ' , '; echo $email;
		  }													  
	  else{ ?>
		  Deze reservering wordt goedgekeurd <?php echo $name;echo ' , '; echo $email; 
	  }
	  ?> </h2>
 <?php }
	 }  ?>
   
</div>
 
</body>
</html>
  