<?php 
//Database connection
require_once 'db.php';
//insert into database

if(!empty($_POST['code']) && isset($_POST['code'])) {

$error=array();
 $discount_coupon_code = $_POST['code'];

 $check_user_id_exist=mysqli_query($mysqli,"select * from promotion_discount_code_tbl where coupon_code='".$discount_coupon_code."'");
    $row = mysqli_fetch_assoc($check_user_id_exist);
    $db_discount_coupon_code = $row['coupon_code'];
	if($db_discount_coupon_code == $discount_coupon_code){
		   $current_date=date('Y-m-d');
		   $db_expire_time = date('Y-m-d',strtotime($row['expire_at']));
			if($db_expire_time >= $current_date){

				
				
		        $get_email=mysqli_query($mysqli,"select *,promotion_tbl.name,promotion_tbl.email from promotion_discount_code_tbl inner join promotion_tbl on promotion_discount_code_tbl.user_id=promotion_tbl.id where promotion_discount_code_tbl.user_id='".$row['user_id']."'");
			
				 $rows = mysqli_fetch_assoc($get_email);
				 $email=$rows['email'];	
				 $name=$rows['name'];	
				 if(!empty($row["dish"])){


				  $text='free dish '.$row["dish"].'';
				}
				else{
				 $text= $row["discount"].'% discount';
				}
				$error['e_sucess'] ="Vola! Discount Coupon code is redeemed!<br>You have given " .$text. ' to ' .$name;
				

				 if(!empty($row["dish"])){

					   $msg='Thank you for visit Pakwaan again.Congratulation your free dish '.$row["dish"].' coupon redeemed successfully.';
					}
					else{
					 $msg='Thank you for visit Pakwaan again.Congratulation your '.$row["discount"].'% discount coupon redeemed successfully.';
					}


				 require_once 'mail_function.php';
				 $mail=sendmail($name,$email,$msg);
				  if($mail){

	mysqli_query($mysqli,"UPDATE promotion_discount_code_tbl SET coupon_code='',expire_at='".$current_date."',discount='',dish='',expire_in_days='' WHERE user_id='" . $row['user_id'] . "'"); 
					}
			}else{
				$error['e_msg']="Coupon code is expired!";
			     }
		}else{

			$error['e_msg']="Coupon code is not valid!";
		}

  echo json_encode($error);
}
?>