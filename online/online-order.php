
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
	<title><?php echo $data2['meta-title'];?></title>		
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta http-equiv="refresh" content="1200;url=fresh1.php" />
	<meta name="description" content="<?php echo $data2['meta_des'];?>"/>	
    <script src="jquery.min.js"></script>    
    <link rel="shortcut icon" href="<?php echo $data2['fav-icon']; ?>">  		
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
     .resopnclose ,.noworking{display: none;}
    </style>    </head>
    <body>    
<?php include 'public_header.php';?>
 
        <div class="container fullwidth">
            <?php
		
            include 'css_file.php';
            include 'lang-var.php';
  

 ///echo '<pre>';
/// print_r($_SESSION);
 ///echo '</pre>';

 	
			
           /* $_SESSION['current_lang']='en';*/
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
if(!isset($_SESSION['current_pick'])){$_SESSION['current_pick']=2;}
           $current_lang = $_SESSION['current_lang'];
            define('UTF8_ENABLED', '');
              $currency = '€';
            ?>

            <script>
                b_url1 = '<?php echo online_base_url; ?>';
                currency = '<?php echo $currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
            </script>
           <input type="hidden" id="current_lang" value="<?php echo $current_lang; ?>">
            <input type="hidden" id="current_postcodeis" value="<?php
            if ($_SESSION['current_pick']==1 && isset($_SESSION['curntpostcode_id'])) {
                echo $_SESSION['curntpostcode_id'];
            } else {
                echo "notset";        
            }
            ?>">    
            <input type="hidden" id="current_productprice" value="" >
            <input type="hidden" id="current_productname" value="" >
            <input type="hidden" id="current_productid" value="" >
       
<?php				
// check preorder							
$query = $mysqli->query("SELECT * FROM `worktimecheck` where id=1 ");
$row = $query->fetch_array();							
$preorder_now = $row['preorder'];							
							
$resdelvery_msg ='';
$resdelvery_msg2 ='';			
$holidayclose = 0;
$displayhide = '';			
			
 // Restaurant active No active
			    $daystatus_query = "Select *  From daystatus";
                $daystatus_result = $mysqli->query($daystatus_query);
				$rowstatus = $daystatus_result->fetch_assoc();
				/// $status_active = $rowstatus['status'];				
				  $status_date = $rowstatus['cdate'];			
				if($current_lang=='en'){	 $status_msg = $rowstatus['rh_msg_en'];		}
			    else{	 $status_msg = $rowstatus['rh_msg_nl'];		}
			
			 $today = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));
			 $status_date2 = date('Y-m-d', strtotime($status_date));
			
			   if ($status_date2==$today ){
				    $status_active = $rowstatus['status'];
			   }
		  	else{
				$status_active = "Active";
			}
			
			
			
// CHeck restaurant holiday
  $supply4 = $mysqli->query("SELECT * FROM restraholidays");  
         while ($row = $supply4->fetch_assoc()) {
                    $rh_start_date = $row['rh_start_date'];
                    $rh_end_date = $row['rh_end_date'];
                    $rh_msg_en = $row['rh_msg_en'];
                    $rh_msg_nl = $row['rh_msg_nl'];

             }  
            $today = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));
            $stratDate = date('Y-m-d', strtotime($rh_start_date));
            $endDate = date('Y-m-d', strtotime($rh_end_date));

           // if holdays on (restaurant closed)
            if (($today >= $stratDate) && ($today <= $endDate)){
				 $holidayclose = 1;
                   /// echo $weekoff;
                    $resopnclose = 'resopnclose';
            }
            else{
            $today_day = date('l');
            $time_now = date("H:i");    
            $today_d= date("y-m-d");
  
				
				
// Check service type (Delivery , pickup and both)				
	  $query12 = $mysqli->query("SELECT * FROM `deliveryinfo` where id=1 ");
	  $row12 = $query12->fetch_array();				
	  $service_type = $row12['pickup'];		

			 
				
			
 // check shift 1
 
$shift_check ='';	
$resopen_time = 0;
$resclse_time = 0;	
$resopen_time2 = 0;
$resclse_time2 = 0;
$shift_open = 0;
$opentime_remains = 0;
 $shifttime_check = $mysqli->query("SELECT * FROM worktime where wt_day  = '" . $today_day . "' ");  
  while ($row = $shifttime_check->fetch_assoc()) {
                    $shift_op_tim = $row['wt_opentime1'];
                    $shift_cl_tim = $row['wt_closetime1'];
                    $shift_check = $row['wt_SHIFT1openORclose'];
                       }
           
            $current_time = $time_now;
            $sunrise = $shift_op_tim;
            $sunset =  $shift_cl_tim;
            $date1 = DateTime::createFromFormat('H:i', $current_time);
            $date2 = DateTime::createFromFormat('H:i', $sunrise);
            $date3 = DateTime::createFromFormat('H:i', $sunset);
            if ( $shift_check=="open" )  //($date1 > $date2) && ($date1 < $date3 ) &&
            {
                    if ( $date1 <  $date2 ){ //  ho starting time
       					 $resdelvery_msg =  $serve_start_from.' '.$sunrise;
						 $resdelvery_msg2 =  $resdelvery_msg_text.' '.$sunrise;
						 $befoeropen_pick = $openfrom_pick.' '.$sunrise; 
						  $resdelvery_msg_first =  $serve_start_from.' '.$sunrise;
						$opentime_remains = 1;
                    }
				   else if( $date1 < $date3 ){ //  how ending time
					      $resdelvery_msg =  $serve_till.' '.$sunset;
						  $resdelvery_msg2 =  $pick_till.' '.$sunset;						  
					   $resclse_time = 1;
					   $opentime_remains = 0;
                    }
					else{	
						$resclse_time2 = 1;
					}					
				  if ( $date1 >  $date2  && $date1 < $date3){
					   $resopen_time = 1;
				  }				
            }  
            else{    
                   $resopnclose = 'resopnclose';
             }
            echo '<br>';

 
	 

if($resclse_time==0 && $opentime_remains ==0){
 // check shift 2
 $shifttime_check = $mysqli->query("SELECT * FROM worktime where wt_day  = '" . $today_day . "'");
  while ($row = $shifttime_check->fetch_assoc()) {
                    $shift_op_tim = $row['wt_opentime2'];
                    $shift_cl_tim = $row['wt_closetime2'];
                      $shift_check2 = $row['wt_SHIFT2openORclose'];
   }  
            $current_time = $time_now;
            $sunrise = $shift_op_tim;
            $sunset =  $shift_cl_tim;
            $date1 = DateTime::createFromFormat('H:i', $current_time);
            $date2 = DateTime::createFromFormat('H:i', $sunrise);
            $date3 = DateTime::createFromFormat('H:i', $sunset);
  		  if ( $shift_check2=="open" ) //($date1 > $date2) && ($date1 < $date3 ) &&
            {
			  $resclse_time = ''; $resclse_time2 = '';
                  if ( $date1 <  $date2 ){ //  ho starting time
       					 $resdelvery_msg =  $serve_start_from.' '.$sunrise;
					  
						 $resdelvery_msg2 =  $resdelvery_msg_text.' '.$sunrise;
						 $befoeropen_pick = $openfrom_pick.' '.$sunrise; 
                    }
				   else if( $date1 < $date3 ){ //  how ending time
					      $resdelvery_msg =  $serve_till.' '.$sunset;
						 $resdelvery_msg2 =  $pick_till.' '.$sunset;	
					  
					   $resclse_time = 1;
                    }
					else{	
						$resclse_time2 = 1;
					}	
				
				  if ( $date1 >  $date2  && $date1 < $date3){
					   $resopen_time = 1;
				  }				
            }
			else{   ///echo $close4theday;
                 $resopnclose = 'resopnclose';
             }				
			}			
				
				
            }// if restaurant not closed
			
			
	 
			
