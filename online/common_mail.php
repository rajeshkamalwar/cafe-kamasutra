<?php 
session_start();

include 'admin/db.php';
include 'config.php';


//language code end//

//booking mail to user at time of booking form//

 $chk_in_odrdis_tab = "SELECT * FROM `res_custom_field` where `status` ='1'";      
	   $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
	   $email_result1=mysqli_fetch_assoc($chk_in_odrdis_tab_result);
 	   $status_send_field = $email_result1['status'];
 		 


if($status_send_field==1){
	
 function sendMAilToUser($name,$email,$from,$subject,$content,$footer,$opt_field_name,$opt_field,$people,$date,$phone,$msg) {
 if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
           $current_lang = $_SESSION['current_lang'];  
if ($current_lang == "en" || isset($_GET['langca']) && $_GET['langca']==1) {               
                $ldate="Date";
                $lperson="Person";
                $lname = "Name";
                $lemail="E-mail Address";
                $lphone="Telephone Number";
	            $lmsg="Message";
                $thankyou="Thank you";
                $request="Your request";
                $this_text="This message was sent by";
                $on="on";
                $admin="Dear Admin";             
            } else {
                $ldate="Datum";
                $lperson="Persoon";
                $lname = "Naam";
                $lemail="E-mail adres";
                $lphone="Telefoon nummer";
	            $lmsg="Bericht";
                $thankyou="Bedankt";
                $request="Uw aanvraag";
                $this_text="Dit bericht is verzonden door";
                $on="op";
                $admin="Beste Admin";
}  
	
 echo $opt_fieldname;
		
	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');
	$message ='<h3>'.$thankyou.' '.$name.'</h3>';
	$message .=$content;

 
	$message .='<h3>'.$request.':</h3>';
	$message .='<p>'.$lname.': '.$name.'</p>';
	$message .='<p>'.$lperson.': '.$people.'</p>';
	$message .='<p>'.$ldate.': '.$date.'</p>';

	$message .='<p>'.$lphone.': '.$phone.'</p>';
	$message .='<p>'.$lemail.': '.$email.'</p>';
	 	$message .='<p>'.$opt_field_name.': '.$opt_field.'</p>';	
	$message .='<p>'.$lmsg.': '.$msg.'</p>';
	$message .='<br>';
	$message .=$footer;
	$message .='<p>'.$this_text.' '.$site_url.' '.$on.' '.$current_date.'.</p>';
	$From_Email_Address=$from;
	$to_id=$email;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($to_id,$subject,$message,$headers);		
	return $mail;
	 
	 print_r($message);
}
}
else{
	function sendMAilToUser($name,$email,$from,$subject,$content,$footer,$opt_field_name,$opt_field,$people,$date,$phone,$msg) {


//language start//

 if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
           $current_lang = $_SESSION['current_lang'];
  
if ($current_lang == "en" || isset($_GET['langca']) && $_GET['langca']==1) {               
                $ldate="Date";
                $lperson="Person";
                $lname = "Name";
                $lemail="E-mail Address";
                $lphone="Telephone Number";
	            $lmsg="Message";
                $thankyou="Thank you";
                $request="Your request";
                $this_text="This message was sent by";
                $on="on";
                $admin="Dear Admin";             
            } else {
                $ldate="Datum";
                $lperson="Persoon";
                $lname = "Naam";
                $lemail="E-mail adres";
                $lphone="Telefoon nummer";
	            $lmsg="Bericht";
                $thankyou="Bedankt";
                $request="Uw aanvraag";
                $this_text="Dit bericht is verzonden door";
                $on="op";
                $admin="Beste Admin";
}  
	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');
	$message ='<h3>'.$thankyou.' '.$name.'</h3>';
	$message .=$content;
	$message .='<h3>'.$request.':</h3>';
	$message .='<p>'.$lname.': '.$name.'</p>';
	$message .='<p>'.$lperson.': '.$people.'</p>';
	$message .='<p>'.$ldate.': '.$date.'</p>';
    $message .='<p>'.$lphone.': '.$phone.'</p>';
	 $message .='<p>'.$lemail.': '.$email.'</p>';
	$message .='<p>'.$lmsg.': '.$msg.'</p>';
	$message .='<br>';
	$message .=$footer;
	$message .='<p>'.$this_text.' '.$site_url.' '.$on.' '.$current_date.'.</p>';
	$From_Email_Address=$from;
	$to_id=$email;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($to_id,$subject,$message,$headers);		
	return $mail;
}
}

