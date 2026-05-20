<?php
	include 'admin/db.php';
	$id=$_POST['id'];
	$sql = "DELETE FROM `tbl_user` WHERE usr_id=$id";
	if ($mysqli->query($sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>