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
 $query12 = "SELECT * FROM `postcode_delivery` WHERE `postcode_id`='" . $postcode_id . "'";
        $result12 = $mysqli->query($query12);
		$newdeldata='';
        while($row12 = $result12->fetch_assoc()){
			$newdeldata .= '
			<div id="delpostcode' . $row12['id'] . '"><input type="hidden" name="delpostid[]" id="delpostid[]" value="'.$row12['id'].'">
			
            <div class="col-md-4">
                                            <label for="attributes price">Delivery Charges</label>
                                            <input type="text" class="form-control" id="postcode_deliv_chrg_new_edit[]" name="postcode_deliv_chrg_new_edit[]" value="'.$row12['postcode_deli_chrg'].'" placeholder="example: 2.00" required>
                                     <a id="del_delrec" dataid="' . $row12['id'] . '"><i class="fa fa-trash-o" style="font-size:20px;color:red"></i></a></div>
                                        </div>';
		}
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
<label for = "attributes price">Free From</label>
<input type = "text" class = "form-control" id = "postcode_free_from_new_edit" name = "postcode_free_from_new_edit" placeholder = "For example: 12.00" value = "' . $row['postcode_free_from'] . '" required>
</div>
<div class="form-group">
       <label for="attributes price">Delivery Charges</label>
<input type="text" class="form-control" id="postcode_deliv_chrg_new2" name="postcode_deliv_chrg_new2" value="' . $row['postcode_deli_chrg'] . '" required="">
                                        </div>
<div class="field_editwrapper">
            '.$newdeldata.'
        
   <!--<a href="javascript:void(0);" class="editadd_button" title="Add field"  style="display:none;"><img src="add-icon.png" style="width: 5%;" /></a>-->
</div>

';
    }

    if ($postcode_action == "edit_postcode") {

        $postcode_id = $_POST['postcode_id'];
        $postcode_name_edit = $_POST['postcode_name_edit'];
        $postcode_neighborhood_name_edit = $_POST['postcode_neighborhood_name_edit'];
        $postcode_minimum_amt_edit = $_POST['postcode_minimum_amt_edit'];
      $postcode_free_from_new_edit = $_POST['postcode_free_from_new_edit'];
		
		 ///$postcode_deliv_chrg_new = $_POST['postcode_deliv_chrg_new'];
		$postcode_deliv_chrg_new = str_replace(',', '.', $_POST['postcode_deliv_chrg_new']);
   //postcode_deliv_chrg_new_edit
		
       $edit_query_updte_postcode = "UPDATE `postcode` SET `postcode`='" . $postcode_name_edit . "', `postcode_nbh`='" . $postcode_neighborhood_name_edit . "',`postcode_min_amt`='" . $postcode_minimum_amt_edit . "',`postcode_free_from`='" . $postcode_free_from_new_edit . "' ,`postcode_deli_chrg`='" . $postcode_deliv_chrg_new . "' WHERE `postcode_id`='" . $postcode_id . "'";

        $dupesql = "SELECT * FROM `postcode` where `postcode` = '" . $postcode_name_edit . "'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['postcode_id'] != $postcode_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $postcode_name_edit . ' already exists.</div></div></div>';
        } else {
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);

         
			if ($edit_postcode_result) {
		/*
		 for($count = 0; $count<count($_POST['delpostid']); $count++)
		 {
			if($_POST['delpostid'][$count]=='new'){
				 $dupesql = "SELECT * FROM `postcode_delivery` where `postcode_id` = '" . $postcode_id . "'";
				  $duperaw = $mysqli->query($dupesql);  
				$cat_count = $duperaw->num_rows; 
				 if($cat_count>0){
					 	$postcodeadd = $mysqli->query("UPDATE `postcode_delivery` SET `postcode_id`='".$postcode_id."',`min_amt`='" . $_POST['min_amt_edit'][$count] . "', `max_amt`='" . $_POST['max_amt_edit'][$count] . "', `postcode_deli_chrg`='" . $_POST['postcode_deliv_chrg_new_edit'][$count] . "' where `id` = '".$_POST['delpostid'][$count]."' ");
				 }
				else{
    		$postcodeedit = $mysqli->query("INSERT INTO `postcode_delivery`(`postcode_id`,`min_amt`, `max_amt`, `postcode_deli_chrg`) VALUES ('".$postcode_id."','" . $_POST['min_amt_edit'][$count] . "','" . $_POST['max_amt_edit'][$count] . "','" . $_POST['postcode_deliv_chrg_new_edit'][$count] . "')");
				}
			///echo 'ok';
			} else { 
				
			$postcodeadd = $mysqli->query("UPDATE `postcode_delivery` SET `postcode_id`='".$postcode_id."',`min_amt`='" . $_POST['min_amt_edit'][$count] . "', `max_amt`='" . $_POST['max_amt_edit'][$count] . "', `postcode_deli_chrg`='" . $_POST['postcode_deliv_chrg_new_edit'][$count] . "' where `id` = '".$_POST['delpostid'][$count]."' ");
			///echo $_POST['delpostid'];
			}*/
				
				
				
			 
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
        $postcode_min_amt = $_POST['postcode_minimum_amt_new'];
        $postcode_free_from_new = $_POST['postcode_free_from_new'];
		 /// $postcode_deliv_chrg_new = $_POST['postcode_deliv_chrg_new'];

		$postcode_deliv_chrg_new = str_replace(',', '.', $_POST['postcode_deliv_chrg_new']);
		
		
        $add_attrrib_query = "INSERT INTO `postcode`(`postcode`, `postcode_nbh`, `postcode_min_amt`,`postcode_free_from`,`postcode_deli_chrg`) VALUES ('" . $postcode . "','" . $postcode_nbh . "','" . $postcode_min_amt . "','".$postcode_free_from_new."','".$postcode_deliv_chrg_new."')";

		 ///$add_attrrib_query_result = $mysqli->query($add_attrrib_query);
        $dupesql = "SELECT `postcode` FROM `postcode` where `postcode` = '$postcode'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['postcode'] == $postcode || $duperaw->num_rows > 0) {			
  			$notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $postcode . ' already exists.</div></div></div>';
       }
		else{
			 $add_attrrib_query_result = $mysqli->query($add_attrrib_query);
			$notification_message = '<div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode added successfully.</div></div></div>';
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
	    if ($postcode_action == "deletedelcharge") {
        $postcodedel_id = $_POST['postcodedel_id'];
        $result = $mysqli->query("DELETE  FROM `postcode_delivery` WHERE `id`='" . $postcodedel_id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Postcode deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Postcode not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
?>
<script type="text/javascript">
$(document).ready(function(){
    var maxEditField = 10; //Input fields increment limitation
    var addEditButton = $('.editadd_button'); //Add button selector
    var wrapperEdit = $('.field_editwrapper'); //Input field wrapper
    var fieldEditHTML = '<div> <input type="hidden" name="delpostid[]" id="delpostid[]" value="new"> <div class="col-md-4"><label for="attributes price">Delivery Charges</label><input type="text" class="form-control" id="postcode_deliv_chrg_new_edit[]" name="postcode_deliv_chrg_new_edit[]" placeholder="example: 2.00" required> </div> <a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png" style="width: 5%;"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addEditButton).click(function(){
        //Check maximum number of input fields
        if(x < maxEditField){ 
            x++; //Increment field counter
            $(wrapperEdit).append(fieldEditHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapperEdit).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

 
	</script>