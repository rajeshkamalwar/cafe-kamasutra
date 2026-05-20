<?php

include 'db.php';
include 'config.php';



if (isset($_POST['gift_action'])) {
    $gift_action = $_POST['gift_action'];

 

    if ($gift_action == "load") {
        $showallodr=$_POST['showallodr'];
       /// $additional_query="";
       /// if($showallodr!="yes"){$additional_query=" And ot_trx_status='Success' ";}
		$additional_query="OR ot_paymentoption='PIN'";
        if($showallodr!="yes"){$additional_query=" And ot_trx_status='Success' OR (ot_paymentoption='PIN' AND  ot_trx_status='Processing')";}
        $list_gift_query = "Select * From `tbl_orders` where `ot_OrderDate` like '" . date('Y-m') . "%'".$additional_query." ORDER BY `norderid` desc"; //echo $list_gift_query;die();
        $result_list_gift_query = $mysqli->query($list_gift_query);
        $list_gift = '<tbody><tr>
                                                <th>#</th>
                                                
                                                <th>Order ID</th>
												<th>Date</th>
												<th>Time</th>
                                                <th>Amount</th>
                                                <th>Payment Option</th>
                                                <th>Payment Status</th>
                                                <th>Pickup / Delivery</th>
												<th>Pickup / Delivery Time</th>
                                                <th>Order Status</th>
                                                <th>Note</th>
												<th>Print Status</th>
												<th>GPS Status</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_gift_query->num_rows == 0) {
            $list_gift .= '<tr><td colspan=9><center>No record found.</center></td></tr>';
        } else {
            $cno = 0;
            while ($row = $result_list_gift_query->fetch_assoc()) {
				$data111=$row['ot_OrderDate'];
				if($row['print_status']=='1'){
				$pstatus = "Done.";	
				} else { 
				$pstatus = '<a href="printstatus.php?oid='.$row['ot_id'].'"><button type="button" class="btn btn-primary">Ok</button></a>';	
				}
                $gift_item="";
                if(strlen($row['ot_giftitem'])>0){$gift_item=$row['ot_giftitem'];}else{$gift_item="No gift item.";}
                $cno++;
                $usr_detal_query="Select * from tbl_user where usr_id='".$row['ot_UserId']."'";
                $result_usr_detal_query = $mysqli->query($usr_detal_query);
				$usr_detal_query22="Select * from adm_set where adm_set_name='gps_type' ";
                $result_usr_detal_query22 = $mysqli->query($usr_detal_query22);
				$row_usr22 = $result_usr_detal_query22->fetch_assoc();
				$gpstype = $row_usr22['adm_set_vlu'];
				if($gpstype=='Mail'){
					if($row['gpsstatus']=='1'){
						$gstaction = 'Sent';
					} else {
					$gstaction = '<a href="mailsend.php?id='.$row['ot_UserId'].'&otid='.$row['ot_id'].'&m=2">Send Mail</a>';
					}
				}else{
					if($row['gpsstatus']=='1'){
						$gstaction = 'Sent';
					} else {
					$gstaction = '<a href="msgsend.php">Send MSG</a>';
					}
				}
				if($row['alldata']!=''){
					$alldata =  $row['alldata'];
				} else { 
					$alldata =  $row['ot_order_details'];
				}
                $user_details='';
                $user_details='<table class="table table-bordered table-striped"><tr>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Note</th>
						<th>QR Code</th>
                        </tr>';
                 while ($row_usr = $result_usr_detal_query->fetch_assoc()) {
					 if($row['ot_paymentoption']=='COD'){ $ot_paymentoption='CASH'; } elseif($row['ot_paymentoption']=='creditcard'){$ot_paymentoption='Master Card';}else { $ot_paymentoption=$row['ot_paymentoption']; }
				
					 if($row['ot_pick_del']=='both'){ $ot_pick_del = 'Delivery'; } else { $ot_pick_del = $row['ot_pick_del']; }
                     if($row['cutlery']=='yes'){
						$cutlery = '<h4>Cutlery : '.$row['cutlery'].'</h4>';
					}
					 else { 
						 $cutlery='';
					 }
					 if($ot_pick_del!='pickup'){
						 if($row_usr['qrcode']!=''){
						 $qrcode =  '<img src="https://restaurantkamasutra.nl/online/'.$row_usr['qrcode'].'" style="height:60px">';
						 } else { 
						 $qrcode =  ''; 	 
						 }
					 } else { 
						$qrcode =  ''; 
					 }
					 if($row['ot_status']!='Complete'){
						 $orderstatus = $row['ot_status']. "<br/>" .'<a href="updateorderstatus.php?id='.$row['ot_UserId'].'&otid='.$row['ot_id'].'&m=2">click for Complete</a>';
					 } else { 
						  $orderstatus = $row['ot_status'];
					 }
                     $user_details.='<tr>
                                        <td>'.$row_usr['usr_first_name'].' </td>
                                        <td>'.$row_usr['usr_streetaddress1'].'<br/>'.$row_usr['usr_order_city'].'</td>
                                        <td>'.$row_usr['usr_zipcode'].' '.$row_usr['usr_zipcode2letter'].'</td>
                                        <td>'.$row_usr['usr_order_phone'].'</td>
                                        <td>'.$row_usr['usr_emailid'].'</td>
                                        <td>'.$row['ot_odrnote'].'</td>
                                        
                                        <td>'.$qrcode.'</td>
                                    </tr>';
                 }$user_details.='</table>';
                 
                 
                 $three_dot='';
                 if(strlen($row['ot_odrnote'])>10){$three_dot='...';}
                $list_gift .= '
            <tr >
                <td>' . $cno . '</td>
                
                <td data-toggle="collapse" data-target="#demo' . $cno . '" class="accordion-toggle hendmouse" title="Click to view details">' . $row['ot_id'] . '</td>
								<td>'.date_format(new DateTime($data111), "M d, Y").'</td>

				<td>' . date_format(new DateTime($row["ot_time"]), "H:i") . '</td>
				
                <td>' . str_replace('.',',',$row['ot_TotalAmount']). '</td>
                <td>' . $ot_paymentoption . '</td>
                <td>' . $row['ot_trx_status'] . '</td>
                <td>' . $ot_pick_del . '</td>
				 <td>' . $row['del_time'] . '</td> 
                <td>' . $orderstatus . '</td>
                <td>' . substr($row['ot_odrnote'], 0, 30) .''.$three_dot.'</td>
                     <td>' . $pstatus . '</td>  
					 <td>' .$gstaction. '</td>
                <td>
                <a title="View Details" class="btn btn-social-icon btn-primary" data-toggle="collapse" data-target="#demo'.$cno.'" class="accordion-toggle hendmouse" id="edit_record" dataid="'.$row['ot_id'].'"><i class="fa fa-eye"></i></a> <a title="Update Status" class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="'.$row['ot_id'].'"><i class="fa fa-pencil"></i></a> <a title="Bill Print" class="btn btn-social-icon btn-warning printorder" data-dataid='.$row['ot_id'].'><i class="fa fa-print"></i></a><a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="'.$row['ot_id'].'"><i class="fa fa-trash"></i> </a></td>
            </tr>
            <tr class="detailstab">            
                <td colspan="9" class="hiddenRow">
                    <div class="accordian-body collapse" id="demo' . $cno . '">
                    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1' . $cno . '" data-toggle="tab">Order Details</a></li>
              <li ><a href="#tab_2' . $cno . '" data-toggle="tab">User Details</a></li>
              <li ><a href="#tab_3' . $cno . '" data-toggle="tab">Gift Item</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1' . $cno . '">
                '.$alldata.'
				'.$cutlery.'
              </div>
              <div class="tab-pane table-responsive" id="tab_2' . $cno . '">
                <b>User Details:</b>
                '.$user_details.'
              </div>
              <div class="tab-pane table-responsive" id="tab_3' . $cno . '">
                <b>Selected Gift Item:</b>
                '.$gift_item.'
              </div>
            </div>
          </div>
                </div>
                </td>
            </tr>
                        ';
            }
        }
        echo $list_gift . "</tbody>";
    }

    

    if ($gift_action == "edit_load_record") {
        $result = $mysqli->query("SELECT * FROM `tbl_orders` WHERE `ot_id`='" . $_POST['ot_id'] . "'");
        $row = $result->fetch_assoc();
        $row['ot_paymentoption'];
        
        
        
        $active1=$active2=$active3=$active4='';
        if($row['ot_status']=='Pending'){$active1='selected="selected"';}
        if($row['ot_status']=='Complete'){$active2='selected="selected"';}
        if($row['ot_status']=='Cancel'){$active3='selected="selected"';}
        if($row['ot_status']=='Processing'){$active4='selected="selected"';}
		
        $paymentactive1=$paymentactive2=$paymentactive3=$paymentactive3=$paymentactive5='';
        if($row['ot_paymentoption']=='COD'){$paymentactive1='selected="selected"';}
        if($row['ot_paymentoption']=='iDEAL'){$paymentactive2='selected="selected"';}
        if($row['ot_paymentoption']=='Master Card'){$paymentactive3='selected="selected"';}
        if($row['ot_paymentoption']=='Paypal'){$paymentactive3='selected="selected"';}
        if($row['ot_paymentoption']=='PIN'){$paymentactive5='selected="selected"';}
        
        $output="";
        $output.='<input type="hidden" id="ot_id" value="' . $_POST['ot_id'] . '">
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6 col-sm-12">
                        <label for="min_odr_amunt">Order Status</label>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <select name="currentstatus" id="currentstatus" class="form-control select2" style="width: 100%;">
                                <option value="Pending" ' .$active1. ' >Pending</option>
                                <option value="Processing" ' .$active4. ' >Processing</option>
                                <option value="Complete" ' .$active2. ' >Complete</option>
                                <option value="Cancel" ' .$active3. ' >Cancel</option>
                            </select>
                            </div>
                        </div>
						</div>
						 <div class="form-group">
						<div class="row">
                        <div class="col-md-6 col-sm-12">
                        <label for="min_odr_amunt">Payment Type</label>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <select name="ot_paymentoption" id="ot_paymentoption" class="form-control select2" style="width: 100%;">
                                <option value="CASH" ' .$paymentactive1. ' >Cash</option>
                                <option value="iDEAL" ' .$paymentactive2. ' >iDEAL</option>
                                <option value="Master Card" ' .$paymentactive3. ' >Master Card</option>
                                <option value="Paypal" ' .$paymentactive4. ' >Paypal</option>
								 <option value="PIN" ' .$paymentactive5. ' >Pin</option>
                            </select>
                            </div>
                        </div>
						</div>
						 <div class="form-group">
						<div class="row">
                        <div class="col-md-6 col-sm-12">
                        <label for="min_odr_amunt">Transaction Id</label>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input name="ot_trxid" id="ot_trxid" class="form-control" value="'.$row['ot_trxid'].'">
                            </div>
                        </div>
                    </div>';
        
        
        echo $output;
        
    }
