<?php
require 'db.php';
include 'config.php';
ob_start();
if(isset($_POST['postcode'])){
   $postcode = $_POST['postcode'];
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
             while ($row = $query1->fetch_assoc()) {
             $_SESSION['ispostcodeset']='yes';
             $_SESSION['curntpostcode_id']=$row['postcode_id'];
             $_SESSION['curntpostcode']=$row['postcode'];
             $_SESSION['postcode_min_amt']=$row['postcode_min_amt'];
             $_SESSION['postcode_deli_chrg']=$row['postcode_deli_chrg'];
             $_SESSION['postcode_free_from']=$row['postcode_free_from'];
             
             $echostr= "pass";
             }
         }
        
   echo $response;
   die;
	
}