<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<!--<meta http-equiv="refresh" content="7; url=fresh1.php" />-->   
        <script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
	$(window).on('load',function(){
    var delayMs = 1500; // delay in milliseconds    
   setTimeout(function(){
        $('#myCouponModal').modal('show');
    }, delayMs);
  });</script>
		
 	
    </head>
    <body>
        <?php include 'public_header.php';?>
        <div class="container checkoutpage received-page">
            <?php
            session_start();
            include 'admin/db.php';
            include 'admin/config.php';
            include 'css_file.php';
            ob_start();
		
            $current_lang = $_SESSION['current_lang'];
            $PostcodePageURL = "postcodelist.php";
            define('UTF8_ENABLED', '');
           $currency = '€';
 		?>
            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                currency = '<?php echo currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
            </script>
            <style>
                @media print {
  #print_page {text-decoration: none;font-size: 0px;display: none;width:0px;height:0px; }
  a[href]:after { content: none !important; }a[href]:before { content: none !important; }
  img[src]:after { content: none !important; }
}
</style>     <?php
			
            if ($current_lang == "en") {
                $or_section_title = "ORDER RECEIVED";
                $or_thankyou_msg = "Thanks. Your order has been received.<br/>You will receive a confirmation by e-mail. It may be that it ends up in your SPAM folder. We kindly ask you to contact our restaurant if you have not received confirmation. This way we are sure that your order has arrived.";
                $or_orderno = "Order Number:";
                $or_date = "Date:";
                $or_total = "Total:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Cash";
				$paymentmethod_pin = "Pin";
				$twoline_msg = "Order Details";
                $cust_dtls_title = "Customer Information";
                $or_email = 'Email';
                $or_tele = 'Telephone';
                $or_free_item = 'Also Free';
                $or_Pickup_Delivery = 'Pick up / Delivery';
                $bill_addr = 'Billing Address';
                $gobackbtn_txt = "Go back to make new order";
				$cash_text='Cash';
				$pin_text='Pin';
				$pickupdel = 'Pick up';
			 $deliverydel = 'Delivery';
				 $offer = 'Coupon';
				$offertext='Check your mailbox, you have received coupon for next order.';
            } else {
                $or_section_title = "BESTELLING ONTVANGEN";
                $or_thankyou_msg = "Bedankt. Je bestelling is ontvangen.<br/>U ontvangt een bevestiging via e-mail. Het kan zijn dat deze in uw SPAM map terecht komt. Wij vragen u vriendelijk om contact met ons restaurant op te nemen indien u geen bevestiging heeft ontvangen. Zo zijn we er zeker van dat uw bestelling aangekomen is.";
                $or_orderno = "Bestellingsnummer:";
                $or_date = "Datum:";
                $or_total = "Totaal:";
                $or_paymethod = "Betaalmethode:";
                $paymentmethod_cash = "Contant";
				$paymentmethod_pin = "Pin";
				
                $twoline_msg = "Bestel Details";
                $cust_dtls_title = "Klantgegevens";
                $or_email = 'E-mail';
                $or_tele = 'Telefoon';
                $or_free_item = 'Gratis Item';
                $or_Pickup_Delivery = "Afhalen / Bezorgen";
                $bill_addr = 'UW GEGEVENS';
                $gobackbtn_txt = "Ga terug naar de bestelling";
				$cash_text='Contant';
				$pin_text='Pin';
				$pickupdel = 'Afhalen';
			    $deliverydel = 'Bezorgen';
				$offer = 'Kortingbon';
				$offertext='Controleer uw mailbox, u heeft een kortingsbon voor de volgende bestelling ontvangen.';
            }
			
		 
		
            ?>       
            
            <div class="row order-recieve" id="divToPrint">
                <div class="col-md-12"><br/></div>				 
              <?php if(!empty($_SESSION["shopping_cart"])) {
                $order_no = $_GET['order_id'];
            $query = "select tbl_user.*,tbl_orders.*  from `tbl_user` Inner JOIN tbl_orders on tbl_user.usr_id =tbl_orders.ot_UserId AND tbl_orders.ot_id=" . $order_no;
                $result_query = $mysqli->query($query);
                while ($row = $result_query->fetch_assoc()) {//echo "<pre>";print_r($row);die();
                    $email = $row['usr_emailid'];
                    $telephone = $row['usr_order_phone'];
                   if($row['ot_pick_del']=='both' OR $row['ot_pick_del']=='delivery'){ $pickdel = $deliverydel; } else { $pickdel = $pickupdel; }
                    $OR_first_name = $row['usr_first_name'];
                    $OR_last_name = $row['usr_last_name'];
                    $OR_companyname = $row['usr_company'];
                    $OR_address1 = $row['usr_streetaddress1'];
                    $OR_address2 = $row['usr_streetaddress2'];
                    $OR_postcode = $row['usr_zipcode'];
                    $OR_postcode2let = $row['usr_zipcode2letter'];
                    $OR_city = $row['usr_emailid'];
					$tipamt = $row['tip_amt']; 

                       $totalamt = $row["ot_TotalAmount"];
				}
	
	
	 $query11="SELECT * From tbl_orders where ot_id = '".$order_no."'";
                             $query_result11 = $mysqli->query($query11);
                             $row11=$query_result11->fetch_array();
							 $payment_methodold = $row11['ot_paymentoption'];
							 setlocale(LC_ALL, 'nl_NL');
							 $aa = $row11['ot_TotalAmount'];
							 $aa22 = $row11['cutlerycharges'];
                                $date = $row11['ot_OrderDate'];
								$free_item = $row1['free_item'];
			echo $free_item;
	
                ?>
                <?php ////if (isset($_POST['payment_method'])) {
               if ($payment_methodold == "COD") {
				   
				   /* COD Case */				
				 include 'mail.php';
				   
			 				 	
                }
				else if ($payment_methodold == "PIN") {
					/* COD Case */				
				 include 'mail.php';
			 
			 }					
  ////  }
	else {    }

          ?>

                <div class="col-md-12">
                        <div class="pm-widget">
                            <div class="product_main_category">
                                <h2 class="main-heading"><?php echo $or_section_title; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-10 col-sm-12"><p class="text_msg"><?php echo $or_thankyou_msg; ?></p></div>
                            <div class="col-md-2 col-sm-12"><button id="print_page" class="btn btn-primary " onclick="PrintDiv();" style="float:right;background-color: #3c8dbc;"><i class="fa fa-print"></i> Print</button></div>
                        </div>
						<?php
						   
							
	

if($row11['cutlery']=='yes'){
    $cutrleryline = '<div style="font-size:15px;">Cutlery: ' . $row11['cutlery'] . '</div><br/>';
    	if($row11['cutlerycharges']!=''){
    $cuttrshow = '<tr ><td colspan="3">Cutlery charge</td><td align="right">'. $currency . " " .$aa22  . '</td></tr>';
	}
	else { 
	///	$cuttrshow = '<tr ><td colspan="3">Cutlery </td><td align="right">Yes</td></tr>';
	}
}



 if($payment_methodold=='COD'){ $payment_methodnew = 'CASH'; } elseif($payment_methodold=='creditcard') { $payment_methodnew = 'Master Card'; } elseif($payment_methodold=='paypalec') { $payment_methodnew = "Paypal"; } else { $payment_methodnew = $payment_methodold;}
  ?>
                      <div class="col-md-12 col-sm-12 table-responsive order-main-details">
                            <table class="table">
                                <tr>
                                    <td><?= $or_orderno; ?><br/><p class="orderno_cls"><?= $order_no; ?></p></td>
                                    <td><?= $or_date; ?><br/><p class="date_cls"><?= date("d M, Y",strtotime($date)); ?></p></td>
                                    <td><?= $or_total; ?><br/><p class="total_cls"><?= "€" .number_format($aa, 2, ",", "."); ?></p></td>
                                    <td><?= $or_paymethod; ?><br/><p class="paymethod_cls"><?php echo $payment_methodnew;?></p></td>

                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <p class="odr_dtls"><?php echo $twoline_msg; ?></p>
                        </div>
                        <div class="col-md-12 col-sm-12  order-rec-table">
				
                            <?= $row11["alldata"] ?>
							
                        </div> 
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><?php echo $cust_dtls_title; ?></p>
                            <p>
                            <table class="address-recorder">
                                <tr><td><b><?= $or_email ?>: </b> <?php echo $email; ?></td></tr>
                                <tr><td><b><?= $or_tele ?>: </b> <?php echo $telephone ?></td></tr>
                               <?php if (isset($_SESSION['free_item']) &&    ($_SESSION['free_item'] != 'no free item')) { ?>    <tr><td><b><?= $or_free_item ?>: </b> <?php echo $_SESSION['free_item'] ?></td></tr><?php } ?>
                                <tr><td><?php echo $pickdel; ?></td></tr>
								 
                            </table>
                            </p>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><?php echo $bill_addr; ?></p>
                            <p class="cus-add-show">
                                <?php
                                echo $OR_first_name  . "<br/>" . $OR_companyname . "<br/>" . $OR_address1  . "<br/>" . $OR_postcode . " " . $OR_postcode2let . "<br/>" . $OR_city;
                                ?>
                            </p>
					 
                        </div>
                    </div>
                    <div class="col-md-12">
                       <!-- <a  id="gtc"><p  class="btn btn-primary"><?//= $gobackbtn_txt; ?></p></a>-->
                    </div>
                <div class="col-md-12">&nbsp;</div>
                    <?php

                    ?>
                
                    <?php
                    // .send mail for this order
                    
                    //include 'printbill.php';
                } else {
                   include 'fresh.php';
                  header('Location: online-order.php');
                }
                ?>
            </div>
        </div>
	<?php $querycopun = $mysqli->query("select * from tbl_orders where regisid Like '".$_SESSION['username']."' ");
    while($row_user = $querycopun->fetch_array()){
				    $registeruserid = $row_user['regisid'];
	 }	
	 
	$querycopun = $mysqli->query("select * from tbl_orders where regisid Like '".$_SESSION['username']."' ");
	$checkmailstatus = $mysqli->query("select * from lostcustomercoupon where id=1");	
	$countcoupon2 =  $querycopun->fetch_assoc();		
	$countcoupon =  $checkmailstatus->fetch_assoc();		
	$status = $countcoupon['status'];	
	$countcoupon = $querycopun->num_rows;		
	
	$popupfirsttime = $mysqli->query("select * from registeruser where email Like '".$_SESSION['username']."' ");	
	$popcheck =  $popupfirsttime->fetch_assoc();
	$shoornot = $popcheck['popupshow'];	
	//
	if($status=='Active' && !empty($registeruserid) AND $shoornot==0){
	?>
	<div class="modal fade" id="myCouponModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $offer; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $offertext; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
	<?php 
	
	$edit_dish_query = "UPDATE `registeruser` SET `popupshow`='1' WHERE  email Like '".$_SESSION['username']."' ";
	$edit_dish_query_result = $mysqli->query($edit_dish_query);
	} ?>
        <?php include 'public_footer.php';?>
        <script>
        /////  $(document).on('click', '#gtc', function () {

           ////// $("#gtc").load('fresh1.php');
           /////window.location.replace("online-order.php");
        ///// });
			
		////	$("#gtc").load('fresh.php');
        </script>
        <script type="text/javascript">     
 function PrintDiv() {    
     var divToPrint = document.getElementById('divToPrint');
      var popupWin = window.open('', '_blank', 'width=300,height=300');
     popupWin.document.open();
       
      popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
      popupWin.document.close();
         }
 </script>
<?php
	
 
	 
 
		if(isset($_SESSION["shopping_cart"])){
        unset($_SESSION["shopping_cart"]);
		unset($_SESSION["shopping_cart"]);
		unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
		unset($_SESSION['current_pick']);
        unset($_SESSION['order_session']);
		 unset($_SESSION['res_close']);	
			 unset($_SESSION['res_msg']);	
		 unset($_SESSION['free_item']);	
			
	}
	 
      
	?>
    </body>
</html>