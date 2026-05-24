<style>
	.blink-bg{
		color: #fff;
		padding: 10px;
		display: inline-block;
		border-radius: 5px;
		animation: blinkingBackground 2s infinite;
	}
	@keyframes blinkingBackground{
		0%		{ background-color: #10c018;}
		25%		{ background-color: #1056c0;}
		50%		{ background-color: #ef0a1a;}
		75%		{ background-color: #254878;}
		100%	        { background-color: #04a1d5;}
	}
</style>


<?php
require 'db.php';
$connect = $mysqli;
$query = "SELECT * FROM tbl_orders WHERE comment_status = 0 and ot_trx_status = 'Success' order by ot_time DESC ";
$result = mysqli_query($connect, $query);
$output = '';
while($row = mysqli_fetch_array($result))
{
	$link11 = $_SERVER['PHP_SELF'];
    $link22 = explode('/',$link11);
	$link = end($link22);
	$user = "SELECT * FROM tbl_user WHERE usr_id = '".$row['ot_UserId']."' ";
	$result12 = mysqli_query($connect, $user);
	$row_user = mysqli_fetch_array($result12);
	
	$data111 = $row["ot_OrderDate"];
	$pstatus = '<a href="printstatus.php?oid='.$row['ot_id'].'"><button type="button" class="btn btn-primary">Ok</button></a>';	
	if($row['ot_paymentoption']=='iDEAL'){ 
		$otpayment = '<img src="icon.png" style="height: 25px;">';
	} elseif($row['ot_paymentoption']=='creditcard'){ 
		
		$otpayment = '<img src="mastercard.png" style="height: 25px;">';
	}else {
		$otpayment = '<b style="font-size: 15px;">Cash</b>';
		  } 
 $output .= '
<div class="container">
<div class="row">
 <div class="col-sm-6">
          <div class="info-box " >
            <span class="info-box-icon blink-bg" style="font-size:25px;height: 104px;">'.date_format(new DateTime($row["ot_time"]), "H:i").'</span>
 <audio controls autoplay style="display:none;">
  <source src="good-msg-tone-50191.mp3" >
</audio>
            <div class="info-box-content">
              <span class="info-box-text">'.$row_user['usr_first_name'].' '.$row_user['usr_last_name'].'</span>
              <span class="info-box-text">'.$row_user['usr_streetaddress1'].''.$row_user['usr_streetaddress2'].' '.$row_user['usr_zipcode'].' '.$row_user['usr_zipcode2letter'].' '.$row_user['usr_order_city'].'</span>              
				<span class="info-box-text" >€ '.$row['ot_TotalAmount'].' , '.date_format(new DateTime($row["ot_time"]), "H:i").'</span>
				<span class="info-box-text" style="text-align: right;">'.$otpayment.'  <a  data-dataid='.$row['ot_id'].' class="btn btn-social-icon btn-warning printorderbtn2"  target="_new" ><i class="fa fa-print"></i></a>   <a href="printstatus.php?oid='.$row['ot_id'].'&link='.$link.'"   target="_new"><button type="button" class="btn btn-primary">Ok</button></a>   </span>
			  </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
 </div>
 </div> 
 
  
 ';
	
}
echo $output;
?>