if(!isset($_SESSION['min_amt'])){
	$query = $mysqli->query("SELECT * FROM `minorder` where id=1 ");
	$row = $query ? $query->fetch_array() : null;
	$_SESSION['min_amt'] = $row ? $row['min_amt'] : 0;
}

if(!isset($_SESSION['current_pick'])){				
	if($service_type=="pickup"){
		$query = $mysqli->query("SELECT * FROM `minorder` where id=1 ");
			$row = $query->fetch_array();
		if($preorder_now!=0){
		     $_SESSION['current_pick'] = 2;
			 $_SESSION['min_amt']=$row['min_amt'];
		}
		elseif($preorder_now==0 && $resopen_time==1){
		     $_SESSION['current_pick'] = 2;
			 $_SESSION['min_amt']=$row['min_amt'];
		
		}
			 
	}
	
}
		    ?>
		
         
          
            <!-- Main popup -->
		   <?php 
			$closeonpcik = 0;
			if (isset($_SESSION['current_pick']) && $service_type=="pickup" && $preorder_now==1 && $resopen_time==0 && $resclse_time2!=1 &&  $_SESSION['order_session']['base_total']==0)    { 
				$closeonpcik = 1;
			?>
              <div id="myModalNew" class="modal fade in " tabindex="-1"   style="display: block">
            <?php }    
             elseif (isset($_SESSION['current_pick']) && $service_type=="pickup" ) {  ?>
              <div id="myModalNew" class="modal fade in" tabindex="-1"   style="display: none">
            <?php }  
			    elseif (isset($_SESSION['current_pick'])) {  ?>
				     <div id="myModalNew" class="modal fade in" tabindex="-1"   style="display: none">
			<?php } else{ ?>
              <div id="myModalNew" class="modal fade in" tabindex="-1"   style="display: block">
            <?php } ?>

                <div class="modal-dialog modal-sm">
				
					
                    <div class="modal-content">
                        <div class="modal-body msg-body">
                            <button type="button" class="close" data-dismiss="modal" id="modal2" aria-hidden="true">×</button>
			 		<?php	
					
						if($holidayclose==1){
							if($current_lang=='en'){echo $rh_msg_en ; }else{ echo  $rh_msg_nl;   }	 
							$_SESSION['res_close'] = 1;				
						 
						}	 
 						elseif($status_active=='Close'){
							echo $status_msg;
							$_SESSION['res_close'] = 1;	 						 
						}
							 elseif($shift_check=="open" && $resopen_time==0 && $resclse_time2==1){								 
								 echo $status_msg;
								 $_SESSION['res_msg'] = $status_msg;	
								 
						  
							
								  
							 }
							elseif($shift_check=="open" && $resopen_time==0 &&$resclse_time2!=1 ){// res opening msg
								if($service_type=="pickup"){ echo $befoeropen_pick; }
								else{ echo $resdelvery_msg; }	
							  
												
							$_SESSION['res_msg'] = $resdelvery_msg;		
						 
								
							}
						 elseif($shift_check=="open" && $resclse_time==1 && $resclse_time2!=1){ // res closing msg
						 	 if($service_type=="pickup"){ echo $resdelvery_msg2; }
								else{ echo $resdelvery_msg; }
								$_SESSION['res_msg'] = $resdelvery_msg;
						       
							}	
							
							elseif($shift_check2=="open" && $resopen_time==0 &&$resclse_time2!=1 ){// res opening msg
								if($service_type=="pickup"){ echo $resdelvery_msg2; }
								else{ echo $resdelvery_msg; }
									 
							$_SESSION['res_msg'] = $resdelvery_msg;		
								 
							}
						 elseif($shift_check2=="open" && $resclse_time==1 && $resclse_time2!=1){ // res closing msg
						 	 if($service_type=="pickup"){ echo $resdelvery_msg2; }
								else{ echo $resdelvery_msg; }
								$_SESSION['res_msg'] = $resdelvery_msg;
														}	
						elseif($shift_check=="close"){
								echo   $close4theday;
							$_SESSION['res_close'] = 1;
							 
							}
						 elseif($resclse_time2==1){
								echo   $close4theday;
								$_SESSION['res_close'] = 1;
							
							}
							else{
								 
								/// echo $resdelvery_msg;
								 
							}
							
							
						 
	$displayhide = 'noworking';						
			// if res holiday No. open timing match and preorder on	
					
		if($holidayclose==0){
				$displayhide = 'working';				
				if($shift_check=="close" && $shift_check2!="open"){ // if shift closed
					$displayhide = 'noworking';
				}
				elseif($status_active=='Inactive'){
					$displayhide = 'noworking';
				}				
			  else if($shift_check=="open" &&  $resopen_time==0 && $preorder_now==0 && $shift_check2!="open"){
				// if open time 0 and preorder not
					$displayhide = 'noworking';
				}
			   else if(($shift_check=="open" &&  $resopen_time==0) && $preorder_now==1 && $resclse_time2!=1){
					 $displayhide = 'working';
				}
		       else if($shift_check=="open" &&  $resopen_time==1){
					 $displayhide = 'working';
				}
				else if($shift_check2=="open" &&  $resopen_time2==1){
					/// if shift 2 is open
					$displayhide = 'working';
				}	
			   elseif($resclse_time2==1){
					$displayhide = 'noworking';
				}	
			
	if($closeonpcik==1){ $displayhide = 'noworking'; }
			}
 		?>
						
          </div>
						
         <div class="modal-body <?php echo $displayhide; ?>">
             <p class="popupheading"><?php if($service_type=="both"){  echo  $Deliveryprefer; } ?></p>
           <div class="choose-method <?php $resopnclose; ?>"> 
			   
			<?php if (isset($_SESSION['username']) && $_SESSION['username']!=1){ ?>
			   <a  href="<?php echo online_base_url; ?>setpick.php?action=delivery" class="btn btn-primary"><?php echo $deiveryup;?></a>
			 <?php }  else{ if($service_type=="both"){ ?>  
            <button onclick="myFunction12()" class="btn btn-primary"><?php echo $deiveryup;?></button>
			   <?php } } ?>
			   <?php if($service_type!="delivery"){ ?>
            <a href="<?php echo online_base_url; ?>setpick.php?action=pickup"  class="btn btn-primary" id="select_en_delivery" data-id="pickup"><?php echo $pickup; ?> </a>
			   <?php } ?>			 
        	</div>
            <?php if($service_type=="both"){ ?><div id="myDIV"  style="display: none"><?php }
				 if($service_type=="delivery"){  ?><div id="myDIV"><?php } ?>
                         <p><?= $PostcodePopupP1; ?></p>
                            <form method="post" id="pc_form" name="pc_form">
 <input type="text" id="chk_postcode" class="form-control" placeholder="1234" pattern="\d{4}" maxlength="4" ><span id="chk_postcode_errmsg"></span>
 <input type="button" class="btn btn-primary btn-padd2  btn-style2" name="pc_submit" id="pc_suit" value="<?= $btntext; ?>">
				 <span id="post_err"></span></form>
                 <p><a href="<?= $PostcodePageURL; ?>" target="_blank"><?= $PostcodePageURLtxt; ?></a></p>
              </div>
                         </div><!--msg-body-->						 
                    </div><!--modal-content-->
                </div>
            </div>
				  
            <!-- //.postcode popup -->
            <!-- options popup -->
         
             <div id="myModalNew1" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body">
                           <div class="modal-header modal-header1"> <p class="popupheading"><?php echo $option_l;?><button type="button" class="close" data-dismiss="modal" id="modal3" aria-hidden="true">×</button></p>
							   <div class="maintitle"><h4></h4><p class="pro_pop_info"></p><div class="pricepop"><span></span>
		<input type="hidden" class="pricedish" value=""></div></div>
							   <input type="hidden" class="newpriadd" value="0.00">
							   </div>
                            <p></p>
                            <form method="post" id="pc_form2" name="pc_form2">
                            </form>
						</div><!--modal-body-->
     <div class="modal-footer">
               <div class="select_main_quty">                 
                  <!--<div class="col-md-9"><a class="reset_variations">Reset</a></div>  -->
				   <div class="col-md-9 quantity-row"><span><?php echo $quan_l; ?></span>
                    <input type="number" id="quantity" class="form-group" min="1" max="" name="quantity" value="1" size="4" pattern="[1-9]*" inputmode="numeric">
                    </div>                    
                    <div class="col-md-3"></div><div class="col-md-9" id="tcfs"></div>
                    <input type="hidden" name="tcfs33" id="tcfs33" />
                    <input type="hidden"   class="variable_prices" value="" />
                        <input type="hidden" name="required" id="required-attr"  value="0" />
                           <div class="submit-btn"><div class="warchoose"  style="display:none;"><?php echo $attrreq_war; ?></div>
                           <input type="button" name="submit" id="attrib_add_to_cart" class="btn btn-primary pull-right" value="<?php echo $add_btn_l; ?>" /></div></div><!--modal-footer-->
                         </div>
                    </div>
                </div>
            </div>
			
			  <!-- product image popup-->
			 <div class="modal fade" id="modal-viewimage">
                    <div class="modal-dialog imageview"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>                                    
                                </div>
                                <div class="modal-body">
                                    <div class="box-body" id="view_img_data"><img src=""></div>
                                </div>          
                         </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
				  
			        
            <div class="row online-order-page display-flex">
               <div class="col-md-3 sidebarleft">
                    <div class="pm-widget" id="sticky1">
                         <div class="product_main_category">
                            <h6 class="main-heading">Menu <span class="mob_close_btn">X</span></h6>
                                 <div class="sidenav">
                                 <ul class="main_category">
	  <?php 
	$query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where  `discount` != 0  AND `discountdays` !='none'");
	if( $query_postdel11->num_rows>0){	?>
									<li><a href="#today-discount"><?php echo $todadis; ?></a></li>	
	 <?php } ?>
					<?php
						
									 
						 $all_cats = array();						  
						  // Get categories order
                           $main_cat = $mysqli->query("SELECT *   FROM `menu_order`");
                           $roww = $main_cat->fetch_assoc();
                           $cat_name = $roww['cat_sort_order'];									 
							$getcategores = $mysqli->query("SELECT * FROM `categories` ");		 
			                while ($row_cat = $getcategores->fetch_assoc()){							  							 
									$all_cats[] =  $row_cat['cat_id'];								 
					       }							 			 
                           $maincat=explode(',',$cat_name);    
							$arrunq = [];		 
							$result_diff = array_merge($maincat,$all_cats);	
							 $arrunq = array_unique($result_diff);	 
									 
				// Get if super categories is enable					 
					 $sup_cat_qury = $mysqli->query("SELECT *   FROM `supercategories`");     
					if( $sup_cat_qury->num_rows>0){										 
					   $sup_cat_order = $mysqli->query("SELECT *   FROM `supercategory_order`  ");   
						  $roww_sup_ord = $sup_cat_order->fetch_assoc();
                           $sup_cat_order_arry = $roww_sup_ord['sup_cat_order'];				 
							
				  $array=array_map('intval', explode(',', $sup_cat_order_arry));
                $array = implode("','",$array);						
					$sup_cat_qury = $mysqli->query("SELECT *   FROM `supercategories`  ORDER BY FIELD(`supcat_id`,'" . $array . "')");                
					 while ($row_cat_sup = $sup_cat_qury->fetch_assoc()){ 
                           $sup_catname = $row_cat_sup['supcat_id'];
						  if($current_lang=="dutch"){ $sup_cat_name =  $row_cat_sup['supcat_name_nl'];   } 
						  else { $sup_cat_name =  $row_cat_sup['supcat_name_en']; }
						
					 echo '<div class="dropdown-row"><button class="dropdown-btn">'.$sup_cat_name.' <i class="fa fa-caret-down"></i></button>';
						 
					  echo '<div class="dropdown-container"  style="display:none;">';						  
					  $get_customername = $mysqli->query("SELECT * FROM categories where  sub_cat_id = '".$sup_catname."'");                 
						    while ($row_cat = $get_customername->fetch_assoc()){	
								$catneme23 = '';
								 if ($current_lang == "en") {	$catneme23 = $row_cat['cat_name_en'];
									 }
								else { $catneme23 = $row_cat['cat_name_nl']; }							
                              $catneme2 = str_replace(' ', '-', $catneme23);							 
                           echo '<li><a href="#'.$catneme2.'">'.$catneme23.'</a></li>';
                          } 						 
						  echo '</div></div>';										  
					  } // if super categoires is enable
					}  								 
					else{  						
						 // loaad categorires witthout super categoire  				
						  // print categoires with order
                          foreach ($arrunq as $key => $value) {         
                            $get_customername = $mysqli->query("SELECT * FROM categories where cat_id  = '" . $value . "'");			  
							   if($current_lang=="dutch") { 	$catneme23 = $get_customername->fetch_array()['cat_name_nl'];}
								else {	$catneme23 = $get_customername->fetch_array()['cat_name_en'];  }                           
                              $catneme2 = str_replace(' ', '-', $catneme23);
                             echo '<li><a href="#'.$catneme2.'">'.$catneme23.'</a></li>';
                          }                                
						 }	
									 
						 ?>
								 </ul>	 
                             
                            </div>                           
                        </div>
                    </div>
                </div>
               

                <!-- center--list-->
                <div class="col-md-6 middle-products">
                    <div class="products">
			 
		  <?php
  // all dishes without discount, without today discount
                $ordercount = [];
                $stop = 0;
                // Get man dish orders
                 $dish_order = $mysqli->query("SELECT * FROM dish_order");
                       while($roww_5 = $dish_order->fetch_assoc()){
                            $ordercount[] = $roww_5['do_cat_id'];
                        }
                $disordertotal = count($ordercount);
                // Get menu order
                       $main_cat = $mysqli->query("SELECT *   FROM `menu_order`");
                         $roww = $main_cat->fetch_assoc();
                           $cat_name = $roww['cat_sort_order'];
                           $maincat=explode(',',$cat_name);      
									
                          foreach ($arrunq as $key => $value) {
                            $get_customername = $mysqli->query("SELECT * FROM categories where cat_id  = '" . $value . "'");
               				 $roww_cat = $get_customername->fetch_assoc();
                       
						if ($current_lang == "en"){   $cat_name = $roww_cat['cat_name_en'];	$product_desc = $roww_cat['cat_desc_en']; } else {   $cat_name = $roww_cat['cat_name_nl']; 	$product_desc = $roww_cat['cat_desc_nl']; }		  
                $cat_name2 =    str_replace(' ', '-', $cat_name);
							  
							  
                    echo '<li class="product-category product"> ';
				///	 echo $roww_cat['cat_id'];		  
                    echo '<h3 id="'.$cat_name2.'" class="sub_ca_name">'.$cat_name.' <p>'.$product_desc.'</p></h3>';                 
                 $dish_order = $mysqli->query("SELECT * FROM dish_order where do_cat_id  = '" . $value . "'");  
                 $roww_3 = $dish_order->fetch_assoc();
                    
							///  print_r($roww_3);
							  
                 $disharangs = $roww_3 ? $roww_3['do_dish_sort_order'] : '0';
                $array=array_map('intval', explode(',', $disharangs));
				 $array2=array_map('intval', explode(',', $disharangs));
                $array = implode("','",$array);		
							  
			 
							  
$print_dish = "SELECT  *  FROM `dish`  WHERE  CONCAT(',', `categry_id`, ',') like '%," . $value . ",%'   AND dish_status = 'Active'   ORDER BY FIELD(`dish_id`,'" . $array . "')";	 
							  
	 					  
							  
			  $query_result2 = $mysqli->query($print_dish);				  
				if ($query_result2->num_rows > 0) {      
                   $query_result = $mysqli->query($print_dish);				 
				}		
				 else{
				 
				 }			  
							  
				 $all_varar = [];
				  $all_var_qury = "SELECT  *  FROM `dish`  WHERE  `categry_id`   IN(".$value.")    AND dish_status = 'Active' ";   
				   $allvarget = $mysqli->query($all_var_qury); 
					 while ($row1 = $allvarget->fetch_assoc()) {
						 $all_varar[] = $row1['dish_id'];
					 }		
		///print_r($print_dish);					  
	if ($query_result2->num_rows > 0) {  						  
	while($roww_4 = $query_result->fetch_assoc()){ ?>
                <div class="product_cart">			 
                        <div class="product_detailss">
                        <h3><?php if($current_lang=='dutch') {echo 	$roww_4['dish_name_nl']; } else {  echo 	$roww_4['dish_name_en'];}
	 ?></h3>
                        <div class="prod-descreption">
							
                        <p><?php  if($current_lang=='dutch') {echo 	$roww_4['dish_desc_nl']; } else {  echo 	$roww_4['dish_desc_en'];} ?></p>							
						<?php if (strlen($roww_4['icon']) > 0) {	
								echo '<div class="alrgy-row">';
							$icon_query = "SELECT  *  FROM `media`  WHERE   `id` IN(".$roww_4['icon'].")";	
							$icon_query_result = $mysqli->query($icon_query);									
								 while($roww_icon = $icon_query_result->fetch_assoc()){
									echo '<img src="admin/'.$roww_icon['icon'].'" height="30" width="30"> ';
								 }
								echo '</div>';								
							}?>								
                       </div><!--descript-->							
                  </div>
					<?php
				  if($roww_4['thumbnail']!=''){
							echo '<div class="dish-img"><a data-toggle="modal" data-target="#modal-viewimage" id="view_image" dataid="' . $roww_4['dish_id'] . '"><img src="' . online_base_url . $roww_4['thumbnail'] . '"  data-full="' . online_base_url . $roww_4['product_image'] . '"   width="89"></a></div>';
							}
 $query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ".$roww_4['dish_id']."  ");	 
   		$discount = $query_postdel11->fetch_assoc();
									  
		 $dicountamtt2 = $discount ? $discount['discount'] : 0;
	     $dicountamtt=($roww_4["dish_price"] * ($dicountamtt2 / 100));
         $dis2 = $roww_4["dish_price"]-number_format($dicountamtt,2);	  
	 $dicountamtt2=$roww_4["dish_price"]-$dicountamtt;		 
if($query_postdel11->num_rows > 0 && $dicountamtt!=0)	{	?>
 <div class="addtocart_price">
<span class="price"><span class="amount"><span class="currencySymbol">€</span>
	<del><?php echo number_format($roww_4['dish_price'], 2, ",", "."); ?></del> 	 
	 </span><br> 
	 <span class="price"><span class="amount"><span class="currencySymbol">€</span>
	<?php echo   number_format($dis2, 2, ",", "."); ?></span>
	 </span> </span><br> 
        <div class="add_to_cartbutn">
        <input type="hidden" name="quantity" id="quantity<?php echo $roww_4["dish_id"]; ?>" class="form-control" value="1" />
        <input type="hidden" name="hidden_name" id="name<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_name_en"]; ?>" />
<input type="hidden" name="hidden_price" id="price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo number_format($dicountamtt2,2); ?>" />
<?php } else{ ?>			
			
 <div class="addtocart_price">
	 
 <span class="price currencySymbol <?php if($value==6) { echo 'price-dbl'; }  ?>"><?php echo $currency; ?><?php echo  number_format($roww_4["dish_price"], 2, ",", ".") ; 
			 
		 
			 
	 if($roww_4["dish_id"]==54){echo ', 13,50';	 }
	 if($roww_4["dish_id"]==55){echo ', 16,45';	 }
	 if($roww_4["dish_id"]==56){echo ', 14,95';	 }
	 if($roww_4["dish_id"]==57){echo ', 14,95';	 }
	 if($roww_4["dish_id"]==59){echo ', 13,95';	 }
	 if($roww_4["dish_id"]==58){echo ', 13,95';	 }
	 if($roww_4["dish_id"]==60){echo ', 14,45';	 }
	 if($roww_4["dish_id"]==61){echo ', 13,95';	 }
	 if($roww_4["dish_id"]==62){echo ', 14,95';	 }	
			 
	 if($roww_4["dish_id"]==63){echo ', 14,45';	 }	
	 if($roww_4["dish_id"]==64){echo ', 13,45';	 }	
	 if($roww_4["dish_id"]==65){echo ', 14,95';	 }	
	 if($roww_4["dish_id"]==66){echo ', 13,95';	 }	
	 if($roww_4["dish_id"]==67){echo ', 13,45';	 }				 
			 
			 
			 
			 
	 ?></span>	 
        <div class="add_to_cartbutn">
        <input type="hidden" name="quantity" id="quantity<?php echo $roww_4["dish_id"]; ?>" class="form-control" value="1" />
        <input type="hidden" name="hidden_name" id="name<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_name_en"]; ?>" />
        <input type="hidden" name="hidden_price" id="price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_price"]; ?>" />			
 <?php } ?> 			
        <input type="hidden" name="hidden_dish_type" id="dish_type<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_type"]; ?>" /> 
