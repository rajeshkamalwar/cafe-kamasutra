<?php

include 'db.php';
include 'config.php';
include 'function.php';
if (isset($_POST['cat_sortorder_action'])) {
    $cat_sortorder_action = $_POST['cat_sortorder_action'];
    if ($cat_sortorder_action == "new_sort_order4cat") {
        $newdortorder4cat = implode(',', $_POST['newdortorder4cat']);
        
		
		$checkquery = "Select * from `supercategory_order` ";
$result_checkquery = $mysqli->query($checkquery);
 	
		
	   $newdortorder4cat_query='';
 
		
		
		if($result_checkquery->num_rows >0){
			  $newdortorder4cat_query = "UPDATE `supercategory_order` SET `sup_cat_order`='".$newdortorder4cat."' WHERE `supcatorder_id`='1'";
		}
	else{
		$newdortorder4cat_query = "Insert into `supercategory_order` (`sup_cat_order`)  values('".$newdortorder4cat."')";
	}
		
      
        //echo $newdortorder4cat_query;die();
        $newdortorder4cat_result = $mysqli->query($newdortorder4cat_query);
            if ($newdortorder4cat_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
            }
        echo $notification_message;
    }
}