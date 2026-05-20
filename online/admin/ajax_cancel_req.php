<?php 
//Database connection
require_once 'db.php';
require_once '../common_mail.php';


//code cancel//

if(!empty($_POST['id']) && isset($_POST['id'])) {

 $id = $_POST['id'];

	//send mail to user//
	$get_user_details=mysqli_query($mysqli,"select * from reservation_tbl where res_id='".$id."'");
	if(mysqli_num_rows($get_user_details) > 0){

		$fetch_data=mysqli_fetch_assoc($get_user_details);


		 if($fetch_data['lang']=='en'){
		$email_query3 = "select * from email_templete where type='4'";
	}else{

		$email_query3 = "select * from email_templete where type='9'";
	}



		$email_results3= mysqli_query($mysqli,$email_query3);
		$email_result3=mysqli_fetch_assoc($email_results3);

		sendcancelMAilToUser($fetch_data['name'],$fetch_data['email'],$email_result3['form'],$email_result3['subject'],$email_result3['content'],$email_result3['footer'],$fetch_data['person'],$fetch_data['date'].' '.$fetch_data['time'],$fetch_data['phone'],$fetch_data['lang']);

		mysqli_query($mysqli,"delete from reservation_tbl WHERE res_id='" . $id . "'"); 

	}

}
?>