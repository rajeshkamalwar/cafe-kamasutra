<?php
//Database connection
include 'db.php';
//insert into database

//user fields insert//

if(!empty($_POST)) {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $facebook_id = $_POST['facebook_id']; 
 $allow = $_POST['allow']; 


$sql=mysqli_query($mysqli,"select * from promotion_tbl where email='".$email."'");
 if(mysqli_num_rows($sql) > 0){

  echo '<div class="alert alert-danger" role="alert">Email already exist!</div>'; 

 }else{
	 mysqli_query($mysqli, "insert into promotion_tbl (name, email, facebook_id,allow) values ('".$name."', '".$email."', '".$facebook_id."','".$allow."')"); 
	 echo '<div class="alert alert-success" role="alert">Data saved successfully!</div>';
      }
}


?>