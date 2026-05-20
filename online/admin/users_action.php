<?php
include 'db.php';
include 'config.php';

if (isset($_POST['postcode_action'])) {
    
    $postcode_action = $_POST['postcode_action'];
    
    if ($postcode_action == "load") {
        $list_postcode_query        = "Select * From `users` where user_type=2";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode              = '<tbody><tr>
                                                <th>S.No.</th>
                                                <th>User Name</th>
                                                <th>Password </th>
                                                <th>Emailid</th>
                                                <th>Mobile</th>
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
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['password'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['number'] . '</td>
                                    <td>
                                        <a title="Edit" class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <a title="Change Status" class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-stateChange" id="change_record" dataid="' . $row['id'] . '"><i class="fa fa-toggle-on"></i></a>  
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
        $query       = "SELECT * FROM `users` WHERE `id`='" . $postcode_id . "'";
        
        
        $result = $mysqli->query($query);
        $row    = $result->fetch_assoc();
        if ($row['postcode'] == '1') {
            $postcode = 'checked';
        } else {
            $postcode = '';
        }
        if ($row['minorder'] == '1') {
            $minorder = "checked";
        } else {
            $minorder = "";
        }
        if ($row['products'] == '1') {
            $products = "checked";
        } else {
            $products = "";
        }
        if ($row['time_setting'] == '1') {
            $time_setting = "checked";
        } else {
            $time_setting = "";
        }
        if ($row['dishbycategory'] == '1') {
            $dishbycategory = "checked";
        } else {
            $dishbycategory = "";
        }
        if ($row['gift_item'] == '1') {
            $gift_item = "checked";
        } else {
            $gift_item = "";
        }
        if ($row['delivery_item'] == '1') {
            $delivery_item = "checked";
        } else {
            $delivery_item = "";
        }
        if ($row['discount'] == '1') {
            $discount = "checked";
        } else {
            $discount = "";
        }
        if ($row['discount'] == '1') {
            $discount = "checked";
        } else {
            $discount = "";
        }
        if ($row['order'] == '1') {
            $order = "checked";
        } else {
            $order = "";
        }
        if ($row['setting'] == '1') {
            $setting = "checked";
        } else {
            $setting = "";
        }
        if ($row['welcome'] == '1') {
            $welcome = "checked";
        } else {
            $welcome = "";
        }
		if ($row['cashier'] == '1') {
            $cashier = "checked";
        } else {
            $cashier = "";
        }
		if ($row['users'] == '1') {
            $users = "checked";
        } else {
            $users = "";
        }
        if ($row['preorder'] == '1') {
            $preorder = "checked";
        } else {
            $preorder = "";
        }
		if ($row['sales_report'] == '1') {
            $sales_report = "checked";
        } else {
            $sales_report = "";
        }
		if ($row['gps_mail'] == '1') {
            $gps_mail = "checked";
        } else {
            $gps_mail = "";
        }
		if ($row['cutlery_charges'] == '1') {
            $cutlery_charges = "checked";
        } else {
            $cutlery_charges = "";
        }
		if ($row['customer'] == '1') {
            $customer = "checked";
        } else {
            $customer = "";
        }
		if ($row['coupon_mail'] == '1') {
            $coupon_mail = "checked";
        } else {
            $coupon_mail = "";
        }
		if ($row['lost_customer'] == '1') {
            $lost_customer = "checked";
        } else {
            $lost_customer = "";
        }
		if ($row['newsletter'] == '1') {
            $newsletter = "checked";
        } else {
            $newsletter = "";
        }
		if ($row['plastic_charge'] == '1') {
            $plastic_charge = "checked";
        } else {
            $plastic_charge = "";
        }
		if ($row['review'] == '1') {
            $review = "checked";
        } else {
            $review = "";
        }
		if ($row['tip'] == '1') {
            $tip = "checked";
        } else {
            $tip = "";
        }
		if ($row['table'] == '1') {
            $table = "checked";
        } else {
            $table = "";
        }
		if ($row['promotion'] == '1') {
            $promotion = "checked";
        } else {
            $promotion = "";
        }
		if ($row['email_import'] == '1') {
            $email_import = "checked";
        } else {
            $email_import = "";
        }
		 if ($row['reserva_module'] == '1') {
            $reserv_module = "checked";
        } else {
            $reserv_module = "";
        }
		
		
		
		
		
		
        echo '<input type = "hidden" id = "postcode_id" value = "' . $_POST['postcode_id'] . '">
<div class = "form-group">
<label for = "name">Username </label>
<input type = "text" class = "form-control" id = "username_edit" name = "username_edit" placeholder = "Enter Username" value = "' . $row['name'] . '" required >
</div>
<div class = "form-group">
<label for = "password">Password</label>
<input type = "text" class = "form-control" id = "password_edit" name = "password_edit" placeholder = "Enter Password" value = "' . $row['password'] . '" required>
</div>
<div class = "form-group">
<label for = "email">Email Id</label>
<input type = "text" class = "form-control" id = "emailid_edit" name = "emailid_edit" placeholder = "Enter Emailid" value = "' . $row['email'] . '" required>
</div>
<div class = "form-group">
<label for = "number">Mobile Number</label>
<input type = "text" class = "form-control" id = "number_edit" name = "number_edit" placeholder = "Enter Number" value = "' . $row['number'] . '" required>
</div>
<h4>Users module</h4>
 <div class="form-group">
 <label for="attributes price">Sales Report</label>
                                            <input type="checkbox"  id="sales_report" name="sales_report" value="1" '.$sales_report.'>
											<label for="attributes price">Customer</label>
                                            <input type="checkbox"  id="customer_edit" name="customer_edit" value="1" '.$customer.'>
  <label for="postcode">Welcome Text</label>
  
                                            <input type="checkbox"  id="welcome" name="welcome" value="1" ' . $welcome . '>
											   <label for="postcode">Cashier</label>
                                            <input type="checkbox"  id="cashier" name="cashier" value="1" ' . $cashier . '>
											   <label for="postcode">Users</label>
                                            <input type="checkbox"  id="users" name="users" value="1" ' . $users . '>
<label for="postcode">Postcode</label>
                                            <input type="checkbox"  id="postcode" name="postcode" value="1" ' . $postcode . '>
                                                <label for="minorder">Min order</label>
                                            <input type="checkbox"  id="minorder" name="minorder" value="1" ' . $minorder . '>
                                                <label for="products">Menu/Products</label>
                                            <input type="checkbox"  id="products" name="products" value="1" ' . $products . '>
                                                <label for="attributes price">Time Setting</label>
                                            <input type="checkbox"  id="time_setting" name="time_setting" value="1" ' . $time_setting . '>
                                                <label for="attributes price">Dish by category</label>
                                            <input type="checkbox"  id="dishbycategory" name="dishbycategory" value="1" ' . $dishbycategory . '>
                                                <label for="attributes price">Gift Item</label>
                                            <input type="checkbox"  id="gift_item" name="gift_item" value="1" ' . $gift_item . '> 
                                               <label for="attributes price">Delivery Item</label>
                                            <input type="checkbox"  id="delivery_item" name="delivery_item" value="1" ' . $delivery_item . '>
                                                <label for="attributes price">Discount</label>
                                            <input type="checkbox"  id="discount" name="discount" value="1" ' . $discount . '>
                                                <label for="attributes price">Holidays</label>
                                            <input type="checkbox"  id="holidays" name="holidays" value="1" ' . $holidays . '>
                                               <label for="attributes price">Orders</label>
                                            <input type="checkbox"  id="order" name="order" value="1" ' . $order . '>
                                               <label for="attributes price">Setting</label>
                                            <input type="checkbox"  id="setting" name="setting" value="1" ' . $setting . '>
											  <label for="attributes price">Pre Order</label>
                                            <input type="checkbox"  id="preorder" name="preorder" value="1" ' . $preorder . '>
											<label for="attributes price">Cutlery charges</label>
                                            <input type="checkbox"  id="cutlery_charges" name="cutlery_charges" value="1" '.$cutlery_charges.'>
											  
											   <label for="attributes price">GPS Mail Text</label>
                                            <input type="checkbox"  id="gps_mail" name="gps_mail" value="1" '.$gps_mail.'>
											<label for="attributes price">2nd Coupon Mail </label>
                                            <input type="checkbox"  id="coupon_mail_edit" name="coupon_mail_edit" value="1" '.$coupon_mail.'>
											    <label for="attributes price">Lost Customer</label>
                                            <input type="checkbox"  id="lost_customer_edit" name="lost_customer_edit" value="1" '.$lost_customer.'>
											    <label for="attributes price">Newsletter</label>
                                            <input type="checkbox"  id="newsletter_edit" name="newsletter_edit" value="1" '.$newsletter.'>
											    <label for="attributes price">Plastic charge</label>
                                            <input type="checkbox"  id="plastic_charge_edit" name="plastic_charge_edit" value="1" '.$plastic_charge.'>
											    <label for="attributes price">Review</label>
                                            <input type="checkbox" id="review_edit" name="review_edit" value="1" '.$review.'>
											 <label for="attributes price">Tip</label>
                                            <input type="checkbox" id="tip_edit" name="tip_edit" value="1" '.$tip.'>
											 <label for="attributes price">Table</label>
                                            <input type="checkbox" id="table_edit" name="table_edit" value="1" '.$table.'>
											<label for="attributes price">Promotion</label>
                                            <input type="checkbox" id="promotion_edit" name="promotion_edit" value="1" '.$promotion.'>
											
											<label for="attributes price">Email Import</label>
                                           <input type="checkbox" id="email_import_edit" name="email_import_edit" value="1" '.$email_import.'>
										<label for="attributes price">Reservation</label>
                                      <input type="checkbox" id="reserv_module_edit" name="reserv_module_edit" value="1" '.$reserv_module.'>	
                                        </div> 
';
    }
    
    if ($postcode_action == "edit_postcode") {
        
        $postcode_id    = $_POST['postcode_id'];
        $username_edit  = $_POST['username_edit'];
        $password_edit  = $_POST['password_edit'];
        $emailid_edit   = $_POST['emailid_edit'];
        $number_edit    = $_POST['number_edit'];
        $postcode       = $_POST['postcode'];
        $minorder       = $_POST['minorder'];
        $products       = $_POST['products'];
        $time_setting   = $_POST['time_setting'];
        $dishbycategory = $_POST['dishbycategory'];
        $gift_item      = $_POST['gift_item'];
        $delivery_item  = $_POST['delivery_item'];
        $discount       = $_POST['discount'];
        $holidays       = $_POST['holidays'];
        $order          = $_POST['order'];
        $setting        = $_POST['setting'];
        $welcome        =  $_POST['welcome'];
		 $cashier       = $_POST['cashier'];
		 $users         = $_POST['users'];
		$preorder        = $_POST['preorder'];
		$sales_report        = $_POST['sales_report'];
		$gps_mail        = $_POST['gps_mail'];
		$cutlery_charges        = $_POST['cutlery_charges'];
		$customer_edit = $_POST['customer_edit'];
		$coupon_mail        = $mysqli->escape_string($_POST['coupon_mail_edit']);
		$lost_customer        = $mysqli->escape_string($_POST['lost_customer_edit']);
		$newsletter        = $mysqli->escape_string($_POST['newsletter_edit']);
		$plastic_charge        = $mysqli->escape_string($_POST['plastic_charge_edit']);
		$review        = $mysqli->escape_string($_POST['review_edit']);
		$tip        = $mysqli->escape_string($_POST['tip_edit']);
		$table        = $mysqli->escape_string($_POST['table_edit']);
		$promotion        = $mysqli->escape_string($_POST['promotion_edit']);
		$email_import        = $mysqli->escape_string($_POST['email_import_edit']);
		 $reserva_module        = $mysqli->escape_string($_POST['reserva_module']);
		
        $edit_query_updte_postcode = "UPDATE `users` SET `name`='" . $username_edit . "', `password`='" . $password_edit . "',`email`='" . $emailid_edit . "',`number`='" . $number_edit . "',`welcome`='" . $welcome . "',`cashier`='" . $cashier . "',`users`='" . $users . "',`postcode`='" . $postcode . "',`minorder`='" . $minorder . "',`products`='" . $products . "',`time_setting`='" . $time_setting . "',`dishbycategory`='" . $dishbycategory . "',`gift_item`='" . $gift_item . "',`delivery_item`='" . $delivery_item . "',`discount`='" . $discount . "',`holidays`='" . $holidays . "',`order`='" . $order . "',`setting`='" . $setting . "',`preorder`='" . $preorder . "',`sales_report`='" . $sales_report . "' ,`gps_mail`='" . $gps_mail . "' ,`cutlery_charges`='" . $cutlery_charges . "',`customer`='".$customer_edit."',`coupon_mail`='".$coupon_mail."',`lost_customer`='".$lost_customer."',`newsletter`='".$newsletter."',`promotion`='".$promotion."',`email_import`='".$email_import."',`plastic_charge`='".$plastic_charge."',`review`='".$review."',`tip`='".$tip."',`table`='".$table."' ,`reserva_module`='".$reserva_module."' WHERE `id`='" . $postcode_id . "'";
        
        $dupesql              = "SELECT * FROM `users` where `name` = '" . $username_edit . "'";
        $duperaw              = $mysqli->query($dupesql); //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row          = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['id'] != $postcode_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $username_edit . ' already exists.</div></div></div>';
        } else {
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);
            
            if ($edit_postcode_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Users updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Users not updated. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }
    
    if ($postcode_action == "add_postcode") {
        $username       = $mysqli->escape_string($_POST['username']);
        $password       = $mysqli->escape_string($_POST['password']);
        $emailid        = $mysqli->escape_string($_POST['emailid']);
        $number         = $mysqli->escape_string($_POST['number']);
        $welcome       = $mysqli->escape_string($_POST['welcome']);
		 $cashier       = $mysqli->escape_string($_POST['cashier']);
		 $users       = $mysqli->escape_string($_POST['users']);
		 $postcode       = $mysqli->escape_string($_POST['postcode']);
        $minorder       = $mysqli->escape_string($_POST['minorder']);
        $products       = $mysqli->escape_string($_POST['products']);
        $time_setting   = $mysqli->escape_string($_POST['time_setting']);
        $dishbycategory = $mysqli->escape_string($_POST['dishbycategory']);
        $gift_item      = $mysqli->escape_string($_POST['gift_item']);
        $delivery_item  = $mysqli->escape_string($_POST['delivery_item']);
        $discount       = $mysqli->escape_string($_POST['discount']);
        $holidays       = $mysqli->escape_string($_POST['holidays']);
        $order          = $mysqli->escape_string($_POST['order']);
        $setting        = $mysqli->escape_string($_POST['setting']);
        $preorder        = $mysqli->escape_string($_POST['preorder']);
		$sales_report   = $mysqli->escape_string($_POST['sales_report']);
		$gps_mail        = $mysqli->escape_string($_POST['gps_mail']);
		$cutlery_charges        = $mysqli->escape_string($_POST['cutlery_charges']);
		$customer        = $mysqli->escape_string($_POST['customer']);
		$coupon_mail        = $mysqli->escape_string($_POST['coupon_mail']);
		$lost_customer        = $mysqli->escape_string($_POST['lost_customer']);
		$newsletter        = $mysqli->escape_string($_POST['newsletter']);
		$plastic_charge        = $mysqli->escape_string($_POST['plastic_charge']);
		$review        = $mysqli->escape_string($_POST['review']);
		$tip        = $mysqli->escape_string($_POST['tip']);
		$table        = $mysqli->escape_string($_POST['table']);
		$promotion        = $mysqli->escape_string($_POST['promotion']);
		$email_import        = $mysqli->escape_string($_POST['email_import']);
		$reserva_module        = $mysqli->escape_string($_POST['reserva_module']);
		
		
        $add_attrrib_query = "INSERT INTO `users`(`name`, `password`, `email`,`number`,`user_type`,`welcome`,`cashier`,`users`,`postcode`,`minorder`,`products`,`time_setting`,`dishbycategory`,`gift_item`,`discount`,`holidays`,`order`,`setting`,`delivery_item`,`login_status`,`status`,`preorder`,`sales_report`,`gps_mail`,`cutlery_charges`,`customer`,`coupon_mail`,`lost_customer`,`newsletter`,`plastic_charge`,`review`,`tip`,`table`,`promotion`,`email_import`,`reserva_module`) VALUES ('" . $username . "','" . $password . "','" . $emailid . "','" . $number . "','2','" . $welcome . "','" . $cashier . "','" . $users . "','" . $postcode . "','" . $minorder . "','" . $products . "','" . $time_setting . "','" . $dishbycategory . "','" . $gift_item . "','" . $discount . "','" . $holidays . "','" . $order . "','" . $setting . "','" . $delivery_item . "','active','active','" . $preorder . "','" . $sales_report . "','" . $gps_mail . "','" . $cutlery_charges . "','".$customer."','".$coupon_mail."','".$lost_customer."','".$newsletter."','".$plastic_charge."','".$review."','".$tip."','".$table."','".$promotion."','".$email_import."','".$reserva_module."')";
        
        $dupesql              = "SELECT `name` FROM `users` where `name` = '$username'";
        $duperaw              = $mysqli->query($dupesql); //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row          = $duperaw->fetch_assoc();
        $notification_message = '';
        
        if ($duperaw_row['name'] == $username || $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $username . ' already exists.</div></div></div>';
        } else {
            $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
            if ($add_attrrib_query_result) {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">User added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Users not added. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }
    
    if ($postcode_action == "change_postcode_status_get") {
         $postcode_id = $_POST['postcode_id'];
        
         $query    = "select * from `users` where `id`=  $postcode_id ";
        $res_data = $mysqli->query($query);
        
        $row           = $res_data->fetch_assoc();
        $return_string = '';
        if ($row['status'] == 'active') {
            $active = 'selected="selected"';
        }
        if ($row['status'] == 'Inactive') {
            $inactive = 'selected="selected"';
        }
        $return_string = ' 
                                        <div class="col-sm-12">
                                            <fieldset>
                                               <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="Select Status">Select Status</label>
                                                        <select name="currentstatus" id="currentstatus" class="form-control select2" style="width: 100%;">
                                                            <option value="active" ' . $active . ' >Active</option>
                                                            <option value="Inactive" ' . $inactive . ' >Inactive</option>
                                                        </select>
                                                        
<input id="postcode_id" type="hidden" value="' . $postcode_id . '"/>
                                                    </div>
                                                    
                                                </div></fieldset></div>';
        
        echo $return_string;
    }
    
    if ($postcode_action == "postcode_status_set") {
        $status      = $_POST['selected_value'];
        $postcode_id = $_POST['postcode_id'];
        
        $update_query = "UPDATE `users` SET `status`='" . $status . "' WHERE `id`='" . $postcode_id . "'";
        
        $notification_message = '';
        $result               = $mysqli->query($update_query);
        if ($result) {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">User status updated successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! User status not updated. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }
    
    if ($postcode_action == "delete") {
        $postcode_id          = $_POST['postcode_id'];
        $result               = $mysqli->query("DELETE  FROM `users` WHERE `id`='" . $postcode_id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}