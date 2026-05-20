<?php 
//Database connection
require_once 'db.php';
//code date range//

if(!empty($_POST['sdate']) && isset($_POST['sdate']) && !empty($_POST['edate']) && isset($_POST['edate'])) {

 $date_change1 = explode("/", $_POST['sdate']);
 $date_change2 = explode("/", $_POST['edate']);
 $sdate=$date_change1[2].'-'.$date_change1[1].'-'.$date_change1[0];
 $edate=$date_change2[2].'-'.$date_change2[1].'-'.$date_change2[0];

 $array = array();

$final_date1 = strtotime($sdate);
$final_date2 = strtotime($edate);
  
//loop for to get all date returns between start and end dates//

for($currentDate = $final_date1; $currentDate <= $final_date2; 
     $currentDate += (86400)) {
                                          
    $store = date('d/m/Y', $currentDate);
    $array[] = $store;
 }

//convert date to string format//

 $main_date_string="'".implode("','",array_unique($array))."'";

  $check_data=mysqli_query($mysqli,"select * from date_tbl where id='1'");
    if(mysqli_num_rows($check_data) > 0){
   

          mysqli_query($mysqli,'UPDATE date_tbl SET sdate="'.$sdate.'",edate="'.$edate.'",json_date="'.$main_date_string.'" WHERE id="1"'); 
           
    
      }else{

            mysqli_query($mysqli,'INSERT into date_tbl (sdate,edate,json_date)values("'.$sdate.'","'.$edate.'","'.$main_date_string.'")'); 

      }
}else{
  ///mysqli_query($mysqli,'UPDATE date_tbl SET sdate="",edate="",json_date="" WHERE id="1"'); 

}

//time slot work//
if(!empty($_POST['st_1']) && isset($_POST['st_1']) && !empty($_POST['et_1']) && isset($_POST['et_1'])) {

 
 
	$st1_1 =$_POST['st_1'];
	$et1_1= $_POST['et_1'];

	$st1_2 =$_POST['st_2'];
	$et1_2= $_POST['et_2'];
	
		$st1_3 =$_POST['st_3'];
	$et1_3= $_POST['et_3'];
	
		$st1_4 =$_POST['st_4'];
	$et1_4= $_POST['et_4'];
	
		$st1_5 =$_POST['st_5'];
	$et1_5= $_POST['et_5'];
	
		$st1_6 =$_POST['st_6'];
	$et1_6= $_POST['et_6'];
	
	$st1_7 =$_POST['st_7'];
	$et1_7= $_POST['et_7'];
 

 
//convert time to string format//

 ///$main_date_stringt="".implode(",",array_unique($array1))."";
$main_date_stringt = 0;
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='5'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_1.'",et="'.$et1_1.'",json_date="'.$main_date_stringt.'" WHERE id="5"');           }
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='13'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_2.'",et="'.$et1_2.'",json_date="'.$main_date_stringt.'" WHERE id="13"');           }
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='14'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_3.'",et="'.$et1_3.'",json_date="'.$main_date_stringt.'" WHERE id="14"');           }
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='15'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_4.'",et="'.$et1_4.'",json_date="'.$main_date_stringt.'" WHERE id="15"');           }
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='16'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_5.'",et="'.$et1_5.'",json_date="'.$main_date_stringt.'" WHERE id="16"');           }
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='17'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_6.'",et="'.$et1_6.'",json_date="'.$main_date_stringt.'" WHERE id="17"');           } 
 
		$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='18'");
		if(mysqli_num_rows($check_data1) > 0){
			  mysqli_query($mysqli,'UPDATE date_tbl SET st="'.$st1_7.'",et="'.$et1_7.'",json_date="'.$main_date_stringt.'" WHERE id="18"');           }
 
	
	
	else{
        ///    mysqli_query($mysqli,'INSERT into date_tbl (st,et,json_date)values("'.$st1_1.'","'.$et1_1.'","'.$main_date_stringt.'")'); 

      }



	

}else{

 //// mysqli_query($mysqli,'UPDATE date_tbl SET st="",et="",json_date="" WHERE id="5"'); 

}


//before time work//
if(!empty($_POST['bt']) && isset($_POST['bt'])) {


 $before_time = $_POST['bt'];


  $check_data1=mysqli_query($mysqli,"select * from date_tbl where id='9'");
    if(mysqli_num_rows($check_data1) > 0){
   

          mysqli_query($mysqli,'UPDATE date_tbl SET before_time="'.$before_time.'" WHERE id="9"'); 
           
    
      }else{

            mysqli_query($mysqli,'INSERT into date_tbl (before_time)values("'.$before_time.'")'); 

      }



}else{
  ///mysqli_query($mysqli,'UPDATE date_tbl SET st="",et="",json_date="" WHERE id="9"'); 
}



//before time work//
if(!empty($_POST['at_1']) && isset($_POST['at_1'])) {
 $before_time = $_POST['at_1'];
  $check_data1=mysqli_query($mysqli,"select * from date_tbl where id='10'");
    if(mysqli_num_rows($check_data1) > 0){
          mysqli_query($mysqli,'UPDATE date_tbl SET week="'.$before_time.'" WHERE id="10"');      
    
      }else{
            mysqli_query($mysqli,'INSERT into date_tbl (week)values("'.$before_time.'")'); 
      }
}else{}

//before time work//
if(!empty($_POST['d_off1']) ||!empty($_POST['d_off2']) || !empty($_POST['d_off3'])) {
 	 $d_off1 = $_POST['d_off1'];
	 $d_off2 = $_POST['d_off2'];
	 $d_off3 = $_POST['d_off3'];
	
	if($d_off1!=''){	$datesarry[] = $d_off1;}
	if($d_off2!=''){$datesarry[] = $d_off2;}
	if($d_off3!=''){$datesarry[] = $d_off3;}

	
	
	
	$newsave =  implode(",",$datesarry);
print_r($newsave);	
	
  $check_data1=mysqli_query($mysqli,"select * from date_tbl where id='11'");
    if(mysqli_num_rows($check_data1) > 0){
         mysqli_query($mysqli,'UPDATE date_tbl SET json_date="'.$newsave.'" WHERE id="11"');      
    
      }else{
       ///     mysqli_query($mysqli,'INSERT into date_tbl (json_date)values("'.$before_time.'")'); 
      } 
}else{}

//before time work//
if(!empty($_POST['d_off2']) ||!empty($_POST['d_off2']) || !empty($_POST['d_off2'])) {
 	 $d_off1 = $_POST['d_off2'];
  $check_data1=mysqli_query($mysqli,"select * from date_tbl where id='11'");
    if(mysqli_num_rows($check_data1) > 0){
         mysqli_query($mysqli,'UPDATE date_tbl SET json_date="10-10-1970" WHERE id="11"');      
    
      }else{
       ///     mysqli_query($mysqli,'INSERT into date_tbl (json_date)values("'.$before_time.'")'); 
      } 
}else{}




?>