<?php

include 'db.php';
include 'config.php';
if (isset($_POST['cat_action'])) {
    $cat_action = $_POST['cat_action'];

    if ($cat_action == "add") {
        $supcat_name_new_ln1 = $mysqli->escape_string($_POST['supcat_name_new_ln1']);
        $supcat_name_new_ln2 = $mysqli->escape_string($_POST['supcat_name_new_ln2']);
        $supcat_description_add_ln1 = $mysqli->escape_string($_POST['supcat_description_add_ln1']);
        $supcat_description_add_ln2 = $mysqli->escape_string($_POST['supcat_description_add_ln2']);

        $add_attrrib_query = "INSERT INTO `supercategories`(`supcat_name_en`,`supcat_name_nl`, `supcat_desc_en`, `supcat_desc_nl`) VALUES ('" . $supcat_name_new_ln1 . "','" . $supcat_name_new_ln2 . "','" . $supcat_description_add_ln1 . "','" . $supcat_description_add_ln2 . "')";
		
        //echo $add_attrrib_query;die();
        $dupesql = "SELECT * FROM `supercategories` where `supcat_name_en` = '$supcat_name_new_ln1'";
        $duperaw = $mysqli->query($dupesql);
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['supcat_name_en'] == $supcat_name_new_ln1 || $duperaw->num_rows > 0) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $supcat_name_new_ln1 . ' already exists.</div></div></div><!-- //.Note section -->';
        } else {
            $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
            if ($add_attrrib_query_result) {
                $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Category added successfully.</div></div></div><!-- //.Note section -->';
            } else {
                $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Category not added. Please try again little later.</div></div></div><!-- //.Note section -->';
            }
        }
        echo $notification_message;
    }

    if ($cat_action == "load") {
        $list_attrib_query = "Select * From `supercategories`";
        $result_list_attrib_query = $mysqli->query($list_attrib_query);
        $list_categories = '<tbody><tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                               <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>';

        if ($result_list_attrib_query->num_rows == 0) {
            $list_categories .= '<tr>
                                    <td colspan=3><center>No record found.</center></td>
                                  </tr>';
        } else {
            include 'function.php';
            while ($row = $result_list_attrib_query->fetch_assoc()) {
                $list_categories .= '<tr>
                                    <td>' . $row['supcat_name_en'] . '</td>
                                    <td>' . short_desc($row['supcat_desc_en'], 50) . '</td>
                                    <!-- <td>' . $row['supcat_status'] . '</td> -->
                                    <td>
                                        <a class="btn btn-social-icon btn-info" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['supcat_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['supcat_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <!-- <a class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-stateChange" id="change_record" dataid="' . $row['supcat_id'] . '"><i class="fa fa-toggle-on"></i></a> -->  
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['supcat_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
            $list_categories .= '</tbody>';
        }
        echo $list_categories;
    }

    if ($cat_action == "view") {
        $cat_view_query = "Select * From `supercategories` where `supcat_id`='" . $_POST['supcat_id'] . "'";
        $result_cat_view_query = $mysqli->query($cat_view_query);
        $row = $result_cat_view_query->fetch_assoc();
        $cat_view_res = '';
        $cat_view_res = '<input type="hidden" id="categories_id" value="' . $row['supcat_id'] . '">
                    <div class="form-group">                    
                                            <label for="category name">Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="supcat_name_new_ln1" name="subcategory_name_edit_ln1" placeholder="Super Category name in ' . lang1 . '" required value="' . $row['supcat_name_en'] . '">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_new_ln2" name="subcategory_name_edit_ln2" placeholder="Super Category name in ' . lang2 . '" required value="' . $row['supcat_name_nl'] . '">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Category Description</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="supcat_description_edit_ln1" name="subcategory_description_edit_ln1"  placeholder="Super Category description in  ' . lang1 . '" >' . $row['supcat_desc_en'] . '</textarea>
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="supcat_description_edit_ln2" name="supcategory_description_edit_ln2"  placeholder="Super Category description in  ' . lang2 . '" >' . $row['supcat_desc_nl'] . '</textarea>
                                               </div>
                                           </div>
                                        </div>';
        echo $cat_view_res;
    }

    if ($cat_action == "edit_load_record") {
        $cat_view_query = "Select * From `supercategories` where `supcat_id`='" . $_POST['supcat_id'] . "'";
        $result_cat_view_query = $mysqli->query($cat_view_query);
        $row = $result_cat_view_query->fetch_assoc();
        $load_edit_res = '';
        $load_edit_res = '<input type="hidden" id="categories_id" value="' . $row['supcat_id'] . '">
                    <div class="form-group">                    
                                            <label for="category name">Super Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="supcat_name_edit_ln1" name="supcat_name_edit_ln1" placeholder="Super Category name in ' . lang1 . '" required value="' . $row['supcat_name_en'] . '">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="supcat_name_edit_ln2" name="supcat_name_edit_ln2" placeholder="Super Category name in ' . lang2 . '" required value="' . $row['supcat_name_nl'] . '">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Super Category Description</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="supcat_description_edit_ln1" name="supcat_description_edit_ln1"  placeholder="Super Category description in  ' . lang1 . '" >' . $row['supcat_desc_en'] . '</textarea>
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="supcat_description_edit_ln2" name="supcat_description_edit_ln2"  placeholder="Super Category description in  ' . lang2 . '" >' . $row['supcat_desc_nl'] . '</textarea>
                                               </div>
                                           </div>
                                        </div>';
        echo $load_edit_res;
    }

    if ($cat_action == "edit") {
        $supcat_id = $_POST['supcat_id'];
        $supcat_name_edit_ln1 = $mysqli->escape_string($_POST['supcat_name_edit_ln1']);
        $supcat_name_edit_ln2 = $mysqli->escape_string($_POST['supcat_name_edit_ln2']);
        $supcat_description_edit_ln1 = $mysqli->escape_string($_POST['supcat_description_edit_ln1']);
        $supcat_description_edit_ln2 = $mysqli->escape_string($_POST['supcat_description_edit_ln2']);

        $edit_cat_query = "UPDATE `supercategories` SET `supcat_name_en`='" . $supcat_name_edit_ln1 . "',`supcat_name_nl`='" . $supcat_name_edit_ln2 . "', `supcat_desc_en`='" . $supcat_description_edit_ln1 . "',`supcat_desc_nl`='" . $supcat_description_edit_ln2 . "' WHERE `supcat_id`='" . $supcat_id . "'";

        // echo $edit_cat_query;die();

        $dupesql = "SELECT * FROM `supercategories` where `supcat_name_en` = '$supcat_name_edit_ln1'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['cat_id'] != $cat_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $supcat_name_edit_ln1 . ' already exists.</div></div></div>';
        } else {
            $edit_cat_query_result = $mysqli->query($edit_cat_query);


            if ($edit_cat_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Category updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Category not updated. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($cat_action == 'get_status_cat') {
        $supcat_id = $_POST['supcat_id'];
        $query = "select `supcat_status` from `supercategories` where supcat_id=" . $supcat_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['supcat_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['supcat_status'] == 'Inactive') {
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
                                                        
<input id="mso" type="hidden" value="' . $cat_id . '"/>
                                                    </div>
                                                     
                                                </div></fieldset></div>';
        echo $return_string;
    }

    if ($cat_action == 'change_status') {
        $cat_id = $_POST['cat_id'];
        $status = $_POST['selected_value'];
        $change_status_query = "UPDATE `supercategories` SET `supcat_status`='" . $status . "' WHERE `supcat_id`='" . $cat_id . "'";

        $change_status_result = $mysqli->query($change_status_query);
        $notification_message = '';
        if ($change_status_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Category status updated successfully.</div></div></div>';
        } else {
            $edit_attrrib_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($cat_action == 'delete') {
        $supcat_id = $_POST['supcat_id'];
        $notification_message = '';
        $query = "DELETE  FROM `supercategories` WHERE `supcat_id`='" . $supcat_id . "'";

        if ($mysqli->query($query)) {
            
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Category deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Category not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}