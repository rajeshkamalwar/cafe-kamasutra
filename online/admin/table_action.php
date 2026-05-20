<?php
// 2 hours in seconds
// 2 hours in seconds
session_start();


include 'db.php';
include 'config.php';
//include 'tfunction.php';

ob_start();
$logo_query="select * from adm_set where adm_set_name='print_url'";
        $logo_url= $mysqli->query($logo_query)->fetch_object()->adm_set_vlu;
$current_lang = $_SESSION['current_lang'];

function addZeroes($num) {
$value = $num;
    
    if (strpos($value, '.') !== false) {
    return number_format((float)$num, 2, ',', '');}
    
    if (strpos($value, ',') !== false) {
        $value=str_replace(",",".",$value);
         return number_format((float)$value, 2, ',', '');
    }
    if (strpos($value, '.') == false) {
    return number_format((float)$num, 2, ',', '');}
    
    if (strpos($value, ',') == false) {
    return number_format((float)$value, 2, ',', '');}
    
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action=="checkgiftitem"){
        //echo "SELECT * FROM `giftitem` where '".$_POST['cart_cost_now']."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`";
        $result=$mysqli->query("SELECT `gt_msg` FROM `giftitem` where '".$_POST['cart_cost_now']."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`");
       
        //echo $result->num_rows;
        
        if($result->num_rows > 0)
        {
             $row=$result->fetch_assoc();
             echo ($current_lang=="en")?"You will receive one ".trim($row['gt_msg']).". You can make your choice on the checkout page.":"Je ontvangt er een ".trim($row['gt_msg']).". U kunt uw keuze maken op de afrekenpagina. ";
             $_SESSION['gt_msg_giftitem']=$row['gt_msg'];
        }
    }
    
   
  if ($action == 'removepostcode') {
		
		  $currenttable = $_POST['currentselected']; 		
			 $today = date('Y-m-d');
			 $deltefromdevices1 = "DELETE   FROM `table_booked` WHERE   table_no =$currenttable  AND DATE(date_time) = '$today'";
			 $deltefromdevices = "DELETE  FROM `table_booked_2` WHERE   table_no =$currenttable  AND DATE(date_time) = '$today'";
		    $deltefromdevices3 = "DELETE  FROM `messages` WHERE   table_no =$currenttable  AND DATE(date_time) = '$today'";
         	$mysqli->query($deltefromdevices1);
		  $mysqli->query($deltefromdevices);
		$mysqli->query($deltefromdevices3);
		
    }
    
    
    if ($action == 'checkpostcode') {
        $echostr='';
        
        $query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $_POST['chk_postcode']."' AND `postcode_status`='Active'");
        
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
         echo trim($echostr);
    }
    
  
    if($action == 'loadcartdata'){
		 $currenttable = $_POST['currentselected'];
        $total_price = 0;$delivery_crg_amt='';$discount_amt=0;$cart_FinalBill_amt4d=0;$cart_FinalBill2pay_now1=0;$oo_cakrt='';
       // echo "<br/>1>".$discount_amt."<";
$total_item = 0;$cart_delivery_charge_now='';
$product_name=($current_lang=="en")?"Name":"Naam";
$product_price=($current_lang=="en")?"Price":"Prijs";
//$product_quantity=($current_lang=="en")?"Quantity":"Aantal stuks";
$product_quantity=($current_lang=="en")?"Qty":"Qty";
$product_total=($current_lang=="en")?"Total":"Totaal";
$product_subtotal=($current_lang=="en")?"Subtotal":"Subtotaal";
$product_action=($current_lang=="en")?"Action":"Actie";
$remove=($current_lang=="en")?"Remove":"Verwijderen";
$empty_cart=($current_lang=="en")?"Your Cart is Empty!":"Uw winkelwagen is leeg!";
$delivery_charge=($current_lang=="en")?"Delivery charge":"Bezorgkosten";
$discount_percentage=($current_lang=="en")?"Discount":"Korting";
$finaltotal=($current_lang=="en")?"Total":"Totaal";
$plastic_charge=($current_lang=="en")?"Plastic charge":"Plastic lading";
$queryplastic = $mysqli->query("SELECT * FROM `plastic` where status='Active' ");
  $countplastic = $queryplastic->num_rows;
   $rowplastic = $queryplastic->fetch_assoc();
$output = '<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" id="order_tables"><table class="table table-bordered table-striped"><tr class="pro_tbl_head">'
        . '<th width="30%">'.$product_name.'</th>'. ' <th width="15%">'.$product_quantity.'</th> <th width="25%">'.$product_total.'</th><th width="25%">'.$product_action.'</th></tr>';
//$cop_cart_details='<div class="table-responsive" id="order_table"><table class="table table-bordered table-striped"><tr><th width="45%">'.$product_name.'</th><th width="10%">'.$product_quantity.'</th><th width="20%">'.$product_price.'</th><th width="15%">'.$product_total.'</th></tr>';


$currency = '€';
$today = date('Y-m-d');
$ot_time =  date('H:i:s');   
$deviceip ='100.22.22';  

$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttable' AND DATE(date_time) = '$today'");	
$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttable'");

		
 	while($row1 = $result->fetch_assoc()) {
		$table_noexists = $row1['table_no'];
		$price_after_dis = $row1['price_after_dis'];
		$discounton = $row1['discounton'];
		$disamount = $row1['disamount1'];
		$discountype = $row1['discountype'];
		
	 	
	}
$countplastic = $result->num_rows; 
	while($row = $table1->fetch_assoc()) {				 
				$table_no = $row['table_no'];			
			 	$output .= '<tr><td><span class="table-qty">'.$row['quty'].'×</span>'.$row['proname'].'</td>
				 <td class="cart_btn"><input type="hidden" value="'.$row['quty'].'"  class="check_crrent_quty"><a class="updateminusqty cart-meal-edit-delete" id="'. $row['proid'].'"><i class="fa fa-minus" aria-hidden="true"></i></a><p class="quantiy">'.$row['quty'].'</p><a class="updateqty cart-meal-edit-add" id="'. $row["proid"].'"><i class="fa fa-plus" aria-hidden="true"></i>
				 </a></td><td align="right">'.$currency.''.number_format($row['quty'] * $row['price'],  2, ",", ".").'</td><td><a name="delete" class="btn btn-danger btn-xs delete" id="'. $row["proid"].'" title="'.$remove.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
				 $total_price = $total_price + ($row['quty'] *$row['price']);
				 $total_item = $total_item + 1;
				 $totalprdt  =$totalprdt + $row['price'];
			}
			 //  $output .='<div class="row text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div><div class="col-md-6 col-xs-6 col-sm-6 txt" >'.$product_total.'</div><div class="col-md-6 col-xs-6 col-sm-6 txt_right">
			  // <span id="totalamount1"> '.number_format($total_price, 2).'</span></div></div>';
			   
			if($discounton==1 && $discountype==1){   
			$cart_delivery_charge_now=0;$discount_amount_now=0;
			  $kart_tc = $total_price;		 			 
			  $discount_amount_now=($kart_tc * ($disamount / 100));	 
			 $afterdiscountamt = $total_price - $discount_amount_now;		
				$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr   class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.number_format($disamount).'%)</td><td align="right" id="cart_discount_now">-€ '.number_format($discount_amount_now,  2, ",", ".").'</td></tr><tr class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
				/// $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
			   }		
		   else if($discounton==1 && $discountype==2){   
			    $discount_amount_now=$total_price - $disamount;	 
			 $afterdiscountamt =   $discount_amount_now;	
			   $cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.number_format($disamount).')</td><td align="right" id="cart_discount_now">-€ '.number_format($disamount, 2).'</td></tr><tr class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
			 ///   $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
		   }
			   else{
				$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_total.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr></tbody></table>'; 
				   /// $cop_cart_details.='<div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>';
				$afterdiscountamt = 0.00;
				$discount_amount_now = 0.00;
			   }

		 
			if(!empty($table_noexists)){
			   $edit_gift_query = "UPDATE `table_booked_2` SET   `object`='" . $deviceip . "', `logged_user`='" . $name . "', `total_price`='" .$total_price . "', `price_after_dis`='" .number_format($afterdiscountamt, 2) . "', `discountprice`='" . number_format($discount_amount_now, 2) . "'   WHERE `table_no`='" . $currenttable . "' AND DATE(date_time) = '$today'";
			   $mysqli->query($edit_gift_query);
			   
			}
			else{ 
				if($discounton==1 && $discountype==1 ){   
					$insert_order_query="INSERT INTO `table_booked_2`(`table_no`, `object`, `logged_user`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `order_time`, `date_time`)  VALUES ('".$currenttable."','".$deviceip."','".$name."','".$total_price."','1','1','".$disamount."','".number_format($afterdiscountamt, 2)."','". number_format($discount_amount_now, 2)."','".$ot_time."','".date("Y-m-d h:m:i")."')";
				}
		   if($discounton==1 && $discountype==2){   
					$insert_order_query="INSERT INTO `table_booked_2`(`table_no`, `object`, `logged_user`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `order_time`, `date_time`)  VALUES ('".$currenttable."','".$deviceip."','".$name."','".$total_price."','1','2','".$disamount."','".number_format($afterdiscountamt, 2)."','". number_format($disamount, 2)."','".$ot_time."','".date("Y-m-d h:m:i")."')";
				}
				else{
					if($currenttable!=0){
 					$insert_order_query="INSERT INTO `table_booked_2`(`table_no`, `object`, `logged_user`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `order_time`, `date_time`)  VALUES ('".$currenttable."','".$deviceip."','".$name."','".$total_price."','0','1','0.00','".number_format($afterdiscountamt, 2)."','". number_format($discount_amount_now, 2)."','".$ot_time."','".date("Y-m-d h:m:i")."')";
					}
			} 
				 $insert_order_query_result = $mysqli->query($insert_order_query);
				
			}
		 
	$table1=$mysqli->query("SELECT `message` FROM `messages` WHERE  table_no = '$currenttable' AND DATE(created_at) = '$today'");
	 
	while($row1 = $table1->fetch_assoc()) {
		 $message = $row1['message'];
	}
		
		
			 $data=array(
				 	 'afterdis'=> $cop_cart_details,
				'cart_details'  => $output,
				'total_price1'  => number_format($total_price, 2),
				 'discountaddremove'=> $discountonofdiv,
				 'message'=> $message,		
				 'total_item'=>$total_item			
			 );   		
		 echo json_encode( $data);	 
    }
    
    	 
  if($action == 'loadcartdata2'){
		 $currenttable = $_POST['currentselected'];
        $total_price = 0;$delivery_crg_amt='';$discount_amt=0;$cart_FinalBill_amt4d=0;$cart_FinalBill2pay_now1=0;$oo_cakrt='';
       // echo "<br/>1>".$discount_amt."<";
$total_item = 0;$cart_delivery_charge_now='';
$product_name=($current_lang=="en")?"Name":"Naam";
$product_price=($current_lang=="en")?"Price":"Prijs";
$product_quantity=($current_lang=="en")?"Qty":"qty";
$product_quantity=($current_lang=="en")?"Qty":"Qty";
$product_total=($current_lang=="en")?"Total":"Totaal";
$product_subtotal=($current_lang=="en")?"Subtotal":"Subtotaal";
$product_action=($current_lang=="en")?"Action":"Actie";
$remove=($current_lang=="en")?"Remove":"Verwijderen";
$empty_cart=($current_lang=="en")?"Your Cart is Empty!":"Uw winkelwagen is leeg!";
$delivery_charge=($current_lang=="en")?"Delivery charge":"Bezorgkosten";
$discount_percentage=($current_lang=="en")?"Discount":"Korting";
$finaltotal=($current_lang=="en")?"Total":"Totaal";
$plastic_charge=($current_lang=="en")?"Plastic charge":"Plastic lading";
$output = '<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" id="order_tables"><table class="table table-bordered table-striped"><tr class="pro_tbl_heads">'
        . '<th width="30%">'.$product_name.'</th>'. '<th width="15%">'.$product_quantity.'</th><th width="25%">'.$product_total.'</th><th width="25%">'.$product_action.'</th></tr>';

 $currency = '€';
$today = date('Y-m-d');
$ot_time =  date('H:i:s');   
$deviceip ='100.22.22';  

$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttable' AND DATE(date_time) = '$today'");	
$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttable'");
 	while($row1 = $result->fetch_assoc()) {
		$table_noexists = $row1['table_no'];
		$price_after_dis = $row1['price_after_dis'];
		$discounton = $row1['discounton'];
		$disamount = $row1['disamount1'];
		$discountype = $row1['discountype'];
	 	$username = $row1['logged_user'];
	}
$countplastic = $result->num_rows; 
	  if(!empty($countplastic)){
	while($row = $table1->fetch_assoc()) {				 
				$table_no = $row['table_no'];			
			 	$output .= '<tr><td><span class="table-qty">'.$row['quty'].'×</span>'.$row['proname'].'</td>
				 <td class="cart_btn"><input type="hidden" value="'.$row['quty'].'"  class="check_crrent_quty"><a class="updateminusqty cart-meal-edit-delete" id="'. $row['proid'].'"><i class="fa fa-minus" aria-hidden="true"></i></a><p class="quantiy">'.$row['quty'].'</p><a class="updateqty cart-meal-edit-add" id="'. $row["proid"].'"><i class="fa fa-plus" aria-hidden="true"></i>
				 </a></td><td align="right">'.$currency.''.number_format($row['quty'] * $row['price'], 2, ",", ".").'</td><td><a name="delete" class="btn btn-danger btn-xs delete" id="'. $row["proid"].'" title="'.$remove.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
				 $total_price = $total_price + ($row['quty'] *$row['price']);
				 $total_item =$total_item+$row['quty'];
				 $totalprdt  =$totalprdt + $row['price'];
			}
			 //  $output .='<div class="row text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div><div class="col-md-6 col-xs-6 col-sm-6 txt" >'.$product_total.'</div><div class="col-md-6 col-xs-6 col-sm-6 txt_right">
			  // <span id="totalamount1"> '.number_format($total_price, 2).'</span></div></div>';
			   
			if($discounton==1 && $discountype==1){   
			$cart_delivery_charge_now=0;$discount_amount_now=0;
			  $kart_tc = $total_price;		 			 
			  $discount_amount_now=($kart_tc * ($disamount / 100));	 
			 $afterdiscountamt = $total_price - $discount_amount_now;		
				$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.number_format($disamount).'%)</td><td align="right" id="cart_discount_now">-€ '.number_format($discount_amount_now, 2, ",", ".").'</td></tr><tr class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
		/// 	 $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
			   }	
		   else if($discounton==1 && $discountype==2){   
			    $discount_amount_now=$total_price - $disamount;	 
			 $afterdiscountamt =   $discount_amount_now;	
			   $cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.number_format($disamount).')</td><td align="right" id="cart_discount_now">-€ '.number_format($disamount, 2, ",", ".").'</td></tr><tr class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
			 ///  $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
		   }
			   else{
				$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_total.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($total_price, 2, ",", ".").'</td></tr></tbody></table>'; 
		///  $cop_cart_details.='<div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>';
				
			   }
	$table1=$mysqli->query("SELECT `message` FROM `messages` WHERE  table_no = '$currenttable' AND DATE(created_at) = '$today'");	 
	while($row1 = $table1->fetch_assoc()) {
		 $message = $row1['message'];
	}
		
		  $data=array(
			'cart_details'  => $output,
			'checkemptynot' => 1,
			  	 'afterdis'=> $cop_cart_details,
			  	 'total_price1'  => number_format($total_price, 2),
			///	 'discountaddremove'=> $discountonofdiv,
			  	 'message'=> $message,
			     'bookedby'=> $username,
			     'total_item'=>$total_item,
			   'discounton' =>$discounton
			 ); 		
	  }
	  else{
		    $data=array(
		  'checkemptynot' =>2
		    	 
				 ); 
	  }
	  
	  
	   echo json_encode( $data);

 }	
	
	
    if($action=='dish_attrib_popup'){
       $current_lang=$_POST['current_lang'];
	  $product_attrib=$_POST['product_attrib'];
		$currency = '+€ ';
	  
 
	if($current_lang=="en"){  $limit_text = 'Limit';}
		else {  $limit_text = 'Begrenzing'; }
		
	$required_ALL = 0;	
	$count = 1;	
       // get varialbes by id's   
       $print_dish = "SELECT  *  FROM `tvariable`  WHERE   `variable_id` IN(".$product_attrib.") ";
       $query_result = $mysqli->query($print_dish); 
       while($row2 = $query_result->fetch_assoc()){
            $type = $row2['type']; // selectbox, checkbox
            $selection_type = $row2['option_type'];  // Single , 2,3 or multiple
		    $selection_type2 = $row2['option_type'];  // Single , 2,3 or multiple
            $required = $row2['required'];
		    if($required==1){ $required_ALL = $required_ALL+1; $req = '*';}else{$req = '';}  
            $varib_name=($current_lang=="en")?$row2['variable_name_en']:$row2['variable_name_nl'];
            $varib_name_des=($current_lang=="en")?$row2['variable_description_en']:$row2['variable_description_nl']; 
            $variable_attrb_list = $row2['variable_attrb_list'];
             if($selection_type==4 || $selection_type==0){
              $selection_type = 'No';
				 $limit_text = '';
				     $selection_type2 = ' '; 
            }  
		   else{
			   if($current_lang=="en"){  $limit_text = 'Limit';}
		       else {  $limit_text = 'Begrenzing'; }
		   }
		     
		  
		   
		   
        if($type==1){   // checkbox              ?>
        <div class="select_main attrno <?php echo $varib_name;?>">
        <?php  echo '<p class="var_des">'.$varib_name_des.'</p>';
					 echo '<span class="var-label">'.$varib_name.' <b>'.$req.'</b></span>';   ?>
			
       <?php // <sup>'.$limit_text.' '.$selection_type2.'</sup>
        $print_dish2 = "SELECT  *  FROM `tattribute`  WHERE   `attrib_id` IN(".$variable_attrb_list.")";
        $query_result2 = $mysqli->query($print_dish2); 
         while($row2 = $query_result2->fetch_assoc()){
              $attrib_name=($current_lang=="en")?$row2['attrib_name_en']:$row2['attrib_name_nl'];
             if($row2['attrib_price']!=0.00){
            $attrib_price =   '('.$currency .''.number_format($row2['attrib_price'], 2, ",", ".").')';
			 }
			 else{$attrib_price = '';
			 }
       ?> 
         <div class="label attriblabel">
             <?php 
echo '<input type="checkbox" class="attrcheckadd" data-name="'.$attrib_name.'" data-price="'.$row2['attrib_price'].'" value="'.$row2['attrib_id'].'" data-limit="'.$selection_type.'" >'.$attrib_name.' '.$attrib_price.'</label>';
             ?>
         </div>
        <?php } // attribute loop  
            echo '<input type="hidden"  class="type" value="'.$type.'" />';
            echo '<input type="hidden"   class="required" value="'.$required.'" />';
			  echo '<input type="hidden"   class="required_pass required_pass_'.$count.'" value="'.$required.'" />';
           ?> 
         </div><!--attriblabel-->
             
        <?php    }// if varilabe is checkbox
            else{ // if select option
        $sel_optn=($current_lang=="en")?'Choose an option...':'Een optie kiezen…';    
         echo '<div class="select_main attrno  '.$varib_name.'">';	 
        echo '<span class="var-label">'.$varib_name.'<b>'.$req.'</b></span>'; 
        echo '<select id="dish_attrib'.$varib_name.'" name="dish_attrib" class="form-group dish_attrib'.$varib_name.' attriblok">';
		echo '<option value="default">'.$sel_optn.'</option>';
   $print_dish2 = "SELECT  *  FROM `tattribute`  WHERE   `attrib_id` IN(".$variable_attrb_list.")";
        $query_result2 = $mysqli->query($print_dish2); 
         while($row2 = $query_result2->fetch_assoc()){
              $attrib_name=($current_lang=="en")?$row2['attrib_name_en']:$row2['attrib_name_nl'];
               if($row2['attrib_price']!=0.00){
            $attrib_price =   '('.$currency .''.number_format($row2['attrib_price'], 2, ",", ".").')';
			 }
			 else{$attrib_price = '';
			 }
    
echo '<option data-lok="'.$row2['attrib_price'].'" data-price="'.$row2['attrib_price'].'" value="'.$row2['attrib_id'].'"  data-name="'.$attrib_name.'">'.$attrib_name.' '.$attrib_price.'</option>';
             ?>       
        <?php } // attribute loop  
			echo '</select>';	
            echo '<input type="hidden"  class="type" value="'.$type.'" />';
		   echo '<input type="hidden"   class="required_pass required_pass_'.$count.'" value="'.$required.'" />';
            echo '<input type="hidden"   class="selected_price" value="0" />';
            echo '<input type="hidden"   class="required" value="'.$required.'" />';
		 
				
           ?>       
    </div>
        <?php

            } // if choose type seelect
		$count++;
         }         
           ///print_r($query_result2);
   echo '<input type="hidden"   class="required_all" value="'.$required_ALL.'" />';
    }

	
  
       
