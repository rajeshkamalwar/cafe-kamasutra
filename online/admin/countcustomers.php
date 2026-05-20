

<?php
require 'db.php';
include 'config.php';
ob_start();
if(isset($_POST['days'])){
   $days = $_POST['days'];
   $query = "select count(*) as cntUser from postcode where postcode='".$postcode."'";
   $result = $mysqli->query($query);
   $response = "<span style='color: red;'><input type='hidden' name='poid' value='notavailable'>We do not deliver to this zip code area.</span>";
   if($result->num_rows){
      $row = $result->fetch_assoc();
      $count = $row['cntUser'];
      if($count > 0){
          $response = "<input type='hidden' name='poid' value='Available'><span style='color: green;'>Available.</span>";
      }
   }
	 $echostr='';
        
        $query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $postcode."' AND `postcode_status`='Active'");
        
//        print_r($query1);die();die();die();die();
         if ($query1->num_rows == 0) {$echostr="fail";$_SESSION['curntpostcode']='notset';}
         else{
             
         }
        
   echo $response;
   die;
	
}