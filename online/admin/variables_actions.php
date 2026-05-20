<?php

include 'db.php';
include 'config.php';

if (isset($_POST['variables_action'])) {
    $variables_action = $_POST['variables_action'];

    if ($variables_action == "view") {

        $result = $mysqli->query("SELECT * FROM `variable` WHERE `variable_id`='" . $_POST['varib_id'] . "'");
        $row = $result->fetch_assoc();
        $cheked_list4attr=explode(",",$row['variable_attrb_list']);
        
        
                /* to get list of all attr start*/
                $avilable_attributes = "Select * from `attribute` where attrib_status='Active'";
                    $avilable_attributes_result = $mysqli->query($avilable_attributes);
                    $variable_attrb_list = '';
                    if ($avilable_attributes_result->num_rows > 0) 
                    {   while ($attrib = $avilable_attributes_result->fetch_assoc()) 
                        {   $checkedornot = '';
                            if (in_array($attrib['attrib_id'], $cheked_list4attr)) {
                                $checkedornot = 'checked';
                            }
                            $variable_attrb_list .= '<div class="col-md-4 col-sm-12">
                                        <div class = "checkbox">
                                         <label>
                                                <input type = "checkbox" id="' . $attrib['attrib_name_en'] . '-' . $attrib['attrib_id'] . '" name = "cat_list_chk" value = "' . $attrib['attrib_id'] . '"' . $checkedornot . '/>' . $attrib['attrib_name_en'] . '
                                         </label>
                                        </div>                    
                               </div>';
                        }
                    }
                    /* to get list of all attr End*/



        echo '<input type="hidden" id="varib_id" value="' . $_POST['varib_id'] . '">
<div class="form-group">
                                        <label for="variable name">Variable name</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_view_en" name="variable_name_view_en" value="'.$row['variable_name_en'].'" >
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_view_nl" name="variable_name_view_nl" value="'.$row['variable_name_nl'].'" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable name">Select Attributes</label>
                                        <div class="row">
                                            '.$variable_attrb_list.'
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable description">Variable description</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_view_en" name="variable_description_view_en" >'.$row['variable_description_en'].'</textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_view_nl" name="variable_description_view_nl" >'.$row['variable_description_nl'].'</textarea>
                                            </div>
                                        </div>
										
                                    </div>';
    }

    if ($variables_action == "load") {
        $list_varib_query = "Select * From `variable`";
        $result_varib_query = $mysqli->query($list_varib_query);
        $list_varib= '<tbody><tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                               <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>';
        if ($result_varib_query->num_rows == 0) {
            $list_varib.= '<tr><td colspan=3><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
            while ($row = $result_varib_query->fetch_assoc()) {
                $list_varib.= '<tr>
                                    <td>' . $row['variable_name_en'] . '</td>
                                    <td>' . short_desc($row['variable_description_en'], 50) . '</td>
                                  <!--  <td>' . $row['variable_status'] . '</td> -->
                                    <td>
                                        <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['variable_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['variable_id'] . '"><i class="fa fa-pencil"></i></a>  
                                       <!-- <a class="btn btn-social-icon btn-warning" data-toggle="modal" data-target="#modal-stateChange" id="change_record" dataid="' . $row['variable_id'] . '"><i class="fa fa-toggle-on"></i></a>  -->
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['variable_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        echo $list_varib . "</tbody>";
    }

    if ($variables_action == "add") {

        $variable_name_new_en = $mysqli->escape_string($_POST['variable_name_new_en']);
        $variable_name_new_nl = $mysqli->escape_string($_POST['variable_name_new_nl']);
        $variable_description_new_en = $mysqli->escape_string($_POST['variable_description_new_en']);
        $variable_description_new_nl = $mysqli->escape_string($_POST['variable_description_new_nl']);
        $variable_attrib_new = $mysqli->escape_string($_POST['variable_attrib_new']);
		
		 $variable_choose_opt = $_POST['choosemethod'];
		 $is_required = $_POST['is_required'];		
		 $dish_choose_type = $_POST['dishchoosetype'];
		
		
 
        $add_variable_query = "INSERT INTO `variable`(`variable_name_en`,`variable_name_nl`,`variable_description_en`,`variable_description_nl`,`variable_attrb_list`,`type`,`option_type`,`required`) VALUES ('" . $variable_name_new_en . "','" . $variable_name_new_nl . "','" . $variable_description_new_en . "','" . $variable_description_new_nl . "','" . $variable_attrib_new . "','" . $variable_choose_opt . "','". $dish_choose_type . "','" . $is_required . "')";      //    echo $add_attrrib_query;die();
		
        $dupesql = "SELECT * FROM `variable` where `variable_name_en` = '$variable_name_new_en'";
        $duperaw = $mysqli->query($dupesql);       //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['variable_name_en'] == $variable_name_new_en || $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $variable_name_new_en . ' already exists.</div></div></div>';
        } else {
            $add_variable_query_result = $mysqli->query($add_variable_query);
            if ($add_variable_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Variable added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Variable not added. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($variables_action == "edit_load_record") {
        $result = $mysqli->query("SELECT * FROM `variable` WHERE `variable_id`='" . $_POST['varib_id'] . "'");
        $row = $result->fetch_assoc();
        $cheked_list4attr=explode(",",$row['variable_attrb_list']);
		
         $dish_choose_type = $_POST['dishchoosetype'];
		
		 $variable_choose_opt = $_POST['choosemethod'];
		 $variable_choose_type = $_POST['choosetype'];
        
                /* to get list of all attr start*/
                $avilable_attributes = "Select * from `attribute` where attrib_status='Active'";
                    $avilable_attributes_result = $mysqli->query($avilable_attributes);
                    $variable_attrb_list_edit = '';
                    if ($avilable_attributes_result->num_rows > 0) 
                    {   while ($attrib = $avilable_attributes_result->fetch_assoc()) 
                        {   $checkedornot = '';
                            if (in_array($attrib['attrib_id'], $cheked_list4attr)) {
                                $checkedornot = 'checked';
                            }
                            $variable_attrb_list_edit .= '<form method="post"><div class="col-md-4 col-sm-12">
                                        <div class = "checkbox">
                                         <label>
                                                <input type = "checkbox" id="' . $attrib['attrib_name_en'] . '-' . $attrib['attrib_id'] . '" name = "cat_list_chk_edit" value = "' . $attrib['attrib_id'] . '"' . $checkedornot . '/>' . $attrib['attrib_name_en'] . '
                                         </label>
                                        </div>                    
                               </div>';
                        }
                    }
                    /* to get list of all attr End*/



        echo '<input type="hidden" id="varib_id" value="' . $_POST['varib_id'] . '">
<div class="form-group">
                          <label for="variable name">Variable name</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_edit_en" name="variable_name_edit_en" value="'.$row['variable_name_en'].'" >
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_edit_nl" name="variable_name_edit_nl" value="'.$row['variable_name_nl'].'" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable name">Select Attributes</label>
                                        <div class="row">
                                            '.$variable_attrb_list_edit.'
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable description">Variable description</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_edit_en" name="variable_description_edit_en" >'.$row['variable_description_en'].'</textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_edit_nl" name="variable_description_edit_nl" >'.$row['variable_description_nl'].'</textarea>
                                            </div>
                                        </div>
										<br>
											 <div class="form-group">
                                        <label for="variable description">Variable Type</label>
                                        <div class="row">
                                          <div class="col-md-4 col-sm-12">';                                                
										if($row['type']==1){
					 	echo  '<input type="checkbox"    id="choosemethod" name="choosemethod" value="1" checked="checked"  class="choosemethod"> Checkbox ';
							}
							else{
								 echo '<input type="checkbox"    id="choosemethod" name="choosemethod" value="1" class="choosemethod"> Checkbox';
							}
			 echo ' </div>
                                           <div class="col-md-4 col-sm-12">';
                            	if($row['type']==2){
			 	echo  '<input type="checkbox"    id="choosemethod" name="choosemethod" value="2" checked="checked" class="choosemethod"> Select Option';
				 
							}
							else{
								 echo '<input type="checkbox"    id="choosemethod" name="choosemethod" value="2" class="choosemethod"> Select Option';
								
							}
		 
	
		
			
											 
                                          echo '  </div>
										 <br>
										</div>
			<div class="form-group">
                                        <label for="variable description">Required</label>';							
				if($row['required']==1){									
				 echo  '<input type="checkbox"    id="is_required" name="is_required" value="1" checked="checked" class="is_required"> Required';
			 echo  ' <input type="checkbox"    id="is_required" name="is_required" value="0" class="is_required"> No-required ';
}
		else{
			 echo  ' <input type="checkbox"    id="is_required" name="is_required" value="0" checked="checked" class="is_required"> No-required ';
			 echo  ' <input type="checkbox"    id="is_required" name="is_required" value="1" class="is_required"> Required';
		}							
										
echo '  </div>
	 <!--<div class="form-group">
                                        <label for="variable description">Limit type</label>
                                        <div class="row">
                                          <div class="col-md-4 col-sm-12">
                                                <input type="checkbox"  class="choosetype1"  id="dishchoosetype" name="dishchoosetype" value="1" >Checkboxes Choose
                                            </div>
                                           <div class="col-md-4 col-sm-12">
                                                <input type="checkbox" class="choosetype1"  id="dishchoosetype" name="dishchoosetype" value="2" >
											  Select Box
                                            </div>
										  </div>-->
                                        	 <div class="form-group">
                                        <label for="variable description">Limit Type</label>
                                        <div class="row">
                                          <div class="col-md-3 col-sm-12">';
if($row['option_type']==1){
echo  '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="1"  checked="checked"  class="dishchoosetype"> Single';
}
else{
echo '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="1"  class="dishchoosetype"> Single';
}

                                               
                                            echo '</div>
                                           <div class="col-md-3 col-sm-12">';
                                       												
if($row['option_type']==2){
echo  '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="2"  checked="checked"  class="dishchoosetype"> Limit 2';
}
else{
echo '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="2"  class="dishchoosetype"> Limit 2';
}		
												
												
											    
                                           echo ' </div>
										 <div class="col-md-3 col-sm-12">';
if($row['option_type']==3){
echo  '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="3"  checked="checked"  class="dishchoosetype"> Limit 3';
}
else{
echo '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="3"  class="dishchoosetype"> Limit 3';
}	
		                                           echo ' </div>
										 <div class="col-md-3 col-sm-12">';
if($row['option_type']==4){
echo  '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="4"  checked="checked"  class="dishchoosetype"> Multiple Choice';
}
else{
echo '<input type="checkbox"    id="dishchoosetype" name="dishchoosetype" value="4"  class="dishchoosetype"> Multiple Choice';
}									
											   
                                            echo '</div>
										</div>
										

                                    </div></form>
                                    </div>';
    }

    if ($variables_action == "edit") {
        $varib_id = $_POST['varib_id'];
        $variable_name_edit_en = $_POST['variable_name_edit_en'];
        $variable_name_edit_nl = $_POST['variable_name_edit_nl'];
        $variable_description_edit_en = $_POST['variable_description_edit_en'];
        $variable_description_edit_nl = $_POST['variable_description_edit_nl'];
        $variable_attrib_edit = $_POST['variable_attrib_edit'];
		 $variable_choose_opt = $_POST['choosemethod'];
		 $variable_choose_type = $_POST['dishchoosetype'];		
    	$is_required = $_POST['is_required'];

        $edit_varib_query = "UPDATE `variable` SET `variable_name_en`='" . $variable_name_edit_en . "',`variable_name_nl`='" . $variable_name_edit_nl . "', `variable_description_en`='" . $variable_description_edit_en . "',`variable_description_nl`='" . $variable_description_edit_nl . "',`variable_attrb_list`='" . $variable_attrib_edit . "' , `type`='" . $variable_choose_opt . "' , `option_type`='" . $variable_choose_type . "', `required`='" . $is_required . "'    WHERE  `variable_id`='" . $varib_id . "'";

        $dupesql = "SELECT * FROM `variable` where `variable_name_en` = '$variable_name_edit_en'";
        $duperaw = $mysqli->query($dupesql);        //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        if ($duperaw_row['variable_id'] != $varib_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $variable_name_edit_en . ' already exists.</div></div></div>';
        } else {
            $edit_varib_query_result = $mysqli->query($edit_varib_query);

            $notification_message = '';
            if ($edit_varib_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Variable updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Variable not updated. Please try again little later.</div></div></div>';
            }
        }
     echo $notification_message;
		 
		
    }

    if ($variables_action == 'get_status') {
        
        $varib_id = $_POST['varib_id'];
        $query = "select `variable_status` from `variable` where variable_id=" . $varib_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['variable_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['variable_status'] == 'Inactive') {
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
                                                        
<input id="mso" type="hidden" value="' . $varib_id . '"/>
                                                    </div>
                                                     
                                                </div></fieldset></div>';
        echo $return_string;
    }

    if ($variables_action == 'change_status') {
        $varib_id = $_POST['varib_id'];
        $status = $_POST['selected_value'];
        $change_status_query = "UPDATE `variable` SET `variable_status`='" . $status . "' WHERE `variable_id`='" . $varib_id . "'";

        $change_status_result = $mysqli->query($change_status_query);
        $notification_message = '';
        if ($change_status_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Variable status updated successfully.</div></div></div>';
        } else {
            $edit_attrrib_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($variables_action == 'delete') {
        $varib_id = $_POST['varib_id'];
        $notification_message = '';
        $query = "DELETE  FROM `variable` WHERE `variable_id`='" . $varib_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Variable deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Variable not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
?>