if($action == 'addtokart'){
	  $currenttabe = $_POST["currentselected"]; 	
	 
	 
   $custmdataid=rand(1, 9999).date("hmi");
 

   $item_array = array(
	'product_id'               =>     $_POST["product_id"],  
	'product_name'             =>     $_POST["product_name"],  
	'product_price'            =>     $_POST["product_price"],  
	'product_quantity'         =>     $_POST["product_quantity"],
	'custkey'                  =>      $custmdataid
   );
  $names_str = serialize($item_array); 
print_r($names_str);
   $today = date('Y-m-d');
   $ot_time =  date('H:i:s');  
$deviceip ='100.22.22'; 

$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttabe' AND proid = '".$_POST["product_id"]."'  AND  DATE(date_time) = '$today'");
$quty;
	while($row = $table1->fetch_assoc()) {
		$quty = $quty+$row['quty'];
		$proid =  $row['proid'];
	} 

	$quty = $quty+1;
  if($proid==$_POST["product_id"]){ 
	$edit_gift_query = "UPDATE `table_booked` SET   `quty`='" . $quty . "'     WHERE `table_no`='" . $currenttabe . "' AND  `proname`='" . $_POST["product_name"] . "'  AND  DATE(date_time) = '$today'";
	$mysqli->query($edit_gift_query);
   }
   else{ 
	    $insert_order_query="INSERT INTO `table_booked`(`table_no`,`proid`, `proname`,`price`,`quty`,`date_time`)  VALUES ('".$currenttabe."','".$_POST["product_id"]."','".$_POST["product_name"]."','".$_POST["product_price"]."','".$_POST["product_quantity"]."','".date("Y-m-d h:m:i")."')";
	  $insert_order_query_result = $mysqli->query($insert_order_query);
    }
 
 
}