<input type="hidden" name="hidden_dish_attrib" id="dish_attrib<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_attrib"]; ?>" />
 <input type="hidden" name="plastc_box" id="pl_price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["bag_charge"]; ?>" />
<?php  if (isset($_SESSION['current_pick'])) { ?>			
<a class="addbtn add_to_cart" name="add_to_cart" id="<?php echo $roww_4["dish_id"]; ?>" href="javascript:void(0)">  </a>
 	<?php } else{ ?>
	<button class="chosway-btn"></button>
	<?php } ?>
	 </div>           </div>          
        </div>
               <?php } // main dish loop
						  }
		 		  
	///	print_r($all_varar);					  
	 $result23=array_diff($all_varar,$array2);			  
			if($result23){
				foreach($result23 as $result23_sing){
		 $print_dish2 = "SELECT  *  FROM `dish`  WHERE    dish_id ='".$result23_sing."' "; 
				$query_result = $mysqli->query($print_dish2);
 
				} }							  
							  
               echo '<li>';
                   }   ?>

          </div>
                </div><!-- middle products-->
            
                <div class="col-md-3 pm-sidebar-right">
                     <div class="pm-widget" id="sticky">
                         <h6  class="main-heading"><?= $yourorder_l ?><span class="mob_close_btn2"  style="display:none;">X</span></h6>

                    <div class="widget_shopping_cart_content">                                                                         
                                   <div class="container-fluid">
                                        <div class="product-cart">
                                         </div><!--product-list--> 
                                    <div class="total-box text_totalamount display-flex"><div class="col-md-6"><?php echo $total_cart; ?></div>
                                        <div class="col-sm-6 txt_right totalcart"></div>
                                    </div>
									     <div class="total-box text_totalplst display-flex"><div class="col-md-6"><?php echo $palstbag1; ?></div>    <div class="col-sm-6 txt_right totalcart_plst"></div>
								  </div> 
                                    <div class="go-check-btn" align="right">
                                        <a href="checkout.php" class="btn btn-primary" id="check_out_cart" style="display:none"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo $cart_btn_lang; ?>   </a>
						<?php if($_SESSION['current_pick']==2){ ?>				
                        <a href="#" class="btn btn-default" id="clear_cart"><i class="fa fa-trash" aria-hidden="true"></i><?php echo $cart_btn_lang2; ?>  </a><?php } ?>
										
                                    </div>

             <div class="delvey-info">
		<?php  if ((isset($_SESSION['current_pick']) && $_SESSION['current_pick']==1) && isset($_SESSION['curntpostcode']) && $_SESSION['curntpostcode']!='notset'){ ?><!-- if method is delivery -->	
              <h2> <?= $DeliveryInformationSection ?></h2>
                <div class="del-prices">								   
				<div class="postcode-row display-flex">						   
				<label id="ur_postcode" for="post_code"><?php echo $urpostcode_l;?> <span><?php
if (isset($_SESSION['curntpostcode'])) {   echo $_SESSION['curntpostcode'];}?></span> </label>
					<p id="close_postcode" class="close_postcode">x</p></div> 
					 <ul>
   	<?php  if($_SESSION['postcode_min_amt']==0 || $_SESSION['postcode_min_amt']==0.00){}else{   ?>						 
   <li><?php   echo $minamt_L;?> <b><?php echo $currency ;   echo number_format($_SESSION['postcode_min_amt'], 2, ",", ".")  ?></b></li>
	  <?php } ?>
	<?php if($_SESSION['postcode_free_from']==999 || $_SESSION['postcode_free_from']==0 || $_SESSION['postcode_free_from']==0.00){}else{   ?>
   <li><?php   echo $freefrom;?> <b><?php echo $currency ;
																																		
print_r($_SESSION['postcode_free_from']);																																		///echo number_format($_SESSION['postcode_free_from'], 2, ",", ".")  ?></b></li>
						 <?php } ?>
    <li><?php if($_SESSION['postcode_free_from']!=999){  echo $DeliveryCharge_L;?> <b><?php echo $currency ; echo number_format($_SESSION['postcode_deli_chrg'], 2, ",", ".") ;} ?></b></li>  </ul>
			   </div><!--.del-prices-->
 <?php } ?>
			 
                                      </div><!--delvery-info-->
									   
		 <?php  if (isset($_SESSION['current_pick']) && $_SESSION['current_pick']==2){ ?>
									   <p><b><?php  echo $onlyfor_pik;?></b></p>
			   <li><?php   echo $minamt_L;?> <b><?php echo $currency ;   echo number_format($_SESSION['min_amt'], 2, ",", ".")  ?></b></li> <?php } 
									   
									   
									   
									   
									   // if method is delivery
									    if (isset($_SESSION['current_pick']) && $_SESSION['current_pick']==1){
									   if($holidayclose==0 ||   $shift_check=="open"){?>	
									   <p class="resdelvery_msg"><b><?php 	
											 if($shift_check=="open" && $resopen_time==0){
												echo $resdelvery_msg;
												}
											 elseif($shift_check=="open" && $resclse_time==1){
													echo $resdelvery_msg;
											}
										   ?></b></p>
									   <?php } }
									    // if delivery method is pickup
									  if (isset($_SESSION['current_pick']) && $_SESSION['current_pick']==2){ ?>	
									
									   <p class="resdelvery_msg"><b><?php 	
											 if($shift_check=="open" && $resopen_time==0){
												echo $resdelvery_msg2;
												}
											 elseif($shift_check=="open" && $resclse_time==1){
													echo $resdelvery_msg2;
											}
										   ?></b></p>
									   <?php } 
									   ?>
                                    </div>
                            <div id="display_item"></div><div id="discount_msg"></div>
                        </div>
						 
                 </div>
				
					
					
                </div><!--Right cart-->
				  </div>


        <?php $discount_query = "Select *  From discount_description";
                $discount_result = $mysqli->query($discount_query);
                $disrow = $discount_result->fetch_assoc();
                if ($current_lang == "en") {
                        $dismsg1 = $disrow['rh_msg_en'];
                    } else {
                        $dismsg1 = $disrow['rh_msg_nl'];
                    }
	
			$discount_query = "Select *  From discount";
                $discount_result = $mysqli->query($discount_query);
                $disrow2 = $discount_result->fetch_assoc();
	
	
        if($disrow2['active'] ==1 ){
        ?>
	  			<?php   
			echo $_SESSION['current_pick'];
			if (isset($_SESSION['current_pick']) && $_SESSION['current_pick']==1) { ?>  
                <div id="my-welcome-message" class="my-welcome-message"  style="display:none;">
					312123
				<?php }   
				else if (isset($_SESSION['current_pick']) && $_SESSION['current_pick']==2 &&  isset($_SESSION['order_session'])) { ?>  
                <div id="my-welcome-message" class="my-welcome-message"  style="display:none;">
					asdasd
				<?php } else{ ?>	
				<div id="my-welcome-message" class="my-welcome-message" >
				<?php } ?>
                <div class="my-welcome-message-box">
					<h2><?php if($current_lang=='dutch') { echo $disrow2['title_nl2']; }else{ echo $disrow2['title2'];} ?></h2>
                    <p><?php echo $dismsg1; ?></p>					
					<button type="button" class="btn btn-primary"  id="gorefresh"  style="display:none;">Ok</button>
					<a  href="<?php echo online_base_url; ?>setpick.php?action=pickup" class="btn btn-primary"  id="gorefresh_pick"  style="display:none;">Ok</a>
			 	<a id="fvpp-close">✖</a>
				</div>
                    </div>
        <script src="jquery.firstVisitPopup.js"></script> 
                <script>
        ///    $(function () {
              ///  $('#my-welcome-message').firstVisitPopup({
                ///    cookieName : 'homepage',
                 ///   showAgainSelector: '#show-message'
               // });
          ///  });
        </script> 
        <?php } /* else{  ?>
				<?php   if (isset($_SESSION['current_pick'])) { ?>  
                <div id="my-welcome-message" class="my-welcome-message"  style="display:none;">
				<?php } else{ ?>
				<div id="my-welcome-message" class="my-welcome-message">
				<?php } ?>
                <div class="my-welcome-message-box">
			     	<button type="button" class="btn btn-primary"  id="gorefresh"  style="display:none;">Ok</button>
					<a  href="https://natrajrestaurant.nl/online/setpick.php?action=pickup" class="btn btn-primary"  id="gorefresh_pick"  style="display:none;">Ok</a>
			 	<a id="fvpp-close" style="display:none;">✖</a>
				</div>
                    </div>	
	<?php	} */	?>
        
