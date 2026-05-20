<?php
 

include 'admin/db.php';
	$data2=array();
	$query = "Select * From `head_settings`";
		$result_query = $mysqli->query($query);									
			while ($row = $result_query->fetch_assoc()) {							 
			$data2[$row['settings_name']] = $row['sett_data'];
		}
 
?>
 
<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	    <meta http-equiv="refresh" content="1200;url=fresh1.php" />
		<title><?php echo $data2['meta-title'];?></title>	
		<script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--<script src="jquery.redirect.js"></script>-->
    </head>
    <body class="checkout_page2">
    <?php include 'public_header.php'; ?> 
        <div class="container checkoutpage checkoutpage-main" id="checkoutclass">
            <?php
  include 'admin/config.php';
			
 	
include 'css_file.php';
setlocale(LC_ALL, 'nl_NL');			
if (isset($_SESSION['current_lang'])){
    $current_lang = $_SESSION['current_lang'];
}
else{
    $current_lang = "dutch";
    $_SESSION['current_lang'] = $current_lang;
}
$PostcodePageURL = "postcodelist.php";
define('UTF8_ENABLED', '');

function getUserIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
 include 'lang-var.php';
?>
            <script>
              var  b_url1 = 'https://restaurantkamasutra.nl/online/';
              var  currency = '<?php echo '€' . ' '; ?>';
              var   current_lang = '<?php echo $current_lang; ?>';

            </script>

 <div class="row">
      <div class="col-md-12"><br/></div>
        <?php if (!empty($_SESSION["shopping_cart"])){  ?>
                    <form method="post">
                        <div class="col-md-12">
                            <div class="pm-widget">
                                <div class="product_main_category">
                                    <h1 class="main-heading"> <?php
    if ($current_lang == "en")  {         echo "CHECKOUT";    }      else     {          echo "AFREKENEN";      }   ?></h1>
                                </div>
                            </div>
                            <div class="col-md-12" id="error_panel"></div>

                         <div class="field-container">
                            <div class="col-md-6 fields-left">
                                
								<?php if(!isset($_SESSION['username'])){?>
								<h3><?php echo $L_BillingAddress; ?></h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label ><?php echo $L_Firstname; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Firstname" name="CoC_Firstname" >
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Companyname; ?></label>
                                            <input type="text" class="form-control" id="CoC_Companyname" name="CoC_Companyname" >
                                        </div>
                                    </div>
                                </div>
								  <?php if (($_SESSION['current_pick'] ?? 0) == 1)  { ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Streetaddress; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Housenumber" name="CoC_Housenumber" placeholder="<?=$L_Streetaddress_placeholder ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row  postcoderow display-flex">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Postcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Postcode" name="CoC_Postcode" value="<?=$_SESSION['curntpostcode']; ?>"   disabled="true" >
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_TwolettersofyourPostcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_TwolettersofyourPostcode" name="CoC_TwolettersofyourPostcode" pattern="\d{2}" maxlength="2"  minlength="2" >&nbsp;<span id="chk_postcode_errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_TownCity; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_TownCity" name="CoC_TownCity" >
                                        </div>
                                    </div>
                                </div>
								<?php  } ?>
                                <div class="form-group">
                                    <div class="row postcoderow  display-flex">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Phone; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Phone" name="CoC_Phone" pattern="\d{10}" maxlength="10">&nbsp;<span id="CoC_Phone_errmsg"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Emailaddress; ?><span class="required">*</span></label>
                                            <input type="email" class="form-control" id="CoC_Emailaddress" name="CoC_Emailaddress" ><span id="CoC_Emailaddress_errmsg"></span>
                                        </div>
                                    </div>
                                </div> 
							 <?php if (($_SESSION['current_pick'] ?? 0) == 1)  { ?>
							<!--	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $saveaspass; ?><!--<span class="required">*</span>--></label>
                                     <!--       <input type="checkbox" id="saveaspass" name="saveaspass" value="1">
                                        </div>
                                        
                                    </div>
                                </div> -->
								<?php } ?>
								<div class="form-group" id="shopasstext" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $l_password; ?><span class="required">*</span></label>
                                            <input type="password" class="form-control" id="regpassword" name="regpassword">
                                        </div>
                                    </div>
                                </div> 
								<?php } else {  
								$qquery = $mysqli->query("select * from tbl_user where regisid = '".(isset($_SESSION['username']) ? $mysqli->real_escape_string($_SESSION['username']) : '')."' ");
		                        ?>
								<?php if(($_SESSION['current_pick'] ?? 0) == 2){?>
								<h3><?php echo $L_BillingAddress; ?></h3>
								<?php } else { ?>
								<h3><?php echo $L_SelectBillingAddress; ?></h3>
								<?php } ?>
								
								<div class="form-group">
                                    <div class="row">
										<?php while($row_user = $qquery->fetch_array()){
											 $checklogintype = $row_user['login_type'];?>
                                        <div class="col-md-6 col-sm-12">
          <div class="info-box " >
			  <?php if(($_SESSION['current_pick'] ?? 0)==2){?>
            <div class="info-box-content">
              <span class="info-box-text"><?php echo $row_user['usr_first_name']; ?>  </span><br/>
              <span class="info-box-text"><?php echo $row_user['usr_company']; ?> <br/>
				<span ><?php echo $row_user['usr_order_phone'];?></span><br/><span><?php echo $row_user['usr_emailid'];?></span></div>
			  <?php } else { ?>
			  <div class="info-box-content">
              <span class="info-box-text"><?php echo $row_user['usr_first_name']; ?> </span><br/>
              <span class="info-box-text"><?php echo $row_user['usr_streetaddress1']; ?> <br/><?php echo $row_user['usr_zipcode']; ?> <?php echo $row_user['usr_zipcode2letter'];?> <?php echo $row_user['usr_order_city']; ?></span>	<br/>
				<span ><?php echo $row_user['usr_order_phone'];?></span><br/><span><?php echo $row_user['usr_emailid'];?></span></div>
				
				<?php if($checklogintype == 1){ ?>
				
				 <input type="hidden" id="CoC_Housenumber" name="CoC_Housenumber" value="<?php echo $row_user['usr_streetaddress1']; ?>">
			  <input type="hidden" id="CoC_Postcode" name="CoC_Postcode"  value="<?php echo $row_user['usr_zipcode']; ?>">
			  <input type="hidden" id="CoC_TwolettersofyourPostcode" name="CoC_TwolettersofyourPostcode" value="<?php echo $row_user['usr_zipcode2letter']; ?>">
			  <input type="hidden" id="CoC_TownCity" name="CoC_TownCity" value="<?php echo $row_user['usr_order_city']; ?>">
				<?php } ?>
				
			  <?php } ?>
            <!-- /.info-box-content -->
			  <br/>
				
			  <input type="radio" name="userdelid" id="userdelid" value="<?php echo $row_user['usr_id']; ?>">
			  <input type="hidden" id="CoC_Firstname" name="CoC_Firstname" value="<?php echo $row_user['usr_first_name']; ?>">
			  <input type="hidden" id="CoC_Companyname" name="CoC_Companyname" value="<?php echo $row_user['usr_company']; ?>">
				 <?php if(($_SESSION['current_pick'] ?? 0)==2){?>

				<?php }?>
			  <input type="hidden" id="CoC_Phone" name="CoC_Phone" value="<?php echo $row_user['usr_order_phone']; ?>">
			  <input type="hidden" id="CoC_Emailaddress" name="CoC_Emailaddress" value="<?php echo $row_user['usr_emailid']; ?>">
          </div>
          <!-- /.info-box -->
			<?php
						 
									?>
			   <div class="onpickupfields"   style="display:none;">
			                              <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Streetaddress; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Housenumber" name="CoC_Housenumber" placeholder="<?=$L_Streetaddress_placeholder ?>"  value="<?php  if(!empty($row_user['usr_streetaddress1'])){echo $row_user['usr_streetaddress1'];}else{echo $_SESSION['curntpostcode'];  } ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Postcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_Postcode" name="CoC_Postcode" disabled="true" value="<?php  if(!empty($row_user['usr_zipcode'])){echo $row_user['usr_zipcode'];}else{echo $_SESSION['curntpostcode'];  } ?>" >
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_TwolettersofyourPostcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_TwolettersofyourPostcode" name="CoC_TwolettersofyourPostcode" pattern="\d{2}" maxlength="2"  minlength="2"  value="<?php  if(!empty($row_user['usr_zipcode2letter'])){  echo $row_user['usr_zipcode2letter']; } ?>">&nbsp;<span id="chk_postcode_errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_TownCity; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="CoC_TownCity" name="CoC_TownCity" value="<?php  if(!empty($row_user['usr_order_city'])){  echo $row_user['usr_order_city']; } ?>">
                                        </div>
                                    </div>
                                </div>
			  </div><!--.onpickupfields-->	
			  
			  
			  
        </div><?php }/*loop*/ ?>
										<div class="col-md-6 col-sm-12">
											<div class="info-box-new-address">
											<button type="button" class="btn btn-primary new-address" data-toggle="modal" data-target="#myModaladdress"><?php echo $addnewadres; ?></button>
										</div></div>
 </div>
 </div> 
								
							 
								<?php  } ?>
						
								<div class="form-group number-spec">
                                    <div class="row">
									<?php
    $edit_query16 = "SELECT * from `cutlerysetting` ";
    $query_result16 = $mysqli->query($edit_query16);
    $row16 = $query_result16->fetch_array();
    if ($row16['status'] == 'Active')
    {
?>
		<?php if ($row16['chargeoption'] == 'free')
        { ?>
								<h3><?php echo $cutleryhading; ?></h3> <input type="radio" name="cutlery" id="cutlery" value="yes"><?php echo $cutyes; ?> 
										<input type="radio" name="cutlery" id="cutlery"  value="No" ><?php echo $cutrno; ?>
										<?php
        }
        else
        { ?>
								<h3><?php echo $cutleryhading; ?></h3> <input type="radio" class="add_cutlery" name="cutlery" id="cutlery" value="yes" data-id="<?php echo str_replace(',', '.', $row16['charge'])	; ?>"><?php echo $cutyes; ?>
										<input type="radio" name="cutlery" id="cutlery" class="add_cutlery" value="No" data-id="<?php echo str_replace(',', '.', $row16['charge'])	; ?>"><?php echo $cutrno; ?>
									<input type="hidden" name="showcutcharge" id="showcutcharge" value="0">
										<?php
        } ?>
									
								<?php
    } ?>
									</div>
								</div>
									 <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $coupontext; ?></label>
                                            <input type="text" class="form-control"  id="coupon" name="coupon"  >
											<input type="hidden" name="status" id="status" >
											<input type="hidden" name="couponcharge11" id="couponcharge11" >
											<input type="hidden" name="cochargeshow" id="cochargeshow" >
											<input type="hidden" name="couponcodetext" id="couponcodetext" >
											<input type="hidden" name="discounttypeshow" id="discounttypeshow" >
											 <span id="status1" style="color: green;display:none;">Applied</span>
											<span id="status2" style="color: red;display:none;">We are giving discount more then Coupon</span>
											<span id="status3" style="color: green;display:none;">your Coupon discount is more then korting. So korting discount will not apply </span>
<span id="status4" style="color: red;display:none;"><?php if($current_lang=="dutch"){ echo 'Niet geldig'; } else { echo 'Not Valid Expired';} ?></span>
											
                                        </div>
                                    </div>
							</div><!--left-feilds-->

                            <div class="col-md-6 fields-right">
                                <h3><?=$L_Additionalinformation; ?></h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?=$L_Ordernotes; ?></label>
                                            <textarea class="form-control" rows="2" id="CoC_Ordernotes" name="CoC_Ordernotes"  placeholder="<?=$L_Ordernotes_placeholder ?>"></textarea>
                                        </div>
                                    </div>
                                </div>
								<?php
		
		
 
		
    
?>
	<div class="form-group">
             <div class="row">
               <div class="col-md-12 col-sm-12">
               <label><?php if (($_SESSION['current_pick'] ?? 0) ==1) {
        echo $deliverytime;
    }
    else  {
        echo $pickuptime;
    } ?> </label>
				   <?php
	
	 	
    $get_time_data=mysqli_query($mysqli,"select * from date_tbl where id='3'");
    if(mysqli_num_rows($get_time_data) > 0){
    $get_time=mysqli_fetch_assoc($get_time_data); 
     $json_time=$get_time['json_date'] ? $get_time['json_date']:'';
		 $interval=$get_time['json_date'];
    }	   
 
	
  $today_day = date('l');
	 $shifttime_check = $mysqli->query("SELECT * FROM worktime where wt_day  = '" . $today_day . "' ");  
 		 while ($row = $shifttime_check->fetch_assoc()) {
                    $shift_op_tim = strtotime($row['wt_opentime1']);
                    $shift_cl_tim = strtotime($row['wt_closetime1']);   
			  
           }
		$timenow =  strtotime(date('H:i'));	
				
			 if (isset($_SESSION['in_preorder_time']) && $_SESSION['in_preorder_time']==1) {
	  

	     ?>
                <select class="form-control" rows="2" id="del_time" name="del_time">
							 
								 <?php
							   for ($i=$shift_op_tim;$i<=$shift_cl_tim;$i = $i + $interval*60){
									  $currnt_time = strtotime(date('H:i',$i));	
								   print_r($timenow);
									  if($currnt_time<$timenow){
									/// echo '<option>--sd'.date('H:i A',$i).'</option>';
									  }        
									  else{
 										 echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i',$i).'</option>';
								  }
								}					?> 
					</select><?php 
	  	  echo '<h3>We are starting from: '.date('H:i',$shift_op_tim).'</h3>'; 
	  
	  } else { 	   
				   
				   
				   
				   ?>
                <select class="form-control" rows="2" id="del_time" name="del_time">
								<option><?php echo $selecttime; ?></option>
								 <?php
							   for ($i=$shift_op_tim;$i<=$shift_cl_tim;$i = $i + $interval*60){
									  $currnt_time = strtotime(date('H:i',$i));	
								   print_r($timenow);
									  if($currnt_time<$timenow){
									/// echo '<option>--sd'.date('H:i A',$i).'</option>';
									  }        
									  else{
 										 echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i',$i).'</option>';
								  }
								}					?> 
					</select>
				      <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="checkbox">
												<?php  if(($_SESSION['current_pick'] ?? 0)==1){?>
												<input type="hidden" name="pick_or_del" id="pick_or_del" value="delivery">
												<?php } else{ ?>
                                            <input type="hidden" name="pick_or_del" id="pick_or_del" value="pickup"><?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
										
                            </div>  <!--right feilds-->
                            </div><!--field-container-->
								
						  
								
                            <div class="col-md-12 col-sm-12">
                                <label><?=$L_yourorder; ?></label>
                                <div id="cart_details"></div>
								<div id="cartnewdata"></div>
								<div class="box-total"><p class="showdiv" style="display:none;"><td ><b><?php echo $Cutlery_charge; ?></b></td><td align="right" id="cutlerycharges1" ><span id="cutlerycharges1"></span></td></p>
									<p class="tipamttr" id="tipamttr" style="border-bottom: solid 1px #ccc;display:none;"><td colspan="3"><b style="font-size: 16px;
    font-weight: normal;padding-left: 10px;"><?php echo $tiptext; ?> </b></td><td align="right" id="tiptotamtd" ><span id="tiptotamtd1" style="float: right;
    font-size: 17px; padding-right: 14px;"></span></td></p>
									
									<p class="showdivjyocou" style="border-bottom: solid 1px #ccc;display:none;" ><td><b>Coupon <span id="couponcode"></span></b></td><td align="right" id="couponcharge" ><span style="float:right"><span id="showminus">  <span class="coupanminus"><span id="couponcharge"></span><b id="removecoupon" style="display:none;">remove</b></span></td></p>
								 
								<p class="total"><td colspan="3" class="finaltotal"><b><?php echo $finaltotal; ?></b></td><td align="right" id="totalamount1" ><span id="totalamount1"></span></td></p>

								</div>
								</div>
								<input type="hidden" name="cutlerycharges" id="cutlerycharges">
								<input type="hidden" name="totalamount" id="totalamount">
									<input type="hidden" name="totalamount2" id="totalamount2">
                                <?php $odt_safe2 = $_SESSION["cart_details_for_odrtbl"] ?? []; ?>
                                <script>
                                   /// cop_cart_details_js = '<?php echo $odt_safe2['cart_details'] ?? ''; ?>';
                                   /// total_price_js = '<?php echo str_replace(",", "", $odt_safe2['total_price'] ?? ''); ?>';
                                   /// discount_js = '<?php echo str_replace(",", "", $odt_safe2['discount'] ?? ''); ?>';
                                   /// delivery_charge_js = '<?php echo $odt_safe2['delivery_charge'] ?? ''; ?>';
                                   /// finalbill_js = '<?php echo str_replace(",", "", $odt_safe2['finalbill'] ?? ''); ?>';
                               </script>
							<input type="hidden" name="totalamountbase" id="totalamountbase"  value="<?php echo ($_SESSION["order_session"]["base_total"] ?? 0) ?? 0; ?>">
						</div>
							<?php if (strlen($_SESSION["gift_choice_dropdown"] ?? '') > 0)
    { ?>
							<div class="col-md-12 col-sm-12 gift-sec">
								<div class="free_drop"><strong> <?=$L_gift_choice ?></strong>
									<select id="free_item" name="free_item" class="form-control"><?=$_SESSION["gift_choice_dropdown"] ?></select>
								</div></div><?php
	 } ?>
							</div>
							
							
							
							<?php   $query = "Select * From `tipamounts`";
								$result_query = $mysqli->query($query);	
								 while ($row = $result_query->fetch_assoc()) {
									 $tipstatus =  $row['status'];
								 }
	if($tipstatus=='Active'){
								?>
								<div class="tip-section">
								<div class="tip-div">
								<label><?php echo $tip;?></label>							
								
								
								
								<?php 
								 $query = "Select * From `tipamounts`";
								$result_query = $mysqli->query($query);	     
							//	$row = $result_query->fetch_assoc();
   echo '<select name="tipamt"  id="tipamt">  ';?>
	<option value=""><?php echo $choosetip;?></option>   								
	 <?php 
	 while ($row = $result_query->fetch_assoc()) {
		 echo '<option  value="'.$row['tipval1'].'" />€'.$row['tipval1'].'</option> ';
		 	 echo '<option  value="'.$row['tipval2'].'" />€'.$row['tipval2'].'</option> ';
		 	 echo '<option  value="'.$row['tipval3'].'" />€'.$row['tipval3'].'</option> ';
		 	 echo '<option  value="'.$row['tipval4'].'" />€'.$row['tipval4'].'</option> ';
		     echo '<option  value="'.$row['tipval5'].'" />€'.$row['tipval5'].'</option> ';
		 	 echo '<option  value="'.$row['tipval6'].'" />€'.$row['tipval6'].'</option> ';
		     echo '<option  value="'.$row['tipval7'].'" />€'.$row['tipval7'].'</option> ';
		 	 echo '<option  value="'.$row['tipval8'].'" />€'.$row['tipval8'].'</option> ';
		     echo '<option  value="'.$row['tipval9'].'" />€'.$row['tipval9'].'</option> ';
		 	 echo '<option  value="'.$row['tipval10'].'" />€'.$row['tipval10'].'</option> ';
		 
		 
	 }
	echo '</select>'; ?>
							<input type="hidden" value="0" id ="tipinput" name="tipinput">
								</div>
								</div>	
								<?php } ?>
							 
							<br/><br/><br/>
							
							<?php $edit_query13 = "SELECT * from `adm_set` where adm_set_name='ideal' ";
    $query_result13 = $mysqli->query($edit_query13);
    $row13 = $query_result13->fetch_array();

    $edit_query14 = "SELECT * from `adm_set` where adm_set_name='mastercard' ";
    $query_result14 = $mysqli->query($edit_query14);
    $row14 = $query_result14->fetch_array();

    $edit_query15 = "SELECT * from `adm_set` where adm_set_name='paypal' ";
    $query_result15 = $mysqli->query($edit_query15);
    $row15 = $query_result15->fetch_array();
	
	$edit_query17 = "SELECT * from `adm_set` where adm_set_name='cash' ";
    $query_result17 = $mysqli->query($edit_query17);
    $row17 = $query_result17->fetch_array();
	
	$edit_query18 = "SELECT * from `adm_set` where adm_set_name='pin' ";
    $query_result18 = $mysqli->query($edit_query18);
    $row18 = $query_result18->fetch_array();   ?>
							
									
                            <!-- Payment option section -->
                            <div class="col-md-12 col-sm-12 bs-example">
                                <div class="ac-container">
										<?php if ($row17['adm_set_vlu'] == '1')    { ?>
                                    <div class="input-block">
                                        <input class="toggler" id="ac-1" name="paymentoption" type="radio" checked value="COD">
                                        <label class="label-toggle" for="ac-1"> <span><?php
    if ($current_lang == "en")  {           echo 'In Cash';           }
    else
    {                         echo 'Contant';               }
?></span></label>
                                        <div class="form-row">

                                            <div>
                                                <label class="stacked" for="login"><?php
    if ($current_lang == "en") {            echo 'Pay cash on delivery.';             }
    else            {                           echo 'Contant betalen bij aflevering.';                }
?></label>

                                            </div>
                                        </div>
                                    </div>
									
									<?php } if ($row18['adm_set_vlu'] == '1')    { ?>
									 <div class="input-block">
                                        <input class="toggler" id="ac-5" name="paymentoption" type="radio" value="PIN">
                                        <label class="label-toggle" for="ac-5"> <span><?php
    if ($current_lang == "en")  {           echo 'PIN';       }
    else                     {                  echo 'PIN';               }
?></span></label>
                                        <div class="form-row">

                                            <div>
                                                <label class="stacked" for="login"><?php
    if ($current_lang == "en") {             echo 'PIN Payment.';            }
    else                   {                     echo 'PIN Payment.';           }
?></label>

                                            </div>
                                        </div>
                                    </div>
									<?php
    } ?>		
									
									<?php if ($row13['adm_set_vlu'] == '1')
    { ?>
                                    <div class="input-block">
                                        <input class="toggler" id="ac-2" name="paymentoption" type="radio" value="iDEAL">
                                        <label class="label-toggle" for="ac-2"><span>iDEAL</span></label>
                                        <div class="form-row">

                                            <div>
                                                <label class="stacked" for="login">Pay with iDEAL</label>
                                                <?Php
        $tstbk = $mysqli->query("select adm_set_vlu from adm_set where adm_set_name='testbk'")
            ->fetch_object()->adm_set_vlu;
        $bnkurl = "";
        if ($tstbk == "yes")              {
            $bnkurl = "https://www.sisow.nl/Sisow/iDeal/RestHandler.ashx/DirectoryRequest?test=true";
        }
        else                      {
            $bnkurl = "https://www.sisow.nl/Sisow/iDeal/RestHandler.ashx/DirectoryRequest";
        }
        $obj_xml = new SimpleXMLElement($bnkurl, NULL, true);
        $total = $obj_xml
            ->directory
            ->issuer
            ->count();
        $str = "<select name='ideal_issuer' id='ideal_issuer' class='form-control'>";
        for ($i = 0;$i < $total;$i++)
        {
            $strselect = '';
            if ($i == 0)                {                          $strselect = 'selected="selected"';                     }
            $str = $str . "<option value=" . $obj_xml
                ->directory
                ->issuer[$i]->issuerid . " " . $strselect . " >" . $obj_xml
                ->directory
                ->issuer[$i]->issuername . "</option>";            
        }
        $str = $str . "</select>";
        echo $str;
?>
                                            </div>

                                        </div>
                                    </div> 
									<?php
    } ?>
									<?php if ($row14['adm_set_vlu'] == '1')
    { ?>
								 <div class="input-block">
                                        <input class="toggler" id="ac-3" name="paymentoption" type="radio" value="creditcard">
                                        <label class="label-toggle" for="ac-3"><span>Master Card</span></label>
                                       
                                        <div class="form-row">

                                            <div>
                                                <label class="stacked" for="login"><?php
        if ($current_lang == "en")             {                   echo 'Pay With Master Card.';                  }
        else                   {                             echo 'Pay With Master Card.';                  }
?></label>

                                            </div>
                                        </div>
                                    </div> 
									<?php
    } ?>
									<?php if ($row15['adm_set_vlu'] == '1')
    { ?>
									<div class="input-block">
                                        <input class="toggler" id="ac-4" name="paymentoption" type="radio" value="paypalec">
                                        <label class="label-toggle" for="ac-4"><span>Paypal</span></label>
                                        <div class="form-row">  <div>
                                                <label class="stacked" for="login"></label>
                                            </div>
                                        </div>
                                    </div>
									<?php
    } ?>
								</div></div>
							
							<div>
                            <!-- //.Payment option section -->

                            <div class="col-md-12 col-sm-12 mob_vis_div">
								
								<?php
		// Delivery uses postcode_min_amt; pickup uses min_amt
	if ( ( $_SESSION['current_pick'] ?? 0 ) == 2 ) {
		$minamt_cont = $_SESSION['min_amt'] ?? 0;
	} else {
		$minamt_cont = $_SESSION['postcode_min_amt'] ?? 0;
	}
	$totalam_cont = $_SESSION['order_session']['base_total'] ?? 0;
	 
 		if(number_format($totalam_cont,2)>=number_format($minamt_cont,2)){	 ?>
								 
								
                              <input type="button" id="placeodr" value="<?php echo $placeodr_l; ?>" class="btn btn-primary"><br/><br/>
								<?php } ?>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo getUserIpAddr(); ?>"/>
                    </form>

   

                <?php
}
else
{ //Empty Cart
     ?>
                    <div class="col-md-12">
                        <div class="pm-widget">
                            <div class="product_main_category">
                                <h2 class="main-heading">CART</h2>
                            </div>
                        </div>
                        <div class="col-md-12 empty_cart">
                            <?php echo $emptycart_msg; ?>
                            <p><?=$redirect_msg  ?></p>
                        </div>
						 </div>
                    <?php
} ?>
</div></div>
   	<?php include 'public_footer.php';
     include 'newaddress.php';            ?>

<?php  
         $qquery = $mysqli->query("select * from tbl_user where regisid = '".(isset($_SESSION['username']) ? $mysqli->real_escape_string($_SESSION['username']) : '')."' ");
               while($row_user = $qquery->fetch_array()){
				     $checklogintype = $row_user['login_type'];
				    $registeruserid = $row_user['regisid'];
			   }
			?>				
	  <?php if (($_SESSION['current_pick'] ?? 0) == 2)  { ?>
		 <input type="hidden" id="deliveryopt_session" name="deliveryopt_session" value="2">
	<?php } ?>
	  <?php if (($_SESSION['current_pick'] ?? 0) == 1)  { ?>
		 <input type="hidden" id="deliveryopt_session" name="deliveryopt_session" value="1">
	<?php } ?>
			
 <input type="hidden" id="deliveryopt" name="deliveryopt" value="<?php echo $checklogintype ; ?>">
 <input type="hidden" id="registeruserid" name="registeruserid" value="<?php echo $registeruserid ; ?>">
	
			
			
	<?php $discount_query = "Select *  From discount_description";
                $discount_result = $mysqli->query($discount_query);
                $disrow = $discount_result->fetch_assoc();
		        if ($current_lang == "en") {      $dismsg1 = $disrow['rh_msg_en'];                       }
                else {    $dismsg1 = $disrow['rh_msg_nl'];                     }
		
			$discount_query = "Select *  From discount";
                $discount_result = $mysqli->query($discount_query);
                $disrow2 = $discount_result->fetch_assoc();
	
	
        if($disrow2['active'] ==1 ){
        ?>
	  <?php   if (isset($_SESSION['current_pick'])) { ?>  
                <div id="my-welcome-message" class="my-welcome-message"  style="display:none;">
				<?php } else{ ?>
				<div id="my-welcome-message" class="my-welcome-message">
				<?php } ?>
                <div class="my-welcome-message-box">
				<h2><?php echo $disrow2['title2']; ?></h2>
                    <p><?php echo $dismsg1; ?></p>					
					<button type="button" class="btn btn-primary"  id="gorefresh"  style="display:none;">bezorgen</button>
					<a  href="https://restaurantkamasutra.nl/online/setpick.php?action=pickup" class="btn btn-primary"  id="gorefresh_pick"  style="display:none;">bezorgen</a>
			 	<a id="fvpp-close" style="display:none;">✖</a>
				</div>
                    </div>
			
		<script src="jquery.firstVisitPopup.js"></script> 
<script>
			$(function () {
				$('#my-welcome-message').firstVisitPopup({
					cookieName : 'homepage',
					showAgainSelector: '#show-message'
				});
			});
		</script>
		<?php } ?>

		    <script type="text/javascript">

				
				$(document).on('click', '.add_cutlery', function () {
                    var sel_pick = $(this).attr("data-id");
					var cutleryoption = $("input[name='cutlery']:checked").val();
					var finalbill_js = $('#totalamount').val();
                    var finalbill_js33 = $('#totalamount').val();
					
					
				    var currency = "€ ";
					if($(this).val() === "yes"){
                    var action = 'updatecutlerycharges';
						
					var cutlerycharge = sel_pick;
					var cutlerycharge12 = currency.concat(sel_pick);
					var totalamount = parseFloat(finalbill_js) + parseFloat(sel_pick); 
					var totalamountnew = totalamount.toFixed(2);
					var totalamountnew12 = currency.concat(totalamountnew);
					$('.showdiv').show();
					$('#totalamount').val(totalamountnew);
					$('#cutlerycharges').val(cutlerycharge);
					$('#totalamount1').html(totalamountnew12);
					$('#cutlerycharges1').html(cutlerycharge12);
				 
					$('#showcutcharge').val(sel_pick);
					} else { 
					var newselpickcharge = $('#showcutcharge').val();
					var totalamount = parseFloat(finalbill_js) - parseFloat(newselpickcharge);
					var totalamountnew = totalamount.toFixed(2);
					var totalamount12 = currency.concat(totalamountnew);	
					//var totalamount12 = currency.concat(totalamount);
					var cutlerycharge = '';
					$('.showdiv').hide();
					$('#totalamount').val(totalamount);
					$('#cutlerycharges').val(cutlerycharge);
					$('#totalamount1').html(totalamount12);
					$('#cutlerycharges1').html(cutlerycharge12);
					}
                });
             $(document).ready(function() {
             $('#0').hide();
            });
			load_cart_data();
                function load_cart_data()
                {
					var cutlerycharges = $('#cutlerycharges').val();
					
                    var action = "loadcartdata";
                    $.ajax({
                        url: "postcodecheck.php",
                        method: "POST",
                        data: {action: action, },
                        dataType: "json",
                        success: function (data)
                        {
							console.log(data);
							 
							//$('#totalamount1').text(data.totalamount1);
                            $('#cart_details').html(data.cart_details);
							$('#cartnewdata').html(data.cartnewdata);
							var totalamountold = data.totalamount1;
							var cutlerycharges = $('#cutlerycharges').val();
							var currency = "€ ";
							if(cutlerycharges!=''){
							var totalamount = parseFloat(totalamountold)+parseFloat(cutlerycharges);
								var totalamount23 = parseFloat(data.total_amt_1)+parseFloat(cutlerycharges);
								$('#totalamount').val(data.totalamount);
								$('#totalamount1').html(data.total_amt_final2);
									$('#totalamount2').val(totalamount);
								$('#totalamountbase').val(totalamount23);
								
							} else { 
								$('#totalamount').val(data.total_amt_final1);
								$('#totalamount2').val(data.total_amt_final1);
								$('#totalamount1').html(data.total_amt_final2);
								$('#totalamountbase').val(data.total_amt_1);
								 
							}
							if(data.delvery_chrge==0){
								$('.delvery-row').fadeOut(0);
							}
							
                        }
                    });
                }
			$(document).on('click', '.updateqty', function () {
				
	               var product_id = $(this).attr("id");
				   
					   var action = 'updateqty';
                         $.ajax({
							type: "POST",
                            url: "postcodecheck.php",
                            data: {
								product_id: product_id,
								action: action
							},
							  dataType: "html",
                              success: function ()
                            {
                                load_cart_data();
                            }
                        });
                });	
			
				$(document).on('click', '.updateminusqty', function () {
					
	               var product_id = $(this).attr("id");
				    var action = 'updateminusqty';
                          $.ajax({
                        url: "postcodecheck.php",
                        method: "POST",
                            data: {
								product_id: product_id, 
								action: action
							},
                               success: function ()
                            {
                                load_cart_data();
                            }
                        });
                });
			</script>
		<script  language="JavaScript" type="text/javascript">
                        
                        $(document).ready(function () {
  $("#CoC_TwolettersofyourPostcode").keypress(function (e) {
     if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
        $("#chk_postcode_errmsg").html("Alphabates Only").show().fadeOut("slow");
        return false;
    }
   });
   $("#CoC_Phone").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#CoC_Phone_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });
							
  $("#twolettersofyourPostcode").keypress(function (e) {
     if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
        $("#newpostcode_errmsg").html("Alphabates Only").show().fadeOut("slow");
        return false;
    }
   });
							$("#phonenumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#newphone_errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });
				 
});
	 $("#removecoupon").click(function(){
		 var couponcode = $("#couponcode").text();
		 var couponcharge = $("#cochargeshow").val();
		 var totalamount1 = $('#totalamount').val();
		  var currency = "€ ";
		var discounttypeshow = $('#discounttypeshow').val(); 
		 if(discounttypeshow != 'freedish'){
		 var totalamount = parseFloat(totalamount1) + parseFloat(couponcharge);
					var totalamountnew = totalamount.toFixed(2);
					var totalamountnew12 = currency.concat(totalamountnew);
		 
					$('#totalamount').val(totalamountnew);
					$('#totalamount1').html(totalamountnew12);
				 	$('#totalamount2').val(totalamountnew);
			 } 
		$( "#coupon" ).prop( "disabled", false );
		$("#couponcharge").text('');
		$("#couponcharge11").val('');
        $("#couponcode").html('');
		$("#coupon").val('');
		$("#statusfvfv").text('');
				$('.showdivjyocou').hide();
		  
	 });
	 $("#coupon").keyup(function(){
            var coupon = $(this).val().trim();
		 var disc_amt_on=0;
			 var totalamount1 = $('#totalamountbase').val();
					   var disc_amt = $("#discperctgeamt").val();
					 if(disc_amt==null){
						 disc_amt = 0;
						 disc_amt_on =1;
					 }
		 var final_all = 0;
		 
      if(coupon != ''){
	$.ajax({
        type: "POST", // The method of sending data can be with GET or POST
        url: "couponcheck.php", // Fill in url / php file path to destination
        data: {coupon: coupon,disc_amt:disc_amt,totalamount1:totalamount1,disc_amt_on:disc_amt_on}, // data to be sent to the process file
        dataType: "json",
       
	success: function(response){ // When the submission process is successful
	 $('#status4').fadeOut(50);
		console.log(response);
            if(response.status == 1 && response.bigger == 1){ // If the content of the status array is success
				
				var currency = "€ ";
				$("#discounttypeshow").val(response.discount);
				if(response.discount == "freedish"){ 				
				}
				else {
				   $('.showdivjyocou').fadeIn(50);
					$('#couponcode').html(coupon);
					
					$('#couponcharge').html('- '+response.copn_amt);
					$('#cochargeshow').val(response.copn_amt2);
					
					$('#couponcodetext').val(coupon);
					var deliver_charge  = $('.del_cost').val();
					var plastick_charge  = $('.plastic_charge').val();
					var cutlury_charge  = $('.cutlerycharges').val();
					var tip_charge  = $('#tipinput').val();
					
					var after_disc_pric = response.final_amt;
					  if(deliver_charge!=null) { final_all = parseFloat(final_all) + parseFloat(deliver_charge);  }  
					  if(plastick_charge!=null) { final_all =parseFloat(final_all) +parseFloat(plastick_charge);  }  
					  if(cutlury_charge!=null) { final_all =parseFloat(final_all) +parseFloat(cutlury_charge);  }  
					   if(tip_charge!=null) { final_all =parseFloat(final_all) +parseFloat(tip_charge);  } 
					var all_final =   parseFloat(after_disc_pric)+parseFloat(final_all);
					
					 var all_final_format = all_final.toFixed(2);
					 var final_amt_replace = all_final_format.toString().replace(/\./g, ',');
					 var addcurr_fina_amt = currency.concat(final_amt_replace);
					$('#totalamount1').html(addcurr_fina_amt);
					$('#totalamount').val(all_final_format);
				 	$('#totalamount2').val(all_final_format);
					$()
					
					 if(response.bigger == 1){  ///$('#status3').fadeIn(50);
											  $('#kortingrow').fadeOut(100); }
					
					else { ///$('#status1').fadeIn(50);
					}
				}
				$( "#coupon" ).prop( "disabled", true );
      }
		
		
		else{ 
			 if(response.bigger == 0){ ///$('#status2').fadeIn(50); 
			 }
			else{ $('#status4').fadeIn(50); }
      }
		},
         
         });
		  
      }else{
		 
          $("#coupon_newresponse").html("");
	  }

    });
			
			
		 $("#addpostcode").keyup(function(){

      var postcode = $(this).val().trim();
      if(postcode != ''){

         $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {postcode: postcode},
            success: function(response){
      
                $('#postcode_newresponse').html(response);

             }
         });
      }else{
         $("#postcode_newresponse").html("");
      }

    });					
			$("#CoC_Emailaddress").keyup(function(){
				var CoC_Emailaddress = $("#CoC_Emailaddress").val();
				var spass = $("input[name='saveaspass']:checked").val();
				 if(spass=='1'){
					 
         $.ajax({
            url: 'checkemail.php',
            type: 'post',
            data: {emailid: CoC_Emailaddress},
            success: function(response){
			if(response==1){
				  if (current_lang == 'en') {
				   alert("Already registered with this email address");
				  } else {
					  alert("Reeds geregistreerd met dit e-mailadres");
				  }
					$("#shopasstext").hide();
					document.getElementById("saveaspass").checked = false;
				} else {
                   $("#shopasstext").show();
					document.getElementById("saveaspass").checked = true;
				}	
             }
         });
		  }
				
			});
