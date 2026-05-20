<?php 
include "db.php";

$id = 0;
if(isset($_POST['id'])){
   $id = mysqli_real_escape_string($mysqli,$_POST['id']);
}

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($mysqli,"SELECT * FROM email_import WHERE id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM email_import WHERE id=".$id;
		mysqli_query($mysqli,$query);
		echo 1;
		exit;
	}else{
        echo 0;
        exit;
    }
}

echo 0;
exit;