if($action == 'adddiscount'){
	$product_price="Price";
	$product_subtotal="Subtotal";
	$finaltotal="Total";
	$discount_percentage="Discount";
	$currenttabe = $_POST["currentselected"];
	 
  $today = date('Y-m-d');
	$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttabe'");
	while($row1 = $result->fetch_assoc()) {
				$current_price = $row1['total_price'];
		}
	
	$cart_delivery_charge_now=0;$discount_amount_now=0;
	 $kart_tc = $current_price;
	 $disType;

	if(!empty($_POST['discountamt'])){
	 $discount_amount_now=($kart_tc * ($_POST['discountamt'] / 100));
	 $disType = 1;
		$afterdiscountamt = $current_price - $discount_amount_now;
	}
	else{
		 $discount_amount_now=($kart_tc - ($_POST['discountffix'])); 
		  $afterdiscountamt = $discount_amount_now;
		 $disType = 2;    
		}

  

	if(!empty($_POST['discountamt'])){
		$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($current_price,  2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr  class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.$_POST['discountamt'].'%)</td><td align="right" id="cart_discount_now">-€ '.number_format($discount_amount_now, 2).'</td></tr><tr  class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
		///  $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
		$discountprice = $_POST['discountamt'];
	  }
		else if(!empty($_POST['discountffix'])){
		$cop_cart_details.='<table  class="table table-bordered table-striped"><tbody><tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">€ '.number_format($current_price,  2, ",", ".").'</td></tr>'.$delivery_chargenew.'<tr  class="disc-inforhide">'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.$_POST['discountffix'].')</td><td align="right" id="cart_discount_now">-€ '.number_format($_POST['discountffix'], 2).'</td></tr><tr  class="disc-inforhide"><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">€ '.number_format($afterdiscountamt, 2, ",", ".").'</td></tr></tbody></table>'; 
			///  $cop_cart_details.='<div class="removdis">Remove discount: <div class="discountremove">X</div></div>';
			$discountprice = $_POST['discountffix'];
	  }

	   $today = date('Y-m-d');
	   $ot_time =  date('H:i:s');   
   $deviceip ='100.22.22';  
   
	
   $countplastic = $result->num_rows;   
   if(!empty($countplastic)){
	   
	   
	  $edit_gift_query = "UPDATE `table_booked_2` SET   `total_price`='" .$current_price . "', `price_after_dis`='" .number_format($afterdiscountamt, 2) . "',`discounton`='1',`discountype`='".$disType."',  `disamount1`='" .$discountprice. "', `discountprice`='" . number_format($discount_amount_now, 2) . "'   WHERE `table_no`='" . $currenttabe . "' AND DATE(date_time) = '$today'";
	$mysqli->query($edit_gift_query);
	  
	}

	$data = array(
		'discounthtml'=>    $cop_cart_details,  
		'priceafterdiscount'=>   number_format($afterdiscountamt, 2),
		'discountamt'=>    number_format($discount_amount_now, 2)

	   );	   
	 echo json_encode($data);
 	
}

	
	
if($_POST["action"] == 'removediscount') {
		$currenttable = $_POST["currentselected"];
		$today = date('Y-m-d');
			$product_total="Totaal";  
			$afterdiscountamt = 0.00;
			$discount_amount_now = 0.00;
 
			$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttable'");
			while($row1 = $result->fetch_assoc()) {
				$total_price = $row1['total_price'];
			}


		$edit_gift_query = "UPDATE `table_booked_2` SET  `total_price`='" .$total_price . "', `price_after_dis`='0.00',`discounton` = '0',`discountype` = '0', `discountprice`='0.00'   WHERE `table_no`='" . $currenttable . "' AND DATE(date_time) = '$today'";
			$mysqli->query($edit_gift_query);
     

}


if($_POST["action"] == 'remove') {
	 $currenttabe = $_POST["currentselected"]; 
  	$product_id = $_POST["product_id"]; 
	$today = date('Y-m-d');
	$deltefromdevices = "DELETE   FROM `table_booked` WHERE  (DATE(date_time) = '$today' AND table_no = '$currenttabe') AND proid ='$product_id' ";         
	 $mysqli->query($deltefromdevices);
	
	$result=$mysqli->query("SELECT  `table_no`  FROM `table_booked` WHERE  DATE(date_time) = '$today' AND table_no = '$currenttabe'"); 
 $countplastic = $result->num_rows;   
		if(!empty($countplastic)){
			echo 0;
		}
	else { echo 1; }
	
 }// action remove


if($_POST["action"] == 'empty') {
  unset($_SESSION["product_cart"]);
 }
    
}


