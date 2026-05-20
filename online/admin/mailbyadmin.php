<?php

$current_lang=$_SESSION['current_lang'];

        $ot_id = $order_id;
        $query="SELECT a.*, b.* From tbl_user a INNER JOIN tbl_orders b on a.usr_id = b.ot_UserId and b.ot_id = '".$ot_id."'";
        $query_result = $mysqli->query($query);
        $row=$query_result->fetch_array();

        if($row['ot_paymentoption']=='COD'){ $ot_paymentoption= 'CASH'; } else { $ot_paymentoption= $row['ot_paymentoption']; }  

$result_query_abc = $mysqli->query("Select * From `adm_set`");
$logo_url='';$rest_titl='';
        while ($row12abc = $result_query_abc->fetch_assoc()) {
           if($row12abc['adm_set_name']=='print_url'){$logo_url=$row12abc['adm_set_vlu'];}
           if($row12abc['adm_set_name']=='rest_title'){$rest_titl=$row12abc['adm_set_vlu'];}
        }
        
         if ($current_lang == "dutch") {
                 $or_orderno = "Bestellingsnummer:";
                $or_date = "Datum:";
                $or_total = "Totaal:";
                $or_paymethod = "Betalingsmiddel:";
                $paymentmethod_cash = "Contant";
                $twoline_msg = "Bestel Details";
                $cust_dtls_title = "Klantgegevens";
                $or_email = 'E-mail';
                $or_tele = 'Telefoon';
                $or_free_item = 'Gratis Item';
                $or_Pickup_Delivery = "Afhalen / Bezorgen";
                $bill_addr = 'UW GEGEVENS';
			 $deliverytime="Bezorgtijd : ";
			  $or_notes = 'Bestelnotities : ';
			 $deliveryee = 'Bezorgen';
			  $pickupee = 'Afhalen';
                $footer_msg='<center style="font-size: 14px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
			 $mail_msg_alert="<script type='text/javascript'>alert('Controleer uw mailbox voor de bevestigings mail');</script>";
			  $urorderrec='Nieuwe klantorder';
            } else {
			 
			 $or_orderno = "Order Number:";
                $or_date = "Date:";
                $or_total = "Total:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Cash";
                $twoline_msg = "Order Details";
                $cust_dtls_title = "Customer Information";
                $or_email = 'Email';
                $or_tele = 'Telephone';
                $or_free_item = 'Free Item';
                $or_Pickup_Delivery = 'Pick up / Delivery';
			 $or_notes = 'Order notes : ';
                $bill_addr = 'Billing Address';
			 $deliveryee = 'Delivery';
			  $pickupee = 'Pickup';
                $footer_msg='<center style="font-size: 14px;color: #000;"><b>Thank you for your order.<br/>Enjoy your meal!</b></center>';
			 $mail_msg_alert="<script type='text/javascript'>alert('Please check your email account for confirmation mail.');</script>";
			 $urorderrec='Your order received';
               
            }
            
        $freeitem='';
        if (isset($row['ot_giftitem']) && !empty($row['ot_giftitem']) && ($row['ot_giftitem'] !='no free item')) 
        { 
            $freeitem='<tr><td>'.$or_free_item.': '.$row['ot_giftitem'].'</td></tr>'; 
        }
       if($row['ot_pick_del']=='both'){ $ot_pick_del = $deliveryee; } elseif($row['ot_pick_del']=='delivery'){ $ot_pick_del = $deliveryee; } else { $ot_pick_del = $pickupee; } 
$oder_str_for_print=str_replace('class="table table-bordered table-striped"', 'style="width: 100%!important;"', str_replace('<th width="15%">', '<th style="width:auto; padding:0px 10px;">',str_replace('<th width="20%">', '<th style="width:auto; padding:0px 10px;">',str_replace('<th width="10%">', '<th style="width:auto;">',str_replace('<th width="45%">', '<th style="width:auto;text-align:left;">',$row['ot_order_details'])))));   
      
setlocale(LC_ALL, 'nl_NL');
$aa=$row['ot_TotalAmount'];
setlocale(LC_ALL, NULL);

        $data111=$row['ot_OrderDate'];
       $print_bill='';
       $print_bill='<div class="print_content" style="width:100% !important;padding: 5px 10px;font-size:15px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;">
<div><center><img src="'.$logo_url.'" class="img-responsive" width="150" height="80" style="display: block;max-width: 100%;height: auto;"/></center><br/></div>
 <div class="col-md-12 col-sm-12">
                            <p style="font-size:15px; margin-block-start: 0px; margin-block-end: 0px;"><b>'.$bill_addr.'</b></p>
                             <div style="font-size:15px;">'.$row['usr_first_name'] . ' ' . $row['usr_last_name'] . '</div>
							 <div style="font-size:15px;">' . $row['usr_company'] . '</div>
							 <div style="font-size:15px;">' . $row['usr_streetaddress1'] . ' ' . $row['usr_streetaddress2'] . ' </div>
							 
							 <div style="font-size:15px;">' . $row['usr_zipcode'] . ' ' . $row['usr_zipcode2letter']. ' ' . $row['usr_order_city'].'</div>
							 <div style="font-size:15px;">  '.$or_email.': '.$row['usr_emailid'].' </div>
							 <div style="font-size:15px;">  '.$or_tele.': '.$row['usr_order_phone'].' </div>
							 
                        </div>
						   <div class="col-md-12 col-sm-12">
                            <!--p style="font-size:15px;"><b>'.$cust_dtls_title.'</b></p-->
                            
                            <!--table style="word-wrap:break-word; border:0px solid #000;font-size:15px;width:auto">
                                <tr><td>'.$or_email.': '.$row['usr_emailid'].'</td></tr>
                                <tr><td>'.$or_tele.': '.$row['usr_order_phone'].'</td></tr>
                             </table-->
							
							 <p style="font-size:15px; margin:6px 0px;"> '.$freeitem.' </p>
                           
                        </div>
<div class="col-md-12 col-sm-12 table-responsive ">
     <div style="font-size:15px;">'.$or_orderno.' #'.$row['ot_id'].'</div>
     <div style="font-size:15px;">'.$or_date.' '.date_format(new DateTime($data111), "d/m/Y").' on '.date_format(new DateTime($data123), "H:i").'</div>
	 <div style="font-size:15px;">'.$ottime.' '.$row['del_time'].'</div>
     <div style="font-size:15px;font-weight:700;">'.$or_total.' '.currency . " " . $aa.'</div>
     <div style="font-size:15px; font-weight:700;">'.$or_paymethod.' '.$ot_paymentoption.'</div><div><br/></div>
     <div style="font-size:15px; margin-bottom: 6px;"> '.$ot_pick_del.'</div>
 <div style="font-size:15px;">'.$or_notes.' '.$row['ot_odrnote'].'</div><div><br/></div>

	                   </div>                
                        <div class="col-md-12 col-sm-12 mail_prt">
                            '.$oder_str_for_print.' 
                        </div> 
                     
                       <div class="col-md-12 col-sm-12">'.$footer_msg.'</div></div>';
?>    
<?php

$email=$row['usr_emailid'];
$to_id=$email;
$message = $print_bill;
$subject = $rest_titl." - ".$urorderrec." (".$row['ot_id'].") - ".date_format(new DateTime($data111), "d/m/Y");

$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
$Additional_Email= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp_pwd'")->fetch_object()->adm_set_vlu;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
mail($Additional_Email, $subject, $message, $headers);