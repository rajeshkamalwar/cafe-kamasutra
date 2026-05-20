<?php

include 'db.php';
include 'config.php';



if (isset($_POST['gift_action'])) {
    $gift_action = $_POST['gift_action'];

 

    if ($gift_action == "load") {
        $showallodr=$_POST['showallodr'];
        $additional_query="OR ot_paymentoption='PIN'";
        if($showallodr!="yes"){$additional_query=" And ot_trx_status='Success' OR (ot_paymentoption='PIN' AND  ot_trx_status='Processing')";}
       $list_gift_query = "Select * From `tbl_orders` where `ot_OrderDate` like '" . date('Y-m-d') . "%'".$additional_query." ORDER BY `norderid` DESC"; //echo $list_gift_query;die();
        $result_list_gift_query = $mysqli->query($list_gift_query);
        $list_gift = '<tbody><tr>
                                                <th>#</th>
                                                
                                                <th>Order ID</th>
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
				 if($row['ot_pick_del']=='both'){ $ot_pick_del = 'Delivery'; } else { $ot_pick_del = $row['ot_pick_del']; }
                 if($row['cutlery']=='yes'){
						$cutlery = '<h4>Cutlery : '.$row['cutlery'].'</h4>';
					}
					else { 
						 $cutlery='';
					}
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
					$gstaction = '<a href="mailsend.php?id='.$row['ot_UserId'].'&otid='.$row['ot_id'].'&m=1">Send Mail</a>';
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
					   if($ot_pick_del!='pickup'){
						 if($row_usr['qrcode']!=''){
						 $qrcode =  '<img src="https://restaurantkamasutra.nl/online/'.$row_usr['qrcode'].'" style="height:60px">';
						 } else { 
						 $qrcode =  ''; 	 
						 }
					 } else { 
						$qrcode =  ''; 
					 }
                     $user_details.='<tr>
                                        <td>'.$row_usr['usr_first_name'].'</td>
                                        <td>'.$row_usr['usr_streetaddress1'].'<br/>'.$row_usr['usr_order_city'].'</td>
                                        <td>'.$row_usr['usr_zipcode'].' '.$row_usr['usr_zipcode2letter'].'</td>
                                        <td>'.$row_usr['usr_order_phone'].'</td>
                                        <td>'.$row_usr['usr_emailid'].'</td>
                                         <td>' . $row['ot_odrnote'].'</td>
                                       
                                        <td>'.$qrcode.'</td>
                                    </tr>';
                 }$user_details.='</table>';
				
                 $three_dot='';$paymentMethod='';
                 if(strlen($row['ot_odrnote'])>10){$three_dot='...';}
				if($row['ot_paymentoption']=='COD'){$paymentMethod='CASH';} elseif($row['ot_paymentoption']=='PIN'){$paymentMethod='PIN';} elseif($row['ot_paymentoption']=='creditcard'){$paymentMethod='Master Card';}else{$paymentMethod=$row['ot_paymentoption'];}
				if($row['ot_status']!='Complete'){
						 $orderstatus = $row['ot_status']. "<br/>" .'<a href="updateorderstatus.php?id='.$row['ot_UserId'].'&otid='.$row['ot_id'].'&m=1">click for Complete</a>';
					 } else { 
						  $orderstatus = $row['ot_status'];
					 }
                $list_gift .= '
            <tr >
                <td>' . $cno . '</td>
                
                <td data-toggle="collapse" data-target="#demo' . $cno . '" class="accordion-toggle hendmouse" title="Click to view details">' . $row['ot_id'] . '</td>
				<td>' . date_format(new DateTime($row["ot_time"]), "H:i") . '</td>
                <td>' . str_replace('.',',',$row['ot_TotalAmount']). '</td>
                <td>' . $paymentMethod . '</td>
                <td>' . $row['ot_trx_status'] . '</td>
                <td>' . $ot_pick_del . '</td>
				 <td>' . $row['del_time'] . '</td> 
                <td>' . $orderstatus . '</td>
                <td>' . substr($row['ot_odrnote'], 0, 10) .''.$three_dot.'</td>
                  <td>' . $pstatus . '</td> 
				  <td>'.$gstaction.'</td>
                <td>
                <a title="View Details" class="btn btn-social-icon btn-primary" data-toggle="collapse" data-target="#demo'.$cno.'" class="accordion-toggle hendmouse" id="edit_record" dataid="'.$row['ot_id'].'"><i class="fa fa-eye"></i></a> <a title="Update Status" class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="'.$row['ot_id'].'"><i class="fa fa-pencil"></i></a> <a title="Bill Print" class="btn btn-social-icon btn-warning printorder"   data-dataid='.$row['ot_id'].'><i class="fa fa-print"></i></a><a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="'.$row['ot_id'].'"><i class="fa fa-trash"></i> </a></td>
            </tr>
            <tr class="detailstab">
            
                <td colspan="9" class="hiddenRow">
                    
                    <div class="accordian-body collapse" id="demo' . $cno . '">
                    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1' . $cno . '" data-toggle="tab">Order Details</a></li>
              <li><a href="#tab_2' . $cno . '" data-toggle="tab">User Details</a></li>
              <li><a href="#tab_3' . $cno . '" data-toggle="tab">Gift Item</a></li>
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
    
    
    
   
}
?>
<script type="text/javascript">
	
</script>	  