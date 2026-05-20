<?php 
include 'db.php';
include 'config.php';


 


function sendOtP($name,$email,$code,$discount,$expire_date,$mail_footer,$res_email_main) {
if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }
$subject = 'Restaurant Kamasutra  Promtion Discount';
$message ='<h3>Dear '.$name.',</h3>
<p>'.$dish.' '.$discount.' with <b>'.$code.'</b> coupon code. This coupon code is valid till <b>'.date('d-m-Y',strtotime($expire_date)).'.</b></p>
<br>
<p><b>Deal Terms:</b></p>
<p><b>Validity:</b> 1 months from the time of issue on all days of the week (excluding holidays).</p>
<p>Reservations: At least 2 hours in advance via restaurantkamasutra.nl.</p>
<p><b>Mention:</b> Coupon code mentioned during reservation.</p>


<p>With Best Regards,</p>
<p>'.$mail_footer.'</p>';
	
$From_Email_Address=$res_email_main;
$to_id=$email;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
$mail=mail($to_id,$subject,$message,$headers);
	
return $mail;
}

function sendmail($name,$email,$discount,$mail_footer,$res_email_main) {

$subject = 'Redeemed Discount Coupon';
$message ='<h3>Dear '.$name.'</h3>
<p>'.$discount.'</p>
<p>We hope you enjoyed your delicious food and would love to hear your feedback.</p>
<p>Please take a moment to review us on Google through below link.</p>
<p><a href="https://www.google.com/search?q=Pakwaan+restaurant&sxsrf=AOaemvKKukatcR-57rgZ8BU4NN_ZMEHkFg%3A1631609938483&source=hp&ei=UmRAYdS3Ge-Vxc8PtYmU2AM&iflsig=ALs-wAMAAAAAYUByYmaBwNJU41VCLVef4DlHSYR_K0J4&gs_ssp=eJzj4tVP1zc0zK7KykkzMc8zYLRSNagwMU82M7A0MbZMNE02SzI2tTKoMDOzNLY0MbUwNE4ys0xLMfQSLEpMSkxMUihKLS5JLC1KzCsBAOP5FVg&oq=Pakwaan&gs_lcp=Cgdnd3Mtd2l6EAEYADIOCC4QgAQQxwEQrwEQkwIyBQgAEMsBMgsILhDHARCvARDLATIHCAAQChDLATIHCAAQChDLATIFCAAQywEyBwgAEAoQywEyBwgAEAoQywEyBwgAEAoQywEyBwgAEAoQywE6BAgjECc6BQgAEIAEOggIABCABBCxAzoICC4QgAQQsQM6EQguEIAEELEDEIMBEMcBEKMCOgsILhCABBCxAxCDAToFCC4QgAQ6CwgAEIAEELEDEIMBOgsILhCABBDHARCvAToECAAQCjoHCC4QsQMQCjoHCAAQsQMQCjoECC4QClDbDVjKGmD1LmgAcAB4AIABgAGIAZkEkgEDNS4xmAEAoAEB&sclient=gws-wiz#lrd=0x47c609439a5c6b35:0x6693945813b69fd1,1,,">Give Review</a></p>

<p>Thank you in advance for your feedback. We look forward to welcome you soon...</p>

<p>With Best Regards,</p>
<p>'.$mail_footer.'</p>';	
$From_Email_Address=$res_email_main;
$to_id=$email;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
$mail=mail($to_id,$subject,$message,$headers);
	
return $mail;
}


function sendReminder($name,$email,$expire,$mail_footer,$res_email_main) {
		

	
$subject = 'Your Coupon Code will Expire Very Soon';
$message ='<h3>Dear '.$name.'</h3>
<p>Thanks for visiting us. We hope we were able to meet your expectations. Just to let you know that your coupon code expires Very Soon</p>
<p>To take advantage of this offer, you can easily book your table online at Restaurant Kamasutra  and enjoy the Indian and Indonesian cuisine.</p>

<p>With Best Regards,</p>
<p>'.$mail_footer.'</p>';	
$From_Email_Address=$res_email_main;
$to_id=$email;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
$mail=mail($to_id,$subject,$message,$headers);
	
return $mail;
}

?>