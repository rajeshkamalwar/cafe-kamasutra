<?php

include 'db.php';
include 'config.php';
include 'function.php';
 
 
		 
		    
		      $field_name = $_POST['cfs'];
              $status = $_POST['status'];
		 
   $query = "DELETE    FROM `res_custom_field`";

      $add_dish_query = "INSERT INTO `res_custom_field`(`field_name`,`status`) VALUES ('" . $field_name . "','" . $status . "')";
 if ($mysqli->query($query)) {
	  $add_dish_query_result = $mysqli->query($add_dish_query);
 }
	 
 

?>