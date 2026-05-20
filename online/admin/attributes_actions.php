<?php

include 'db.php';
include 'config.php';

function addZeroes($num) {
$value = $num;
    
//    if (strpos($value, '.') !== false) 
//        return number_format((float)$num, 2, ',', '');
    if (strpos($value, '.') !== false) 
        return number_format((float)$num, 2, '.', '');
    
    if (strpos($value, ',') !== false) {
        $value=str_replace(",",".",$value);
//         return number_format((float)$value, 2, ',', '');
         return number_format((float)$value, 2, '.', '');
    }
    if (strpos($value, '.') == false) 
//        return number_format((float)$num, 2, ',', '');
        return number_format((float)$num, 2, '.', '');
    
    if (strpos($value, ',') == false) 
        return number_format((float)$value, 2, '.', '');
    
}

if (isset($_POST['attrib_action'])) {
    $attrib_action = $_POST['attrib_action'];

    if ($attrib_action == "view") {

        $result = $mysqli->query("SELECT * FROM `attribute` WHERE `attrib_id`='" . $_POST['attrib_id'] . "'");
        $row = $result->fetch_assoc();
        echo '<input type="hidden" id="attrib_id" value="' . $_POST['attrib_id'] . '">
<div class="form-group">
    <label for="attributes name">Attributes Name</label>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        <input type="text" class="form-control" placeholder="Attribute name in '.lang1.'" id="variablename_edit_en" value="' . $row['attrib_name_en'] . '" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <input type="text" class="form-control" placeholder="Attribute name in '.lang2.'" id="variablename_edit_nl" value="' . $row['attrib_name_nl'] . '" required>
    </div>
</div>
<div class="form-group">
    <label for="attributes price">Price</label>
    <input type="text" class="form-control" id="attributes_price_edit" placeholder="Price" value="' . $row['attrib_price'] . '" required>
</div>
<div class="form-group">
    <label for="variable description">Variable Description</label>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        <textarea class="form-control" rows="3" placeholder="Description in '.lang1.'"  id="variable_description_edit_en">' . $row['attrib_desc_en'] . '</textarea>
        </div>
        <div class="col-md-6 col-sm-12">
        <textarea class="form-control" rows="3" placeholder="Description in '.lang2.'"  id="variable_description_edit_nl">' . $row['attrib_desc_nl'] . '</textarea>
        </div>
        </div>
</div>';
    }

    if ($attrib_action == "load") {
        $list_attrib_query = "Select * From `attribute`";
        $result_list_attrib_query = $mysqli->query($list_attrib_query);
        $list_attrib = '<tbody><tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_attrib_query->num_rows == 0) {
            $list_attrib.= '<tr><td colspan=4><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
            while ($row = $result_list_attrib_query->fetch_assoc()) {
                $list_attrib .= '<tr>
                                    <td>' . $row['attrib_name_en'] . '</td>
                                    <td>' . $row['attrib_price'] . '</td>
                                    <td>' . short_desc($row['attrib_desc_en'], 50) . '</td>
                                    <!-- <td>' . $row['attrib_status'] . '</td> -->
                                    <td>
                                        <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['attrib_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['attrib_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <!-- <a class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-change_status" id="change_status" dataid="' . $row['attrib_id'] . '"><i class="fa fa-toggle-on"></i></a> -->
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['attrib_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        echo $list_attrib . "</tbody>";
    }

    if ($attrib_action == "add") {

        $attributes_name_new_en = $mysqli->escape_string($_POST['attributes_name_new_en']);
        $attributes_name_new_nl = $mysqli->escape_string($_POST['attributes_name_new_nl']);
        $attributes_price_new = addZeroes($mysqli->escape_string($_POST['attributes_price_new']));
        $attributes_description_add_en = $mysqli->escape_string($_POST['attributes_description_add_en']);
        $attributes_description_add_nl = $mysqli->escape_string($_POST['attributes_description_add_nl']);

        $add_attrrib_query = "INSERT INTO `attribute`(`attrib_name_en`,`attrib_name_nl`,`attrib_price`,`attrib_desc_en`,`attrib_desc_nl`) VALUES ('" . $attributes_name_new_en . "','" . $attributes_name_new_nl . "','" . $attributes_price_new . "','" . $attributes_description_add_en . "','" . $attributes_description_add_nl . "')";      //    echo $add_attrrib_query;die();
        $dupesql = "SELECT * FROM `attribute` where `attrib_name_en` = '$attributes_name_new_en'";
        $duperaw = $mysqli->query($dupesql);       //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['attrib_name_en'] == $attributes_name_new_en || $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $attributes_name_new_en . ' already exists.</div></div></div>';
        } else {
            $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
            if ($add_attrrib_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Attribut added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Attribut not added. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($attrib_action == "edit_load_record") {

        $result = $mysqli->query("SELECT * FROM `attribute` WHERE `attrib_id`='" . $_POST['attrib_id'] . "'");
        $row = $result->fetch_assoc();
        echo '<input type="hidden" id="attrib_id" value="' . $_POST['attrib_id'] . '">
<div class="form-group">
    <label for="attributes name">Attributes Name</label>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        <input type="text" class="form-control" id="attributes_name_edit_en" value="' . $row['attrib_name_en'] . '" required placeholder="Attribute name in '.lang1.'">
    </div>
    <div class="col-md-6 col-sm-12">
        <input type="text" class="form-control" id="attributes_name_edit_nl" value="' . $row['attrib_name_nl'] . '" required placeholder="Attribute name in '.lang2.'">
    </div>
</div>
<div class="form-group">
    <label for="attributes price">Price</label>
    <input type="text" class="form-control" id="attributes_price_edit" value="' . $row['attrib_price'] . '" required placeholder="Price">
</div>
<div class="form-group">
    <label for="variable description">Attribute Description</label>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        <textarea class="form-control" rows="3" placeholder="Attribute description in '.lang1.'" id="attributes_description_edit_en">' . $row['attrib_desc_en'] . '</textarea>
        </div>
        <div class="col-md-6 col-sm-12">
        <textarea class="form-control" rows="3" placeholder="Attribute description in '.lang2.'" id="attributes_description_edit_nl">' . $row['attrib_desc_nl'] . '</textarea>
        </div>
        </div>
</div>';
    }

    if ($attrib_action == "edit") {
        $attrib_id = $_POST['attrib_id'];
        $attrib_name_en = $_POST['attributes_name_edit_en'];
        $attrib_name_nl = $_POST['attributes_name_edit_nl'];
        $attributes_price_edit = $_POST['attributes_price_edit'];
        $variable_description_edit_en = $_POST['attributes_description_edit_en'];
        $variable_description_edit_nl = $_POST['attributes_description_edit_nl'];

        $edit_attrrib_query = "UPDATE `attribute` SET `attrib_name_en`='" . $attrib_name_en . "',`attrib_name_nl`='" . $attrib_name_nl . "', `attrib_price`='" . addZeroes($attributes_price_edit) . "',`attrib_desc_en`='" . $variable_description_edit_en . "',`attrib_desc_nl`='" . $variable_description_edit_nl . "'  WHERE `attrib_id`='" . $attrib_id . "'";

        $dupesql = "SELECT * FROM `attribute` where `attrib_name_en` = '$attrib_name_en'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        if ($duperaw_row['attrib_id'] != $attrib_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $attrib_name_en . ' already exists.</div></div></div>';
        } else {
            $edit_attrrib_query_result = $mysqli->query($edit_attrrib_query);

            $notification_message = '';
            if ($edit_attrrib_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Attribut updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Attribut not updated. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($attrib_action == 'get_status') {
        $attrib_id = $_POST['attrib_id'];
        $query = "select `attrib_status` from `attribute` where attrib_id=" . $attrib_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['attrib_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['attrib_status'] == 'Inactive') {
            $inactive = 'selected="selected"';
        }
        $return_string = '<div class="col-sm-12">
                <fieldset>
                <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                <label for="Select Status">Select Status</label>
                <select name="currentstatus" id="currentstatus" class="form-control select2" style="width: 100%;">
                                                            <option value="Active" ' . $active . ' >Active</option>
                                                            <option value="Inactive" ' . $inactive . ' >Inactive</option>
                                                        </select>
                                                        
<input id="mso" type="hidden" value="' . $attrib_id . '"/>
                                                    </div>
                                                     
                                                </div></fieldset></div>';
        echo $return_string;
    }

    if ($attrib_action == 'change_status') {
        $attrib_id = $_POST['attrib_id'];
        $status = $_POST['selected_value'];
        $change_status_query = "UPDATE `attribute` SET `attrib_status`='" . $status . "' WHERE `attrib_id`='" . $attrib_id . "'";

        $change_status_result = $mysqli->query($change_status_query);
        $notification_message = '';
        if ($change_status_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Attribut status updated successfully.</div></div></div>';
        } else {
            $edit_attrrib_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($attrib_action == 'delete') {
        $attrib_id = $_POST['attrib_id'];
        $notification_message = '';
        $query = "DELETE  FROM `attribute` WHERE `attrib_id`='" . $attrib_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Attribut deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Attribut not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
?>