if ($gift_action == 'delete') {
        $attrib_id = $_POST['attrib_id'];
        $notification_message = '';
      $query = "DELETE  FROM `tbl_orders` WHERE `ot_id`='" . $attrib_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Order deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Order not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
	if ($gift_action == 'deletebycode') {
         $attrib_id = $_POST['attrib_id'];
		  $delcode = $_POST['delcode'];
        $notification_message = '';
		$del_query22="Select * from adm_set where adm_set_name='delcode' ";
                $result_del_query22 = $mysqli->query($del_query22);
				$row_delusr22 = $result_del_query22->fetch_assoc();
				$delcodedb = $row_delusr22['adm_set_vlu'];
		 
		if($delcode==$delcodedb){
      $query = "DELETE  FROM `tbl_orders` WHERE `ot_id`='" . $attrib_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Order deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Order not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        } 
		} else { 
			$notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Code is wrong. Please try again little later.</div></div></div><!-- //.Note section -->';
		}
        echo $notification_message;
    }
    if ($gift_action == "edit") {
        $ot_trxid = $_POST['ot_trxid']; $ot_paymentoption = $_POST['ot_paymentoption'];
        $ot_id = $_POST['ot_id']; $selected_val = $_POST['selected_val'];
        $edit_gift_query = "UPDATE `tbl_orders` SET `ot_status`='" . $selected_val . "',`ot_paymentoption`='".$ot_paymentoption."',`ot_trxid`='".$ot_trxid."' WHERE `ot_id`='" . $ot_id . "'";
        

        $edit_gift_query_result = $mysqli->query($edit_gift_query);

        $notification_message = '';
        if ($edit_gift_query_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Order status updated successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Order status not updated. Please try again little later.</div></div></div>';
        }

        echo $notification_message;
    }
    
    
     if ($gift_action == "print") {
        $logo_url="https://littleindiarestaurant.nl/site/wp-content/themes/onlineorder/img/logo.jpg";
        $ot_id = $_POST['ot_id'];
        $query="SELECT a.*, b.* From tbl_user a INNER JOIN tbl_orders b on a.usr_id = b.ot_UserId and b.ot_id = '".$ot_id."'";
        $query_result = $mysqli->query($query);
        $row=$query_result->fetch_array();
        $current_lang="en_not";
         if ($current_lang == "en") {
                $or_orderno = "Order Number:";
                $or_date = "Date:";
                $or_total = "Total:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Cash";
                $twoline_msg = "Order Details";
                $cust_dtls_title = "Customer Information";
                $or_email = 'Email';
                $or_tele = 'Telephone';
                $or_free_item = 'Also Free';
                $or_Pickup_Delivery = 'Pick up / Delivery';
                $bill_addr = 'Billing Address';
                $footer_msg='<center style="font-size: 30px;color: #000;"><b>Thank you for your order.<br/>Eat tasty!</b></center>';
            } else {
                $or_orderno = "Order Number:";
                $or_date = "Date:";
                $or_total = "Totaal:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Contant";
                $twoline_msg = "Bestel Details";
                $cust_dtls_title = "Klantgegevens";
                $or_email = 'E-mail';
                $or_tele = 'Telefoon';
                $or_free_item = 'Gratis Item';
                $or_Pickup_Delivery = "Afhalen / Bezorgen";
                $bill_addr = 'UW GEGEVENS';
                $footer_msg='<center style="font-size: 30px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
            }
            
        $freeitem='';
        if (isset($row['ot_giftitem']) && !empty($row['ot_giftitem'])) 
        { 
            $freeitem='<tr><td>'.$or_free_item.': '.$row['ot_giftitem'].'</td></tr>'; 
        }
        
       
        
        $data111=$row['ot_OrderDate'];
       $print_bill='';
       $print_bill='<style>.forprint_admin{width:100% !important;padding: 5px 50px;font-size:30px;font-weight:800;font-family:serif,Arial,"Times New Roman",georgia,garamond;}</style><div class="print_content" class="forprint_admin">
<div><center><img src="'.$logo_url.'" class="img-responsive" style="min-width:500px;"/>          </center><br/></div>
<div class="col-md-12 col-sm-12 table-responsive ">
     <div>'.$or_orderno.' #'.$row['ot_id'].'</div>
     <div>'.$or_date.' '.date_format(new DateTime($data111), "M d, Y").'</div>
     <div>'.$or_total.' '.currency . " " . $row['ot_TotalAmount'].'</div>
     <div>'.$or_paymethod.' '.$row['ot_paymentoption'].'</div><div><br/></div>
                        </div>                
                        <div class="col-md-12 col-sm-12 mail_prt"><style>.mail_prt td:first-child{font-size:10px;}.mail_prt table{max-width:95%;}</style>
                            '.$row['ot_order_details'].' 
                        </div> 
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><b>'.$cust_dtls_title.'</b></p>
                            <p>
                            <table>
                                <tr><td>'.$or_email.': '.$row['usr_emailid'].'</td></tr>
                                <tr><td>'.$or_tele.': '.$row['usr_order_phone'].'</td></tr>
                                '.$freeitem.'
                                <tr><td>'.$or_Pickup_Delivery.': '.$row['ot_pick_del'].'</td></tr>
                            </table>
                            </p>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><b>'.$bill_addr.'</b></p>
                            <p>'.$row['usr_first_name'] . ' ' . $row['usr_last_name'] . '<br/>' . $row['usr_company'] . '<br/>' . $row['usr_streetaddress1'] . '<br/>' . $row['usr_streetaddress2'] . '<br/>' . $row['usr_zipcode'] . ' ' . $row['usr_zipcode2letter']. '<br/>' . $row['usr_order_city'].'</p>
                        </div><div class="col-md-12 col-sm-12"><center>'.$footer_msg.'</center></div></div>';
       
       
       echo $print_bill;
//       die($print_bill);
        
    }

   
}
?>

<script>
	   $(".printorder").click(function(){				    
			   var thiss = $(this);
		 	 var showresultof = $(this).attr('data-dataid');			 
                var action = 'printorders';			 
                   $.ajax({
                        type: "POST",
                       url: "all_order_action_print.php",
                         data: {showresultof: showresultof, action: action },
                        dataType: "html",
                        success: function (data1)
                        {
							   // $('#userInfo').html(data1);
							 //  var printContent = document.getElementById('userInfo');
								 var WinPrint = window.open('', '', 'width=900,height=650');
								 WinPrint.document.write(data1);
								 WinPrint.document.close();
								 WinPrint.focus();
								 WinPrint.print();
								 WinPrint.close();	     
                        }
                    });	 
	  });
</script>	

