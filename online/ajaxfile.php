<?php
require 'admin/db.php';
include 'admin/config.php';
ob_start();
session_start();
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
if(isset($_POST['postcode'])){
   $postcode = $_POST['postcode'];
   $query = "select count(*) as cntUser from postcode where postcode='".$postcode."'";
   $result = $mysqli->query($query);
	 if($current_lang=="dutch"){
		 $response = "<span style='color: red;'><input type='hidden' name='poid' value='notavailable'>Wij bezorgen niet in deze postcodegebied.</span>";
   
	 } else { 
		 $response = "<span style='color: red;'><input type='hidden' name='poid' value='notavailable'>We do not deliver to this zip code area.</span>";
	 }
   if($result->num_rows){
      $row = $result->fetch_assoc();
      $count = $row['cntUser'];
      if($count > 0){
		  if($current_lang=="dutch"){
          $response = "<input type='hidden' name='poid' value='Available'><span style='color: green;'>bezorg wel.</span>";
		  } else {
			$response = "<input type='hidden' name='poid' value='Available'><span style='color: green;'>Available.</span>";  
		  }
      }
   }
	 $echostr='';
        
        $query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $postcode."' AND `postcode_status`='Active'");
      
        
   echo $response;
   die;
	
}