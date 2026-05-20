<?php
require_once 'db.php';
 
if($_POST['perlimt']) {
 
	 $perlimt = $_POST['perlimt'];	
  $check_data1=mysqli_query($mysqli,"select * from date_tbl where id='12'");
    if(mysqli_num_rows($check_data1) > 0){
		if($_POST['perlimt']==''){
			  mysqli_query($mysqli,'UPDATE date_tbl SET week="0" WHERE id="12"');   
		}
		else{
         mysqli_query($mysqli,'UPDATE date_tbl SET week="'.$perlimt.'" WHERE id="12"');      
		}
    
      }else{
       ///     mysqli_query($mysqli,'INSERT into date_tbl (json_date)values("'.$before_time.'")'); 
      } 	
	
} 


?>