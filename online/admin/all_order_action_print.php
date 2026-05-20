<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action=="printorders"){
 $ot_id = $_POST['showresultof']; 
	
	$data2=array();
		$logomain = '';
	$query = "Select * From `head_settings`";
		$result_query = $mysqli->query($query);									
			while ($row = $result_query->fetch_assoc()) {							 
			$data2[$row['settings_name']] = $row['sett_data'];
					$logomain = 'https://restaurantkamasutra.nl/online/'.$data2['logo'];
		}	
		
		
$edit_query = "UPDATE `tbl_orders` SET `print_status`='1',`comment_status`='1' WHERE `ot_id`='" . $ot_id . "'";
       $edit_gift_query_result11 = $mysqli->query($edit_query);
		
		
$queryp="SELECT * From printsetting where id = '1'";
        $query_resultp = $mysqli->query($queryp);
        $rowp=$query_resultp->fetch_array();

        $logo_query="select * from adm_set where adm_set_name='print_url'";
        $logo_url= $mysqli->query($logo_query)->fetch_object()->adm_set_vlu;
        // $ot_id = $_GET['dataid'];
		$edit_query = "UPDATE `tbl_orders` SET `comment_status`='1' WHERE `ot_id`='" . $ot_id . "'";
       $edit_gift_query_result11 = $mysqli->query($edit_query);
        $query="SELECT a.*, b.* From tbl_user a INNER JOIN tbl_orders b on a.usr_id = b.ot_UserId and b.ot_id = '".$ot_id."'";
        $query_result = $mysqli->query($query);
        $row=$query_result->fetch_array();
		$usr_emailid = $row['usr_emailid'];
		$usr_order_phone = $row['usr_order_phone'];
		$ot_odrnote =$row['ot_odrnote'];
		//$ot_pick_del =$row['ot_pick_del'];
		$usr_first_name = $row['usr_first_name'];
		$usr_last_name = $row['usr_last_name'];
		$usr_company = $row['usr_company'];
		$usr_streetaddress1 = $row['usr_streetaddress1'];
		$usr_streetaddress2 = $row['usr_streetaddress2'];
		$usr_zipcode = $row['usr_zipcode'];
		$usr_zipcode2letter = $row['usr_zipcode2letter'];
		$usr_order_city = $row['usr_order_city'];
if($row['ot_pick_del']!='pickup'){
	if($row['qrcode']!=''){
        $qrcodenew = '<img src="https://restaurantkamasutra.nl/online/'.$row['qrcode'].'" style="height: auto;max-width: 50px;">';
	} else { 
		$qrcodenew = '';
	}
} else { 
	$qrcodenew = '';
}
        $current_lang="en_not";
         if ($current_lang == "en") {
                $or_orderno = "Order Number:";
                $or_date = "DATE:"; 
                $or_total = "TOTAL:";
			    $or_dt = "ORDER DETAIL";
			    $or_best = "ORDERED ON: ";
			    $or_for = "ORDER FOR:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Cash";
                $twoline_msg = "Order Details";
                $cust_dtls_title = "INFO";
                $or_email = 'Email';
			  $pickuptime="Pick up Time";
				$deliverytime="Delivery Time : ";
                $or_tele = 'Telephone';
                $or_free_item = 'Also Free';
                $or_Pickup_Delivery = 'Pick up / Delivery : ';
			    $or_notes = 'Order notes : ';
                $bill_addr = 'Billing Address';
			 $deliveryee = 'Delivery';
			  $pickupee = 'Pickup';
			 $cutleryyes = 'Yes';
			 $Cutlery = 'Cutlery';
                $footer_msg='<center style="font-size: 12px;color: #000;"><b>Thank you for your order.<br/>Eat tasty!</b></center>';
			 $payment_txt1='Cash';
            } else {
                $or_orderno = "Ordernummer:";
                $or_date = "";
                $or_total = "TOTAAL:";
			 $or_dt = "BESTELLING";
			 $or_best = "BESTELD OP: ";
			 $or_for = "Order Voor:";
			 $cutleryyes = 'Ja';
			 $Cutlery = 'Bestek';
                $or_paymethod = "Betaaldmethode:";
                $paymentmethod_cash = "Contant";
                $twoline_msg = "Bestel Details";
                $cust_dtls_title = "INFO";
                $or_email = 'E-mail';
                $or_tele = 'Telefoon';
                $or_free_item = 'Gratis Item';
                $or_Pickup_Delivery = "Afhalen / Bezorgen: ";
			    $or_notes = "Bestelnotities:";
                $bill_addr = 'KLANTGEGGEVENS';
			 $pickuptime="afhaaltijd : ";
				$deliverytime="BEZORGTIJD : ";
			 $deliveryee = 'BEZORGEN';
			  $pickupee = 'Afhalen';
                $footer_msg='<center style="font-size: 12px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
			 $payment_txt1='Cash';
            }
            
        $freeitem='';
        if (isset($row['ot_giftitem']) && !empty($row['ot_giftitem']) && ($row['ot_giftitem'] !='no free item')) 
        { 
            $freeitem='<tr><td><b>'.$or_free_item.':</b> '.$row['ot_giftitem'].'</td></tr>'; 
        }
        $data111=$row['ot_OrderDate'];
$data123 = $row["ot_time"];
$datatime111=$row['del_time'];
 $pickuptimedel22 = $row['ot_pick_del'];
        if($row['ot_pick_del']=='pickup'){ $ottime = $pickuptime; } else { $ottime = $deliverytime; }

       $print_bill='';
		$payment_txt='';
                if($row['alldata']!=''){
						$alldata =  $row['alldata'];					
				} else { 
					$alldata =  $row['ot_order_details'];
				 }
if($row['couponcode']==''){
	$couponshow = '';
}else { 
	$couponshow = '<tr ><td>'.$row['couponcode'].'</td><td align="right">'. $row['couponcharge'] . '</td></tr>';
	}
		//if($row['ot_paymentoption']=='COD'){$payment_txt=$payment_txt1;}else{$payment_txt=$row['ot_paymentoption'];}
      if($row['ot_paymentoption']=='COD'){ $ot_paymentoption= 'CASH'; } elseif($row['ot_paymentoption']=='creditcard'){ $ot_paymentoption= 'Master Card'; } elseif($row['ot_paymentoption']=='paypalec'){ $ot_paymentoption= 'Paypal'; } else { $ot_paymentoption= $row['ot_paymentoption']; }  
		$oder_str_for_print =  $alldata;
		setlocale(LC_ALL, 'nl_NL');
		$aa11=$row['ot_TotalAmount'];
$aa = str_replace(".",",",$aa11);
$aa222=$row['cutlerycharges'];
$aa22 = str_replace(".",",",$aa222);
setlocale(LC_ALL, NULL);
if($row['cutlery']=='yes'){
$cutrleryline = '<tr><td><b>'.$Cutlery.' :</b> </td><td>' . $cutleryyes . '</td></tr>';
	$cuttrshow = '<tr ><td>Cutlery charge</td><td align="right">'. currency . " " . $aa22 . '</td></tr>';
}
		
	}
}
?>
<!DOCTYPE html>
<style>

	@media print { 
         
    @page {
                    size: 78mm 200mm;      
		  }
 
	  body  { overflow:visible; 
                    font-family: 'Calibri', sans-serif; /*'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;*/
                  }
			table,table th,table td , span{ font-size:14px; }
	
		#order_table { width:100%; }
 
			
			}
  </style>
 
