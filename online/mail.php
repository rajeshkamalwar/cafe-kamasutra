<?php
session_start();
$current_lang = $_SESSION['current_lang'];
$ot_id = $order_no;
$query = "SELECT a.*, b.* From tbl_user a INNER JOIN tbl_orders b on a.usr_id = b.ot_UserId and b.ot_id = '" . $ot_id . "'";
$query_result = $mysqli->query($query);
$row = $query_result->fetch_array();

$result_query_abc = $mysqli->query("Select * From `adm_set`");
$logo_url = '';
$rest_titl = '';
while ($row12abc = $result_query_abc->fetch_assoc())
{
    if ($row12abc['adm_set_name'] == 'print_url')
    {
        $logo_url = $row12abc['adm_set_vlu'];
    }
    if ($row12abc['adm_set_name'] == 'rest_title')
    {
        $rest_titl = $row12abc['adm_set_vlu'];
    }
}

$order_lang = $row["clang"];

if ($order_lang == "en")
{
    $or_orderno = "Order Number:";
    $or_date = "Date:";
    $or_total = "Total:";
	$or_for = "Order for:";
    $or_paymethod = "Payment Method:";
    $paymentmethod_cash = "Cash";
    $twoline_msg = "Order Details";
    $cust_dtls_title = "Info";
    $or_email = 'Email';
    $or_notes = 'Order notes :';
    $or_tele = 'Telephone';
    $pickuptime = "Pick up Time";
    $deliverytime = "Delivery Time : ";
    $or_free_item = 'Free Item : ';
    $or_Pickup_Delivery = 'Pick up / Delivery :';
    $bill_addr = 'Billing Address';
    $deliveryee = 'Delivery';
    $pickupee = 'Pickup';
	$or_dt = "ORDER DETAIL";
	$cutleryyes = 'Yes';
	$Cutlery_charge = 'Cutlery Charge';
	$Cutlery = 'Cutlery';
    $footer_msg = '<center style="font-size: 12px;color: #000;"><b>Thank you for your order.<br/>Enjoy your meal!</b></center>';
    $mail_msg_alert = "<script type='text/javascript'>alert('Please check your email account for confirmation mail.');</script>";
    $urorderrec = 'Your order received';
	$currency = '€';
}
else
{
    $or_orderno = "Ordernummer:";
    $or_date = "";
    $or_total = "Totaal:";
	$or_for = "Order Voor:";
	$or_dt = "BESTELLING";
    $or_paymethod = "Betaaldmethode:";
    $paymentmethod_cash = "Contant";
    $twoline_msg = "Bestel Details";
    $cust_dtls_title = "Info";
    $or_email = 'E-mail';
    $or_tele = 'Telefoon';
    $or_free_item = 'Gratis Item';
    $or_Pickup_Delivery = "Afhalen / Bezorgen :";
    $bill_addr = 'KLANTGEGGEVENS';
    $pickuptime = "afhaaltijd : ";
    $deliverytime = "Bezorgtijd : ";
    $or_notes = 'Bestelnotities :';
    $deliveryee = 'Bezorgen';
    $pickupee = 'Afhalen';
	$cutleryyes = 'Ja';
	$Cutlery = 'Bestek';
	$Cutlery_charge = 'Bestek ';
    $footer_msg = '<center style="font-size: 12px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
    $mail_msg_alert = "<script type='text/javascript'>alert('Controleer uw mailbox voor de bevestigings mail');</script>";
    $urorderrec = 'Nieuwe klantorder';
	$currency = '€';
}