$("#saveaspass").click(function(){
      //var spass = $(this).val().trim();
		//alert(spass);
		var CoC_Emailaddress = $("#CoC_Emailaddress").val();
		var spass = $("input[name='saveaspass']:checked").val();
      if(CoC_Emailaddress != ''){
		  if(spass=='1'){
         $.ajax({
            url: 'checkemail.php',
            type: 'post',
            data: {emailid: CoC_Emailaddress},
            success: function(response){
			if(response==1){
				  if (current_lang == 'en') {
				   alert("Already registered with this email address");
				  } else {
					  alert("Reeds geregistreerd met dit e-mailadres");
				  }
					$("#shopasstext").hide();
					document.getElementById("saveaspass").checked = false;
				} else {
                   $("#shopasstext").show();
					document.getElementById("saveaspass").checked = true;
				}	
             }
         });
		  } else { 
			  $("#shopasstext").hide();
		  document.getElementById("saveaspass").checked = false;
		  }
      }else{
		  if (current_lang == 'en') {
              alert("Enter Email id first");
			  } else { 
              alert("Voer eerst het e-mailadres in");
			  }
		  $("#shopasstext").hide();
		  document.getElementById("saveaspass").checked = false;
      }

    });		
   $("#addpostcode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        if(current_lang=='dutch')
        {$("#posterrmsg").html("alleen cijfer").show().fadeOut("slow");}else{$("#posterrmsg").html("Digits Only").show().fadeOut("slow");}
               return false;
    }
   });
            
            
                        $('#radio1').prop("checked", true);
                        $("#error_panel").hide();
                        $('#collapseOne').on('shown', function () {
                            $('#radio1').prop("checked", true);
                        });
                        $('#collapseTwo').on('shown', function () {
                            $('#radio2').prop("checked", true);
                        });

                        // validate all details before form submiting
                        $(document).on('click', '#placeodr', function () {
							 var usernameaa = '<?php echo $_SESSION['username'] ?? ''; ?>';
						   if (current_lang == 'en') {
								   var errrequird = "is a required field.";
							   }
							else{var errrequird = " is een verplicht veld.";
							}
                            var error_msg = "";
                            $("#error_panel").hide();
                            if ($("#CoC_Firstname").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<b>Billing address First name</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<b>Factuuradres Voornaam</b> "+errrequird;
                                }
                                $("#CoC_Firstname").addClass('error_control');
                            } else {
                                $("#CoC_Firstname").removeClass('error_control');
                            }

						 var deliveryopt_session = $("#deliveryopt_session").val(); 						 
							var deliveryipt = $("#deliveryopt").val();
							var registeruserid = $('#registeruserid').val();
							var delchooseopt = 1;
						  var newuser = 0;
		    if ($("#CoC_Housenumber").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Street address</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Straat en huisnummer</b> "+errrequird;
                                }
                                $("#CoC_Housenumber").addClass('error_control');
                            } else {
                                $("#CoC_Housenumber").removeClass('error_control');
                            }
                            if ($("#CoC_Postcode").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Postcode / ZIP</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Postcode</b> "+errrequird;
                                }
                                $("#CoC_Postcode").addClass('error_control');
                            } else {
                                $("#CoC_Postcode").removeClass('error_control');
                            }

                            if ($("#CoC_TwolettersofyourPostcode").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Two letters of your Postcode</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Twee letters van uw Postcode</b> "+errrequird;
                                }
                                $("#CoC_TwolettersofyourPostcode").addClass('error_control');
                            } else {
                                $("#CoC_TwolettersofyourPostcode").removeClass('error_control');
                            }

                            if ($("#CoC_TownCity").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Town / City</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Plaats</b> "+errrequird;
                                }
                                $("#CoC_TownCity").addClass('error_control');
                            } else {
                                $("#CoC_TownCity").removeClass('error_control');
                            }

                            if ($("#CoC_Phone").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Phone</b> "+errrequird;;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Telefoon</b> "+errrequird;
                                }
                                $("#CoC_Phone").addClass('error_control');
                            } else {
                                $("#CoC_Phone").removeClass('error_control');
                            }
 
						var x = $('#CoC_Emailaddress').val();
                                    	var atposition=x.indexOf("@");
                                    var dotposition=x.lastIndexOf(".");
							if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Email address</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres E-mailadres</b> "+errrequird;
                                }
                                $("#CoC_Emailaddress").addClass('error_control');
                            } else {
                                $("#CoC_Emailaddress").removeClass('error_control');
                            }

 							var saveaspass = $("input[name='saveaspass']:checked").val();
							var regpassword = $("#regpassword").val();
							if(saveaspass=='1'){
                                 if(regpassword==''){
									 if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Password</b> "+errrequird;
                                } else {
                                    error_msg = error_msg + "<br/><b>Wachtwoord</b> "+errrequird;
                                }
									 //return false;
                               }
							}

                            //console.log(error_msg);
                            if (error_msg != '') {
                                $("#error_panel").html('');
                                $("#error_panel").show();
                                $("#error_panel").html(error_msg);
                                $('html, body').animate({scrollTop: $("#error_panel").offset().top}, 500);
                                return false;
                            }
                          if(usernameaa != ''){
								if ($('input[name="userdelid"]:checked').length == 0) {
									if (current_lang == 'en') {
									   alert("Select one address");
										} else { 
										alert("Selecteer uw adres");
										}
                                     return false;
								}
							}
                            url = 'https://restaurantkamasutra.nl/online/customer_info.php';
                            var cust_firstname = $("#CoC_Firstname").val();
                            var cust_companyname = $("#CoC_Companyname").val();
                            var cust_housenumber = $("#CoC_Housenumber").val();
                            var cust_postcode = $("#CoC_Postcode").val();
                            var cust_2lettersofyourPostcode = $("#CoC_TwolettersofyourPostcode").val();
                            var cust_towncity = $("#CoC_TownCity").val();
                            var cust_phone = $("#CoC_Phone").val();
                            var cust_emailaddress = $("#CoC_Emailaddress").val();
                            var cust_ordernotes = $("#CoC_Ordernotes").val();
							var userdelid = $("input[name='userdelid']:checked").val();
							
                            var cust_freeitem = '';
                            if ($('#free_item').length) {
                                cust_freeitem = $("#free_item option:selected").val();
                            } else {
                                cust_freeitem = "no free item";
                            }
                            var pick_or_del=$("#pick_or_del").val();
							var del_time = $("#del_time option:selected").val();
							var ideal_issuer = $("#ideal_issuer option:selected").val();
                            var payment_option_selected = $("input[name='paymentoption']:checked").val();
                            var cutlery = $("input[name='cutlery']:checked").val();
						   <?php $odt_safe = $_SESSION["cart_details_for_odrtbl"] ?? []; ?>
                         /////	 var cop_cart_details_js = '<?php echo $odt_safe['cart_details'] ?? ''; ?>';
                          /////  var total_price_js = '<?php echo str_replace(",", "", $odt_safe['total_price'] ?? ''); ?>';
                         /////   var discount_js = '<?php echo str_replace(",", "", $odt_safe['discount'] ?? ''); ?>';
                          /////  var delivery_charge_js = '<?php echo $odt_safe['delivery_charge'] ?? ''; ?>';
                         ////   var finalbill_js = '<?php echo str_replace(",", "", $odt_safe['finalbill'] ?? ''); ?>';
                            var cutlerycharges = $("#cutlerycharges").val();
							var couponchargene = $("#cochargeshow").val();
							var couponcodetext = $("#couponcodetext").val();
							var totalamount = $("#totalamount").val();
							var tipamt = $("#tipinput").val();
							var plastic_charge = $(".plastic_charge").val();
							$.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    cust_firstname: cust_firstname,
                                    cust_companyname: cust_companyname,
                                    cust_housenumber: cust_housenumber,
                                    cust_postcode: cust_postcode,
                                    cust_2lettersofyourPostcode: cust_2lettersofyourPostcode,
                                    cust_towncity: cust_towncity,
                                    cust_phone: cust_phone,
                                    cust_emailaddress: cust_emailaddress,
                                    cust_ordernotes: cust_ordernotes,
                                    cust_freeitem: cust_freeitem,
                                    payment_option_selected: payment_option_selected,
                                    pick_or_del:pick_or_del,
                                    del_time:del_time,
									cutlery:cutlery,
                                   //// order_details: cop_cart_details_js,
                                   /// total_price_js: total_price_js,
                                   /// discount_js: discount_js,
                                  ////  delivery_charge_js: delivery_charge_js,
                                  ////  finalbill_js: finalbill_js,
								   	totalamount:totalamount,
									userdelid:userdelid,
									cutlerycharges:cutlerycharges,
                                    saveaspass:saveaspass,
                                    regpassword:regpassword,
									couponcodetext:couponcodetext,
									couponchargene:couponchargene,
									tip_amt:tipamt,
								   	delchooseopt:delchooseopt,
									newuser:newuser,
										plastic_charge:plastic_charge,
                                },
                              dataType: "json",
                                success: function (data)
                                {

                                    console.log(data);
                          									
                                if (data.pass_or_fail == "pass")
                                    {
                                        if (data.payment_method == "COD") {
                                     ///   $.redirect('order_received.php', {'order_id': data.order_id  });
               				   location.replace('order_received.php?order_id='+data.order_id);    
                                        }
                                        //, 'order_time': obj.order_time,'payment_method':obj.payment_method,'email':obj.email,'telephone':obj.telephone,'free_item':obj.free_item,'pickup_or_del':obj.pickup_or_del,'first_name':obj.first_name,'companyname':obj.company_name,'address1':obj.address1,'postcode':obj.postcode,'postcode2let':obj.postcode2let,'city':obj.city,'pick_or_del':obj.pick_or_del,'del_time':obj.del_time,'del_time':obj.del_time,'tip_amt':obj.tip_amt
										
										else if (data.payment_method == "PIN") {
                     /*                       $.redirect('order_received.php', {'order_id': obj.order_id, 'order_time': obj.order_time,'payment_method':obj.payment_method,'email':obj.email,'telephone':obj.telephone,'free_item':obj.free_item,'pickup_or_del':obj.pickup_or_del,'first_name':obj.first_name,'companyname':obj.company_name,'address1':obj.address1,'postcode':obj.postcode,'postcode2let':obj.postcode2let,'city':obj.city,'pick_or_del':obj.pick_or_del,'del_time':obj.del_time,'del_time':obj.del_time,'tip_amt':obj.tip_amt
                }); */
		  location.replace('order_received.php?order_id='+data.order_id)
                                        }
                                        
					 else {var description4online=$('#order_table tr:eq(1) td:eq( 0 )' ).text();	  
						    
 location.replace('payment.php?order_id='+data.order_id+'&issuerid='+ideal_issuer+'&total_payable_amt='+data.total_payable_amt+'&payment_method='+data.payment_method);	   
/*$.redirect('payment.php', {'order_id': obj.order_id, 'order_time': obj.order_time,'payment_method':obj.payment_method,'email':obj.email,'telephone':obj.telephone,'free_item':obj.free_item,'pickup_or_del':obj.pickup_or_del,'first_name':obj.first_name,'companyname':obj.company_name,'address1':obj.address1,'postcode':obj.postcode,'postcode2let':obj.postcode2let,'city':obj.city,'pick_or_del':obj.pick_or_del,'total_payable_amt':obj.total_payable_amt,'description':description4online,'issuerid':ideal_issuer,'key':obj.key,'id':obj.id,'rest_title':obj.rest_title,'tip_amt':obj.tip_amt
   }); */
			 }
                                    } 
                                }
                            });
                        });

	jQuery(document).ready(function($) {

   $('#tipamt').on('change', function (e) {
        var optionSelected = $("option:selected", this);
                var selectamt = optionSelected.val() ;

        var totalamount2 = $('#totalamount2').val();

         if(selectamt==NaN || selectamt=='') { selectamt = 0.00; }
        	   var selectamt2 = ',00';

        	var totalfinal = parseFloat(selectamt) + parseFloat(totalamount2);
        	  var  totalfinal22 = totalfinal.toFixed(2);
        	   // var  totalfinal222 =  parseFloat(totalfinal);
        	   var sum2 = totalfinal22.toString().replace(/\./g, ',');

        	   var sum55= parseFloat(selectamt);
        	   var  totalfinal233 = sum55.toFixed(2);
        	   var sum44 = totalfinal233.toString().replace(/\./g, ',');

               $('#totalamount').val(totalfinal22);
        		var currency = "€";
        	  $('#totalamount1').text(currency+sum2);
        		$('#tipinput').val(selectamt);
        		$('#tiptotamtd1').text('');
        	    if(selectamt<10){
        			$('#tiptotamtd1').text(currency + selectamt+selectamt2);
        		}
        	   else{
        		   $('#tiptotamtd1').text(currency + selectamt);
        		  }
		
   
   if(selectamt==NaN || selectamt==''){
	$('#tipamttr').fadeOut(50);
	}
	else{
	$('#tipamttr').fadeIn(50);
	}
      });
}); 

   </script>

</body>
</html>