<div class="col-sm-12" id="dvContents"  stype="padding:0 15px;" >
									<?php
									  if($pickuptimedel22=='both'){ $ot_pick_del11 = $deliveryee; } else if($pickuptimedel22=='delivery'){ $ot_pick_del11 = $deliveryee; } else { $ot_pick_del11 = $pickupee; }

								$print_bill = '
<div class="print_content">
<div><center><img src="'.$logo_url.'" class="img-responsive" width="100"   /></center><br/></div>
 <div>
                            <p style="font-size: 18px; margin: 0px;background:black; color:#fff; text-align: center; margin-bottom: 10px;  text-transform: uppercase;" ><b>'.$bill_addr.'</b></p>
                             <div class="comm" style="font-size:14px; text-align: center; text-transform: capitalize; ">'.$usr_first_name . '</div>
							 <div class="comm" style="font-size:14px; text-align: center;text-transform: capitalize; ">' . $usr_company . '</div>
							 <div class="comm" style="font-size:14px; text-align: center; text-transform: capitalize; ">' . $usr_streetaddress1 . ' </div>
							 
							 <div class="comm" style="font-size:14px; text-align: center; ; text-transform: capitalize; ">' . $usr_zipcode . ' ' . $usr_zipcode2letter. ' ' . $usr_order_city.'</div>							 
</div>				 

<div  style="font-size:14px; text-align: center;"><b>' . $or_email . '</b> ' . $usr_emailid. '</div>
<div  style="font-size:14px; text-align: center;"><b>' . $or_tele . '</b> ' . $usr_order_phone. '</div>						
<div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">'.$qrcodenew.'</div>  

<div class="col-md-12 col-sm-12 table-responsive">
<p style="font-size: 18px; padding:5px;background:black; color:#fff; text-align: center; font-family: Calibri, Arial, sans-serif;"><b>'.$cust_dtls_title.'</b></p> 


<table  style=" width: 100%;">
<tr >
<td ><b style="font-size:13px;">'.$or_orderno.'</b></td><td  align="right">#'.$ot_id.'</td></tr>
<tr><td><b style="font-size:13px;">'.$or_best.'</b>'.$or_date.' </b></td><td align="right">'.date_format(new DateTime($data111), "d/m/Y").' om '.date_format(new DateTime($data123), "H:i").'</td></tr>
<tr><td><b style="font-size:13px;">'.$ottime.'</b></td><td align="right">'.$datatime111.'</td></tr>
' . $freeitem . '
<tr><td><b style="font-size:13px;">'.$or_total.'</b></td><td align="right">€ ' . $aa.'</td></tr>
<tr><td><b style="font-size:13px;">'.$or_paymethod.'</b></td><td align="right">'.$ot_paymentoption.'</td></tr>
<tr><td><b style="font-size:13px;">'.$or_for.'</b></td><td align="right">'.$ot_pick_del11.'</td></tr>
<tr><td style="font-size:13px;">'.$or_notes.'</td><td align="right">'.$ot_odrnote.'</td></tr>
'.$cutrleryline.'
</tr>
</table>
  </div>                

<p style="font-size: 18px; ma padding:5px; margin:0px;background:black; color:#fff; text-align: center; font-family: Calibri, Arial, sans-serif;"><b>'.$or_dt.'</b></p>
'.$oder_str_for_print.'
 <div>'.$footer_msg.'</div></div>';       
echo $print_bill;
 	?>
</div>
         
