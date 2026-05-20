<?php 
//Database connection
require_once 'db.php';
//insert into database

//code fetch//

if(!empty($_POST['type']) && isset($_POST['type'])) {

 $type = $_POST['type'];

		$check_user_id_exist=mysqli_query($mysqli,"select * from email_templete where type='".$type."'");
		if(mysqli_num_rows($check_user_id_exist) > 0){

			$fetch_email_data=mysqli_fetch_assoc($check_user_id_exist);

			echo json_encode($fetch_email_data);

		}else{
			$fetch_email_data='';
		    echo json_encode($fetch_email_data);

		}


 
}


if(!empty($_POST['type_two']) && isset($_POST['type_two'])) {

 $type_two = $_POST['type_two'];

		$check_user_id_exist=mysqli_query($mysqli,"select * from email_templete where type='".$type_two."'");
		if(mysqli_num_rows($check_user_id_exist) > 0){

			$fetch_email_data=mysqli_fetch_assoc($check_user_id_exist);

			echo json_encode($fetch_email_data);

		}else{
			$fetch_email_data='';
		    echo json_encode($fetch_email_data);

		}


 
}
?>