$freeitem = '';
if (isset($row['ot_giftitem']) && !empty($row['ot_giftitem']) && ($row['ot_giftitem'] != 'no free item'))
{
    $freeitem = '<div><p style="text-align: center; margin: 0px;"><b style="font-weight: 540; letter-spacing: 2px; text-transform: uppercase;">' . $or_free_item . '</b>: ' . $row['ot_giftitem'] . '</p></div>';
}
if ($row['ot_paymentoption'] == 'COD')
{
    $ot_paymentoption = 'CASH';
}
elseif ($row['ot_paymentoption'] == 'PIN')
{
    $ot_paymentoption = 'Pin';
}
elseif ($row['ot_paymentoption'] == 'creditcard')
{
    $ot_paymentoption = 'Master Card';
}
elseif ($row['ot_paymentoption'] == 'paypalec')
{
    $ot_paymentoption = 'Paypal';
}
else
{
    $ot_paymentoption = $row['ot_paymentoption'];
}
if($row['ot_pick_del'] != 'pickup'){
	if($row['qrcode']!=''){
        $qrcodenew = '<img src="https://restaurantkamasutra.nl/online/'.$row['qrcode'].'" height="50" width="50"  style="height: auto;max-width: 50px;width:50px;">';
	}
	else { 
	$qrcodenew = '';
}
} else { 
	$qrcodenew = '';
}
$oder_str_for_print = $row['alldata'];
if ($row['ot_pick_del'] == 'pickup')
{
    $ottime = $pickuptime;
}
else
{
    $ottime = $deliverytime;
}
if ($row['ot_pick_del'] == 'both')
{
    $ot_pick_del = $deliveryee;
}
elseif ($row['ot_pick_del'] == 'delivery')
{
    $ot_pick_del = $deliveryee;
}
else
{
    $ot_pick_del = $pickupee;
}
setlocale(LC_ALL, 'nl_NL');
$aa = $row['ot_TotalAmount'];
$aa22 = $row['cutlerycharges'];
setlocale(LC_ALL, NULL);
if($row['cutlery']=='yes' && $row['cutlerycharges']!=''){
$cutrleryline = '<div style="font-size:15px;">'.$Cutlery.': ' . $cutleryyes . '</div><br/>';
$cuttrshow = '<tr ><td colspan="3">'.$Cutlery_charge.'</td><td align="right">'. $currency . " " . number_format($aa22, 2, ",", ".") . '</td></tr>';
}
if($row['couponcode']==''){
	$couponshow = ''; 
}else { 
	$couponshow = '<tr ><td colspan="3">'.$row['couponcode'].'</td><td align="right">'. $row['couponcharge'] . '</td></tr>';
	}
$data111 = $row['ot_OrderDate'];
$data123 = $row["ot_time"];


$print_bill = '';
$print_bill = '<div class="print_content" style="width:100% !important;padding: 5px 10px;font-size:15px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;">
<div><center><img src="' . $logo_url . '" class="img-responsive" width="150" height="80" style="display: block;max-width: 100%;height: auto;"/></center><br/></div>

 
 <div class="col-md-6 col-sm-6">'.$current_lang.'
                           <p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff; margin-right:20px; text-align: center; margin-bottom: 10px; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;" ><b>'.$bill_addr.'</b></p>
						   
                             <div style="font-size:15px;text-align: center; ">' . $row['usr_first_name'] . '</div>
							 <div style="font-size:15px;text-align: center; ">' . $row['usr_company'] . '</div>
							 <div style="font-size:15px;text-align: center; ">' . $row['usr_streetaddress1'] . ' </div>
							 
							 <div style="font-size:15px;text-align: center; ">' . $row['usr_zipcode'] . ' ' . $row['usr_zipcode2letter'] . ' ' . $row['usr_order_city'] . '</div>
							 <div style="font-size:15px;text-align: center; ">  ' . $or_email . ': ' . $row['usr_emailid'] . ' </div>
							 <div style="font-size:15px;text-align: center; ">  ' . $or_tele . ': ' . $row['usr_order_phone'] . ' </div>
							 
                        </div>
						
						<div class="col-md-6 col-sm-6 " style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
						'.$qrcodenew.'
						</div>
						   <div class="col-md-12 col-sm-12">
                            <!--p style="font-size:15px;"><b>' . $cust_dtls_title . '</b></p-->
                            
                            <!--table style="word-wrap:break-word; border:0px solid #000;font-size:15px;width:auto">
                                <tr><td>' . $or_email . ': ' . $row['usr_emailid'] . '</td></tr>
                                <tr><td>' . $or_tele . ': ' . $row['usr_order_phone'] . '</td></tr>
                             </table-->
							
							 
                           
                        </div>
<div class="col-md-12 col-sm-12 table-responsive ">
 <p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff; margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$cust_dtls_title.'</b></p> 
 
     <div style="font-size:16px; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; "><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">' . $or_orderno . '</b> #' . $row['ot_id'] . '</div>
     <div style="font-size:16px !important; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">' . $or_date . '</b> ' . date_format(new DateTime($data111) , "d/m/Y") . ' on ' . date_format(new DateTime($data123) , "H:i") . '</div>

