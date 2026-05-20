<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
?>
<!DOCTYPE html>
<html>
    <head>
		
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent !important;
            }
            .btn-social-icon > :first-child {
                font-size: 14px !important;
            }
.hiddenRow {
    padding: 0 !important;
}
@media print {
                /*  body * {
                    visibility: hidden;
                  }
                */
                @page {
                    size: auto;   /* auto is the initial value */
                    margin: 0;  /* this affects the margin in the printer settings */
                }
                #printcontent, #printcontent * {
                    /*max-width:300px !important;*/
                    width:300px !important;
                    visibility: visible;
                }
                #section-to-print {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
        </style>
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
        <div class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Order
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">order</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">
<?php  $list_gift_query = "Select * From `tbl_orders`  where ot_id = '".$_GET['oid']."' "; //echo $list_gift_query;die();
        $result_list_gift_query = $mysqli->query($list_gift_query);
					$row_usr = $result_list_gift_query->fetch_assoc();
					$date = $row_usr['ot_OrderDate'];
					$listuser = "Select * From `tbl_user` where usr_id = '".$row_usr['ot_UserId']."' "; //echo $list_gift_query;die();
        $row12= $mysqli->query($listuser);
					$userlist = $row12->fetch_assoc();
					?>
                    <div class="row">
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">About Order</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Here you can see all details about orders you received.</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                       
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
									<a href="printoption.php?dataid=<?php echo $row_usr['ot_id']; ?>" class="btn btn-social-icon btn-warning" ><i class="fa fa-print"></i></a> 
									<table class="table">
                                <tr>
                                    <td>Order Number<br/><p class="orderno_cls"><?php echo $row_usr['ot_id']; ?></p></td>
                                    <td>Order Date<br/><p class="date_cls"><?= $date; ?></p></td>
                                    <td>Total<br/><p class="total_cls"><?= currency . " " . $row_usr['ot_TotalAmount']; ?></p></td>
                                    <td>Payment method<br/><p class="paymethod_cls"><?php if($row_usr['ot_paymentoption']=='COD') { echo $paymentoption = 'CASH';  }else { echo $paymentoption = $row_usr['ot_paymentoption']; }?></p></td>
                                </tr>
                            </table>
                                   <?php echo $row_usr['ot_order_details']; ?>
									 <p class="cust_dtls_title">Customer information</p>
                            <p>
                            <table>
                                <tr><td><b>Email Id: </b> <?php echo $userlist['usr_emailid']; ?></td></tr>
                                <tr><td><b>Telephone : </b> <?php echo $userlist['usr_order_phone'] ?></td></tr>
                                <?php if (isset($row_usr['ot_giftitem']) && !empty($row_usr['ot_giftitem'])) { ?>    <tr><td><b>Free Item: </b> <?php echo $row_usr['ot_giftitem'] ?></td></tr><?php } ?>
                                <tr><td><b>Pick up / Delivery: </b> <?php echo $row_usr['ot_pick_del']; ?></td></tr>
                            </table>
									<br/><p class="cust_dtls_title">Bill Address:</p>
                            <p>
                                <?php

                                echo $userlist['usr_first_name'] . " " . $userlist['usr_last_name'] . "<br/>" . $userlist['usr_company'] . "<br/>" . $userlist['usr_streetaddress1'] . "<br/>" . $userlist['usr_streetaddress2'] . "<br/>" . $userlist['usr_zipcode'] . " " . $userlist['usr_zipcode2letter'] . "<br/>" . $userlist['usr_order_city'];
                                ?>
                            </p>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                       
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->
                </section>
				
		 
				
        
<?php
	 
if ($current_lang == "en")
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
    $or_tele = 'Telephone';
    $bill_addr = 'Billing Address';
	$or_dt = "ORDER DETAIL";
	 $or_free_item = 'Gift Item';
    $footer_msg = '<center style="font-size: 12px;color: #000;"><b>Thank you for your order.<br/>Enjoy your meal!</b></center>';
    $mail_msg_alert = "<script type='text/javascript'>alert('Please check your email account for confirmation mail.');</script>";
    $urorderrec = 'Nieuwe klantorder';
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
    $footer_msg = '<center style="font-size: 12px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
    $mail_msg_alert = "<script type='text/javascript'>alert('Controleer uw mailbox voor de bevestigings mail');</script>";
    $urorderrec = 'Your order received';
}
		

$email = $userlist['usr_emailid'];
				

$subject = $rest_titl . " - " . $urorderrec . " (" . $row_usr['ot_id'] . ") - " . date_format(new DateTime($date) , "d/m/Y");

/* Get Emails from DB */

$From_Email_Address = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")
    ->fetch_object()->adm_set_vlu;
$Additional_Email = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp_pwd'")
    ->fetch_object()->adm_set_vlu;
$Additional_Email2 = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='additional_email2'")
    ->fetch_object()->adm_set_vlu;