<?php include 'public_footer.php';?>
<!---->
 
     
<script>
function myFunction12() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
      document.getElementById("chk_postcode").focus();
  } else {
    x.style.display = "none";
  }
}


$(document).ready(function () {
	
	  jQuery(".dropdown-btn").on("click", function(){
    if( jQuery(this).parent().hasClass("active") ){
      jQuery('.dropdown-row .dropdown-container').slideUp();
      jQuery(this).parent().removeClass("active");
    }
    else{
      jQuery(".dropdown-row .dropdown-container").slideUp();
      jQuery(".dropdown-row").removeClass("active");
      jQuery(this).parent().addClass("active");
      jQuery(this).next('.dropdown-row .dropdown-container').slideDown();
    }
  }); 
	
	 var choosw3total = 0;
	 var choosed = 0;
	 var choosw3total_minus = 0;		
	
  //called when key is pressed in textbox
  $("#chk_postcode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        if(current_lang=='dutch')
        {$("#chk_postcode_errmsg").html("alleen cijfer").show().fadeOut("slow");}else{$("#chk_postcode_errmsg").html("Digits Only").show().fadeOut("slow");}
               return false;
    }
   });

    $(document).on('click','.mob_close_btn,.main_category li',function(){
        $('.sidebarleft').removeClass("dish_cat_icon_y");
    });
    $(document).on('click','.mob_close_btn2',function(){
        $('.pm-sidebar-right').removeClass("cart_icon_y");
    });

	  $(document).on('click','.modal button.close',function(){
        $('#myModalNew').fadeOut();
    });
	
	

});
            
            
            var newWindowWidth = $(window).width();
             if (newWindowWidth > 992) {
                 
                    $(document).on('click', '.dish_cat_icon', function () {
                        $('html, body').animate({
                            'scrollTop' : $(".product_main_category").position().top
                        });    
                    });
                    $(document).on('click', '.cart_icon', function () {
                        $('html, body').animate({
                            'scrollTop' : $("#sticky1").position().top
                        });    
                    });
             }
            
 $(document).ready(function () {
 
  
                // for reset attrib popup dropdown's selected values to default.
                $(document).on('click', '.reset_variations', function () {
                        $( ".attriblok" ).each(function() {
                        $(this).find('option:eq(0)').prop('selected', true);
                          var product_price = $('#current_productprice').val();
                          var totalcostnow=0;
                          totalcostnow=product_price;
                          $( ".attriblok" ).each(function() {
                    var selected_attri_cost=$(this).find(':selected').data('lok');
                    totalcostnow=finalcostforsingleitem(selected_attri_cost, totalcostnow);});
                    $('#tcfs').html('');
                    $('#tcfs').html(parseFloat(totalcostnow).toFixed(2));
                    $('#tcfs33').val(totalcostnow);
                        });
                 });

    
         // final cost for attrib product after any dropdown value change       
                $(document).on("change", ".attriblok", function (event) {    
					var thsval = $(this).find(':selected').val();
				 var is_required =  $(this).parents('.select_main').find('.required').val();
				 if(thsval!='default'){                
                       var varib_price = parseFloat($('.variable_prices').val()); 
                        var reduce =     $(this).parent('.select_main').find('.selected_price').val();
                        if($(this)[0].selectedIndex >= 0){          

                            varib_price -= parseFloat(reduce);     
                             varib_price += parseFloat($(this).find(':selected').data('price'));
                               $(this).parent('.select_main').find('.selected_price').val($(this).find(':selected').data('price'));
							$(this).parents('.select_main').find('.required_pass').val(0);
                        }
                        else{   
							
                        }
              $(this).parent('.select_main').find('.selected_price').val($(this).find(':selected').data('price'));
                        var  total_2 = varib_price.toFixed(2);               
                        var total_3 = total_2.toString().replace(/\./g, ',');
                        $('#tcfs33').val(total_2);  
                         $('.variable_prices').val(total_2);     
                        $('#tcfs').html('€'+total_3);   
				 }
					else{
					 var varib_price = parseFloat($('.variable_prices').val()); 					 
					  var reduce =     $(this).parent('.select_main').find('.selected_price').val();
					   varib_price -= parseFloat(reduce); 
					var  total_2 = varib_price.toFixed(2);              
					  var total_3 = total_2.toString().replace(/\./g, ',');
                        $('#tcfs33').val(varib_price);  
                         $('.variable_prices').val(varib_price);     
                        $('#tcfs').html('€'+total_3); 
					 var reduce =     $(this).parent('.select_main').find('.selected_price').val(0.00);
				}
                       if(is_required==1 && thsval=='default'){
                            $(this).parents('.select_main').find('.required_pass').val(1);
                        } 
					else{
						    ///  thisis.parents('.select_main').find('.required_pass').val(0);}
					}
				 
                });


// Gift And Discount Msg below cart
                function giftanddismsg() {
                     var count_of_item = $('.toprodqty').html();
                    if (count_of_item >= "1") {
                        var action = "checkgiftitem";
                       
                        $.ajax({
                            url: "postcodecheck.php",
                            method: "POST",
                            data: {action: action},
                            dataType: "html",
                            success: function (data)
                            {
                                $('#display_item').html(data);
                            }
                        });

                    } else {
                        $('#display_item').html('');
                    }
                }

//Fetch Shopping Cart Details
                load_cart_data();

                  function load_cart_data()
                {
                    var action = "loadcartdata";
                    $.ajax({
                        url: "postcodecheck.php",
                        method: "POST",
                        data: {action: action, },
                        dataType: "json",
                        success: function (data)
                        {
                            console.log(data);
                             $('.product-cart').html('');
                            $('.badge').text('');
                            $('.product-cart').html(data.cart_details);
                            $('.totalcart').text(data.total_amt_2);
							 $('.Prise').text(data.total_amt_2);
                           /// $('.badge').text(data.total_item);
							 $('.toprodqty').text(data.total_item);
                            var totalqty = data.toprodqty;
                            var total_price_4checkoutBtn = data.total_amt_2;
                           $('.totalcart_plst').text(data.plst_total2);
                         
                          if(data.total_item>0){
                                $("#discount_msg").html('');
                                $("#discount_msg").html(data.discount);
                                
                            }else{$("#discount_msg").html('');}

                             if(data.total_item>0){
                                $('#clear_cart').show();
                                 }else{
                                 $('#clear_cart').hide();

                             }
                             if(data.checkbtn==1){
                                $('#check_out_cart').show();
                                 }else{
                                 $('#check_out_cart').hide();

                             }
									giftanddismsg();
                        },
                        complete: function (data) {
                            giftanddismsg();
                                 setTimeout(function(){
                           
                            },500);
                        }
                    });
                }

                function finalcostforsingleitem(selected_attri_cost, product_price) {
                var tc = parseFloat(selected_attri_cost) + parseFloat(product_price);
                    //alert(parseFloat(tc));
                    return tc;
                }




//Add Items into shopping cart
                $(document).on('click', '.add_to_cart', function () {
                    var product_id = $(this).attr("id");
                    var product_type = $('#dish_type' + product_id).val();
                    var product_attrib = $('#dish_attrib' + product_id).val();
                    var product_name = $('#name' + product_id + '').val();
                    var product_price = $('#price' + product_id + '').val();
                    var platc_charg = $('#pl_price' + product_id).val();
                    var product_quantity = $('#quantity' + product_id).val();
                    $("#current_productprice").val('');
                    $("#current_productname").val('');
                    $("#current_productid").val('');
                    $("#current_productprice").val(product_price);
                    $("#current_productname").val(product_name);
                    $("#current_productid").val(product_id);
          
                    
  if (product_type == "2") {                        
    var prodes = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').parent('.product-category.product').find('.sub_ca_name p').html();
	   
        var prodes_id = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').parent('.product-category.product').find('.sub_ca_name').attr('id');
        
                    if(prodes_id=='menu'){
                        var prodes = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').find('.prod-descreption').find('.clr').html();
                    }


                        url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                        var action = "dish_attrib_popup";
                        var current_lang = $('#current_lang').val();
			           $('#quantity').val('1');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                action: action, product_id: product_id, current_lang: current_lang,product_attrib:product_attrib,platc_charg:platc_charg,
                            },
                            dataType: "html",
                            success: function (data1)
                            {
                                $("#pc_form2").html(data1);
                             $('#myModalNew1').modal('show');
                                
                          $('#myModalNew1').find('.maintitle h4').html(product_name);
                          $('#myModalNew1').find('.pricepop span').html('€ '+product_price);
                          $('#myModalNew1').find('.pricedish').val(product_price);
                          $('#myModalNew1').find('.pro_pop_info').html(prodes);
							 
								choosed = 0;
 	                          choosw3total = 0;
								
							  $('#myModalNew1').find('.newpriadd').val(0);
								
                                var totalcostnow=0;
                                totalcostnow=product_price;
                                
                                  $('#tcfs33').val(parseFloat(totalcostnow).toFixed(2));
                                  var sum1 = parseFloat(totalcostnow).toFixed(2);
                                  var sum2 = sum1.toString().replace(/\./g, ',');
                                $('#tcfs').html('€'+sum2);
                                $('#tcfsbase').val(parseFloat(totalcostnow).toFixed(2));
                    			  $('#myModalNew1').find('.variable_prices').val(product_price);
								$('.warchoose').fadeOut(100);
                            },
                       });
                    } else {
                        final_addtocart(product_id, product_name, product_price, product_quantity,platc_charg);
                    }
                });
             
                
  $(document).on('click', '#attrib_add_to_cart', function () {
					
	  
	  		 var product_name = $("#current_productname").val();
					var product_name_str=product_name+'<br>';           

                     $('.select_main').find('.var-label').each(function() {						
                       var checked_lenght =  $(this).parent('.select_main').find('input').filter(':checked').length; 
                       if(checked_lenght>0){
                       product_name_str=product_name_str+$(this).not('b').html()+':';
                      }
                        $(this).parent('.select_main').find('input').filter(':checked').each(function(index) {                            
                             if (index === (checked_lenght - 1)){
                                 product_name_str=product_name_str+$(this).data('name');                                 
                             }
                             else
                                {  product_name_str=product_name_str+$(this).data('name')+','; }
                             
                        });
						
                        if(checked_lenght>0){
                           product_name_str=product_name_str+'<br/>';
                        }
						
					  var option_lenght =  $(this).parent('.select_main').find('select option').filter(':selected').length; 
					var sel_val =  $(this).parent('.select_main').find('select option').filter(':selected').val();	
					///	console.log(sel_val);
                       if(option_lenght>0 && sel_val!='default'){
                       product_name_str=product_name_str+$(this).html()+':';
                      }
                        $(this).parent('.select_main').find('select option').filter(':selected').each(function(index) {                            
                             if (index === (option_lenght - 1)){
								  if(option_lenght>0 && sel_val!='default'){
                                 product_name_str=product_name_str+$(this).data('name');   
								  }
                             }
                             else{ 
								 if(option_lenght>0 && sel_val!='default'){
									product_name_str=product_name_str+$(this).data('name')+','; }
								}                             
                        });
                        if(option_lenght>0){
                           product_name_str=product_name_str+'<br/>';
						}
						
                    });
					 		
	  		  var var_1 = $('.required_pass_1').val();
	  		  var var_2 = $('.required_pass_2').val();
			  var var_3 = $('.required_pass_3').val();
			  var var_4 = $('.required_pass_4').val();
			  var var_5 = $('.required_pass_5').val();
			  var var_6 = $('.required_pass_6').val();
			  var var_7 = $('.required_pass_7').val();
	          var var_8 = $('.required_pass_8').val();
	  		 
	  if((var_1!=null && var_1==1) || (var_2!=null && var_2==1) || (var_3!=null && var_3==1) || (var_4!=null && var_4==1) || (var_5!=null && var_5==1) || (var_6!=null && var_6==1) || (var_7!=null && var_7==1) || (var_8!=null && var_8==1)){ 
		 
							 	$('.warchoose').fadeIn('100');
							 	return false;
								   }
	  
	  
	  
                     product_name= product_name_str; 
					
 
	  
                    var product_id = $("#current_productid").val();
                    var singleitemcost_ic = $("#tcfs").html();
                    var product_quantity = $("#quantity").val();
                    var product_price12 = $('#current_productprice').val();
                    var singleitemcost_ic33 = $("#tcfs33").val();
					var product_price = singleitemcost_ic33;
					var product_price11 = $('#price' + product_id + '').val();			 
				 var platc_charg = $('#pl_price' + product_id + '').val();		
						///console.log(product_name_str);
						
			  	final_addtocart(product_id, product_name, product_price, product_quantity,platc_charg);
				 
 
                });

 
                    $(document).on('click', '.updateqty', function () {
                   var product_id = $(this).attr("id");
                        
                  // var product_qty = $(this).val();
                    var current_lang = $('#current_lang').val();
                    var action = 'updateqty';
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
                
  $(document).on("click", ".attrcheckadd", function (event) {
         var othersval = 0;
         var priceTotal = 0;
         var originalPrice = parseFloat($('#tcfs33').val()); 
         var varib_price = parseFloat($('.variable_prices').val()); 
         var thisis =$(this);
         var is_require =   thisis.parents('.select_main').find('.required').val();
	 
        // Prevent to limit
           var choose_limit =$(this).data('limit');  
           var lenght_total =   thisis.parents('.select_main').find('input').filter(':checked').length;
            if(lenght_total >= choose_limit ){
                thisis.parents('.select_main').find('input').not(":checked").attr("disabled",true);
				thisis.parents('.select_main').find('.required_pass').val(0);
            }
	     else if(choose_limit=='No'){
			  thisis.parents('.select_main').find('.required_pass').val(0);
		 }
			 
            else{
                 thisis.parents('.select_main').find('input').not(":checked").attr("disabled",false);
				if(is_require==0){ thisis.parents('.select_main').find('.required_pass').val(0); }
				else{ thisis.parents('.select_main').find('.required_pass').val(1); }
				 
            }
         // add price of attribute   
           if ($(this).prop('checked')==true){  
             varib_price += parseFloat($(this).data('price'));
           }
           else{
                varib_price -= parseFloat($(this).data('price'));
           } 
            var total_1 = parseFloat(priceTotal+varib_price);
	        var  total_2 = total_1.toFixed(2);     
            $('.variable_prices').val(total_2);
            var  total_2 = total_1.toFixed(2);               
            var total_3 = total_2.toString().replace(/\./g, ',');
            $('#tcfs33').val(total_2);      
            $('#tcfs').html('€'+total_3);   

         	 if(lenght_total>0){
                 if(is_require==1) { 
					 ///thisis.parents('.select_main').find('.required_pass').val(0);
				 }
                }
             else{
                 /// thisis.parents('.select_main').find('.required_pass').val(1);
                }		  	 
             });
    

  $(document).on("change", "#quantity", function (event) {   
					   var vals = $(this).val();				
					 	//// var pricedish = $('.pricedish').val();
							//// var pricenew = pricedish*vals;
				   	   var totalall = $('.variable_prices').val();
					   var newproi2 =totalall*vals;
				   /// var totalfinal = parseFloat(pricenew)  + parseFloat(newproi2);				  
	 				var  totalfinal22 = newproi2.toFixed(2);				  
				   var sum2 = totalfinal22.toString().replace(/\./g, ',');
                    $('#tcfs').html('');
                    $('#tcfs').html('€'+sum2);
	 				 
	  }); 		 


                $(document).on('click', '.updateminusqty', function () {
                   var product_id = $(this).attr("id");
                        
                  // var product_qty = $(this).val();
                    var current_lang = $('#current_lang').val();
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
//Remove Item from cart
                $(document).on('click', '.delete', function () {
                    var product_id = $(this).attr("id");
                    var current_lang = $('#current_lang').val();
                    var action = 'remove';
                    var delmsg_lok='';
                    if(current_lang=="en"){delmsg_lok="Are you sure you want to remove this product?";}else{delmsg_lok="Weet u zeker dat u dit product wilt verwijderen?"}
                    
                    /*if (confirm(delmsg_lok))
                    {*/
                        $.ajax({
                            url: "postcodecheck.php",
                            method: "POST",
                            data: {product_id: product_id, action: action},
                            success: function ()
                            {
                                load_cart_data();
                                $('#cart-popover').popover('hide');
                         
                            }
                        })
                  /*  } else
                    {
                        return false;
                    }*/
                });
 

                $(document).on('click', '#clear_cart', function () {
                    var action = 'empty';
                    var current_lang = $('#current_lang').val();
                    var currency =
                            $.ajax({
                                url: "postcodecheck.php",
                                method: "POST",
                                data: {action: action},
                                success: function ()
                                {
                                    load_cart_data();
                                    $('#cart-popover').popover('hide');
									window.location.reload(true);
                                    if (current_lang == "en") {
                                        alert("Your Cart has been clear");
                                    } else {
                                        alert("Je winkelwagen is duidelijk");
                                    }
									
                                }
                            });
                });


                function final_addtocart(product_id, product_name, product_price, product_quantity,platc_charg) {
                    var action = "addtokart";
                    var current_lang = $('#current_lang').val();
                    //alert(product_quantity);
                    if (product_quantity > 0 )
                    {
                        if(product_price != ""){
                        $.ajax({
                            url: "postcodecheck.php",
                            method: "POST",
                            data: {product_id: product_id, product_name: product_name, product_price: product_price, product_quantity: product_quantity,platc_charg:platc_charg, action: action},
                            success: function (data)
                            {
                                //console.log(data);
                                load_cart_data();
							 $('#myModalNew1').modal('hide');	
                               /* if (current_lang == "en") {
//                                   alert("Item has been added into cart");
                                   
                                } else {
//                                   alert("Item is toegevoegd aan winkelwagen");
                                    $('#myModalNew1').modal('hide');
                                }*/
                            }
                        });
                    } else {
                         alert("Please Choose one option");
                    }
}else
                    {
                        if (current_lang == "en") {
                            alert("Please Enter Number of Quantity");
                        } else {
                            alert("Voer het aantal aantal in");
                        }
                    }
                }



         
                

                $(document).on('click', '#close_postcode', function () {
                    url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                    var action = 'removepostcode';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
                            $('#clear_cart').click();
                            window.location.reload(true);
                        }
                    });

                });


                var chk_postcode = document.getElementById("chk_postcode");
                chk_postcode.addEventListener("keydown", function (e) {
                    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                        $("#pc_suit").click();
                    }
                });
	 
 
  
	function reload_aftercode(){
		window.location.reload(true);
	}
 

                $(document).on('click', '#pc_suit', function () {
                    var current_lang = $('#current_lang').val();
//                    console.log(current_lang);
                    var chk_postcode = $("#chk_postcode").val();
                    if (chk_postcode == "") {
                        $('#post_err').html('');
                        if (current_lang == "en") {
                            $('#post_err').html("Please provide postcode!");
                        } else {
                            $('#post_err').html("Vul de zip code in!");
                        }
                        $("#chk_postcode").focus();
                        return false;
                    }
					
				///function greet() {	
                    url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                    var action = 'checkpostcode';
                    var chk_postcode = chk_postcode;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            chk_postcode: chk_postcode,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
                            //console.log(current_lang);
                            $('#post_err').html('');
                            var data1 = $.trim(data1);

                            //console.log(data1);
                            if (data1 == "fail") {

                                if (current_lang == "en") {
                                    $('#post_err').html('');
                                    $('#post_err').html("We do not deliver to this zip code area");
                                } else {
                                    $('#post_err').html('');
                                    $('#post_err').html("Wij bezorgen niet in deze postcodegebied");
                                }
                                return false;
                            }

                            if (data1 == 'pass') {
							 $('#myModalNew').fadeOut(0);
								/// $('#my-welcome-message').fadeIn(0);
								///$('#gorefresh').fadeIn(0);
                               /// setTimeout(reload_aftercode, 3000);          
                                window.location.reload(true);
                            }

                        }
                    });
				///}// time function
                });

	 
	 

                $(document).on('click', '#lang_en_btn', function () {
                    url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                    var action = 'change_web_lang';
                });

