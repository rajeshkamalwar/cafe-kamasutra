<?php

require 'db.php';
$connect = $mysqli;
$query = "SELECT * FROM tbl_orders WHERE comment_status = 0 and ot_trx_status = 'Success' order by ot_time DESC ";
$result = mysqli_query($connect, $query);
$output = '';
$output2 = '';
$ordersext  =  array();

while($row = mysqli_fetch_array($result)){
	if($row['ot_paymentoption']=='iDEAL'){ 
		$otpayment = 'iDEAL';
	} elseif($row['ot_paymentoption']=='creditcard'){ 
		
		$otpayment = 'Master Card';

	}
	elseif($row['ot_paymentoption']=='PIN'){ 
		
		$otpayment = 'PIN';

	}
	else {
		$otpayment = 'Cash';
		  } 
	
	$data111 = $row["ot_OrderDate"];
	$pstatus = '<a href="printstatus.php?oid='.$row['ot_id'].'"   target="_new"><button type="button" class="btn btn-primary">Ok</button></a>';	
 $output .= '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <audio controls autoplay style="display:none;">
  <source src="good-msg-tone-50191.mp3" >
</audio>
  <table class="table table-hover table-condensed">
 <tr><th>Date</th><th>Time</th><th>Order ID</th><th>Amount</th><th>Payment Option</th></tr>
 <tr><td>' . date_format(new DateTime($data111), "M d, Y") . '</td><td>' . date_format(new DateTime($row["ot_time"]), "H:i") . '</td><td>'.$row["ot_id"].'</td><td>'.$row["ot_TotalAmount"].'</td><td>'.$otpayment.'</td></tr>
 <tr><td> <a  data-dataid='.$row['ot_id'].' class="btn btn-social-icon btn-warning printorderbtn2"   ><i class="fa fa-print"></i></a>      '.$pstatus.'</td></tr>
 </table>
 </div>
 ';
	
}
echo $output;
/*	if($row['ot_paymentoption']=='iDEAL'){ 
		$otpayment = 'iDEAL';
	} elseif($row['ot_paymentoption']=='creditcard'){ 
		
		$otpayment = 'Master Card';

	}else {
		$otpayment = 'Cash';
		  } 
	
	$data111 = $row["ot_OrderDate"];
	$pstatus = '<a data-id="'.$row['ot_id'].'"><button type="button" class="btn btn-primary  autoorderbtn">Ok</button></a>';	
 $output .= '
 <div class="alert alert_default"  box-id="'.$row['ot_id'].'">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <audio controls autoplay style="display:none;">  <source src="good-msg-tone-50191.mp3" ></audio>
  <table class="table table-hover table-condensed"> <tr><th>Date</th><th>Time</th><th>Order ID</th><th>Amount</th><th>Payment Option</th></tr>
 <tr><td>' . date_format(new DateTime($data111), "M d, Y") . '</td><td>' . date_format(new DateTime($row["ot_time"]), "H:i") . '</td><td>'.$row["ot_id"].'</td><td>'.$row["ot_TotalAmount"].'</td><td>'.$otpayment.'</td></tr>
 <tr><td> <a  data-dataid='.$row['ot_id'].' class="btn btn-social-icon btn-warning printorderbtn2" ><i class="fa fa-print"></i></a>      '.$pstatus.'</td></tr> </table> </div>';
	
	 $output2 .= '<a  data-dataid='.$row['ot_id'].' class="btn btn-social-icon btn-warning printorderbtn2" ><i class="fa fa-print"></i></a>';  
	$ordersext[]  = $row['ot_id'];
}
///echo $output;
			$data=array(
			 	  'ordersext'=> $ordersext
					 ); 
	 	
 	   echo json_encode( $data);
 //print_r($data);

*/

?>
