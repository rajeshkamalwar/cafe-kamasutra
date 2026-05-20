<?php
include 'db.php';
include 'config.php';

if (isset($_POST['postcode_action'])) {
    
    $postcode_action = $_POST['postcode_action'];
    
    if ($postcode_action == "load") {
        $list_postcode_query        = "Select * From `registeruser` ORDER BY id DESC";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode              = '<tbody><tr>
                                                <th>S.No.</th>
                                                <th>User Name</th>
                                                <th>Password </th>
                                                <th>Name</th>
                                                <th>Postcode</th>
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
                $list_postcode .= '<tr class="' . $activ_class . '">
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['confirmpassword'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['postcode'] . '</td>
                                    <td>
                                        <a title="Edit" class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <a title="Delete" class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        echo $list_postcode;
    }
    
    if ($postcode_action == "get_data4edit") {
        $postcode_id = $_POST['postcode_id'];
        $query       = "SELECT * FROM `registeruser` WHERE `id`='" . $postcode_id . "'";
        
        
        $result = $mysqli->query($query);
        $row    = $result->fetch_assoc();
       
        echo '<input type = "hidden" id = "postcode_id" value = "' . $_POST['postcode_id'] . '">
<div class = "form-group">
<label for = "name">Email id </label>
<input type = "text" class = "form-control" id = "username_edit" name = "username_edit" placeholder = "Enter Username" value = "' . $row['email'] . '" required >
</div>
<div class = "form-group">
<label for = "password">Postcode</label>
<input type = "text" class = "form-control" id = "postcode_edit" name = "postcode_edit" placeholder = "Enter postcode" value = "' . $row['postcode'] . '" required>
</div>
<div class = "form-group">
<label for = "email">Name</label>
<input type = "text" class = "form-control" id = "name_edit" name = "name_edit" placeholder = "Enter name" value = "' . $row['name'] . '" required>
</div>
<div class = "form-group">
<label for = "number">Password</label>
<input type = "password" class = "form-control" id = "password_edit" name = "password_edit" placeholder = "Enter Number" value = "' . $row['confirmpassword'] . '" required>
</div>
<div class = "form-group">
<label for = "password">Company name</label>
<input type = "text" class = "form-control" id = "usr_company" name = "usr_company" placeholder = "Enter postcode" value = "' . $row['usr_company'] . '" required>
</div>
<div class = "form-group">
<label for = "password">Street Address</label>
<input type = "text" class = "form-control" id = "usr_streetaddress1" name = "usr_streetaddress1" placeholder = "Enter postcode" value = "' . $row['usr_streetaddress1'] . '" required>
</div>
<div class = "form-group">
<label for = "password">Phone</label>
<input type = "text" class = "form-control" id = "usr_order_phone" name = "usr_order_phone" placeholder = "Enter postcode" value = "' . $row['usr_order_phone'] . '" required>
</div>
<div class = "form-group">
<label for = "password">Two letter Postcode</label>
<input type = "text" class = "form-control" id = "usr_zipcode2letter" name = "usr_zipcode2letter" placeholder = "Enter postcode" value = "' . $row['usr_zipcode2letter'] . '" required>
</div>
<div class = "form-group">
<label for = "password">City</label>
<input type = "text" class = "form-control" id = "usr_order_city" name = "usr_order_city" placeholder = "Enter postcode" value = "' . $row['usr_order_city'] . '" required>
</div>

                                        </div> 
';
    }
    
    if ($postcode_action == "edit_postcode") {
        
        $postcode_id    = $_POST['postcode_id'];
        $username_edit  = $_POST['username_edit'];
        $password_edit  = $_POST['password_edit'];
        $name_edit   = $_POST['name_edit'];
        $usr_company    = $_POST['usr_company'];
        $usr_streetaddress1       = $_POST['usr_streetaddress1'];
        $usr_order_phone       = $_POST['usr_order_phone'];
        $usr_zipcode2letter       = $_POST['usr_zipcode2letter'];
        $usr_order_city   = $_POST['usr_order_city'];
        $postcode_edit = $_POST['postcode_edit'];
		
		$regisdata1 =$mysqli->query("select * from `registeruser` WHERE `id`='" . $postcode_id . "'");
		$getdata1 = $regisdata1->fetch_array();
		$userid = $getdata1['userid'];
		
        $edit_query_updte_postcode = "UPDATE `registeruser` SET `name`='" . $name_edit . "', `password`='" . md5($password_edit) . "',`usr_company`='" . $usr_company . "',`usr_streetaddress1`='" . $usr_streetaddress1 . "',`usr_order_phone`='" . $usr_order_phone . "',`usr_zipcode2letter`='" . $usr_zipcode2letter . "',`usr_order_city`='" . $usr_order_city . "',`postcode`='" . $postcode_edit . "',`confirmpassword`='" . $password_edit . "'  WHERE `id`='" . $postcode_id . "'";
        
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);
            
            if ($edit_postcode_result) {
				$edit_query_updte_postcode11 =  $mysqli->query("UPDATE `tbl_user` SET `usr_first_name`='" . $name_edit . "', `usr_emailid`='" . $username_edit . "',`usr_company`='" . $usr_company . "',`usr_streetaddress1`='" . $usr_streetaddress1 . "',`usr_order_phone`='" . $usr_order_phone . "',`usr_zipcode2letter`='" . $usr_zipcode2letter . "',`usr_order_city`='" . $usr_order_city . "',`usr_zipcode`='" . $postcode_edit . "'  WHERE `usr_id`='" . $userid . "'");
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Customer updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Customer not updated. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }
    
    
    
    if ($postcode_action == "delete") {
        $postcode_id          = $_POST['postcode_id'];
		$regisdata =$mysqli->query("select * from `registeruser` WHERE `id`='" . $postcode_id . "'");
		$getdata = $regisdata->fetch_array();
		$emailid = $getdata['email'];
        $result               = $mysqli->query("DELETE  FROM `registeruser` WHERE `id`='" . $postcode_id . "'");
        $notification_message = '';
        if ($result) {
			$result11               = $mysqli->query("update tbl_orders set regisid = '' WHERE `regisid`='" . $emailid . "'");
			$result12              = $mysqli->query("update tbl_user set regisid = '' WHERE `regisid`='" . $emailid . "'");
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Customer deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Customer not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}