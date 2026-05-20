<?php
session_start();
include 'admin/db.php';
include 'admin/config.php';
//include 'function.php';

ob_start();

$current_lang = $_SESSION['current_lang'] ?? 'en';

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
    $compare_price = $_SESSION["order_session"]['finaL_amt'] ?? 0;
    if($action=="checkgiftitem"){
        //echo "SELECT * FROM `giftitem` where '".$_POST['cart_cost_now']."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`";
        $result=$mysqli->query("SELECT `gt_msg`,`start_date`,`end_date` FROM `giftitem` where '".$compare_price."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`");
       
        //echo $result->num_rows;
        
        if($result->num_rows > 0)
        {
             $row=$result->fetch_assoc();
			$giftstrtdate = $row['start_date'];
			$giftenddate = $row['end_date'];
		$gifttodaysDate = date('Y-m-d');
		if(($gifttodaysDate>=$giftstrtdate) && ($gifttodaysDate <= $giftenddate)){
			 echo ($current_lang=="en")?"You will receive one ".trim($row['gt_msg']).". You can make your choice on the checkout page.":"Je ontvangt er een ".trim($row['gt_msg']).". U kunt uw keuze maken op de afrekenpagina. ";
             $_SESSION['gt_msg_giftitem']=$row['gt_msg'];
		}
        }
    }
    
   

    if ($action == 'removepostcode') {
		
		if(isset($_SESSION['username'])){
			 unset($_SESSION['shopping_cart']);
		    unset($_SESSION['current_pick']);
		}
		else{
		   $_SESSION['curntpostcode']='notset';
        $_SESSION['ispostcodeset']='no';
        unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
			 unset($_SESSION['shopping_cart']);
		    unset($_SESSION['current_pick']);
		
		}

		
		
    }
     if ($action == 'clearpickupsession') {
        $_SESSION['curntpostcode']='notset';
        $_SESSION['ispostcodeset']='no';
        
		 
		 unset($_SESSION['current_pick']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
		 unset($_SESSION['shopping_cart']);
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
            	if($row['postcode_free_from']=='-'){
					 $_SESSION['postcode_free_from']= 999;
				}
               elseif($row['postcode_free_from']==null || $row['postcode_free_from']==''){
					  $_SESSION['postcode_free_from']= 0.00;
				}
				 else{
					  $_SESSION['postcode_free_from']= str_replace(",",".",$row['postcode_free_from']);
				 }
              $_SESSION['current_pick']=1;
             
             $echostr= "pass";
             }
         }
         echo trim($echostr);
    }
    
    