/*
if($_POST["action"] == 'saveorder') {
	
  $currenttabe = $_POST["currentselected"]; 
 $paymentmethod = $_POST["paymentmethod"]; 
	///$order_details = $_SESSION["cart_details_for_odrtbl"]['cart_details'];
	  ///$insert_order_query="INSERT INTO `admin_orders`(`table_no`,`products`,`order_date`) VALUES ('".$currenttabe."','".$order_details."','".date("Y-m-d h:m:i")."')";    
///$insert_order_query_result = $mysqli->query($insert_order_query);
	
$ot_time =  date('H:i:s');  

	$discountsess= $_SESSION['discountt_'.''.$currenttabe];
	
	  $order_details = $_SESSION["cart_details_for_odrtbl"]['cart_details']; 
$total_price_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['total_price']);
$discount_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['discount']); 
$delivery_charge_js = $_SESSION["cart_details_for_odrtbl"]['delivery_charge'];
$finalbill_js = str_replace(",", "",$_SESSION["cart_details_for_odrtbl"]['finalbill']);

$total_item = 0;
$product_name="Naam";
$product_total="Totaal";
$output = '<table class="table table-bordered table-striped" border="1"><tr class="pro_tbl_heads">'
        . '<th width="50%">'.$product_name.'</th>'. '<th width="50%">'.$product_total.'</th></tr>';
 foreach($_SESSION['product_cart'.''.$currenttabe] as $keys => $values)
 {
  
  $output .= '<tr><td><span class="table-qty">'.$values["product_quantity"].'×</span>'.$values["product_name"].'</td><td align="right">'.currency.' '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td></tr>'; 
  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
  $total_item = $total_item + 1;
 }
  $output .= '</table>';	
	
	 
	$price1= 0;
	 $price2 = 0;
	$today = date('Y-m-d');
	$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttabe' AND DATE(date_time) = '$today'");
	while($row = $table1->fetch_assoc()) {
		if($row['protype']==1){
 				$price1 = $price1 + ($row['quty'] *$row['price']);
		}	
		else{
 				$price2 = $price2 + ($row['quty'] *$row['price']);
		}
	}
	
		if($_SESSION['discount_type_'.''.$currenttabe]=='fixed'){
				 $discount_amount_now1="".currency." ".number_format($_SESSION['discountt_'.''.$currenttabe.'_value'], 2);setlocale(LC_ALL,NULL);
      $discount_amt=str_replace("€", "", $_SESSION['discountt_'.''.$currenttabe.'_value']);	 
		}
	else{
		
	 $discount_amount_now1="".currency." ".number_format($_SESSION['discountt_'.''.$currenttabe.'_value'], 2);setlocale(LC_ALL,NULL);
      $discount_amt=str_replace("€", "", $_SESSION['discountt_'.''.$currenttabe.'_value']);	  
	}

	$x = str_replace( ',', '', $discount_amt);
	$dd = floatval(preg_replace('/[^\d.]/', '', $x));
	
	if($_SESSION['discount_type_'.''.$currenttabe]=='fixed'){
		 
		 $total =  $_SESSION["cart_details_for_odrtbl"]['total_price']- $discount_amt;
		$priceInDollars = $x;
	}
	else{
		 $priceInDollars = $dd / 100; 
		  $total =  $_SESSION["cart_details_for_odrtbl"]['finalbill']-$priceInDollars;
		      if(number_format($total, 2) > 0)
		 {setlocale(LC_ALL, 'nl_NL');
			 $discount_amount_now1="- ".currency." ".number_format($total, 2);setlocale(LC_ALL,NULL);
                 $discount_amt=number_format($total, 2);		  
                 }
                 else{setlocale(LC_ALL, 'nl_NL');
					  $discount_amount_now1="- ".currency." ".number_format($total, 2);setlocale(LC_ALL,NULL);
                 $discount_amt=number_format($total, 2);		 
                 }
	}
	

	
	
	if($_SESSION['discount_type_'.''.$currenttabe]=='fixed'){
		   $item_array = array(
    'discountt_'               =>    $_SESSION['discountt_'.''.$currenttabe],  
    'discount_type_'            =>    $_SESSION['discount_type_'.''.$currenttabe],
	    'discountt_val'            =>str_replace("€", "", $_SESSION['discountt_'.''.$currenttabe]) ,
	   'total' =>  $priceInDollars,
	   'disvalfix' => $_SESSION['discountt_'.''.$currenttabe.'_value']
   );
	}
	else{	 
   $item_array = array(
    'discountt_'               =>    $_SESSION['discountt_'.''.$currenttabe],  
    'discount_type_'            =>    $_SESSION['discount_type_'.''.$currenttabe],
	    'discountt_val'            =>  $priceInDollars,
	   'total' =>  $discount_amt,
	   'disvalfix' => $_SESSION['discountt_'.''.$currenttabe.'_value']
   );
	}
	
	if(isset($_SESSION['discountt_'.''.$currenttabe])){ 
	if($_SESSION['discount_type_'.''.$currenttabe]=='fixed'){	
 	$insert_order_query="INSERT INTO `admin_orders`(`table_no`,`products`,`producttable2`, `subtotal`, `discount_if`, `TotalAmount`, `order_time`, `order_date`,`paid_with`)  VALUES ('".$currenttabe."','".$order_details."','".$output."','".$total_price_js."','".str_replace("€", "", $_SESSION['discountt_'.''.$currenttabe])."','".$priceInDollars."','".$ot_time."','".date("Y-m-d h:m:i")."','".$paymentmethod."')";  
		 $insert_order_query_result = $mysqli->query($insert_order_query); 
	}
		else{
		 $insert_order_query="INSERT INTO `admin_orders`(`table_no`,`products`,`producttable2`, `subtotal`, `discount_if`, `TotalAmount`, `order_time`, `order_date`,`paid_with`)  VALUES ('".$currenttabe."','".$order_details."','".$output."','".$total_price_js."','".$priceInDollars."','".$discount_amt."','".$ot_time."','".date("Y-m-d h:m:i")."','".$paymentmethod."')"; 
			 $insert_order_query_result = $mysqli->query($insert_order_query); 
		}
	}
	else{
			 $insert_order_query="INSERT INTO `admin_orders`(`table_no`,`products`,`producttable2`, `subtotal`, `discount_if`, `TotalAmount`,`price_nodrink`,`price_drink`, `order_time`, `order_date`,`paid_with`)  VALUES ('".$currenttabe."','".$order_details."','".$output."','".$total_price_js."','".$discount_js."','".$discount_amt."','".$price2."','".$price1."','".$ot_time."','".date("Y-m-d h:m:i")."','".$paymentmethod."')";
		 $insert_order_query_result = $mysqli->query($insert_order_query); 
	}
	
	
 
	
		unset($_SESSION['product_cart'.''.$currenttabe]);
		  unset($_SESSION['table_msg_'.''.$currenttabe]) ;
			  unset($_SESSION['discountt_'.''.$currenttabe]);
			  unset($_SESSION['discount_type_'.''.$currenttabe]);
			  unset($_SESSION['discountt_'.''.$currenttabe.'_value']);
 		 
	 
	
	 echo json_encode($insert_order_query);
}
*/