/*	 
 $(document).on('click', '#select_en_delivery', function () {
					 $('#myModalNew').fadeOut(0);
                    $('#my-welcome-message').fadeIn(0);
	  				$('#gorefresh_pick').fadeIn(0);
                });
	 
	 */
	 
 $(document).on('click', '#fvpp-close', function () {
					 
                    $('#my-welcome-message').fadeOut(0);
	  				 
                });
	 
	 
	 
	 
 $(document).on('click', '#gorefresh', function () {
			window.location.reload(true);
     });
 	 
	 
            });
	
	
	
/*
$(document).keypress(function(e) {
  if ($("#myModal").hasClass('in') && (e.keycode == 13 || e.which == 13)) {
    $("#popup1btn").click();
  }
});   */

$(document).on('click', '.sel_pick', function () {
                    url = b_url1 + 'setpick.php';  //console.log(url);return false;
                    var sel_pick = $(this).attr("data-id");
                    var action = 'update_pick';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            sel_pick: sel_pick,
                            action: action,
                        },
                        dataType: "html",
                        success: function (data)
                        { window.location.reload(true);
                        }
                    });
                });


     /*
 $(document).on('click', '#view_image', function () {
                                    var dish_id = $(this).attr("dataid");
      url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                    var action = 'viewimage';
                    
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {
                                            dish_id: dish_id,
                                            action: action,
                                        },
                                        dataType: "html",
                                        success: function (data)
                                        {
                                            $('#view_img_data').html('');
                                            $('#view_img_data').html(data);
                                        }
                                    });
                                });
                            */

        /*    $(document).on('click', '#view_video', function () {
                                    var dish_id = $(this).attr("dataid");
      url = b_url1 + 'postcodecheck.php';  //console.log(url);return false;
                    var action = 'viewvideo';
                    
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {
                                            dish_id: dish_id,
                                            action: action,
                                        },
                                        dataType: "html",
                                        success: function (data)
                                        {
                                            $('#view_video_data').html('');
                                            $('#view_video_data').html(data);
                                        }
                                    });
                                });      */
	
	
   $(function() { // document ready
	   if ($('#sticky').length) { // make sure "#sticky" element exists
		var el = $('#sticky');
		var stickyTop = $('#sticky').offset().top; // returns number
		var stickyHeight = $('#sticky').height();
		$(window).scroll(function() { // scroll event
			var limit = $('#footer').offset().top - stickyHeight - 20;
			var windowTop = $(window).scrollTop(); // returns number
			if (stickyTop < windowTop) {
					el.addClass('stockyon1');
			} else {
					el.removeClass('stockyon1');
			}
			if (limit < windowTop) {
				var diff = limit - windowTop;
				el.css({
					top: diff
				});
			}
		});
	}
	if ($('#sticky1').length) { // make sure "#sticky" element exists
		var el1 = $('#sticky1');
		var sticky1Top = $('#sticky1').offset().top; // returns number
		var sticky1Height = $('#sticky1').height();
		$(window).scroll(function() { // scroll event
			var limit1 = $('#footer').offset().top - sticky1Height - 20;
			var windowTop1 = $(window).scrollTop(); // returns number
			if (sticky1Top < windowTop1) {
				el1.addClass('stockyon');
			} else {
				el1.removeClass('stockyon');
			}
			if (limit1 < windowTop1) {
				var diff1 = limit1 - windowTop1;
				el1.css({
					top: diff1
				});
			}
		});
	}
});	
	
	
	$(document).on('click', '#view_image', function () {
            var dish_img = $(this).parent('.dish-img').find('img').attr("data-full");
              $('#view_img_data img').attr('src',dish_img);                    
           });	                         

		$(document).on('click', '.chosway-btn', function () {
           $('#myModalNew').fadeIn(100);                   
           });	
	
            </script>
     
 
    </body>
</html>
 