//booking mail to admin for approval/
function sendMAilToAdmin($from,$subject,$content,$admin_email,$footer,$name,$people,$date,$phone,$email,$msg,$opt_field_name,$opt_field,$lastproid) {

//language start//

 if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
           $current_lang = $_SESSION['current_lang'];
  
if ($current_lang == "en" || isset($_GET['langca']) && $_GET['langca']==1) {
               
                $ldate="Date";
                $lperson="Person";
                $lname = "Name";
                $lemail="E-mail Address";
                $lphone="Telephone Number";
	            $lmsg="Message";
                $thankyou="Thank you";
                $request="Your request";
                $this_text="This message was sent by";
                $on="on";
                $admin="Dear Admin";
	 		    $approve="Approve";
	   $Cancell="Cancel";
	$langca = 1;
             
            } else {

                $ldate="Datum";
                $lperson="Persoon";
                $lname = "Naam";
                $lemail="E-mail adres";
                $lphone="Telefoon nummer";
	            $lmsg="Bericht";
                $thankyou="Bedankt";
                $request="Uw aanvraag";
                $this_text="Dit bericht is verzonden door";
                $on="op";
                $admin="Beste Admin";
				  $approve="Goedkeuren";
           $Cancell="Annuleren";
	$langca = 2;

            }  

	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');	
	$message ='<h3>'.$admin.'</h3>';
	$message .=$content;
	$message .='<h3>'.$request.':</h3>';

	$message .='<p>'.$lname.': '.$name.'</p>';
	$message .='<p>'.$lperson.': '.$people.'</p>';
	$message .='<p>'.$ldate.': '.$date.'</p>';
	$message .='<p>'.$lphone.': '.$phone.'</p>';
	$message .='<p>'.$lemail.': '.$email.'</p>';
	$message .='<p>'.$lmsg.': '.$msg.'</p>';
	if($opt_field!=''){
    	$message .='<p>'.$opt_field_name.': '.$opt_field.'</p>';
	}
	$message .='<br>';
	if($lastproid!=9999){
    $message .='<br>';
	$message .='<p><a style="background-color:green;color:#fff;padding: 10px;" href="https://restaurantkamasutra.nl/online/approve.php?resid='.$lastproid.'&langca='.$langca.'">'.$approve.'</a> <a style="background-color:red;color:#fff;padding: 10px;" href="https://restaurantkamasutra.nl/online/rescancel.php?resid='.$lastproid.'&langca='.$langca.'">'.$Cancell.'</a></p>';
		$message .='<br>';
	} 
	
	$message .='<br>';
	$message .=$footer;
	$message .='<p>'.$this_text.' '.$site_url.' '.$on.' '.$current_date.'.</p>';
	// '<p>His/Her '.$email.' .</p>';
	$From_Email_Address=$from;
	$admin_email=$admin_email;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($admin_email,$subject,$message,$headers);
		
	return $mail;
}


// mail for approval to user/