if($_POST["action"] == 'saveorder') {
	
  $currenttable = $_POST["currentselected"]; 
 $paymentmethod = $_POST["paymentmethod"]; 
	 
        $total_price = 0;$delivery_crg_amt='';$discount_amt=0;$cart_FinalBill_amt4d=0;$cart_FinalBill2pay_now1=0;$oo_cakrt='';
       // echo "<br/>1>".$discount_amt."<";
$total_item = 0;$cart_delivery_charge_now='';
$product_name=($current_lang=="en")?"Name":"Naam";
$product_price=($current_lang=="en")?"Price":"Prijs";
$product_quantity=($current_lang=="en")?"Qty":"qty";
$product_quantity=($current_lang=="en")?"Qty":"Qty";
$product_total=($current_lang=="en")?"Total":"Totaal";
$product_subtotal=($current_lang=="en")?"Subtotal":"Subtotaal";
$product_action=($current_lang=="en")?"Action":"Actie";
$remove=($current_lang=="en")?"Remove":"Verwijderen";
$empty_cart=($current_lang=="en")?"Your Cart is Empty!":"Uw winkelwagen is leeg!";
$delivery_charge=($current_lang=="en")?"Delivery charge":"Bezorgkosten";
$discount_percentage=($current_lang=="en")?"Discount":"Korting";
$finaltotal=($current_lang=="en")?"Total":"Totaal";
$output = '<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" id="order_tables"><table class="table table-bordered table-striped" border="1"  cellspacing="0" cellpadding="7" width="100%"><tr class="pro_tbl_heads">'
        . '<th width="50%">'.$product_name.'</th>'. '<th width="50%">'.$product_total.'</th></tr>';

 
$today = date('Y-m-d');
$ot_time =  date('H:i:s');   

$currency = '€';
$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttable' AND DATE(date_time) = '$today'");	
$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttable'");
 	while($row1 = $result->fetch_assoc()) {
		$table_noexists = $row1['table_no'];
		$price_after_dis = $row1['price_after_dis'];
		$discounton = $row1['discounton'];
		$disamount = $row1['disamount1'];
		$discountype = $row1['discountype'];
		$total_price = $row1['total_price'];
		$discountprice = $row1['discountprice'];
	 	
	}
	 
	
$countplastic = $result->num_rows; 
	while($row = $table1->fetch_assoc()) {				 
				$table_no = $row['table_no'];			
			 	$output .= '<tr><td><span class="table-qty">'.$row['quty'].'×</span> '.$row['proname'].'</td><td align="right">'.$currency.''.number_format($row['quty'] * $row['price'], 2, ",", ".").'</td></tr>';
			} 
  
				if($discounton==1 && $discountype==1){   
					$insert_order_query="INSERT INTO `admin_orders_new`(`table_no`,  `producttable2`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `paid_with`, `order_time`, `order_date`,`ad_status`)  VALUES ('".$currenttable."','".$output."','".$total_price."','1','1','".$disamount."','".number_format($price_after_dis, 2)."','". number_format($discountprice, 2)."','".$paymentmethod."','".$ot_time."','".date("Y-m-d h:m:i")."','1')";
					$check =1;
				}
		   else if($discounton==1 && $discountype==2){   
	$insert_order_query="INSERT INTO `admin_orders_new`(`table_no`,  `producttable2`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `paid_with`, `order_time`, `order_date`,`ad_status`)  VALUES ('".$currenttable."','".$output."','".$total_price."','1','2','".$disamount."','".number_format($price_after_dis, 2)."','". number_format($discountprice, 2)."','".$paymentmethod."','".$ot_time."','".date("Y-m-d h:m:i")."','1')";
			   $check =2;
				}
				else{
			$insert_order_query="INSERT INTO `admin_orders_new`(`table_no`,  `producttable2`, `total_price`, `discounton`, `discountype`, `disamount1`,`price_after_dis`, `discountprice`, `paid_with`, `order_time`, `order_date`,`ad_status`)  VALUES ('".$currenttable."','".$output."','".$total_price."','0','0','0.00','".$total_price."','0.00','".$paymentmethod."','".$ot_time."','".date("Y-m-d h:m:i")."','1')";
					$check =3;
			} 
			  $insert_order_query_result = $mysqli->query($insert_order_query);
				
		
 
		   
	 		$deltefromdevices1 = "DELETE   FROM `table_booked` WHERE   table_no =$currenttable";
			 $deltefromdevices = "DELETE  FROM `table_booked_2` WHERE   table_no =$currenttable";
				 $deltefromdevices3 = "DELETE  FROM `messages` WHERE   table_no =$currenttable";
         	$mysqli->query($deltefromdevices1);
		   $mysqli->query($deltefromdevices);
	   $mysqli->query($deltefromdevices3);
	 echo json_encode($insert_order_query_result);		 
 
}