if($action == 'loadcartdata'){
        $total_price = 0;$delivery_crg_amt='';$discount_amt=0;$cart_FinalBill_amt4d=0;$cart_FinalBill2pay_now1=0;
$total_item = 0;$cart_delivery_charge_now='';
$toprodqty = 0;
$product_name=($current_lang=="en")?"Name":"Naam";
$product_price=($current_lang=="en")?"Price":"Prijs";
//$product_quantity=($current_lang=="en")?"Quantity":"Aantal stuks";
$product_quantity=($current_lang=="en")?"#":"#";
$product_total=($current_lang=="en")?"Total":"Totaal";
$product_subtotal=($current_lang=="en")?"Subtotal":"Subtotaal";
$product_action=($current_lang=="en")?"Action":"Actie";
$remove=($current_lang=="en")?"Remove":"Verwijderen";
$empty_cart=($current_lang=="en")?"Your Cart is Empty!":"Uw winkelwagen is leeg!";
$delivery_charge=($current_lang=="en")?"Delivery charge":"Bezorgkosten";
$plastic_charge=($current_lang=="en")?"Plastic charge":"Plastic Tas";
/// $palstbag=($current_lang=="en")?"Plastic Box":"Statiegeld";	
 $palstbag=($current_lang=="en")?"Plastic Bin Surcharge":"Plastic Bak Toeslag";	
	
$discount_percentage=($current_lang=="en")?"Discount":"Korting";
$finaltotal=($current_lang=="en")?"Total":"Totaal";
 $queryplastic = $mysqli->query("SELECT * FROM `plastic` where status='Active' ");
 $countplastic = $queryplastic->num_rows;
  $rowplastic = $queryplastic->fetch_assoc();
 ///$palstbag=($current_lang=="en")?"Plastic Box":"Statiegeld";	
	$palstbag=($current_lang=="en")?"Plastic Bin Surcharge":"Plastic Bak Toeslag";	
 $currency = '€';
	$plst_chrg = 0;		
$output = '<div class="table-responsive table-wrapper-scroll" id="order_table"><table class="table table-bordered table-striped cart-table"><tr class="pro_tbl_head" >'
    . '<th width="40%">'.$product_name.'</th><th width="10%">'.$product_quantity.'</th><th width="20%">'.$product_price.'</th>'
    . '<th width="15%">'.$product_total.'</th><th width="5%">'.$product_action.'</th></tr>';


//if Discout is activate	
$discountquery=$mysqli->query("Select * from discount where `discount_id`=1");
$rowdiscount = $discountquery->fetch_assoc();
		
	$distrtdate = $rowdiscount['start_date'];
		$disenddate = $rowdiscount['end_date'];
		$distodaysDate = date('Y-m-d');
		if (($distodaysDate >= $distrtdate) && ($distodaysDate <= $disenddate)) {
			if($_SESSION['current_pick']==1){
			$discount = $rowdiscount['delivery_discount'];
			} else { 
			$discount = $rowdiscount['discount_percentage'];	
			}
		} else { 
			$discount =0;
		}
	
if(!empty($_SESSION["shopping_cart"]))
{setlocale(LC_ALL, 'nl_NL');
 foreach($_SESSION["shopping_cart"] as $keys => $values) {
     
	$totalsnew =  number_format($values["product_quantity"] * $values["product_price"], 2);
  ///$totalnews2 =  str_replace('.',',',$totalsnew);

  $output .= '<tr style="vertical-align:top;"><td>'.$values["product_name"].'</td><td class="cart_btn">
 <button class="updateminusqty cart-meal-edit-delete" id="'. $values["custkey"].'"></button>
 <p class="quantiy">'.$values["product_quantity"].'</p>
<button type="button" class="updateqty cart-meal-edit-add" id="'. $values["custkey"].'"></button></td>
<td align="right">'.$currency .' '.number_format($values["product_price"], 2, ",", ".").'</td><td align="right">'.$currency .' '. number_format($totalsnew, 2, ",", ".").'</td><td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["custkey"].'" title="'.$remove.'"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
	 
  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
  $total_item = $total_item + 1;
	 $toprodqty = $toprodqty+$values["product_quantity"];
	  $plst_chrg = $plst_chrg + ($values["product_quantity"] * $values["platc_charg"]); 
 } 
 $cart_delivery_charge_now=0; 
 // Set postcode options ,  free from, delivery charge
 if($_SESSION['current_pick']==1){ // if is delivery
    $freefrom =  $_SESSION['postcode_free_from'];
	$postcodeid  =  $_SESSION['curntpostcode_id'];   
    $cart_delivery_charge_now=  $_SESSION['postcode_deli_chrg'];
 	 
 } 
 else {	 
 }
        // Cacluate Discount on total price
        $discount_amount_now=0;
        $kart_tc= $total_price;
        $discount_amount_now=($kart_tc * ($discount / 100));
        $discount_amount_now1=$cart_delivery_charge_now1='';
        $dilvery_mprice_format = $cart_delivery_charge_now1;

       // if postcode has delivery charge    -> if devliery charge is big then 0
 		if($cart_delivery_charge_now > 0 && $freefrom==999){
			  $cart_delivery_charge_now1="+ ".$currency." ". number_format(0.00, 2, ",", ".");
              $delivery_crg_amt= 0.00;
			   $cart_delivery_charge_now = 0;
		}
		elseif($cart_delivery_charge_now > 0 && $freefrom==0 || $freefrom==0.00){
			    $cart_delivery_charge_now1="+ ".$currency." ". number_format($cart_delivery_charge_now, 2, ",", ".");
                $delivery_crg_amt= number_format($cart_delivery_charge_now, 2);
		 }
        elseif($cart_delivery_charge_now > 0 && $total_price<$freefrom){ 
                $cart_delivery_charge_now1="+ ".$currency." ". number_format($cart_delivery_charge_now, 2, ",", ".");
                $delivery_crg_amt= number_format($cart_delivery_charge_now, 2);
          }
 		else{ //-> if devliery charge is  0
			$cart_delivery_charge_now1="+ ".$currency." ". number_format(0.00, 2, ",", ".");
              $delivery_crg_amt= 0.00;
			$cart_delivery_charge_now = 0;
		}

         // if discount is on
         if($discount_amount_now> 0) {
			 $discount_amount_now1="- ".$currency." ".  number_format($discount_amount_now, 2, ",", ".");
                 $discount_amt=number_format($discount_amount_now, 2);
            }


// Plastick charges 
$rowplasticcharge = $currency." ".$rowplastic['charge'];
 if($countplastic=='0'){
	 $plasticcharge = '';
 } else { 
 	$plasticcharge = '<tr class="plastic-cahrge"><td>'.$plastic_charge.'</td><td align="right" id="cart_discount_now" class="">+ '.$currency .' '. number_format($rowplastic['charge'], 2, ",", ".").'<input type="hidden" value="'.number_format($rowplastic['charge'], 2).'" class="plastic_charge"></td></tr>';
	
 }
         $cart_FinalBill2pay_now=0;
         $cart_FinalBill2pay_now=($total_price+$cart_delivery_charge_now+$rowplastic['charge'])-$discount_amount_now;
         $cart_FinalBill_amt4d=$cart_FinalBill2pay_now;


// bottom cart area
$carybottom = '<table class="table table-bordered table-striped cart-bototm-area">';
 if($_SESSION['current_pick']==1){
         $carybottom.='<tr  class="subtotal"><td class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">'.currency.' '.number_format($total_price, 2, ",", ".").'</td></tr><tr class="delvery-row"><td>'.$delivery_charge.'</td><td align="right" id="cart_delivery_charge_now">'.$cart_delivery_charge_now1.'<input type="hidden" class="del_cost" value="'.number_format($cart_delivery_charge_now, 2).'"></td></tr>'.$plasticcharge.'';setlocale(LC_ALL,NULL);
 } else {
     $carybottom.='<tr ><td class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">'.currency.' '. number_format($total_price, 2, ",", ".").'</td></tr>'.$discountrow.''.$plasticcharge.'';setlocale(LC_ALL,NULL);
 }


// if discount in
if($discount=='0'){  $discountrow = "";   }
 else { 
	   $chkcouponapplied = $_SESSION['couponset'];
	 if($chkcouponapplied=='no'){
		  $carybottom .= '<tr id="kortingrow"><td><input type="hidden" id="discperctge" value="'.$discount.'"><input type="hidden" id="discperctgeamt" value="'.number_format($discount_amount_now,2).'"></td><td align="right" id="cart_discount_now"></td></tr></table>';
	 }
	 else{
	     // IF devery is -> Pincode
 $carybottom .= '<tr id="kortingrow"><td>'.$discount_percentage.' ('.$discount.'%)<input type="hidden" id="discperctge" value="'.$discount.'"><input type="hidden" id="discperctgeamt" value="'.number_format($discount_amount_now,2).'"></td><td align="right" id="cart_discount_now">'.$discount_amount_now1.'</td></tr>';
	 }
 }

  if($plst_chrg>0){
	$carybottom .= '<tr class="plastic-cahrge"><td>'.$palstbag.'</td><td align="right"  class="">'.$currency .' '. number_format($plst_chrg, 2, ",", ".").'<input type="hidden" value="'.number_format($plst_chrg, 2).'" class="plastic_charge"></td></tr>';
 
 }
 
 
 
 
} // if cart session is set      

else
{ $output .= '<tr><td align="center" colspan="5">'.$empty_cart.'</td></tr>';}
$output .= '</table></div>';
$carybottom .= '</table>';
if($discount=='0'){
	$discount="";
} else {
$discount=($current_lang=="en")?"You receive $discount% Discount. It is calculated on the checkout page.":"U ontvangt $discount% Discount. Het wordt op afrekenpagina berekend.";
}
$q123="SELECT * FROM `giftitem` where '".number_format($total_price, 2)."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`";
 $result=$mysqli->query($q123);
 $gift_choice_dropdown='';
 while($row=$result->fetch_assoc()){
	 $giftstrtdate = $row['start_date'];
			$giftenddate = $row['end_date'];
		$gifttodaysDate = date('Y-m-d');
		if(($gifttodaysDate>=$giftstrtdate) && ($gifttodaysDate <= $giftenddate)){
 if(!empty($row['gt_1'])){$gift_choice_dropdown.='<option value="'.$row['gt_1'].'">'.$row['gt_1'].'</option>';}
 if(!empty($row['gt_2'])){$gift_choice_dropdown.='<option value="'.$row['gt_2'].'">'.$row['gt_2'].'</option>';}
 if(!empty($row['gt_3'])){$gift_choice_dropdown.='<option value="'.$row['gt_3'].'">'.$row['gt_3'].'</option>';}
 if(!empty($row['gt_4'])){$gift_choice_dropdown.='<option value="'.$row['gt_4'].'">'.$row['gt_4'].'</option>';}
 if(!empty($row['gt_5'])){$gift_choice_dropdown.='<option value="'.$row['gt_5'].'">'.$row['gt_5'].'</option>';}
 if(!empty($row['gt_6'])){$gift_choice_dropdown.='<option value="'.$row['gt_6'].'">'.$row['gt_6'].'</option>';}
 } }
	
$totalamount1 = number_format($cart_FinalBill_amt4d, 2);
  $checkbtn = 0;

 if(($_SESSION['current_pick'] ?? 0)==1){
	 if($total_price>=($_SESSION['postcode_min_amt'] ?? 0)){
		 $checkbtn = 1;
	 }
 }
 if(($_SESSION['current_pick'] ?? 0)==2){
	 if($total_price>=($_SESSION['min_amt'] ?? 0)){
		 $checkbtn = 1;
	 }
 }
	
$newafter_plastcahrge = number_format($cart_FinalBill_amt4d, 2) +number_format($plst_chrg, 2)	;	
	
$data = array(
	 'cart_details'  => $output, // cart for show on online order page
     'total_amt_1'  =>   number_format($total_price, 2) ,
	 'total_amt_2'  => $currency .''.number_format($total_price, 2, ",", "."),
     'total_amt_final1'  =>number_format($newafter_plastcahrge, 2),
     'total_amt_final2'  => $currency .''.number_format($newafter_plastcahrge, 2, ",", ".") ,
     'total_item'  => $total_item,
     'discount' => $discount, 
   'cartnewdata'=>$carybottom, // cart show on checkout page
   'checkbtn'=>     $checkbtn,
	'delvery_chrge' => $cart_delivery_charge_now,
	'plst_total' => number_format($plst_chrg, 2) ,
	'plst_total2' => $currency .''.number_format($plst_chrg, 2, ",", ".") 
); 
$_SESSION["gift_choice_dropdown"]=$gift_choice_dropdown;
$data1=array(
       'base_total'=> number_format($total_price, 2),
       'finaL_amt' => number_format($cart_FinalBill_amt4d, 2),
       'discount_amt' => number_format($discount_amt, 2),
	   'plast_charge' => $rowplastic['charge'],
	   'plast_bag' => number_format($plst_chrg, 2)
);
$_SESSION["order_session"]=$data1;
ob_clean();
echo json_encode($data);
 }



    if($action=='dish_attrib_popup'){
       $current_lang=$_POST['current_lang'];
	  $product_attrib=$_POST['product_attrib'];
		$currency = '+€ ';
	// check variable order (table name is `variable-orde` in legacy schema)
	  $array = '';
	  $var_query     = 'SELECT * FROM `variable-orde` LIMIT 1';
	  $var_query_res = $mysqli->query( $var_query );
	  if ( $var_query_res && $var_query_res->num_rows > 0 ) {
		  $row1     = $var_query_res->fetch_assoc();
		  $varorder = $row1['varialbe_order'];
		  $array    = implode( "','", array_map( 'intval', explode( ',', $varorder ) ) );
	  }
	  if ( $array === '' && $product_attrib !== '' ) {
		  $array = implode( "','", array_map( 'intval', explode( ',', $product_attrib ) ) );
	  }
		
	if($current_lang=="en"){  $limit_text = 'Limit';}
		else {  $limit_text = 'Begrenzing'; }
		
	$required_ALL = 0;	
	$count = 1;	
       // get varialbes by id's   
       $print_dish = "SELECT  *  FROM `variable`  WHERE   `variable_id` IN(".$product_attrib.") ORDER BY FIELD(`variable_id`,'" . $array . "')";
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
        $print_dish2 = "SELECT  *  FROM `attribute`  WHERE   `attrib_id` IN(".$variable_attrb_list.")";
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
   $print_dish2 = "SELECT  *  FROM `attribute`  WHERE   `attrib_id` IN(".$variable_attrb_list.")";
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

    $custmdataid=rand(1, 9999).date("hmi");
  if(isset($_SESSION["shopping_cart"]))
  {
   $is_available = 0;
   foreach($_SESSION["shopping_cart"] as $keys => $values)
   {
      if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"] && $_SESSION["shopping_cart"][$keys]['product_name'] == $_POST["product_name"])
    {
     $is_available++;
     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
    }
   }
   if($is_available == 0)
   {
    $item_array = array(
     'product_id'               =>     $_POST["product_id"],  
     'product_name'             =>     $_POST["product_name"],  
     'product_price'            =>     $_POST["product_price"],  
     'product_quantity'         =>     $_POST["product_quantity"],
		  'platc_charg'         =>     $_POST["platc_charg"],	
     'custkey'                  =>      $custmdataid
    );
    $_SESSION["shopping_cart"][] = $item_array;
   }
  }
  else
  {
	  
   $item_array = array(
    'product_id'               =>     $_POST["product_id"],  
    'product_name'             =>     $_POST["product_name"],  
    'product_price'            =>    $_POST["product_price"],  
    'product_quantity'         =>     $_POST["product_quantity"],
	     'platc_charg'         =>     $_POST["platc_charg"],	
    'custkey'                  =>      $custmdataid
   );
   $_SESSION["shopping_cart"][] = $item_array;
  }
 
}

