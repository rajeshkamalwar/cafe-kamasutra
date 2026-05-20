<?php 
//Database connection
require_once 'db.php';
require_once '../common_mail.php';

//code approve//

if(!empty($_POST['id']) && isset($_POST['id'])) {

 $id = $_POST['id'];
 $approve ='complete';


//send mail to user//
    $get_user_details=mysqli_query($mysqli,"select * from reservation_tbl where res_id='".$id."'");
    if(mysqli_num_rows($get_user_details) > 0){

        $fetch_data=mysqli_fetch_assoc($get_user_details);


        if($fetch_data['lang']=='en'){
		$email_query2 = "select * from email_templete where type='3'";
	}else{

		$email_query2 = "select * from email_templete where type='8'";
	}


		$email_results2= mysqli_query($mysqli,$email_query2);
		$email_result2=mysqli_fetch_assoc($email_results2);

       
   $datez=date('d-m-Y',strtotime($fetch_data['date']));   					
		sendapprovalMAilToUser($fetch_data['name'],$fetch_data['email'],$email_result2['form'],$email_result2['subject'],$email_result2['content'],$email_result2['footer'],$fetch_data['person'],$datez,$fetch_data['time'],$fetch_data['phone'],$fetch_data['lang'],$fetch_data['msg'],$fieldname,$custom_field_opt);

       mysqli_query($mysqli,"UPDATE reservation_tbl SET res_status='" . $approve ."' WHERE res_id='" . $id . "'"); 

    }

}
?>