if($_POST["action"] == 'tableorder_print') {
	$current_lang = $_SESSION['current_lang'];
	 $currenttable = $_POST['currentselected']; 
$product_name=($current_lang=="en")?"Name":"Naam";
$product_price=($current_lang=="en")?"Price":"Prijs";
//$product_quantity=($current_lang=="en")?"Quantity":"Aantal stuks";
$product_quantity=($current_lang=="en")?"Qty":"Qty";
$product_total=($current_lang=="en")?"Total":"Totaal";
$product_subtotal=($current_lang=="en")?"Subtotal":"Subtotaal";
	$discount_percentage=($current_lang=="en")?"Discount":"Korting";
$finaltotal=($current_lang=="en")?"Total":"Totaal";
	$cop_cart_details = '<div class="top-print"><center><img src="'.$logo_url.'" class="img-responsive" width="150" height="80" style="display: block;max-width: 100%;height: auto;"/></center>
	<ul style="display:none">
<li style="list-style: none;text-align: center;padding: 5px;font-weight: 600;">'.$rest_addrss_main.'<br>
'.$rest_postcode_two.','.$rest_postcode_main.' '.$res_rest_city.'</li>
<li style="list-style: none;text-align: center;padding: 5px;font-weight: 600;">'.$res_rest_cont.'</li>
<li style="list-style: none;text-align: center;padding: 5px;font-weight: 600;">'.$res_email_main.'</li>
<li style="list-style: none;text-align: center;padding: 5px;font-weight: 600;">'.$rest_weblink_main.'</li>
</ul></div><p style="font-weight:600;text-align:center">Table No: '.$currenttable.'</p></div><table border="1" cellspacing="0" cellpadding="5" width="100%"><thead><tr>'
        . '<th width="50%">'.$product_name.'</th><th>'.$product_total.'</th></tr></thead><tbody>';

 $currency = '€';
	
$today = date('Y-m-d');
 
   
$table1=$mysqli->query("SELECT * FROM `table_booked` WHERE  table_no = '$currenttable' AND DATE(date_time) = '$today'");	
$result=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today' AND table_no = '$currenttable'");
 	while($row1 = $result->fetch_assoc()) {
		$table_noexists = $row1['table_no'];
		$price_after_dis = $row1['price_after_dis'];
		$discounton = $row1['discounton'];
		$disamount = $row1['disamount1'];
		$discountype = $row1['discountype'];
	 	
	}
$countplastic = $result->num_rows; 
	while($row = $table1->fetch_assoc()) {				 
				$table_no = $row['table_no'];			
			 	$cop_cart_details .= '<tr><td  width="50%"><span class="table-qty">'.$row['quty'].'×</span>'.$row['proname'].'</td>
				<td align="right">'.$currency.' '.number_format($row['quty'] * $row['price'], 2).'</td></tr>';
				 $total_price = $total_price + ($row['quty'] *$row['price']);
				 $total_item = $total_item + 1;
				 $totalprdt  =$totalprdt + $row['price'];
			}
			   
			if($discounton==1 && $discountype==1){   
			$cart_delivery_charge_now=0;$discount_amount_now=0;
			  $kart_tc = $total_price;		 			 
			  $discount_amount_now=($kart_tc * ($disamount / 100));	 
			 $afterdiscountamt = $total_price - $discount_amount_now;		
				$cop_cart_details.='<table   border="1" cellspacing="0" cellpadding="5" width="100%"><tbody><tr><td width="50%">'.$product_subtotal.'</td><td align="right"  width="50%">€ '.number_format($total_price, 2).'</td></tr>'.$delivery_chargenew.'<tr>'.$plasticcharge.'<td>'.$discount_percentage.' ('.number_format($disamount).'%)</td><td align="right"  width="50%">-€ '.number_format($discount_amount_now, 2).'</td></tr><tr><td>'.$finaltotal.'</td><td align="right">€ '.number_format($afterdiscountamt, 2).'</td></tr></tbody></table>'; 
			 
			   }	
		   else if($discounton==1 && $discountype==2){   
			    $discount_amount_now=$total_price - $disamount;	 
			 $afterdiscountamt =   $discount_amount_now;	
			   $cop_cart_details.='<table  border="1" cellspacing="0" cellpadding="5" width="100%"><tbody><tr><td width="50%">'.$product_subtotal.'</td><td align="right">€ '.number_format($total_price, 2).'</td></tr>'.$delivery_chargenew.'<tr>'.$plasticcharge.'<td>'.$discount_percentage.' ('.number_format($disamount).')</td><td align="right" id="cart_discount_now">-€ '.number_format($disamount, 2).'</td></tr><tr><td>'.$finaltotal.'</td><td align="right">€ '.number_format($afterdiscountamt, 2).'</td></tr></tbody></table>'; 
		 
		   }
			   else{
				$cop_cart_details.='<table   border="1" cellspacing="0" cellpadding="5" width="100%"><tbody><tr><td width="50%">'.$product_total.'</td><td align="right">€ '.number_format($total_price, 2).'</td></tr></tbody></table>'; 
				   
			   } 
	
	
	$table1=$mysqli->query("SELECT `message` FROM `messages` WHERE  table_no = '$currenttable' AND DATE(created_at) = '$today'");
	 
				while($row1 = $table1->fetch_assoc()) {
					 $message = $row1['message'];
				}
					
	
	
	$cop_cart_details.='<table   border="1" cellspacing="0" cellpadding="5" width="100%"><tbody><tr><td width="50%">Message</td><td align="right">'.$message.'</td></tr></tbody></table>'; 
 
  
echo  $cop_cart_details;	
	
	
}

