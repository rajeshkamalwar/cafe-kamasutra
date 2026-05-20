<?php

include 'db.php';
include 'config.php';
include 'function.php';
if (isset($_POST['cat_sortorder_action'])) {
    $cat_sortorder_action = $_POST['cat_sortorder_action'];
    
    if ($cat_sortorder_action == "new_sort_order4dish") {
        $cat_id=$_POST['cat_id'];
        $get_var_upin=$_POST['get_var_upin'];
        $newdortorder4cat = implode(',', $_POST['newdortorder4cat']);
        
        
        
        $newdortorder4cat_query='';
        if($get_var_upin=='insert'){$newdortorder4cat_query = "Insert into `dish_order` (`do_cat_id`, `do_dish_sort_order`)  values('".$cat_id."','".$newdortorder4cat."')";}
        if($get_var_upin=='update'){$newdortorder4cat_query = "UPDATE `dish_order` SET `do_dish_sort_order`='".$newdortorder4cat."' WHERE `do_cat_id`='$cat_id'";}
        
        
        
        $newdortorder4cat_result = $mysqli->query($newdortorder4cat_query);
            if ($newdortorder4cat_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }
}