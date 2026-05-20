<?php

include 'db.php';
include 'config.php';

  if(isset($_POST['action']) && $_POST['action']=="update_tip"){
 
   
//echo  $mysqli->escape_string($_POST['tipamt1']);

     
	 
	 
		
           $edit_welcmtxt_query_result = $mysqli->query("UPDATE `tipamounts` SET `tipval1`='" . $mysqli->escape_string($_POST['tipamt1']) . "',`tipval2`='" . $mysqli->escape_string($_POST['tipamt2']) . "',`tipval3`='" . $mysqli->escape_string($_POST['tipamt3']) . "',`tipval4`='" . $mysqli->escape_string($_POST['tipamt4']) . "', `tipval5`='" . $mysqli->escape_string($_POST['tipamt5']) . "', `tipval6`='" . $mysqli->escape_string($_POST['tipamt6']) . "', `tipval7`='" . $mysqli->escape_string($_POST['tipamt7']) . "', `tipval8`='" . $mysqli->escape_string($_POST['tipamt8']) . "', `tipval9`='" . $mysqli->escape_string($_POST['tipamt9']) . "',`tipval10`='" . $mysqli->escape_string($_POST['tipamt10']) . "',`status`='" . $mysqli->escape_string($_POST['status']) . "'");
 
	
}
?>