
<?php
include 'db.php';
include 'config.php';
include 'function.php';
session_start();

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

function removefromdishorder($lastcatidwere,$mysqli,$dish_id)
{
    $lastcatidwere1 = implode(',', $lastcatidwere);
    $query1234 = "select * from `dish_order` where `do_cat_id` in ($lastcatidwere1)";
    echo "<br/>Dish id is: $dish_id<br/>".$query1234;//die();
    $no_of_cat = count($lastcatidwere);
    $query1234_result = $mysqli->query($query1234);
    $query1234_result_numrow = $query1234_result->num_rows;
    if ($query1234_result_numrow > 0) {
        for ($counti = 0; $counti < $no_of_cat; $counti++) {
            $query12345 = "SELECT `do_dish_sort_order` FROM `dish_order` where `do_cat_id` ='" . $lastcatidwere[$counti] . "'";
            echo "<br/>".$query12345;
            $query12345_result = $mysqli->query($query12345);
            $aa1 = array();
            while ($row1 = $query12345_result->fetch_assoc()) {
                array_push($aa1, $row1['do_dish_sort_order']);
            }
            $aa1 = explode(',', $aa1[0]);
            if (in_array($dish_id, $aa1)) {
                foreach (array_keys($aa1, $dish_id) as $key) {
                    unset($aa1[$key]);
                }
                $do_dish_sort_order_val1 = implode(',', $aa1);
                $query12a3 = "UPDATE `dish_order` SET `do_dish_sort_order`='$do_dish_sort_order_val1' WHERE `do_cat_id`='$lastcatidwere[$counti]'";
                $mysqli->query($query12a3);
            }
        }
    }
}


