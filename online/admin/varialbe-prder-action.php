<?php

include 'db.php';
include 'config.php';
include 'function.php';
if (isset($_POST['cat_sortorder_action'])) {
    $cat_sortorder_action = $_POST['cat_sortorder_action'];
    
    if ($cat_sortorder_action == "new_sort_order4dish") {
       
       /// $get_var_upin=$_POST['get_var_upin'];
        $newdortorder4cat = implode(',', $_POST['newdortorder4cat']);
        
        
        
        $newdortorder4cat_query='';
		
	 $print_dish = "SELECT  *  FROM `variable-orde`";
		 $print_dish_check = $mysqli->query($print_dish);
    if($print_dish_check->num_rows > 0) {	
			$newdortorder4cat_query = "UPDATE `variable-orde` SET `varialbe_order`='".$newdortorder4cat."' WHERE `id`=1";
	}
	else{
	 	$newdortorder4cat_query = "Insert into `variable-orde` (  `varialbe_order`)  values('".$newdortorder4cat."')";
	}
 
  $newdortorder4cat_result = $mysqli->query($newdortorder4cat_query);
            if ($newdortorder4cat_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
			
		
        
      print_r($newdortorder4cat_query);
         
    }
}