if($_POST["action"] == 'updatepaymentopt') {
	
//	  $currenttabe = $_POST["currentselected"]; 
	$currentrow = $_POST["showresultof"];
 $choosedval = $_POST["choosedval"]; 
		 //	$insert_order_query="INSERT INTO `admin_orders`(`paid_with`)  VALUES ('".$choosedval."') WHERE id='".$currentrow."'"; 
	    $edit_gift_query = "UPDATE `admin_orders_new` SET `paid_with`='" . $choosedval . "' WHERE `id`='" . $currentrow . "'";
		$mysqli->query($edit_gift_query);
}



if($_POST["action"] == 'deletebycode') {								
         $attrib_id = $_POST['rowid'];
		  $delcode = $_POST['delcode'];
		 $deletenew = $_POST['dele_new'];
        $notification_message = '';
		$del_query22="Select * from adm_set where adm_set_name='delcode' ";
                $result_del_query22 = $mysqli->query($del_query22);
				$row_delusr22 = $result_del_query22->fetch_assoc();
				$delcodedb = $row_delusr22['adm_set_vlu'];
		 //$delcodedb
		if($delcode==$delcodedb){			
			if($deletenew=='yes'){
				  $query = "DELETE  FROM `admin_orders_new` WHERE `id`='" . $attrib_id . "'";
			}
			else{
				   $query = "DELETE  FROM `admin_orders_new` WHERE `id`='" . $attrib_id . "'";
			}
			
     

        if ($mysqli->query($query)) {
           /// $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Order deleted successfully.</div></div></div><!-- //.Note section -->';
        $notification_message =  $attrib_id;
		} else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Order not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        } 
		} else { 
			$notification_message = '1';
		}
	
        echo $notification_message;
    }