function sendapprovalMAilToUser($username,$email,$from,$subject,$content,$footer,$people,$date,$time,$phone,$current_lang,$msg,$opt_field_name,$custom_field_opt) {

//language start//

if ($current_lang == "en" || isset($_GET['langca']) && $_GET['langca']==1) {
               
                $ldate="Date";
                $lperson="Person";
                $lname = "Name";
                $lemail="E-mail Address";
                $lphone="Telephone Number";
	            $lmsg="Message";
				 $ltime="Time";
                $thankyou="Thank you";
                $request="Your request";
                $this_text="This message was sent by";
                $on="on";
                $admin="Dear Admin";
             
            } else {

                $ldate="Datum";
                $lperson="Persoon";
                $lname = "Naam";
                $lemail="E-mail adres";
                $lphone="Telefoon nummer";
	            $lmsg="Bericht";
                $thankyou="Bedankt";
                $request="Uw aanvraag";
                $this_text="Dit bericht is verzonden door";
                $on="op";
                $admin="Beste Admin";
				 $ltime="Tijd";
          


            }  


	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');	
	$message ='<h3>'.$thankyou.' '.$username.'</h3>';
	$message .=$content;
	$message .='<h3>'.$request.':</h3>';

	$message .='<p>'.$lname.': '.$username.'</p>';
	$message .='<p>'.$lperson.': '.$people.'</p>';
	$message .='<p>'.$ldate.': '.$date.'</p>';
    $message .='<p>'.$ltime.': '.$time.'</p>';
	$message .='<p>'.$lphone.': '.$phone.'</p>';
	$message .='<p>'.$lemail.': '.$email.'</p>';
	$message .='<p>'.$lmsg.': '.$msg.'</p>';
	if($custom_field_opt!=''){
		$message .='<p>'.$opt_field_name.': '.$custom_field_opt.'</p>';
	}
	$message .='<br>';
	$message .=$footer;
	$message .='<p>'.$this_text.' '.$site_url.' '.$on.' '.$current_date.'.</p>';
	$From_Email_Address=$from;
	$email=$email;

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($email,$subject,$message,$headers);
		
	return $mail;
}




// mail for cancel to user/

function sendcancelMAilToUser($username,$email,$from,$subject,$content,$footer,$people,$date,$phone,$current_lang) {

//language start//

if ($current_lang == "en" || isset($_GET['langca']) && $_GET['langca']==1) {
               
                $ldate="Date";
                $lperson="Person";
                $lname = "Name";
                $lemail="E-mail Address";
                $lphone="Telephone Number";
	            $lmsg="Message";
                $thankyou="Thank you";
                $request="Your request";
                $this_text="This message was sent by";
                $on="on";
                $admin="Dear Admin";
             
            } else {

                $ldate="Datum";
                $lperson="Persoon";
                $lname = "Naam";
                $lemail="E-mail adres";
                $lphone="Telefoon nummer";
	            $lmsg="Bericht";
                $thankyou="Bedankt";
                $request="Uw aanvraag";
                $this_text="Dit bericht is verzonden door";
                $on="op";
                $admin="Beste Admin";
          


            }  

	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');	
	$message ='<h3>'.$thankyou.' '.$username.'</h3>';
	$message .=$content;
	$message .='<h3>'.$request.':</h3>';

	$message .='<p>'.$lname.': '.$username.'</p>';
	$message .='<p>'.$lperson.': '.$people.'</p>';
	$message .='<p>'.$ldate.': '.$date.'</p>';
	$message .='<p>'.$lphone.': '.$phone.'</p>';
	$message .='<p>'.$lemail.': '.$email.'</p>';
	$message .='<p>'.$lmsg.': '.$msg.'</p>';
	$message .='<br>';
	$message .=$footer;
	$message .='<p>'.$this_text.' '.$site_url.' '.$on.' '.$current_date.'.</p>';
	$From_Email_Address=$from;
	$email=$email;
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($email,$subject,$message,$headers);
		
	return $mail;
}



// Auto approval mail to admin//
function sendautoapprovalMAilToAdmin($from,$subject,$content,$admin_email,$footer) {

	$site_url=$_SERVER['SERVER_NAME'];
	$current_date=date('d F Y H:i');	
	$message ='<h3>Dear Admin</h3>';
	$message .=$content;

	$message .=$footer;
	$message .='<p>This message was sent by '.$site_url.' on '.$current_date.'.</p>';
	// '<p>His/Her '.$email.' .</p>';
	$From_Email_Address=$from;
	$admin_email=$admin_email;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: $From_Email_Address";
	$mail=mail($admin_email,$subject,$message,$headers);
		
	return $mail;
}



?>