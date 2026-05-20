<?php 
include 'admin/db.php';
session_start();
if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }

if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
$errormsg = '';
$showmsg = '';
if(isset($_POST['submit'])){
$email = $_POST['email'];
	$query = $mysqli->query("select * from registeruser where email = '$email' ");
	$count = $query->num_rows;
	$row = $query->fetch_array();
	if($count > 0){
	$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
if($current_lang=='en'){
$subject = 'Reset Password';
} else { 
$subject = 'Wachtwoord opnieuw instellen';
}
if($current_lang=='en'){
	$message = '<table border="1" cellpadding="0" cellspacing="0" style="font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; word-break: normal; color: rgb(0, 0, 0); font-family: Lato; font-size: 14px; width: 450pt; background: white; border: 1pt solid rgb(222, 222, 222);" width="600">
    <tbody>
        <tr>
            <td style="font-family: inherit; margin: 0px; border: none; padding: 0cm;" valign="top">
                <div align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 600px; background: rgb(172, 20, 19);" width="100%">
                        <tbody>
                            <tr>
                                <td style="font-family: inherit; margin: 0px; padding: 27pt 36pt;">
                                    <h1 style="margin: 0cm; line-height: 33.75pt;"><span style="font-size: 22.5pt; font-family: Helvetica, sans-serif; color: white; font-weight: normal;">Application for password recovery</span></h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="font-family: inherit; margin: 0px; border: none; padding: 0cm;" valign="top">
                <div align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 450pt;" width="600">
                        <tbody>
                            <tr>
                                <td style="font-family: inherit; margin: 0px; background: white; padding: 0cm;" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 600px;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="font-family: inherit; margin: 0px; padding: 36pt 36pt 24pt;" valign="top">
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Hello '.$row["name"].',</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Someone has requested a new password for the next account on</span> Pakwaan</p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">&nbsp;</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Username:&nbsp;<a href="mailto:'.$row["email"].'" style="color: rgb(17, 85, 204);" target="_blank">'.$row["email"].'</a></span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">If you have not requested this, you can ignore this email. If you want to continue:</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);"><a data-saferedirecturl="https://www.google.com/url?q=https://restaurantkamasutra.nl/online/resetpassword.php?token%3D38&source=gmail&ust=1613191103184000&usg=AFQjCNFcOKXuj11J3N8_Rg-ez_AUdkeUcg" href="https://restaurantkamasutra.nl/online/resetpassword.php?token='.$row["id"].'" style="color: rgb(89, 143, 222); word-break: break-word;" target="_blank"><span style="color: rgb(172, 20, 19);">Click here to reset your password</span></a></span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Thank you for reading.</span></p>."'.$rest_rest_title.'".<br>"'.$rest_addrss_main.'",<br>"'.$rest_postcode_main.'" "'.$rest_postcode_two.'" "'.$res_rest_city.'"<br>Telephone: "'.$res_rest_cont.'<br><a href="mailto:"'.$res_email_main.'" style="color: rgb(17, 85, 204);" target="_blank">"'.$res_email_main.'"</a><br>"'.$newcontact.'"<br>"'.$newrssinfo.'"<br><a data-saferedirecturl="https://www.google.com/url?q=http://www.restaurantkamasutra.nl&source=gmail&ust=1613191103184000&usg=AFQjCNEr-2zY1XF3WzXhbhgmwf11CEXdNQ" href="http://"'.$rest_weblink_main.'/" style="color: rgb(17, 85, 204);" target="_blank">"'.$rest_weblink_main.'"</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>';
} else { 
$message = '<table border="1" cellpadding="0" cellspacing="0" style="font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; word-break: normal; color: rgb(0, 0, 0); font-family: Lato; font-size: 14px; width: 450pt; background: white; border: 1pt solid rgb(222, 222, 222);" width="600">
    <tbody>
        <tr>
            <td style="font-family: inherit; margin: 0px; border: none; padding: 0cm;" valign="top">
                <div align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 600px; background: rgb(172, 20, 19);" width="100%">
                        <tbody>
                            <tr>
                                <td style="font-family: inherit; margin: 0px; padding: 27pt 36pt;">
                                    <h1 style="margin: 0cm; line-height: 33.75pt;"><span style="font-size: 22.5pt; font-family: Helvetica, sans-serif; color: white; font-weight: normal;">Aanvraag voor wachtwoordherstel</span></h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="font-family: inherit; margin: 0px; border: none; padding: 0cm;" valign="top">
                <div align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 450pt;" width="600">
                        <tbody>
                            <tr>
                                <td style="font-family: inherit; margin: 0px; background: white; padding: 0cm;" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" style="word-break: normal; width: 600px;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="font-family: inherit; margin: 0px; padding: 36pt 36pt 24pt;" valign="top">
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Hallo '.$row["name"].',</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Iemand heeft een nieuw wachtwoord aangevraagd voor het volgende account op</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">&nbsp;</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Gebruikersnaam:&nbsp;<a href="mailto:'.$row["email"].'" style="color: rgb(17, 85, 204);" target="_blank">'.$row["email"].'</a></span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Als je dit niet hebt aangevraagd, kun je deze e-mail negeren. Als je wilt doorgaan:</span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);"><a data-saferedirecturl="https://www.google.com/url?q=https://restaurantkamasutra.nl/online/resetpassword.php?token%3D38&source=gmail&ust=1613191103215000&usg=AFQjCNFlU6pwILWej4TopIFew7UKfeNPMg" href="https://restaurantkamasutra.nl/online/resetpassword.php?token='.$row["id"].'" style="color: rgb(89, 143, 222); word-break: break-word;" target="_blank"><span style="color: rgb(172, 20, 19);">Klik hier om je wachtwoord opnieuw in te stellen</span></a></span></p>
                                                    <p style="margin-right: 0cm; margin-bottom: 12pt; margin-left: 0cm; line-height: 15.75pt;"><span style="font-size: 10.5pt; font-family: Helvetica, sans-serif; color: rgb(99, 99, 99);">Bedankt voor het lezen.</span></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: inherit; margin: 0px; padding: 0pt 36pt;" valign="top">"'.$rest_rest_title.'"<br>"'.$rest_addrss_main.'",<br>"'.$rest_postcode_main.'" "'.$rest_postcode_two.'"  "'.$res_rest_city.'"<br>Telephone: '.$res_rest_cont.'" <br><a href="mailto:"'.$res_email_main.'" style="color: rgb(17, 85, 204);" target="_blank">"'.$res_email_main.'"</a><br>'.$newcontact.'<br>'.$newrssinfo.'<br><a data-saferedirecturl="https://www.google.com/url?q=http://www.restaurantkamasutra.nl&source=gmail&ust=1613191103215000&usg=AFQjCNGVquC5Q49NdP4iqg_VMGGKXgvnhw" href="http://'.$rest_weblink_main.'/" style="color: rgb(17, 85, 204);" target="_blank">"'.$rest_weblink_main.'"</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>
';
}
$to_id=$email;
//$to_id='jyoti@digipanda.co.in';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
		if($current_lang=='dutch'){
		$showmsg='Een wachtwoord reset-email is naar je geregistreerde e-mailadres gestuurd, maar het kan enkele minuten duren voor deze in je inbox verschijnt. Wacht minimaal 10 minuten voor je nog een poging tot resetten waagt.';
		} else { 
			$showmsg='A password reset email has been sent to your registered email address, but it may take a few minutes to appear in your inbox. Wait at least 10 minutes before attempting another reset.';
		}
	} else { 
		if($current_lang=='en'){
		$errormsg = 'Emailid is not registered';
		} else {
		$errormsg = 'Emailid is niet geregistreerd';
		}
			$showmsg='';
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	    <meta http-equiv="refresh" content="1200;url=fresh1.php" />
		<title> Online Order </title>
		<script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="jquery.redirect.js"></script>
		
		<style>
             .form-group {
             margin-bottom: 10px !important;
               }
			.forgerclass {
    text-align: center;
    font-size: 18px;
    line-height: 26px;
    margin-top: 20px;
    padding: 0px 200px 280px;
}
			@media only screen and (max-width: 767px) {
 .forgerclass {
    text-align: center;
    font-size: 18px;
    line-height: 26px;
    margin-top: 20px;
    padding: 0px 0px 280px;
}
}
			@media screen and (min-width: 768px) and (max-width: 991px) { 
    .forgerclass {
    text-align: center;
    font-size: 18px;
    line-height: 26px;
    margin-top: 20px;
    padding: 0px 100px 200px;
}
}
         </style>
		
    </head>
    <body class="checkout_page2">
    <?php include 'public_header.php'; 
		if($current_lang=='dutch'){
			$forgetbutton = 'Wachtwoord opnieuw instellen';
		} else { 
			$forgetbutton = 'reset Password';
		}
		
		?> 
        <div class="container checkoutpage rkgfi5 forgetpass news1">
            <?php

include 'css_file.php'; ?>

            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                currency = '<?php echo currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
                cop_cart_details_js = '';
            </script>
                   <div class="row">
					   <?php if($showmsg=='') { ?>
                        <div class="col-md-12">
							<?php if($current_lang=='dutch'){ ?>
							<h2>Wachtwoord vergeten? Voer je gebruikersnaam of e-mailadres in. Je ontvangt een link via e-mail om een nieuw wachtwoord in te stellen.</h2>
							<?php } else{ ?>
							<h2>Forgot your password? Enter your username or email address. You will receive a link via e-mail to set a new password.</h2>
							<?php } ?>
                          <form method="POST">
							  <p style="color:red;font-size: 22px;"> <?php echo $errormsg; ?></p>
							  <label><?php echo $L_Emailaddress?></label>
							  <input type="email" name="email" required>
							  <input type="submit" name="submit" value="<?php echo $forgetbutton;?>">
							</form>
					   </div>
					   <?php }else {  ?>
					   <p class="forgerclass"><?php echo $showmsg;?></p>
					   <?php }?>
    </div>
  </div>
	</body>
	
<?php include 'public_footer.php'; ?>
</html>
		  