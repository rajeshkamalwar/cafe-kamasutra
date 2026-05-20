<?php
include 'db.php';
include 'config.php';

if (isset($_POST['pages_action'])) {

    $pages_action = $_POST['pages_action'];

    if ($pages_action == "load") {
        $list_postcode_query = "Select * From `pages`";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode = '<tbody><tr>
                                                <th>Pagename</th>
                                                <th>Heading in English</th>
                                                <th>Heading in Dutch </th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode.= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
           
            while ($row = $result_list_postcode_query->fetch_assoc()) {
				 $activ_class="";
                $list_postcode .= '<tr >
                                    <td>' . $row['pagename'] . '</td>
                                    <td>' . $row['heading'] . '</td>
                                    <td>' . $row['headling_nl'] . '</td>
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

    if ($pages_action == "get_data4edit") {
        $postcode_id = $_POST['postcode_id'];
        $query = "SELECT * FROM `pages` WHERE `id`='" . $postcode_id . "'";


        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();

        echo '<input type = "hidden" id = "id" value = "' . $_POST['postcode_id'] . '">
                                        <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Page Name in english </label>
                                            <input type="text" class="form-control" id="pagenamenew" name="pagenamenew" value="'.$row['pagename'].'" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Page Name in Dutch </label>
                                            <input type="text" class="form-control" id="pagename_mlnew" name="pagename_mlnew" value="'.$row['pagename_ml'].'" required >
                                        </div>
										</div>
                                       <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Heading in english </label>
                                            <input type="text" class="form-control" id="headingnew" name="headingnew" value="'.$row['heading'].'" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Heading in Dutch </label>
                                            <input type="text" class="form-control" id="headling_nlnew" name="headling_nlnew" value="'.$row['headling_nl'].'" required >
                                        </div>
										</div>
                                        <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Short Description in english </label>
                                            <input type="text" class="form-control" id="short_descriptionnew" name="short_descriptionnew" value="'.$row['short_description'].'" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Short Description in Dutch </label>
                                            <input type="text" class="form-control" id="short_nlnew" name="short_nlnew" value="'.$row['short_nl'].'" required >
                                        </div>
										</div>
                                        <div class="form-group">
										<div class="col-md-12 col-sm-12">
                                            <label for="postcode name">Long Description in english </label>
                                            <textarea class="form-control" id="long_descriptionnew" name="long_descriptionnew"  required >'.$row['long_description'].'</textarea>
                                        </div>
										<div class="col-md-12 col-sm-12">
                                            <label for="postcode name">Long Description in Dutch </label>
                                            <textarea class="form-control" id="long_nlnew" name="long_nlnew" required >'.$row['long_nl'].'</textarea>
                                        </div>
										</div>
                                        
';
    }

    if ($pages_action == "edit_postcode") {

        $id = $_POST['id'];
        $pagename = $mysqli->escape_string($_POST['pagename']);
        $pagename_ml = $mysqli->escape_string($_POST['pagename_ml']);
        $heading = $mysqli->escape_string($_POST['heading']);
        $headling_nl = $mysqli->escape_string($_POST['headling_nl']);
        $short_description = $mysqli->escape_string($_POST['short_description']);
        $short_nl = $mysqli->escape_string($_POST['short_nl']);
        $long_description = $mysqli->escape_string($_POST['long_description']);
        $long_nl = $mysqli->escape_string($_POST['long_nl']);


        $edit_query_updte_postcode = "UPDATE `pages` SET `pagename`='" . $pagename . "', `pagename_ml`='" . $pagename_ml . "',`heading`='" . $heading . "',`headling_nl`='" . $headling_nl . "',`short_description`='" . $short_description . "',`short_nl`='" . $short_nl . "',`long_description`='" . $long_description . "',`long_nl`='" . $long_nl . "'  WHERE `id`='" . $id . "'";

        
        $notification_message = '';
        
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);

            if ($edit_postcode_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Page updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Page not updated. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }

    if ($pages_action == "add_pages") {
        $pagename = $mysqli->escape_string($_POST['pagename']);
        $pagename_ml = $mysqli->escape_string($_POST['pagename_ml']);
        $heading = $mysqli->escape_string($_POST['heading']);
        $headling_nl = $mysqli->escape_string($_POST['headling_nl']);
        $short_description = $mysqli->escape_string($_POST['short_description']);
        $short_nl = $mysqli->escape_string($_POST['short_nl']);
        $long_description = $mysqli->escape_string($_POST['long_description']);
        $long_nl = $mysqli->escape_string($_POST['long_nl']);

        $add_attrrib_query = "INSERT INTO `pages`(`pagename`, `pagename_ml`, `heading`,`headling_nl`,`short_description`,`short_nl`,`long_description`,`long_nl`) VALUES ('" . $pagename . "','" . $pagename_ml . "','" . $heading . "','" . $headling_nl . "','" . $short_description . "','" . $short_nl . "','" . $long_description . "','" . $long_nl . "')";
       
        $notification_message = '';
        
            $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
            if ($add_attrrib_query_result) {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Page added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Page not added. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }

    if ($pages_action == "change_postcode_status_get") {
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

    if ($pages_action == "postcode_status_set") {
        $status = $_POST['selected_value'];
        $postcode_id = $_POST['postcode_id'];

        $update_query = "UPDATE `postcode` SET `postcode_status`='" . $status . "' WHERE `postcode_id`='" . $postcode_id . "'";
        $notification_message = '';
        $result = $mysqli->query($update_query);
        if ($result) {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">page status updated successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! page status not updated. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($pages_action == "delete") {
        $postcode_id = $_POST['postcode_id'];
        $result = $mysqli->query("DELETE  FROM `pages` WHERE `id`='" . $postcode_id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">page deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Page not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
