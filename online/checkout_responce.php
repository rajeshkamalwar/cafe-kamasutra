<?php


$status=$_GET['status'];
$sha1=$_GET['sha1'];
$trxid=$_GET['trxid'];
$payment=$_GET['payment'];

$ec=$_GET['ec'];
$output='';
$date_time=date("d M, Y H:i:s");
session_start();
include 'admin/db.php';
include 'admin/config.php';
include 'res.php';
ob_start();

$current_lang = $_SESSION['current_lang'];
$PostcodePageURL = "postcodelist.php";
define('UTF8_ENABLED', '');

if ($current_lang == "en") {
                $or_section_title="ORDER RECEIVED";
                $or_thankyou_msg="Thanks. Your order has been received.<br/>You will receive a confirmation by e-mail. It may be that it ends up in your SPAM folder. We kindly ask you to contact our restaurant if you have not received confirmation. This way we are sure that your order has arrived.";
                $or_orderno="Order Number:";
                $or_date="Date:";
                $or_total="Total:";
                $or_paymethod="Payment Method:";
                $paymentmethod_cash="Cash";
                $twoline_msg="Order Details";
                $cust_dtls_title="Customer Information";
                $or_email='Email';
                $or_tele='Telephone';
                $or_free_item='Also Free';
                $or_Pickup_Delivery='Pick up / Delivery';
                $bill_addr='Billing Address';
                $gobackbtn_txt = 'Go back to order';
                $online_pymt_cancel="Online payment was cancelled.";
                $online_pymt_expired="This transaction is expired.";
                $online_pymt_failure="An internal error has occurred with the chosen payment method.";
                $online_pymt_pending="Awaiting actual payment, payment is not certain yet.";
                $online_pymt_denied="The transaction request has been rejected.";
                $redirect_msg = 'You will be redirected to product\'s list to add item(s) in  <span id="pageInfo">10</span> second(s).';
            } else {
               $or_section_title="BESTELLING ONTVANGEN";
               $or_thankyou_msg="Bedankt. Je bestelling is ontvangen.<br/>U ontvangt een bevestiging via e-mail. Het kan zijn dat deze in uw SPAM map terecht komt. Wij vragen u vriendelijk om contact met ons resturant op te namen indien u geen bevestiging heeft ontvangen. Zo zijn we er zeker van dat uw bestelling aangekomen is.";
               $or_orderno="Order Number:";
               $or_date="Order Number:";
               $or_total="Totaal:";
               $or_paymethod="Payment Method:";
               $paymentmethod_cash="Contant";
               $twoline_msg="Bestel Details";
               $cust_dtls_title="Klantgegevens";
               $or_email='E-mail';          
               $or_tele='Telefoon';
               $or_free_item='Gratis Item';
               $or_Pickup_Delivery="Afhalen / Bezorgen";
               $bill_addr='UW GEGEVENS';
               $gobackbtn_txt = 'Ga terug naar de bestelling';
               $online_pymt_cancel="Online betaling is geannuleerd.";
               $online_pymt_expired="Deze transactie is verlopen.";
               $online_pymt_failure="Er is een interne fout opgetreden met de gekozen betaalmethode.";
               $online_pymt_pending="In afwachting van de daadwerkelijke betaling, is de betaling nog niet zeker.";
               $online_pymt_denied="Het transactieverzoek is afgewezen.";
               $redirect_msg = 'U wordt doorgestuurd naar de productlijst om item (s) toe te voegen  <span id="pageInfo">10</span> seconde (n).';
            }
?>
<script>
    b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
    currency = '<?php echo currency . ' '; ?>';
    current_lang = '<?php echo $current_lang; ?>';
</script>    
<?php
$data1=array(
    'order_time' => date("d M, Y"),
    'order_id'  => $ec,
    'payment_method' => 'Online Payment',
    'trxid'=>$trxid,
    'status'=>$status,
);
$_SESSION["online_payment_info"]=$data1;

////$query="UPDATE `tbl_orders` SET `ot_trx_status`='".$status."',`ot_trxid`='".$trxid."' WHERE ot_id='".$ec."'";
//echo $query;die();
////$result_query = $mysqli->query($query);
if($status=='Success')
{
//    $data1=array(
//    'order_time' => date("d M, Y"),
//    'order_id'  => $ec,
//    'payment_method' => 'Online Payment',
//    'trxid'=>$trxid,
//    'status'=>$status,
//);
//$_SESSION["online_payment_info"]=$data1;
	$order_no = $ec;
	////include 'mail.php';
    header('Location: order_received.php?order_id='.$ec.'' );
}
if($status=='Expired')
{
	
echo "<script>
alert('$online_pymt_expired');
window.location.href='https://restaurantkamasutra.nl/online/online-order.php';  
</script>";

}
if($status=='Cancelled')
{
  
echo "<script>
alert('$online_pymt_cancel');
window.location.href='https://restaurantkamasutra.nl/online/online-order.php';  
</script>";
}
if($status=='Failure')
{
  
echo "<script>
alert('$online_pymt_failure');
window.location.href='https://restaurantkamasutra.nl/online/online-order.php';  
</script>";
}
if($status=='Pending')
{
    output($online_pymt_pending,$redirect_msg,$gobackbtn_txt);
}
if($status=='Denied')
{

echo "<script>
alert('Your order has denied');
window.location.href='https://restaurantkamasutra.nl/online/online-order.php';  
</script>";
}
?>