function getallupdatedCatid($dish_cat_list_edit, $mysqli, $dish_id) {
    echo "<br/>cate's string is : " . $dish_cat_list_edit . "<br/>dish id is : " . $dish_id . "<br/><br/>";
    //cat list for this dish
    $dish_cat_list_edit = explode(",", $dish_cat_list_edit);
    $no_of_cat = count($dish_cat_list_edit);
    
    for ($counti = 0; $counti < $no_of_cat; $counti++) {
        $chk_in_odrdis_tab = "SELECT `do_dish_sort_order` FROM `dish_order` where `do_cat_id` ='" . $dish_cat_list_edit[$counti] . "'";
       // echo "<br/>" . $chk_in_odrdis_tab;
        $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
        $entryfoundornot=$chk_in_odrdis_tab_result->num_rows;
        if($entryfoundornot > 0){
        
        echo 'hello';
        $aa=array();
        while ($row1 = $chk_in_odrdis_tab_result->fetch_assoc()) {
            if(!empty($row1['do_dish_sort_order']))
            array_push($aa,$row1['do_dish_sort_order']);
        }

        echo "<br/>1";
        print_r($aa);
        array_push($aa, $dish_id);
        echo "<br/>2";print_r($aa);
        
        $do_dish_sort_order_val2= implode(',', array_unique($aa));
        $query123="UPDATE `dish_order` SET `do_dish_sort_order`='$do_dish_sort_order_val2' WHERE do_cat_id`='$dish_cat_list_edit[$counti]'";
        echo "<br/>".$query123;
        $mysqli->query($query123);
        }else{
        $query1="SELECT `dish_id` FROM `dish` WHERE CONCAT(',', `categry_id`, ',') like '%,".$dish_cat_list_edit[$counti].",%' ORDER By `dish_id` ASC";
            $query1_result = $mysqli->query($query1);
            $do_dish_sort_order_val='';
            if ($query1_result->num_rows == 0) {
               //no dish in this cat found
            } else { $rr=array();
            while ($row1 = $query1_result->fetch_assoc()) {array_push($rr,$row1['dish_id']);}
$do_dish_sort_order_val= implode(',', $rr);
           }
          //  echo "<br/><br/>new order is:".$do_dish_sort_order_val;
            $newentry_query="INSERT INTO `dish_order`(`do_cat_id`, `do_dish_sort_order`) VALUES ('".$dish_cat_list_edit[$counti]."','".$do_dish_sort_order_val."') ";
           // echo "<br/><br/>".$newentry_query;
            $mysqli->query($newentry_query);
        }
        
    }
}
if (isset($_POST['dish_action'])) {
     $dish_action = $_POST['dish_action'];
     if ($dish_action == 'add_load') {
        /* to get list of all varible start */
        $avilable_variable = "Select * from `variable` where variable_status='Active'";
        $avilable_variable_result = $mysqli->query($avilable_variable);
        $variable_variable_list = '';
        if ($avilable_variable_result->num_rows > 0) {
            while ($variable = $avilable_variable_result->fetch_assoc()) {
                $variable_variable_list .= '<div class="col-md-12 col-sm-12">
                                        <div class = "checkbox">
                                         <label>
                                                <input type = "checkbox" id="' . $variable['variable_name_en'] . '-' . $variable['variable_id'] . '" name = "var_list_chk[]" value = "' . $variable['variable_id'] . '"/>' . $variable['variable_name_en'] . '
                                         </label>
                                        </div>                    
                               </div>';
            }
        }
        echo $variable_variable_list;
    }
    if ($dish_action == "load") {
        $list_dish_query = "Select * From `dish`";
        $result_dish_query = $mysqli->query($list_dish_query);
        $list_dish = '<tbody><tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
												<th>Product Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_dish_query->num_rows == 0) {
            $list_dish .= '<tr><td colspan=5><center>No record found.</center></td></tr>';
        } else {
            while ($row = $result_dish_query->fetch_assoc()) {
				if($row['dish_status']=='Active'){
					$faclass = "fa-rotate-180 inactive";
				} else{
					$faclass = "";
				}
				if($row['thumbnail']!=''){
					$productimage = '<img src="https://restaurantkamasutra.nl/online/' . $row['thumbnail'] . '" style="width: 100px;"></br><a class="btn btn-social-icon btn-danger showbutton" data-toggle="modal" data-target="#modal-imagedlt" id="delete_record" dataid="' . $row['dish_id'] . '"><i class="fa fa-trash"></i> </a><a class="btn btn-social-icon btn-primary showbutton12" data-toggle="modal" data-target="#modal-viewimage" id="view_image" dataid="' . $row['dish_id'] . '"><i class="fa fa-eye" id="myImg"></i></a>';
				} else { 
					$productimage = 'No Image';
				}
				
                $list_dish .= '
				<input type="hidden" name="dishid" id="dishid" value="' . $row['dish_id'] . '"><input type="hidden" name="dish_status" id="dish_status"  value="' . $row['dish_status'] . '">
				<tr id="'.$row['dish_id'].'">
                                    <td>' . $row['dish_name_en'] . '</td>
                                    <td>' . $row['dish_price'] . '</td>
                                    <td>' . short_desc($row['dish_desc_en'], 50) . '</td>
									<td>'.$productimage.'  </td>
                                    <td>' . $row['dish_status'] . '</td>
                                    <td>
                                        <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['dish_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['dish_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <a class="approve btn btn-social-icon btn-warning"   dataid="' . $row['dish_id'] . '"><i class="fa fa-toggle-on '.$faclass.'"></i></a>  
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['dish_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        echo $list_dish . "</tbody>";
    }

    if ($dish_action == "add_new_dish") {

        $dish_name_new_en = $mysqli->escape_string($_POST['dish_name_new_en']);
        $dish_name_new_nl = $mysqli->escape_string($_POST['dish_name_new_nl']);
        $dish_price_new = addZeroes($mysqli->escape_string($_POST['dish_price_new']));
        $dish_type = $mysqli->escape_string($_POST['dish_type']);
        $dish_description_add_en = $mysqli->escape_string($_POST['dish_description_add_en']);
        $dish_description_add_nl = $mysqli->escape_string($_POST['dish_description_add_nl']);
        $tax_percent_new = $mysqli->escape_string($_POST['tax_percent_new']);
        $dish_cat_list_new = $_POST['dish_cat_list_new'];
        $opt_var_list_new = $_POST['opt_var_list_new'];

		$icon = $_POST['icon'];
   
        $add_dish_query = "INSERT INTO `dish`(`dish_name_en`,`dish_name_nl`,`dish_desc_en`,`dish_desc_nl`,`dish_price`,`categry_id`,`dish_type`,`dish_attrib`,`dish_tax_rate`,`icon`) VALUES ('" . $dish_name_new_en . "','" . $dish_name_new_nl . "','" . $dish_description_add_en . "','" . $dish_description_add_nl . "','" . $dish_price_new . "','" . $dish_cat_list_new . "','" . $dish_type . "','" . $opt_var_list_new . "','" . $tax_percent_new . "','".$icon."')";
        //die($add_dish_query);
        $dupesql = "SELECT * FROM `dish` where `dish_name_en` = '$dish_name_new_en'";
        $duperaw = $mysqli->query($dupesql);       //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['dish_name_en'] == $dish_name_new_en || $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $dish_name_new_en . ' already exists.</div></div></div>';
        } else {
            $add_dish_query_result = $mysqli->query($add_dish_query);
            if ($add_dish_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Dish not added. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }
if ($dish_action == "viewimage") {
	 $result = $mysqli->query("SELECT * FROM `dish` WHERE `dish_id`='" . $_POST['dish_id'] . "'");
        $row = $result->fetch_assoc();
	echo $variable_list .= '
	<img src="https://restaurantkamasutra.nl/online/'.$row['product_image'].'" style="max-width: 500px;">
	';
}
    if ($dish_action == "view") {
        $result = $mysqli->query("SELECT * FROM `dish` WHERE `dish_id`='" . $_POST['dish_id'] . "'");
        $row = $result->fetch_assoc();

        if (strlen($row['dish_attrib']) > 0) {
            $cheked_list4variable = explode(",", $row['dish_attrib']);
        } else {
            $cheked_list4variable = array();
        }

        if (strlen($row['categry_id']) > 0) {
            $cheked_list4cat = explode(",", $row['categry_id']);
        } else {
            $cheked_list4cat = array();
        }
        /* to get list of all cat start */
        $avilable_variable = "Select * from `variable` where variable_status='Active'";
        $avilable_variable_result = $mysqli->query($avilable_variable);
        $variable_list = '';
        if ($avilable_variable_result->num_rows > 0) {
            while ($variable = $avilable_variable_result->fetch_assoc()) {
                $checkedornot = '';
                if (in_array($variable['variable_id'], $cheked_list4variable)) {
                    $checkedornot = 'checked';
                }
                $variable_list .= '<div class="col-md-12 col-sm-12">
                                        <div class = "checkbox">
                                         <label>
                                                <input type = "checkbox" id="' . $variable['variable_name_en'] . '-' . $variable['variable_id'] . '" name = "varib_list_chk_view" value = "' . $variable['variable_id'] . '"' . $checkedornot . '/>' . $variable['variable_name_en'] . '
                                         </label>
                                        </div>                    
                               </div>';
            }
        }
        /* to get list of all cat End */
        $active = $inactive = $style = '';
        if ($row['dish_type'] == 1) {
            $active = 'selected="selected"';
            $style = "<style>#varib_div_view{display:none;}</style>";
        }
        if ($row['dish_type'] == 2) {
            $inactive = 'selected="selected"';
            $style = "<style>#varib_div_view{display:block;}</style>";
        }
        echo $style . '<div class="form-group">
                                            <label>Dish Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" value="' . $row['dish_name_en'] . '" class="form-control" id="dish_name_view_en" name="dish_name_view_en" placeholder="Dish name in ' . lang1 . ' " >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" value="' . $row['dish_name_nl'] . '" class="form-control" id="dish_name_view_nl" name="dish_name_view_nl" placeholder="Dish name in ' . lang2 . '" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Dish Description</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_view_en" name="dish_description_view_en"  placeholder="Dish description in ' . lang1 . '">' . $row['dish_desc_en'] . '</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_view_nl" name="dish_description_view_nl"  placeholder="Dish description in ' . lang2 . '">' . $row['dish_desc_nl'] . '</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">                                       <div class="form-group">
                                                    <label for="attributes price">Price</label>
                                                    <input type="text" value="' . $row['dish_price'] . '" class="form-control" id="dish_price_view" name="dish_price_view" placeholder="Price" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Dish Type</label>

                                                    <select class="form-control" id="dish_type_view">
                                                        <option value="1"  ' . $active . ' >Simple Dish</option>
                                                        <option value="2" ' . $inactive . '>Custom Dish</option></select>
                                                </div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">


                                                <div class="form-group">
                                                    <label for="attributes price">Dish Category</label>
                                                    <div class="chkbox-div form-control">
                                                        ' .
        get_all_category_chkbox_action($mysqli, "cat_list_chk_view", $cheked_list4cat) . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group " id="varib_div_view">
                                                    <label for="attributes price">Options / variables</label>
                                                    <div class="chkbox-div form-control" id="varible_div_view">
                                                     ' . $variable_list . '
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Tax %</label>
                                                    <input type="text" value="' . $row['dish_tax_rate'] . '" class="form-control" id="tax_percent_view" name="tax_percent_view" placeholder="Tax % " >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                            </div>
                                        </div>';
    }

    if ($dish_action == "edit_load_record") {
        $result = $mysqli->query("SELECT * FROM `dish` WHERE `dish_id`='" . $_POST['dish_id'] . "'");
        $row = $result->fetch_assoc();
		$productvideo = '';
		
		
	$dicountamtt = 0;
	   $query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ". $_POST["dish_id"]."  ");
  		$discount = $query_postdel11->fetch_assoc();
		  $dicountamtt = $discount['discount'];		
		  $discountdays = $discount['discountdays'];	 
	 
 	 $dd = explode(",",$discountdays);		
  		if (in_array("Monday", $dd)){ 
		 $seelctm = 'checked';
		}
		if (in_array("Tuesday", $dd)){ 
		 $seelctm2 = 'checked';
		}
		if (in_array("Wednesday", $dd)){ 
		 $seelctm3 = 'checked';
		}
		if (in_array("Thursday", $dd)){ 
		 $seelctm4 = 'checked';
		}
		if (in_array("Friday", $dd)){ 
		 $seelctm5 = 'checked';
		}
		 if (in_array("Saturday", $dd)){ 
		 $seelctm6 = 'checked';
		}
		 if (in_array("Sunday", $dd)){ 
		 $seelctm7 = 'checked';
		}
		
			
		
                         $edit_query121 = "SELECT * from `video` ";
                                          $query_result121 = $mysqli->query($edit_query121); 
		
										  while($row1221=$query_result121->fetch_array()){
											 if($row1221['id']==$row['video']){
												 $selectvideo = 'selected';
											 } else {
												 $selectvideo = '';
											 }
										$productvideo .= '<option value="'.$row1221['id'].'" '.$selectvideo.'>'.$row1221['video'].'</option>';	  
										  }
        if (strlen($row['dish_attrib']) > 0) {
            $cheked_list4variable = explode(",", $row['dish_attrib']);
        } else {
            $cheked_list4variable = array();
        }
     if (strlen($row['icon']) > 0) {
            $cheked_list4icon = explode(",", $row['icon']);
        } else {
            $cheked_list4icon = array();
        }
        if (strlen($row['categry_id']) > 0) {
            $cheked_list4cat = explode(",", $row['categry_id']);
            $_SESSION['lastcatidwere']=$cheked_list4cat;
        } else {
            $cheked_list4cat = array();
        }


        /* to get list of all cat start */
        $avilable_variable = "Select * from `variable` where variable_status='Active'";
        $avilable_variable_result = $mysqli->query($avilable_variable);
        $variable_list = '';
        if ($avilable_variable_result->num_rows > 0) {
            while ($variable = $avilable_variable_result->fetch_assoc()) {
                $checkedornot = '';
                if (in_array($variable['variable_id'], $cheked_list4variable)) {
                    $checkedornot = 'checked';
                }
				
                $variable_list .= '<div class="col-md-12 col-sm-12">
                                        <div class = "checkbox">
                                         <label>
                                                <input type = "checkbox" id="' . $variable['variable_name_en'] . '-' . $variable['variable_id'] . '" name = "varib_list_chk_edit[]" value = "' . $variable['variable_id'] . '"' . $checkedornot . '/>' . $variable['variable_name_en'] . '
                                         </label>
                                        </div>                    
                               </div>';
            }
        }
		$edit_query121 = "SELECT * from `media` ";
                                          $query_result121 = $mysqli->query($edit_query121); 
										  while($row1221=$query_result121->fetch_array()){
											   $checkedornoticon = '';
                if (in_array($row1221['id'], $cheked_list4icon)) {
                    $checkedornoticon = 'checked';
                }
                                   
											  else {
							 $checkedeadnot = '';					  
											  }
                            $iconlist .='<input type="checkbox" name="iconnew[]" id="iconnew" '.$checkedornoticon.' value='. $row1221['id'].'><img src='. $row1221['icon'].' style="height:20px; widh:20px; ">';
											 } 
        /* to get list of all cat End */

        $active = $inactive = $style = '';
        if ($row['dish_type'] == 1) {
            $active = 'selected="selected"';
            $style = "<style>#varib_div_edit{display:none;}</style>";
        }
        if ($row['dish_type'] == 2) {
            $inactive = 'selected="selected"';
            $style = "<style>#varib_div_edit{display:block;}</style>";
        }
        $style .= '<SCRIPT> 	
	function show(select_item) {
	    if (select_item == "1") {
		    varib_div_edit.style.visibility="hidden";
			varib_div_edit.style.display="none";
			
		} 
		if (select_item == "2") {
			varib_div_edit.style.visibility="visible";
			varib_div_edit.style.display="block";
		}
	}	
</SCRIPT>  
';
        echo $style . '<input type="hidden" id="dish_id" name="dish_id" value="' . $_POST['dish_id'] . '">
		<input type="hidden" id="oldimg" name="oldimg" value="' . $_POST['product_image'] . '">
 <div class="form-group">
                                            <label>Dish Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" value="' . $row['dish_name_en'] . '" class="form-control" id="dish_name_edit_en" name="dish_name_edit_en" placeholder="Dish name in ' . lang1 . ' " >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" value="' . $row['dish_name_nl'] . '" class="form-control" id="dish_name_edit_nl" name="dish_name_edit_nl" placeholder="Dish name in ' . lang2 . '" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Dish Description</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_edit_en" name="dish_description_edit_en"  placeholder="Dish description in ' . lang1 . '">' . $row['dish_desc_en'] . '</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_edit_nl" name="dish_description_edit_nl"  placeholder="Dish description in ' . lang2 . '">' . $row['dish_desc_nl'] . '</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">                                       <div class="form-group">
                                                    <label for="attributes price">Price</label>
                                                    <input type="text" value="' . $row['dish_price'] . '" class="form-control" id="dish_price_edit" name="dish_price_edit" placeholder="Price" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Dish Type</label>

                                                    <select class="form-control" id="dish_type_edit" name="dish_type_edit" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                                                        <option value="1"  ' . $active . ' >Simple Dish</option>
                                                        <option value="2" ' . $inactive . '>Custom Dish</option></select>
                                                </div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">


                                                <div class="form-group">
                                                    <label for="attributes price">Dish Category</label>
                                                    <div class="chkbox-div form-control">
                                                        ' .
        get_all_category_chkbox_action($mysqli, "cat_list_chk_edit[]", $cheked_list4cat) . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group " id="varib_div_edit">
                                                    <label for="attributes price">Options / variables</label>
                                                    <div class="chkbox-div form-control" id="varible_div_edit">
                                                     ' . $variable_list . '
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Tax %</label>
                                                    <input type="text" value="' . $row['dish_tax_rate'] . '" class="form-control" id="tax_percent_edit" name="tax_percent_edit" placeholder="Tax % " >
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
											<label for="attributes price">Icon</label>
'.$iconlist.'
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Product Image</label>
                                                    <input type="file" class="form-control" id="image" name="image" >
                                                </div>
                                            </div>
											<div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Select Video</label>
											         <select class="form-control" name="video" id="video" >
													 <option>Select One</option>
												'.$productvideo.'
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Discount</label>
                                                    <input type="text" value="' . $dicountamtt . '" class="form-control" id="dish_discount" name="dish_discount" placeholder="Discount " >
                                                </div>
                                            </div>
											 <div class="weekDays-selector">
			   <label for="attributes price">Discount days</label><br>
  <input type="checkbox" id="weekday-mon" value="Monday"  name="weekdays[]"  '.$seelctm.' />
  <label for="weekday-mon">M</label>
  <input type="checkbox" id="weekday-tue" value="Tuesday" name="weekdays[]" '.$seelctm2.'  />
  <label for="weekday-tue">T</label>
  <input type="checkbox" id="weekday-wed" value="Wednesday" name="weekdays[]" '.$seelctm3.' />
  <label for="weekday-wed">W</label>
  <input type="checkbox" id="weekday-thu" value="Thursday" name="weekdays[]" '.$seelctm4.' />
  <label for="weekday-thu">T</label>
  <input type="checkbox" id="weekday-fri"  value="Friday" name="weekdays[]"  '.$seelctm5.' />
  <label for="weekday-fri">F</label>
  <input type="checkbox" id="weekday-sat"  value="Saturday"  name="weekdays[]" '.$seelctm6.'/>
  <label for="weekday-sat">S</label>
  <input type="checkbox" id="weekday-sun" value="Sunday" name="weekdays[]"  "'.$seelctm7.'"/>
  <label for="weekday-sun">S</label>
</div>
										</div>
										
	 <div class="plastick-selector col-md-6 col-sm-12 row">  <label for="attributes price">Plastic Charge</label><br>
   <input type="text" value="' . $row['bag_charge'] . '" class="form-control" id="plastic_charg" name="plastic_charg"  >
</div>									
										
										
                                    </div>
										';
    }

    if ($dish_action == "edit") {

        $dish_id = $_POST['dish_id'];
        $dish_name_edit_en = $mysqli->escape_string($_POST['dish_name_edit_en']);
        $dish_name_edit_nl = $mysqli->escape_string($_POST['dish_name_edit_nl']);
        $dish_price_edit = addZeroes($mysqli->escape_string($_POST['dish_price_edit']));
        $dish_type = $mysqli->escape_string($_POST['dish_type']);
        $dish_description_edit_en = $mysqli->escape_string($_POST['dish_description_edit_en']);
        $dish_description_edit_nl = $mysqli->escape_string($_POST['dish_description_edit_nl']);
        $tax_percent_edit = $mysqli->escape_string($_POST['tax_percent_edit']);
        $dish_cat_list_edit = $_POST['dish_cat_list_edit'];
        $opt_var_list_edit = $_POST['opt_var_list_edit'];
		
		  $plcharge = $_POST['plcharge'];
		
$icon = $_POST['icon_edit'];
        $edit_dish_query = "UPDATE `dish` SET `dish_name_en`='" . $dish_name_edit_en . "',`dish_name_nl`='" . $dish_name_edit_nl . "',`dish_desc_en`='" . $dish_description_edit_en . "',`dish_desc_nl`='" . $dish_description_edit_nl . "',`dish_price`='" . $dish_price_edit . "',`categry_id`='" . $dish_cat_list_edit . "',`dish_type`='" . $dish_type . "',`dish_attrib`='" . $opt_var_list_edit . "',`dish_tax_rate`='" . $tax_percent_edit . "',`icon`='".$icon."',`charge_opt`='".$plcharge."' WHERE `dish_id`='" . $dish_id . "'";

        // die($edit_dish_query);
        $dupesql = "SELECT * FROM `dish` where `dish_name_en` = '$dish_name_edit_en'";
        $duperaw = $mysqli->query($dupesql);       //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
        $notification_message = '';
        if ($duperaw_row['dish_id'] != $dish_id && $duperaw->num_rows > 0) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $dish_name_edit_en . ' already exists.</div></div></div>';
        } else {
            $edit_dish_query_result = $mysqli->query($edit_dish_query);
            if ($edit_dish_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Dish not updated. Please try again little later.</div></div></div>';
            }
        }
        echo $notification_message;
    }

    if ($dish_action == 'get_status') {

        $dish_id = $_POST['dish_id'];
        $query = "select `dish_status` from `dish` where dish_id=" . $dish_id;
        $res_data = $mysqli->query($query);

        $row = $res_data->fetch_assoc();
        $return_string = '';
        $active = $inactive = '';
        if ($row['dish_status'] == 'Active') {
            $active = 'selected="selected"';
        }
        if ($row['dish_status'] == 'Inactive') {
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
                                                        
<input id="mso" type="hidden" value="' . $dish_id . '"/>
                                                    </div>
                                                     
                                                </div></fieldset></div>';
        echo $return_string;
    }

    if ($dish_action == 'change_status') {
        $dish_id = $_POST['dish_id'];
        
		$query = "select `dish_status` from `dish` where dish_id=" . $dish_id;
        $res_data = $mysqli->query($query);
        $row = $res_data->fetch_assoc();
		if($row['dish_status']=='Active'){
			$status = 'Inactive';
		}else { 
			$status = 'Active';
		}
        $change_status_query = "UPDATE `dish` SET `dish_status`='" . $status . "' WHERE `dish_id`='" . $dish_id . "'";

        $change_status_result = $mysqli->query($change_status_query);
        $notification_message = '';
        if ($change_status_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish status updated successfully.</div></div></div>';
        } else {
            $edit_attrrib_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }

    if ($dish_action == 'delete') {
        $dish_id = $_POST['dish_id'];
        $notification_message = '';
        $query = "DELETE  FROM `dish` WHERE `dish_id`='" . $dish_id . "'";
        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Dish not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
if ($dish_action == 'deleteimage') {
        $dish_id = $_POST['dish_id'];
        $notification_message = '';
        $query = "update `dish` SET `product_image`='',`thumbnail`='' WHERE `dish_id`='" . $dish_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish image removed successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Dish not removed. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }

}

?>
<script>
	$(document).on('click', '#change_status_btn', function () {
                    var dish_id = $("#dishid").val();
                    var dish_action = 'change_status';
                    var selected_value = $("#dish_status").val();
		//alert(dish_id);
                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_action: dish_action,
                            dish_id: dish_id,
                            selected_value: selected_value
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#status_notimsg').html('');
                            $('#status_notimsg').html(data);
                            $("#status_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#status_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });
	$(".approve").click(function(){
        var dish_id = $(this).parents("tr").attr("id");
        var dish_action = 'change_status';
            $.ajax({
               url: 'dish_action.php',
               type: 'POST',
               data: {
				       dish_action: dish_action,
                       dish_id: dish_id
                      },
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
				    load();
               }
            });
        
    });
</script>