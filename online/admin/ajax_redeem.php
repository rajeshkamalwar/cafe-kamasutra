<?php 
//Database connection
require_once 'db.php';
//insert into database

//code insert//   

if(!empty($_POST['code']) && isset($_POST['code'])) {

	
					$sql = "select * From adm_set";
       $result = mysqli_query($mysqli,$sql); 
   $data1=array();
        while ($row=mysqli_fetch_assoc($result)) {
          $data1[$row['adm_set_name']] = $row['adm_set_vlu'];	
			 
        }
	 $rest_rest_title = $data1['rest_title'];
     $rest_addrss_main = $data1['rest_addrss'];
	 $rest_postcode_main = $data1['rest_postcode'];
	 $res_rest_city = $data1['rest_city'];
	 
	 $res_email_main = $data1['rest_email'];
	 $rest_weblink_main = $data1['rest_weblink'];
	 $res_rest_contact2 = $data1['rest_contact2'];
	 $rest_info = $data1['rest_email'];	
	
		
$message = '<p>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.',<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Tel.: '.$res_rest_cont.'<br/>
'.$res_email_main.' <br/>
'.$rest_weblink_main.'<br/>
'.$newcontact.'<br/>
'.$newrssinfo.'</p>';
	
	
 $code = $_POST['code'];
 $user_id = $_POST['user_id'];
 $discount = $_POST['discount']; 
 $dish = $_POST['dish']; 
 $expire_time = $_POST['expire_time']; 
 $name = $_POST['name']; 
 $email = $_POST['email']; 
 $created_at =date('Y-m-d H:i:s');

$check_user_id_exist=mysqli_query($mysqli,"select * from promotion_discount_code_tbl where user_id='".$user_id."'");
if(mysqli_num_rows($check_user_id_exist) > 0){


if(!empty($discount) && isset($discount)){

	mysqli_query($mysqli,"UPDATE promotion_discount_code_tbl SET coupon_code='" . $code . "',discount='" . $discount . "',dish='',expire_at='" . $expire_time . "',created_at='" . $created_at . "' WHERE user_id='" . $user_id . "'"); 


}else{

	mysqli_query($mysqli,"UPDATE promotion_discount_code_tbl SET coupon_code='" . $code . "',dish='" . $dish . "',discount='',expire_at='" . $expire_time . "',created_at='" . $created_at . "' WHERE user_id='" . $user_id . "'"); 

	
}

if(!empty($dish)){

  $msg='Thank you for your visit. We hope you had delicious food and enjoyed our service.We hope to give us the opportunity to welcome you again. On your next visit, you will get Free Dish <b>'.$dish.'</b>';
}
else{
 $msg='Thank you for your visit. We hope you had delicious food and enjoyed our service.We hope to give us the opportunity to welcome you again. On your next visit, you will get <b>'.$discount.'%</b> discount';
}



//mail//
 require_once 'mail_function.php';
   sendOtP($name,$email,$code,$msg,$expire_time,$message,$res_email_main);
   echo '1';

 }else{




 	if(!empty($discount) && isset($discount)){


 	$sql="INSERT into promotion_discount_code_tbl (coupon_code,user_id,discount,expire_at,created_at) values ('".$code."', '".$user_id."', '".$discount."','".$expire_time."','".$created_at."')";

 }else{

 	$sql="INSERT into promotion_discount_code_tbl (coupon_code,user_id,dish,expire_at,created_at) values ('".$code."', '".$user_id."', '".$dish."','".$expire_time."','".$created_at."')";


 }
 	
	 mysqli_query($mysqli,$sql);
	 if(!empty($dish)){

  $msg='Thank you for your visit. We hope you had delicious food and enjoyed our service.We hope to give us the opportunity to welcome you again. On your next visit, you will get '.$dish.'';
}
else{
 $msg='Thank you for your visit. We hope you had delicious food and enjoyed our service.We hope to give us the opportunity to welcome you again. On your next visit, you will get '.$discount.'% discount';
}

  //mail//
    require_once 'mail_function.php';
	sendOtP($name,$email,$code,$msg,$expire_time,$message,$res_email_main);
    echo '1';
	  }
 
   //run every time when coupon generate//
	if(!empty($discount) && isset($discount)){

	   $run_every_time="INSERT into promation_coupon_data_maintain (user_id,name,email,created,expire,type) values ('".$user_id."', '".$name."','".$email."','".$created_at."','".$expire_time."','".$discount."')";
	   mysqli_query($mysqli,$run_every_time);
	}else{

		$run_every_time="INSERT into promation_coupon_data_maintain (user_id,name,email,created,expire,type) values ('".$user_id."', '".$name."','".$email."','".$created_at."','".$expire_time."','".$dish."')";	
		mysqli_query($mysqli,$run_every_time);
	}
	

         

}
?>