if($_POST["action"] == 'remove') {
	
   foreach($_SESSION["shopping_cart"] as $keys => $values)
  {
   if($values["custkey"] == $_POST["product_id"])
   {
    unset($_SESSION["shopping_cart"][$keys]);
   }
  }
 }

if($_POST["action"] == 'empty') {
	
	if(isset($_SESSION['username'])){
		 unset($_SESSION["shopping_cart"]); 
		 unset($_SESSION['current_pick']);
	}
	else{
		 unset($_SESSION["shopping_cart"]); 
         unset($_SESSION['curntpostcode_id']);
         unset($_SESSION['postcode_min_amt']);
         unset($_SESSION['postcode_deli_chrg']);
         unset($_SESSION['postcode_free_from']);
		 unset($_SESSION['current_pick']);	
	     unset($_SESSION['curntpostcode']);	
	     unset($_SESSION['ispostcodeset']);	
	}
	
  		
 }
 if($_POST["action"] == 'updatecutlerycharges'){
	 
 }
        if($_POST["action"] == 'updateqty') {
	
    foreach($_SESSION["shopping_cart"] as $keys => $values)
  {
   if($values["custkey"] == $_POST["product_id"])
	   //$_SESSION['shopping_cart']['product_quantity']=$_POST["product_qty"];
	$_SESSION["shopping_cart"][$keys]['product_quantity'] = $values["product_quantity"]+1;
	  
    
  }
 }
	if($_POST["action"] == 'updateminusqty') {
	
    foreach($_SESSION["shopping_cart"] as $keys => $values)
  {
   if($values["custkey"] == $_POST["product_id"])
	   //$_SESSION['shopping_cart']['product_quantity']=$_POST["product_qty"];
	   if($values["product_quantity"]>1){
	$_SESSION["shopping_cart"][$keys]['product_quantity'] = $values["product_quantity"]-1;
	   } else { 
		    unset($_SESSION["shopping_cart"][$keys]);
	   }
	  
    
  }
 }
	if($_POST["action"] == 'viewimage') {
		$result = $mysqli->query("SELECT * FROM `dish` WHERE `dish_id`='" . $_POST['dish_id'] . "'");
        $row = $result->fetch_assoc();
		if($current_lang=="en"){
			$dishname = $row['dish_name_en'];
		} else { 
			$dishname = $row['dish_name_nl'];
		}
	echo $variable_list .= ' 
	<img src="https://restaurantkamasutra.nl/online/'.$row['product_image'].'" style="max-width: 500px;">
	';
	}
		if($_POST["action"] == 'viewvideo') {
		$result = $mysqli->query("SELECT * FROM `dish` WHERE `dish_id`='" . $_POST['dish_id'] . "'");
        $row = $result->fetch_assoc();
		$videoid = $row['video'];
			$result11 = $mysqli->query("SELECT * FROM `video` WHERE `id`='" . $videoid . "'");
        $row11 = $result11->fetch_assoc();
			$videourl = $row11['video'];
	echo $variable_list .= '
	<iframe id="cartoonVideo" style="width: 500px;height: 306px;" src="admin/uploads/'.$videourl.'" allowfullscreen></iframe>
	
	';
	}
	
}




	if($_POST["action"] == 'showby_days') {
		
		
		  $choose_date=$_POST['choose_date'];
		/// $skiptime  = date('l', strtotime($choose_date)) 
		  $datetime = DateTime::createFromFormat('d/m/Y', $choose_date);
  		  $choose_date= $datetime->format('l');	 
			 
		    $get_time_data=mysqli_query($mysqli,"select * from date_tbl where id='3'");
				if(mysqli_num_rows($get_time_data) > 0){
				$get_time=mysqli_fetch_assoc($get_time_data);				
					 $interval=$get_time['json_date'];
				}	 
 
	 
				if($choose_date=="Monday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='5'");
				}
			  if($choose_date=="Tuesday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='13'");
				}
			  if($choose_date=="Wednesday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='14'");
				}
			  if($choose_date=="Thursday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='15'");
				}
			  if($choose_date=="Friday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='16'");
				}
			  if($choose_date=="Saturday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='17'");
				}
			  if($choose_date=="Sunday"){		  
					$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='18'");
				}
				if(mysqli_num_rows($person_data2) > 0){

				$person_data_22=mysqli_fetch_assoc($person_data2);   
					   $start_timeee = strtotime($person_data_22['st']); 
				$end_timeee = strtotime($person_data_22['et']);
				$timenow =  strtotime(date('H:i'));	  

	 
					 ////echo '<select class="form-control checktime" name="time" required>';
						 	  echo '<option value="">Selecteer Tijd</option>';
							 for ($i=$start_timeee;$i<=$end_timeee;$i = $i + $interval*60){							 					  
							  echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i',$i).'</option>';
							////	 
						  }
					 

				}
		
		 
					 

  }  
	