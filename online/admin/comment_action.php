
<?php

session_start();
include 'db.php';
include 'config.php';
//include 'tfunction.php';

ob_start();

if (isset($_POST['message'])) {
	$currenttabe = $_POST["currentval"];
    $message = $_POST['message'];
 
   $ot_time =  date('H:i:s');
	 $today = date('Y-m-d');
	$table1=$mysqli->query("SELECT `message` FROM `messages` WHERE  table_no = '$currenttabe' AND DATE(date_time) = '$today'");
	$countplastic = $table1->num_rows; 
	 if(!empty($countplastic)){
		 $edit_gift_query = "UPDATE `messages` SET   `message`='" . $message . "'  WHERE `table_no`='" . $currenttabe . "' AND DATE(date_time) = '$today'";
			   $mysqli->query($edit_gift_query);
	 }
	else{
     $insert_order_query="INSERT INTO `messages`(`table_no`, `message`, `created_at`)  VALUES ('".$currenttabe."','".$message."', '".date("Y-m-d h:m:i")."')";
		 $insert_order_query_result = $mysqli->query($insert_order_query);
	}
	echo $message;
}

?>