<?php 
//Database connection
require_once 'db.php';
require_once '../common_mail.php';
//code approve//

if(!empty($_POST['check']) && isset($_POST['check'])) {

 $check = $_POST['check'];
 $date =date('Y-m-d H:i:s');
 $approve ='complete';

if($check=='1'){

   $check_data=mysqli_query($mysqli,"select * from auto_approve_tbl where id='1'");
  if(mysqli_num_rows($check_data) > 0){
  
          mysqli_query($mysqli,"UPDATE auto_approve_tbl SET auto_date='".$date."',auto_status='" . $check ."' WHERE id='1'"); 
         
          //update all requests of books//
           mysqli_query($mysqli,"UPDATE reservation_tbl SET res_status='" . $approve ."'"); 


          
    
      }else{


      	   mysqli_query($mysqli,"INSERT into auto_approve_tbl (auto_date,auto_status)values('".$date."','".$check."')"); 


      }

        //mail to admin//
     
         $email_query4 = "select * from email_templete where type='5'";
         $email_results4= mysqli_query($mysqli,$email_query4);
         $email_result4=mysqli_fetch_assoc($email_results4);

       sendautoapprovalMAilToAdmin($email_result4['form'],$email_result4['subject'],$email_result4['content'],$email_result4['admin_to'],$email_result4['footer']);
  
    }else {

    	  mysqli_query($mysqli,"UPDATE auto_approve_tbl SET auto_date='',auto_status='0' WHERE id='1'"); 
    	  echo 2;


    }

}
?>