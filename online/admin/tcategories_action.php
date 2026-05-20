<?php

include 'db.php';
include 'config.php';
if (isset($_POST['cat_action'])) {
    $cat_action = $_POST['cat_action'];

    if ($cat_action == "add") {
        $cat_name_new_ln1 = $mysqli->escape_string($_POST['cat_name_new_ln1']);
        $cat_name_new_ln2 = $mysqli->escape_string($_POST['cat_name_new_ln2']);
        $cat_description_add_ln1 = $mysqli->escape_string($_POST['cat_description_add_ln1']);
        $cat_description_add_ln2 = $mysqli->escape_string($_POST['cat_description_add_ln2']);
        $supcat_name_new_ln2 = $mysqli->escape_string($_POST['supcat_name_new_ln2']);
		
        $add_attrrib_query = "INSERT INTO `tcategories`(`sub_cat_id`,`cat_name_en`,`cat_name_nl`, `cat_desc_en`, `cat_desc_nl`) VALUES ('".$supcat_name_new_ln2."','" . $cat_name_new_ln1 . "','" . $cat_name_new_ln2 . "','" . $cat_description_add_ln1 . "','" . $cat_description_add_ln2 . "')";
        //echo $add_attrrib_query;die();
        $dupesql = "SELECT * FROM `tcategories` where `cat_name_en` = '$cat_name_new_ln1'";
        $duperaw = $mysqli->query($dupesql);
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['cat_name_en'] == $cat_name_new_ln1 || $duperaw->num_rows > 0) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $cat_name_new_ln1 . ' already exists.</div></div></div><!-- //.Note section -->';
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
        $list_attrib_query = "Select * From `tcategories`";
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
                                    <td>' . $row['cat_name_en'] . '</td>
                                    <td>' . short_desc($row['cat_desc_en'], 50) . '</td>
                                    <!-- <td>' . $row['cat_status'] . '</td> -->
                                    <td>
                                        <a class="btn btn-social-icon btn-info" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['cat_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['cat_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <!-- <a class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-stateChange" id="change_record" dataid="' . $row['cat_id'] . '"><i class="fa fa-toggle-on"></i></a> -->  
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['cat_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
            $list_categories .= '</tbody>';
        }
        echo $list_categories;
    }

    if ($cat_action == "view") {
        $cat_view_query = "Select * From `tcategories` where `cat_id`='" . $_POST['cat_id'] . "'";
        $result_cat_view_query = $mysqli->query($cat_view_query);
        $row = $result_cat_view_query->fetch_assoc();
		$dupesql22 = "SELECT * FROM `tsupercategories` where supcat_id = '". $row['sub_cat_id'] ."' ";
        $duperaw22 = $mysqli->query($dupesql22);
        $duperaw_row22 = $duperaw22->fetch_assoc(); 
		
        $cat_view_res = '';
        $cat_view_res = '<input type="hidden" id="categories_id" value="' . $row['cat_id'] . '">
		  <div class="form-group">                    
                                            <label for="category name">Super Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-12 col-sm-12">
                                                <input type="text" class="form-control" id="supcat_name_new_ln1" name="supcategory_name_edit_ln1" placeholder="Super Category name " required value="' . $duperaw_row22['supcat_name_en'] . '">
                                            </div>
                                           
                                        </div>
                                        </div>
                    <div class="form-group">                    
                                            <label for="category name">Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_new_ln1" name="category_name_edit_ln1" placeholder="Category name in ' . lang1 . '" required value="' . $row['cat_name_en'] . '">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_new_ln2" name="category_name_edit_ln2" placeholder="Category name in ' . lang2 . '" required value="' . $row['cat_name_nl'] . '">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Category Description</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_edit_ln1" name="category_description_edit_ln1"  placeholder="Category description in  ' . lang1 . '" >' . $row['cat_desc_en'] . '</textarea>
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_edit_ln2" name="category_description_edit_ln2"  placeholder="Category description in  ' . lang2 . '" >' . $row['cat_desc_nl'] . '</textarea>
                                               </div>
                                           </div>
                                        </div>';
        echo $cat_view_res;
    }

    if ($cat_action == "edit_load_record") {
        $cat_view_query = "Select * From `tcategories` where `cat_id`='" . $_POST['cat_id'] . "'";
        $result_cat_view_query = $mysqli->query($cat_view_query);
        $row = $result_cat_view_query->fetch_assoc();
			$dupesql2 = "SELECT * FROM `tsupercategories`";
        $duperaw2 = $mysqli->query($dupesql2);
        while($duperaw_row2 = $duperaw2->fetch_assoc()){ 
			if($duperaw_row2['supcat_id']==$row['sub_cat_id']){
				$selected = "selected"; 
			} else { 
				$selected = ""; 
			}
				$option .= '<option '.$selected.' value="'.$duperaw_row2['supcat_id'].'">'.$duperaw_row2['supcat_name_en'].'</option>';
		}
        $load_edit_res = '';
        $load_edit_res = '<input type="hidden" id="categories_id" value="' . $row['cat_id'] . '">
		<div class="form-group">
                                            <label for="category name">Super Category Name</label>
                                           <div class="row"> 
                                              
                                            <div class="col-md-12 col-sm-12">
                                                <select class="form-control" id="supcat_name_edit_ln2" name="supcat_name_edit_ln2"   >
													<option>Select One</option> 
													'.$option.'
                                             </select></div>
                                        </div>
                                        </div>
                    <div class="form-group">                    
                                            <label for="category name">Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_edit_ln1" name="cat_name_edit_ln1" placeholder="Category name in ' . lang1 . '" required value="' . $row['cat_name_en'] . '">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_edit_ln2" name="cat_name_edit_ln2" placeholder="Category name in ' . lang2 . '" required value="' . $row['cat_name_nl'] . '">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Category Description</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_edit_ln1" name="cat_description_edit_ln1"  placeholder="Category description in  ' . lang1 . '" >' . $row['cat_desc_en'] . '</textarea>
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_edit_ln2" name="cat_description_edit_ln2"  placeholder="Category description in  ' . lang2 . '" >' . $row['cat_desc_nl'] . '</textarea>
                                               </div>
                                           </div>
                                        </div>';
	 echo $load_edit_res;
    }

    if ($cat_action == "edit") {
        $cat_id = $_POST['cat_id'];
        $cat_name_edit_ln1 = $mysqli->escape_string($_POST['cat_name_edit_ln1']);
        $cat_name_edit_ln2 = $mysqli->escape_string($_POST['cat_name_edit_ln2']);
        $cat_description_edit_ln1 = $mysqli->escape_string($_POST['cat_description_edit_ln1']);
        $cat_description_edit_ln2 = $mysqli->escape_string($_POST['cat_description_edit_ln2']);
        $supcat_name_edit_ln2 = $mysqli->escape_string($_POST['supcat_name_edit_ln2']);
        $edit_cat_query = "UPDATE `tcategories` SET `cat_name_en`='" . $cat_name_edit_ln1 . "',`cat_name_nl`='" . $cat_name_edit_ln2 . "', `cat_desc_en`='" . $cat_description_edit_ln1 . "',`cat_desc_nl`='" . $cat_description_edit_ln2 . "',`sub_cat_id`='".$supcat_name_edit_ln2."'  WHERE `cat_id`='" . $cat_id . "'";

        // echo $edit_cat_query;die();

        $dupesql = "SELECT * FROM `tcategories` where `cat_name_en` = '$cat_name_edit_ln1'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['cat_id'] != $cat_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $cat_name_edit_ln1 . ' already exists.</div></div></div>';
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
        $cat_id = $_POST['cat_id'];
        $query = "select `cat_status` from `tcategories` where cat_id=" . $cat_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['cat_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['cat_status'] == 'Inactive') {
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
        $change_status_query = "UPDATE `tcategories` SET `cat_status`='" . $status . "' WHERE `cat_id`='" . $cat_id . "'";

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
        $cat_id = $_POST['cat_id'];
        $notification_message = '';
        $query = "DELETE  FROM `tcategories` WHERE `cat_id`='" . $cat_id . "'";

        $menu_order_query = "Select `cat_sort_order` from `tmenu_order` where `cat_sortorder_id`='1'";
        $result_menu_order_query = $mysqli->query($menu_order_query);
        $cat_sortorderlist = $result_menu_order_query->fetch_assoc();
        $newdortorder4cat_query='';
        if (strlen($cat_sortorderlist['cat_sort_order']) > 0) {
            $cat_sortorderlist1 = explode(",", $cat_sortorderlist['cat_sort_order']);
            $sizeofarray = count($cat_sortorderlist1);
            for ($counti = 0; $counti < $sizeofarray; $counti++) {
                if ($cat_sortorderlist1[$counti] == $cat_id) {
                    
                    foreach (array_keys($cat_sortorderlist1, $cat_id) as $key) {
                        unset($cat_sortorderlist1[$cat_id]);
                    }
                    $newdortorder4cat= implode(",", $cat_sortorderlist1);
                    $newdortorder4cat_query = "UPDATE `tmenu_order` SET `cat_sort_order`='".$newdortorder4cat."' WHERE `cat_sortorder_id`='1'";$mysqli->query($newdortorder4cat_query);
        
                }
            }
        }




        if ($mysqli->query($query)) {
            
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Category deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Category not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}