<p style="font-weight: 500 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;    display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; margin-bottom: 0px; text-align: center;">' . $freeitem . '</p>
	
	<div style="font-size:16px !important; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase !important; letter-spacing: 2px; line-height: 23px;">' . $ottime . '</b> ' . $row['del_time'] . '</div>
    <div style="font-size:16px !important; font-weight:500; letter-spacing: 1px; text-align: center; width: 100%; text-transform: uppercase !important; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b class="testp" style="font-weight: 540 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;" >' . $or_total . '<b> ' . $currency . " " . number_format($aa, 2, ",", ".") . '</div>
     <div style="font-size:16px; font-weight:500;  letter-spacing: 1px;  text-transform: uppercase !important; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">' . $or_paymethod . '</b> ' . $ot_paymentoption . '</div><div><br/></div>
	 
   <div style="font-size:16px;margin-bottom: 6px; text-align: center !important; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important; letter-spacing: 2px; font-weight: 540;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">'.$or_for.'</b> ' . $ot_pick_del . '</div>
 <div style="font-size:16px; font-family: Calibri, Arial, sans-serif; text-align: center; width: 100%;"><b style="font-size:16px;  letter-spacing: 2px; font-weight: 540; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;">' . $or_notes . '</b> ' . $row['ot_odrnote'] . '</div>
 
 <p style="font-weight: 500 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;    display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; margin-bottom: 0px;">'.$cutrleryline.'</p>

 <div><br/></div>

	                   </div>                
                        <div class="col-md-12 col-sm-12 mail_prt">
						<p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff;margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$or_dt.'</b></p>
                            ' . $oder_str_for_print . ' 
							
                        </div> 
                     
                       <div class="col-md-12 col-sm-12">' . $footer_msg . '</div></div>';

?>


     
        
<?php


$email = $row['usr_emailid'];
$to_id = $email;
$message = $print_bill;
$subject = $rest_titl . " - " . $urorderrec . " (" . $row['ot_id'] . ") - " . date_format(new DateTime($data111) , "d/m/Y");

/* Get Emails from DB */

$From_Email_Address = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")
    ->fetch_object()->adm_set_vlu;
$Additional_Email = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp_pwd'")
    ->fetch_object()->adm_set_vlu;
$Additional_Email2 = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='additional_email2'")
    ->fetch_object()->adm_set_vlu;

/* Get Emails from DB */

 
 
 

require "vendor/autoload.php";
$robo = 'robot@example.com';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$developmentMode = false;
$mailer = new PHPMailer($developmentMode);
try {
$mailer->SMTPDebug = 0;
///$mailer->isSMTP();
/*if ($developmentMode) {
$mailer->SMTPOptions = [
'ssl'=> [
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
]
];
} */

 
$mailer->Host = 'smtp.gmail.com';
$mailer->SMTPAuth = true;
$mailer->Username = 'bestelling@restaurantkamasutra.nl';
$mailer->Password = 'herman84@1094HL';
$mailer->SMTPSecure = 'tls';
$mailer->Port = 587;
$mailer->setFrom('order@restaurantkamasutra.nl', 'Restaurant Kamasutra ');
$mailer->addAddress($Additional_Email);
///$mailer->addAddress($Additional_Email2, 'Admin 2');	
	//$mailer->AddCC($Additional_Email);
///$mailer->AddCC($Additional_Email2);
if($Additional_Email2!=''){ 
	  $mailer->addAddress($Additional_Email2);     // Add a recipient
	}
	
	$mailer->isHTML(true);
 $mailer->CharSet = 'UTF-8';	
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->send();
$mailer->ClearAllRecipients();
///echo "MAIL HAS BEEN SENT SUCCESSFULLY";
} catch (Exception $e) {
/// echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}

$mailer = new PHPMailer($developmentMode);
try {
$mailer->SMTPDebug = 0;
///$mailer->isSMTP();
/*if ($developmentMode) {
$mailer->SMTPOptions = [
'ssl'=> [
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
]
];
} */
 
$mailer->Host = 'smtp.gmail.com';
$mailer->SMTPAuth = true;
$mailer->Username = 'bestelling@restaurantkamasutra.nl';
$mailer->Password = 'herman84@1094HL';
$mailer->SMTPSecure = 'tls';
$mailer->Port = 587;
$mailer->setFrom('order@restaurantkamasutra.nl', 'Restaurant Kamasutra ');
$mailer->addAddress($to_id);
$mailer->isHTML(true);
 $mailer->CharSet = 'UTF-8';	
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->send();
$mailer->ClearAllRecipients();
///echo "MAIL HAS BEEN SENT SUCCESSFULLY";
} catch (Exception $e) {
 ///echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}
 
 

 
