<?php
include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    
    $action = $_POST['action'];
    
    if ($action == "load") {
        $list_postcode_query        = "Select * From `lostcustomercoupon` ORDER BY id DESC";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode              = '<tbody><tr>
                                                <th>S.No.</th>
                                                <th>Code</th>
                                                <th>Discount Type </th>
                                                <th>Percenteage Amount</th>
												<th>Fix Amount</th>
                                                <th>Valid time</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode .= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
            
            while ($row = $result_list_postcode_query->fetch_assoc()) {
                $activ_class = "";
                if ($row['status'] == "Inactive") {
                    $activ_class = 'incativ';
                } else {
                    $activ_class = "";
                }
				
				if($row['per_amount']!='')
				{
					$per = "%";
				} else { 
					$per = "";
				}
				if($row['fix_amount']!='')
				{
					$fix = "€";
				} else { 
					$fix = "";
				}
                $list_postcode .= '<tr class="' . $activ_class . '">
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['couponcode'] . '</td>
                                    <td>' . $row['discount'] . '</td>
									<td>' . $row['per_amount'] . ' '.$per.'</td>
                                    <td>'.$fix.' ' . $row['fix_amount'] . ' </td>
                                    <td> ' . $row['validdays'] . '</td>
                                    <td> <a title="Delete" class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        echo $list_postcode;
    }
    
    
    if ($action == "coupun_update") {
        
        $restra_holi_en    = $_POST['restra_holi_en'];
		$restra_holi_nl    = $_POST['restra_holi_nl'];
        $discount  = $_POST['discount'];
		if($discount=='fixamount'){
			$fix_amount   = $_POST['fixamt'];
		} else { 
			$fix_amount = '';
		}
		if($discount=='percentage'){
       		$per_amount  = $_POST['percentageamt'];
		} else { 
			$per_amount = '';
		}
		if($discount=='freedish'){
       		$free_dish  = $_POST['freedishname'];
		} else { 
			$free_dish = '';
		}
        $validdays    = $_POST['validdays'];
        $coupon =  strtoupper(substr(str_shuffle("abcdefghijklmnopqrstvwxyz"), 0, 6));
		$now = date('Y-m-d H:i:s');
        $edit_query_updte_postcode = "UPDATE `lostcustomercoupon` SET `restra_holi_en`='" . $mysqli->escape_string($restra_holi_en) . "',`restra_holi_nl`='" . $mysqli->escape_string($restra_holi_nl) . "', `discount`='" . $discount . "',`per_amount`='" . $per_amount . "',`fix_amount`='" . $fix_amount . "',`freedishname`='" . $free_dish . "',`validdays`='" . $validdays . "',`status`='" . $_POST['status'] . "',`ddate` = '".$now."' where id = 1";
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);
            
            if ($edit_postcode_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Customer updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Customer not updated. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }
    
    
    
    if ($action == "delete") {
        $id          = $_POST['id'];
		$emailid = $getdata['email'];
        $result               = $mysqli->query("DELETE  FROM `lostcustomercoupon` WHERE `id`='" . $id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Customer deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Customer not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}