if ($row_usr['ot_paymentoption'] == 'COD')
{
    $ot_paymentoption = 'CASH';
}
elseif ($row_usr['ot_paymentoption'] == 'CASH')
{
    $ot_paymentoption = 'Cash';
}
 			
				
				
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
				
$freeitem = '';
if (isset($row_usr['ot_giftitem']) && !empty($row_usr['ot_giftitem'])) {
    $freeitem = '<div><p style="text-align: center; margin: 0px;"><b style="font-weight: 540; letter-spacing: 2px; text-transform: uppercase;">' . $or_free_item . '</b>: ' . $row_usr['ot_giftitem'] . '</p></div>';
}				
				
				
	$print_bill = '<div class="print_content" style="width:100% !important;padding: 5px 10px;font-size:15px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;">
<div><center><img src="' . $logo_url . '" class="img-responsive" width="150" height="80" style="display: block;max-width: 100%;height: auto;"/></center><br/></div>
 <div class="col-md-12 col-sm-12">
						   
                             <div style="font-size:15px;text-align: center; ">' . $userlist['usr_first_name'] . '</div>
							 <div style="font-size:15px;text-align: center; ">' . $userlist['usr_company'] . '</div>
							 <div style="font-size:15px;text-align: center; ">' . $userlist['usr_streetaddress1'] . ' </div>
							 
							 <div style="font-size:15px;text-align: center; ">' . $userlist['usr_zipcode'] . ' ' . $row_usr['usr_zipcode2letter'] . ' ' . $row['usr_order_city'] . '</div>
							 <div style="font-size:15px;text-align: center; ">  ' . $or_email . ': ' . $userlist['usr_emailid'] . ' </div>
							 <div style="font-size:15px;text-align: center; ">  ' . $or_tele . ': ' . $userlist['usr_order_phone'] . ' </div>
							 
                        </div>
						
						   <div class="col-md-12 col-sm-12">
                                                   
                            <!--table style="word-wrap:break-word; border:0px solid #000;font-size:15px;width:auto">
                                <tr><td>' . $or_email . ': ' . $row_usr['usr_emailid'] . '</td></tr>
                                <tr><td>' . $or_tele . ': ' . $row_usr['usr_order_phone'] . '</td></tr>
                             </table-->
							
							 
                           
                        </div>
<div class="col-md-12 col-sm-12 table-responsive ">
 <p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff; margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$cust_dtls_title.'</b></p> 
 
     <div style="font-size:16px; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; "><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">' . $or_orderno . '</b> #' . $row_usr['ot_id'] . '</div>
     <div style="font-size:16px !important; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">' . $or_date . '</b> ' . date_format(new DateTime($date) , "d/m/Y") . ' on ' . date_format(new DateTime($date) , "H:i") . '</div>

<p style="font-weight: 500 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px; width: 100%; font-family: Calibri, Arial, sans-serif; margin-bottom: 0px; text-align: center;">' . $freeitem . '</p>

    <div style="font-size:16px !important; font-weight:500; letter-spacing: 1px; text-align: center; width: 100%; text-transform: uppercase !important; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b class="testp" style="font-weight: 540 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;" >' . $or_total . '<b> ' . currency . " " . str_replace('.',',',$row_usr['ot_TotalAmount']) . '</div>
     <div style="font-size:16px; font-weight:500;  letter-spacing: 1px;  text-transform: uppercase !important; text-align: center; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">' . $or_paymethod . '</b> ' . $ot_paymentoption . '</div><div><br/></div>
	 
   <div style="font-size:16px;margin-bottom: 6px; text-align: center !important; width: 100%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important; letter-spacing: 2px; font-weight: 540;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">'.$or_for.'</b> ' . $row_usr['ot_pick_del'] . '</div>

 <div><br/></div>

	                   </div>                
                        <div class="col-md-12 col-sm-12 mail_prt">
						<p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff;margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$or_dt.'</b></p>
                            ' . $row_usr['ot_order_details'] . ' 
							
                        </div> 
                     
                       <div class="col-md-12 col-sm-12">' . $footer_msg . '</div></div>';			
				
				
				
/* Get Emails from DB */
$message = $print_bill;
 

 
 

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
$mailer->Username = 'info@restaurantkamasutra.nl';
$mailer->Password = 'dilbar@1183HG';
$mailer->SMTPSecure = 'tls';
$mailer->Port = 587;
$mailer->setFrom('info@restaurantkamasutra.nl', 'Restaurant Kamasutra ');
//$mailer->addAddress($email);
///$mailer->addAddress($Additional_Email2, 'Admin 2');	
$mailer->AddCC($email);
$mailer->AddCC($Additional_Email);
$mailer->isHTML(true);
 $mailer->CharSet = 'UTF-8';	
$mailer->Subject = $subject;
$mailer->Body = $message;
$mailer->send();
$mailer->ClearAllRecipients();
///echo "MAIL HAS BEEN SENT SUCCESSFULLY";
} catch (Exception $e) {
echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
}

?>
				
 </div>
            <?php include 'footer.php'; ?>
 </div>

    </body>
</html>
