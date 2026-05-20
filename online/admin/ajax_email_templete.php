<?php 
//Database connection
require_once 'db.php';
//insert into database

//code insert//
if(!empty($_POST['type_two']) && isset($_POST['type_two'])) {

 $type = $_POST['type_two'];
 $subject = $_POST['subject_two'];
 $admin_to = $_POST['admin_to_two'] ? $_POST['admin_to_two']:''; 
 $content = htmlspecialchars_decode($_POST['content_two']); 
 $footer = htmlspecialchars_decode($_POST['footer_two']); 
 $form = $_POST['form_two']; 


 //$status=1;
		$check_user_id_exist=mysqli_query($mysqli,"select * from email_templete where type='".$type."'");
		if(mysqli_num_rows($check_user_id_exist) > 0){
//echo 'UPDATE email_templete SET admin_to="' . $admin_to .'",subject="' . $subject .'",content="'.mysqli_real_escape_string($mysqli,$content).'",form="' . $form .'" WHERE type="' . $type .'"';
			mysqli_query($mysqli,'UPDATE email_templete SET admin_to="' . $admin_to .'",subject="' . $subject .'",content="'.mysqli_real_escape_string($mysqli,$content).'",form="' . $form .'",footer="' .mysqli_real_escape_string($mysqli,$footer).'" WHERE type="' . $type .'"'); 

				echo "2";	
		}else{

			mysqli_query($mysqli,"INSERT into email_templete (type,admin_to,subject,content,form,footer) values ('".$type."', '".$admin_to."', '".$subject."','".mysqli_real_escape_string($mysqli,$content)."','".$form."','".mysqli_real_escape_string($mysqli,$footer)."')");
			
		}
 
}

if(!empty($_POST['type']) && isset($_POST['type'])) {
///print_r($_POST);
 $type = $_POST['type'];
 $subject = $_POST['subject'];
 $admin_to = $_POST['admin_to'] ? $_POST['admin_to']:''; 
 $content = htmlspecialchars_decode($_POST['content']); 
 $footer = htmlspecialchars_decode($_POST['footer']); 
 $form = $_POST['form']; 


 //$status=1;
		$check_user_id_exist=mysqli_query($mysqli,"select * from email_templete where type='".$type."'");
		if(mysqli_num_rows($check_user_id_exist) > 0){
//echo 'UPDATE email_templete SET admin_to="' . $admin_to .'",subject="' . $subject .'",content="'.mysqli_real_escape_string($mysqli,$content).'",form="' . $form .'" WHERE type="' . $type .'"';
			mysqli_query($mysqli,'UPDATE email_templete SET admin_to="' . $admin_to .'",subject="' . $subject .'",content="'.mysqli_real_escape_string($mysqli,$content).'",form="' . $form .'",footer="' .mysqli_real_escape_string($mysqli,$footer).'" WHERE type="' . $type .'"'); 

				echo "2";	
		}else{

			mysqli_query($mysqli,"INSERT into email_templete (type,admin_to,subject,content,form,footer) values ('".$type."', '".$admin_to."', '".$subject."','".mysqli_real_escape_string($mysqli,$content)."','".$form."','".mysqli_real_escape_string($mysqli,$footer)."')");
			
		}
 mysqli_query($mysqli,'UPDATE email_templete SET footer="' .mysqli_real_escape_string($mysqli,$footer).'"'); 
}
?>