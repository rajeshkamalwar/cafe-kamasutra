<?php
require 'admin/db.php';
include 'admin/config.php';
ob_start();
$currency = '€ ';
session_start();
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
if($_SESSION['current_pick']=='both'){
	$currentpick = 'delivery';
} else { 
	$currentpick = $_SESSION['current_pick'];
}
if(isset($_POST['coupon'])){	 
   $coupon = $_POST['coupon'];
	 $disc_amt = $_POST['disc_amt'];
	$totalamount1 = $_POST['totalamount1'];
    $disc_amt_on = $_POST['disc_amt_on'];
	$couponis_bigger = 0;
 $coupn_match = 0;
	
	
	// Check couppon for register users
	
	   $query_reg = "select * from user_customercoupon where couponcode='".$coupon."'";
   $result_3 = $mysqli->query($query_reg);
     
	
	// Check lost csutomer
   $query = "select * from lostcustomercoupon where couponcode='".$coupon."'  ";
   $result = $mysqli->query($query);
      $row = $result->fetch_assoc();
  if($result->num_rows>0){ 	// if coupons	  
	   $check_coupon_validation  = 0;
	   $day = $row['customerdays'];
		  $old = $row['ddate'];
		  $days = $row['validdays'];
		     $new = date("d-m-Y", strtotime($old . " + ".$days." day"));
		     $cdate = date("d-m-Y");
	  	     $discounttype = $row['discount'];	  
      if(isset($_SESSION['username'])){
			  $queryuser = $mysqli->query("select * from tbl_orders where regisid = '".$_SESSION['username']."' ");
			  $countusers = $queryuser->num_rows;
	  }
	  
	      // check coupon Expire
		  if(strtotime($cdate) < strtotime($new)){		 
			  $_SESSION['coupon_id'] = $row['id'];
			  if($row['discount']=='fixamount'){
				  $couponcharge = $row['fix_amount'];
				   $final_amt = number_format($totalamount1 - $couponcharge,2);
				    $coupon_dis = $row['fix_amount'];
			  } else if($row['discount']=='percentage'){ 
				  $peramt = $row['per_amount'];				  
                  $couponcharge = ($totalamount1*$peramt)/100;
				   $final_amt = number_format($totalamount1 - $couponcharge,2);	
				    $coupon_dis = $row['per_amount'];
			  } else { 
				  $couponcharge = $row['freedishname'];
				   $final_amt = number_format($totalamount1);
			  }
			  	
			  
			   $check_coupon_validation = 1;
			  // if discount is bigger
			   if($disc_amt_on==1 && $couponcharge>$disc_amt ){
				  $couponis_bigger = 1;
			  }	
			  else if($disc_amt!=0 && $couponcharge>$disc_amt ){
				  $couponis_bigger = 1;
			  }	
			 
		  }
	  
	  else{
		  $check_coupon_validation = 0;
	  }	  
	  
	if($row['delivery_type']=='delivery' || $row['delivery_type']=='both'){
		$counonon_method = 1;
	}
	else{
			$counonon_method = 2;
	}
	if($currentpick==$counonon_method){ // if coupon methid is same as choosed method 
	     if($row['id']==1){ // if delivery method is both
			 
			 
		  }		
		  		  
		  else{ /* if method is delivery */ }		
		    $response = array(
			  'status' =>1,			
 			  'copn_amt' =>  $currency .''.number_format($couponcharge, 2, ",", "."),
			  'copn_amt2' => number_format($couponcharge, 2),
			  'copn_per' =>  $coupon_dis,	
			  'copn_expr' =>$check_coupon_validation,
			  'final_amt'=>   $final_amt,
			  'final_amt2'=>   $currency .''.number_format($final_amt, 2, ",", "."),	
		      'coup_type'=>  $discounttype,	
			  'bigger' =>$couponis_bigger 	
			 ); 
		 
	}// coupon method 
	  else{// if coupon methid is not matched
		     $coupn_match = 1;
	  }
	  if($countusers==0){
		    $response = array(
			  'status' =>4,
			  'msg' => 'Login First'	
			 ); 	  
	  }
	  if($coupn_match == 1){
		    $response = array(
			  'status' =>4,
			  'msg' => 'Wrong'	
			 ); 
	  }
	  
	  if($check_coupon_validation == 0){
		    $response = array(
			  'status' =>0,
			  'msg' => 'Coupon Expired'	
			 ); 
	  }
	  
	  
   } // lsot customre code end
	
	
	// common voucher for register users
	else if($result_3->num_rows>0){ 	
		  $row = $result_3->fetch_assoc();
		 $check_coupon_validation  = 0;
	   $day = $row['customerdays'];
		  $old = $row['ddate'];
		  $days = $row['validdays'];
		     $new = date("d-m-Y", strtotime($old . " + ".$days." day"));
		     $cdate = date("d-m-Y");
	  	     $discounttype = $row['discount'];	  
      if(isset($_SESSION['username'])){			  
			  $countusers = 1;
	  }
	  
	      // check coupon Expire
		  if(strtotime($cdate) < strtotime($new)){		 
			  $_SESSION['coupon_id'] = $row['id'];
			  if($row['discount']=='fixamount'){
				  $couponcharge = $row['fix_amount'];
				   $final_amt = number_format($totalamount1 - $couponcharge,2);
				    $coupon_dis = $row['fix_amount'];
			  } else if($row['discount']=='percentage'){ 
				  $peramt = $row['per_amount'];				  
                  $couponcharge = ($totalamount1*$peramt)/100;
				   $final_amt = number_format($totalamount1 - $couponcharge,2);	
				    $coupon_dis = $row['per_amount'];
			  } else { 
				  $couponcharge = $row['freedishname'];
				   $final_amt = number_format($totalamount1);
			  }
			  				  
			   $check_coupon_validation = 1;
			  // if discount is bigger
			  if($disc_amt!=0 && $couponcharge>$disc_amt ){
				  $couponis_bigger = 1;
			  }			 
		  }	  
	  else{
		  $check_coupon_validation = 0;
	  }	  
	  
	if($row['delivery_type']=='delivery' || $row['delivery_type']=='both'){
		$counonon_method = 1;
	}
	else{
			$counonon_method = 2;
	}
	if($currentpick==$counonon_method){ // if coupon methid is same as choosed method 
	     if($row['id']==1){ // if delivery method is both
		  }		
		  		  
		  else{ /* if method is delivery */ }		
		    $response = array(
			  'status' =>1,			
 			  'copn_amt' =>  $currency .''.number_format($couponcharge, 2, ",", "."),
			  'copn_amt2' => number_format($couponcharge, 2),
			  'copn_per' =>  $coupon_dis,	
			  'copn_expr' =>$check_coupon_validation,
			  'final_amt'=>   $final_amt,
			  'final_amt2'=>   $currency .''.number_format($final_amt, 2, ",", "."),	
		      'coup_type'=>  $discounttype,	
			  'bigger' =>$couponis_bigger 	
			 ); 
		 
	}// coupon method 
	  else{// if coupon methid is not matched
		     $coupn_match = 1;
	  }
	  if($countusers==0){
		    $response = array(
			  'status' =>4,
			  'msg' => 'Login First'	
			 ); 	  
	  }
	  if($coupn_match == 1){
		    $response = array(
			  'status' =>4,
			  'msg' => 'Wrong'	
			 ); 
	  }
	  
	  if($check_coupon_validation == 0){
		    $response = array(
			  'status' =>0,
			  'msg' => 'Coupon Expired'	
			 ); 
	  }				
	}
	
	
   else{ // promo coupon code

	    $query = "select * from promotion_discount_code_tbl where coupon_code='".$coupon."'";
	  	$result = $mysqli->query($query);
      $result4 = $mysqli->query($query);
      	$row = $result->fetch_assoc();
				  $promocode = $row['coupon_code'];
				  $promocodamte = $row['discount'];
				
				 $expdate = $row['expire_at'];
				  $cdate = date("d-m-Y");
	   			  $coupon_dis = $row['discount'];
	   
				if(!empty($promocode)){					
				if(strtotime($expdate) > strtotime($cdate)){					 
				  $peramt = $promocodamte;
				  $pieces = explode(" ", $totalamount1);
				  $percharge = $pieces[1];
					 $totalamount1 = $totalamount1;
                     $couponcharge = ($totalamount1*$peramt)/100;
						$couponcharge = $couponcharge;
					  $final_amt = number_format($totalamount1 - $couponcharge,2);	
					 if($disc_amt!=0 && $couponcharge>$disc_amt ){
						 $couponis_bigger = 1;
					 }
					
							   $response = array(
							  'status' =>1,			
							  'copn_amt' =>  $currency .''.number_format($couponcharge, 2, ",", "."),
								    'copn_amt2' =>number_format($couponcharge, 2),
							  'copn_per' =>  $coupon_dis,	
							  'copn_expr' =>$check_coupon_validation,
							  'final_amt'=>   $final_amt,
							  'final_amt2'=>   $currency .''.number_format($final_amt, 2, ",", "."),	
							  'coup_type'=>  $discounttype,	
							  'bigger' =>$couponis_bigger 	
							 );
				}
				}
			    else{
					   $response = array('status' =>33);
					}
	   
   }

	  if($result->num_rows==0 && $result_3->num_rows==0 &&  $result4->num_rows==0){
		   $response = array('status' =>33);
	  }
	
   
   echo json_encode($response);
}
	
?>