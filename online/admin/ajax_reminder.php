<?php 
//Database connection
require_once 'db.php';
//insert into database

//code insert//

if(!empty($_POST['id']) && isset($_POST['id'])) {

	
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
	
	
	
 	 
$sql = "select *,promotion_discount_code_tbl.expire_at from promotion_tbl left join promotion_discount_code_tbl on promotion_tbl.id=promotion_discount_code_tbl.user_id where promotion_tbl.id='".$_POST['id']."'";
$result = mysqli_query($mysqli,$sql);
if(mysqli_num_rows($result) > 0){

	 $row=mysqli_fetch_assoc($result);
	 $email=$row['email'];
	 $name=$row['name'];
	 // echo $expire=date('d', strtotime($row['expire_at']));
	 $now = time(); // or your date as well
$your_date = strtotime($row['expire_at']);
$datediff = $now - $your_date;

 $expiretime_in_days=abs(round($datediff / (60 * 60 * 24)));

	
     //mail//
    require_once 'mail_function.php';
	sendReminder($name,$email,$expiretime_in_days,$message,$res_email_main);
    echo '1';

    }
}
 
  


?>