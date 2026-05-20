<?php
require_once 'db.php';
//before time work//
if(!empty($_POST['tf']) && isset($_POST['tf'])) {
	     $today_off = $_POST['tf'];   
		 
  	    $query = "DELETE    FROM `res_days_settings`";
        $add_dish_query = "INSERT INTO `res_days_settings`(`is_off`) VALUES ('" . $today_off . "')";
		 if ($mysqli->query($query)) {
			  $add_dish_query_result = $mysqli->query($add_dish_query);
		 }
	
}
?>