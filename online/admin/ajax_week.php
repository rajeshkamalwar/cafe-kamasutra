<?php 
//Database connection
require_once 'db.php';
//code date range//

if(!empty($_POST['week']) && isset($_POST['week'])) {

$week=$_POST['week'] ? $_POST['week']:'';

$current_dates=date('Y-m-d');
$yearEnd = date('Y-m-d', strtotime('12/31'));
$dateSun=[];
$d_array = array();
foreach ($week as $key => $value) {

 $dateSun[] = getAllDays($current_dates, $yearEnd,$week[$key]);


foreach($dateSun as $index => $date)
{
 
  foreach($date as $k => $d)
{
  $d_array[] = $d;
} 

}

}


//convert date to string format//

 $main_date_string="'".implode("','",array_unique($d_array))."'";
 $break_week=implode(",",$week);

  $check_data=mysqli_query($mysqli,"select * from date_tbl where id='2'");
    if(mysqli_num_rows($check_data) > 0){
   

          mysqli_query($mysqli,'UPDATE date_tbl SET week="'.$break_week.'",json_date="'.$main_date_string.'" WHERE id="2"'); 
           
    
      }else{

            mysqli_query($mysqli,'INSERT into date_tbl (week,json_date)values("'.$break_week.'","'.$main_date_string.'")'); 

      }
}else{
            mysqli_query($mysqli,'UPDATE date_tbl SET week="",json_date="" WHERE id="2"'); 

}


 function getAllDays($startDt, $endDt, $weekNum)
  {


    $startDt = strtotime($startDt);
    $endDt = strtotime($endDt);
    $dateSun = array();
   
    do
    {
        if(date("w", $startDt) != $weekNum)
        {
            $startDt += (24 * 3600); // add 1 day
        }
    } while(date("w", $startDt) != $weekNum);
    while($startDt <= $endDt)
    {
        $dateSun[] = date('d/m/Y', $startDt);
        $startDt += (7 * 24 * 3600); // add 7 days
    }

    return($dateSun);
}



if($_POST['time_set']=='time_set'){



  if(!empty($_POST['time']) && isset($_POST['time'])) {

        $check_data=mysqli_query($mysqli,"select * from date_tbl where id='3'");
    if(mysqli_num_rows($check_data) > 0){
   

          mysqli_query($mysqli,'UPDATE date_tbl SET json_date="'.$_POST['time'].'" WHERE id="3"'); 
           
    
      }else{

            mysqli_query($mysqli,'INSERT into date_tbl (json_date)values("'.$_POST['time'].'")'); 

      }


    }else{
            mysqli_query($mysqli,'UPDATE date_tbl SET json_date="" WHERE id="3"'); 

         }
}


//person set//


if($_POST['person_set']=='person_set'){



  if(!empty($_POST['person']) && isset($_POST['person'])) {

        $check_data=mysqli_query($mysqli,"select * from date_tbl where id='4'");
    if(mysqli_num_rows($check_data) > 0){
   

          mysqli_query($mysqli,'UPDATE date_tbl SET json_date="'.$_POST['person'].'" WHERE id="4"'); 
           
    
      }else{

            mysqli_query($mysqli,'INSERT into date_tbl (json_date)values("'.$_POST['person'].'")'); 

      }


    }else{
            mysqli_query($mysqli,'UPDATE date_tbl SET json_date="" WHERE id="4"'); 

         }
}

?>