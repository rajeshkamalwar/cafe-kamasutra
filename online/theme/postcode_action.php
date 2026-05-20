<?php
include 'db.php';
include 'config.php';

if (isset($_POST['postcode_action'])) {

    $postcode_action = $_POST['postcode_action'];

    if ($postcode_action == "load") {
        $list_postcode_query = "Select * From `postcode`";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode = '<tbody><tr>
                                                <th>Postcode</th>
                                                <th>Neighborhood Name</th>
                                                <th>Minimum </th>
                                                <th>Delivery</th>
                                                <th>Free From</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode.= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
           
            while ($row = $result_list_postcode_query->fetch_assoc()) {
				 $activ_class="";
				if($row['postcode_status']=="Inactive"){$activ_class='incativ';}else{$activ_class="";}
                $list_postcode .= '<tr class="'.$activ_class.'">
                                    <td>' . $row['postcode'] . '</td>
                                    <td>' . short_desc($row['postcode_nbh'], 50) . '</td>
                                    <td>' . add_currency_sing($row['postcode_min_amt']) . '</td>
                                    <td>' . add_currency_sing($row['postcode_deli_chrg']) . '</td>
                                    <td>' . add_currency_sing($row['postcode_free_from']) . '</td>
                                    <td>' . $row['postcode_status'] . '</td>
                                    <td>
                                        <a title="Edit" class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['postcode_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <a title="Change Status" class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-stateChange" id="change_record" dataid="' . $row['postcode_id'] . '"><i class="fa fa-toggle-on"></i></a>  
                                        <a title="Delete" class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['postcode_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        echo $list_postcode;
    }

    if ($postcode_action == "get_data4edit") {
        $postcode_id = $_POST['postcode_id'];
        $query = "SELECT * FROM `postcode` WHERE `postcode_id`='" . $postcode_id . "'";


        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();

        echo '<input type = "hidden" id = "postcode_id" value = "' . $_POST['postcode_id'] . '">
<div class = "form-group">
<label for = "postcode name">Postcode </label>
<input type = "text" class = "form-control" id = "postcode_name_edit" name = "postcode_name_edit" placeholder = "For example: 1011" value = "' . $row['postcode'] . '" required >
</div>
<div class = "form-group">
<label for = "attributes price">Neighborhood Name</label>
<input type = "text" class = "form-control" id = "postcode_neighborhood_name_edit" name = "postcode_neighborhood_name_edit" placeholder = "For example: Amsterdam – Nieuwmarkt/Lastage" value = "' . $row['postcode_nbh'] . '" required>
</div>
<div class = "form-group">
<label for = "attributes price">Minimum Amount</label>
<input type = "text" class = "form-control" id = "postcode_minimum_amt_edit" name = "postcode_minimum_amt_edit" placeholder = "For example: 12.00" value = "' . $row['postcode_min_amt'] . '" required>
</div>
<div class = "form-group">
<label for = "attributes price">Delivery Charges</label>
<input type = "text" class = "form-control" id = "postcode_deliv_chrg_edit" name = "postcode_deliv_chrg_edit" placeholder = "For example: 2.00" value = "' . $row['postcode_deli_chrg'] . '" required>
</div>
<div class = "form-group">
<label for = "attributes description">Free From</label>
<input type = "text" class = "form-control" id = "postcode_free_from_edit" name = "postcode_free_from_edit" placeholder = "For example: 22.00" value = "' . $row['postcode_free_from'] . '" required>
</div>

';
    }

    if ($postcode_action == "edit_postcode") {

        $postcode_id = $_POST['postcode_id'];
        $postcode_name_edit = $_POST['postcode_name_edit'];
        $postcode_neighborhood_name_edit = $_POST['postcode_neighborhood_name_edit'];
        $postcode_minimum_amt_edit = $_POST['postcode_minimum_amt_edit'];
        $postcode_deliv_chrg_edit = $_POST['postcode_deliv_chrg_edit'];
        $postcode_free_from_edit = $_POST['postcode_free_from_edit'];


        $edit_query_updte_postcode = "UPDATE `postcode` SET `postcode`='" . $postcode_name_edit . "', `postcode_nbh`='" . $postcode_neighborhood_name_edit . "',`postcode_min_amt`='" . $postcode_minimum_amt_edit . "',`postcode_deli_chrg`='" . $postcode_deliv_chrg_edit . "',`postcode_free_from`='" . $postcode_free_from_edit . "'  WHERE `postcode_id`='" . $postcode_id . "'";

        $dupesql = "SELECT * FROM `postcode` where `postcode` = '" . $postcode_name_edit . "'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['postcode_id'] != $postcode_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $postcode_name_edit . ' already exists.</div></div></div>';
        } else {
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);

            if ($edit_postcode_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode not updated. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($postcode_action == "add_postcode") {
        $postcode = $mysqli->escape_string($_POST['postcode_name_new']);
        $postcode_nbh = $mysqli->escape_string($_POST['postcode_neighborhood_name_new']);
        $postcode_min_amt = $mysqli->escape_string($_POST['postcode_minimum_amt_new']);
        $postcode_deli_chrg = $mysqli->escape_string($_POST['postcode_deliv_chrg_new']);
        $postcode_free_from = $mysqli->escape_string($_POST['postcode_free_from_new']);

        $add_attrrib_query = "INSERT INTO `postcode`(`postcode`, `postcode_nbh`, `postcode_min_amt`,`postcode_deli_chrg`,`postcode_free_from`) VALUES ('" . $postcode . "','" . $postcode_nbh . "','" . $postcode_min_amt . "','" . $postcode_deli_chrg . "','" . $postcode_free_from . "')";

        $dupesql = "SELECT `postcode` FROM `postcode` where `postcode` = '$postcode'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['postcode'] == $postcode || $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $postcode . ' already exists.</div></div></div>';
        } else {
            $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
            if ($add_attrrib_query_result) {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode not added. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($postcode_action == "change_postcode_status_get") {
        $postcode_id = $_POST['postcode_id'];

        $query = "select `postcode_status` from `postcode` where `postcode_id`=" . $postcode_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['postcode_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['postcode_status'] == 'Inactive') {
            $inactive = 'selected="selected"';
        }
        $return_string = ' 
                                        <div class="col-sm-12">
                                            <fieldset>
                                               <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="Select Status">Select Status</label>
                                                        <select name="currentstatus" id="currentstatus" class="form-control select2" style="width: 100%;">
                                                            <option value="Active" ' . $active . ' >Active</option>
                                                            <option value="Inactive" ' . $inactive . ' >Inactive</option>
                                                        </select>
                                                        
<input id="postcode_id" type="hidden" value="' . $postcode_id . '"/>
                                                    </div>
                                                     
                                                </div></fieldset></div>';

        echo $return_string;
    }

    if ($postcode_action == "postcode_status_set") {
        $status = $_POST['selected_value'];
        $postcode_id = $_POST['postcode_id'];

        $update_query = "UPDATE `postcode` SET `postcode_status`='" . $status . "' WHERE `postcode_id`='" . $postcode_id . "'";
        $notification_message = '';
        $result = $mysqli->query($update_query);
        if ($result) {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode status updated successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode status not updated. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($postcode_action == "delete") {
        $postcode_id = $_POST['postcode_id'];
        $result = $mysqli->query("DELETE  FROM `postcode` WHERE `postcode_id`='" . $postcode_id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