if($_POST["action"] == 'search_and_ad') {
	$searchkey = $_POST['valuesearch'];
	if($searchkey!=''){
	 //$query2 = "Select * from tdish where CONCAT(',', `dish_name_nl`, ',') like '%," . $searchkey . ",%'  AND dish_status = 'Active'   ";
  $query2 = "SELECT * FROM tdish  WHERE dish_name_nl LIKE '%$searchkey%'  AND dish_status = 'Active'"	;
                    //echo $query2;die();
        //  $list_gift_query = "Select * From `tdish` where `dish_name_nl` like '%," . $searchkey . ",%'   dish_status = 'Active' "; //echo $list_gift_query;die();

	$dish_list_arr = $mysqli->query($query2);
	$product_list = '';
	
          $product_list .= "<li class=\"product-category table-cat product\">";
		if(mysqli_num_rows($dish_list_arr) > 0){
       while ($row = $dish_list_arr->fetch_assoc()) {
 $product_name = '';
		   $result = str_replace(',', '.', $row['dish_price']);
                        $product_desc = '';
						 $product_list .= '<div class="product_cart table-cart">
						 <div class="product_detailss pro-box">
                        <h4>' . $row['dish_name_en'] . '</h4>
						<div class="prod-descreption">
                        <p>' . $row['dish_desc_en'] . '</p>
						</div></div>
                     <div class="addtocart_price table-price">
                       <span class="price"><span class="amount"><span class="currencySymbol">' . currency . '</span>' .  $result. '</span></span>
                       <div class="add_to_cartbutn">
                       <input type="hidden" name="quantity" id="quantity' . $row["dish_id"] . '" class="form-control" value="1" />
             <input type="hidden" name="hidden_name" id="name' . $row["dish_id"] . '" value="' . $row["dish_name_en"] . '" />
             <input type="hidden" name="hidden_price" id="price' . $row["dish_id"] . '" value="' . $row["dish_price"] . '" />
             <input type="hidden" name="hidden_dish_type" id="dish_type' . $row["dish_id"] . '" value="' . $row["dish_type"] . '" />    
             <input type="hidden" name="hidden_dish_attrib" id="dish_attrib' . $row["dish_id"] . '" value="' . $row["dish_attrib"] . '" />    
<a class="add_to_cart" name="add_to_cart" id="' . $row["dish_id"] . '"  href="javascript:void(0)"><i class="fa fa-plus"></i></a> </div>
                    </div>
                 </div>';	
						
                    }
			
		}else{
			$product_list='';
		}
	
 $product_list .= "</li>";
	  
	echo $product_list;
	} 
}

if($_POST["action"] == 'updateqty') {
	$today = date('Y-m-d');	
	$currenttable = $_POST['currentselected']; 
	$product_id = $_POST['product_id']; 
   $currernt_qty  = $_POST['check_crrent_quty'];
   $currernt_qty = $currernt_qty+1;
    $edit_gift_query = "UPDATE `table_booked` SET   `quty`='" . $currernt_qty . "'  WHERE `table_no`='" . $currenttable . "' AND DATE(date_time) = '$today' AND proid = '$product_id'";
	$done=  $mysqli->query($edit_gift_query);
    
 }

	if($_POST["action"] == 'updateminusqty') {
		$today = date('Y-m-d');	
		$currenttable = $_POST['currentselected']; 
		$product_id = $_POST['product_id']; 
	   $currernt_qty  = $_POST['check_crrent_quty'];
	   $currernt_qty = $currernt_qty-1;
		$edit_gift_query = "UPDATE `table_booked` SET   `quty`='" . $currernt_qty . "'  WHERE `table_no`='" . $currenttable . "' AND DATE(date_time) = '$today' AND proid = '$product_id'";
		$done=  $mysqli->query($edit_gift_query);
 }

 if($action=="checkbooked_tables"){
	$today = date('Y-m-d');
 	$result1=$mysqli->query("SELECT * FROM `table_booked_2` WHERE DATE(date_time) = '$today'");
	 $table_noexists1  =  array();	 
	 		while($row1 = $result1->fetch_assoc()) {	
				$table_noexists1[] = $row1['table_no'];
		}
		 $data=array(  'booked'=> $table_noexists1	); 	 	
	   echo json_encode( $data);	
	 }	
	


 