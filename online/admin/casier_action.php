<?php
session_start();
include 'db.php';
include 'config.php';
//include 'function.php';

ob_start();

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
        $_SESSION['curntpostcode']='notset';
        $_SESSION['ispostcodeset']='no';
        unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
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
		$currency = '€';
$queryplastic = $mysqli->query("SELECT * FROM `plastic` where status='Active' ");
  $countplastic = $queryplastic->num_rows;
   $rowplastic = $queryplastic->fetch_assoc();
$output = '<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" id="order_table"><table class="table table-bordered table-striped"><tr class="pro_tbl_head">'
        . '<th width="40%">'.$product_name.'</th><th width="10%">'.$product_quantity.'</th><th width="20%">'.$product_price.'</th>'
        . '<th width="15%">'.$product_total.'</th><th width="5%">'.$product_action.'</th></tr>';
$cop_cart_details='<div class="table-responsive" id="order_table"><table class="table table-bordered table-striped"><tr><th width="45%">'.$product_name.'</th><th width="10%">'.$product_quantity.'</th><th width="20%">'.$product_price.'</th><th width="15%">'.$product_total.'</th></tr>';


if(!empty($_SESSION["product_cart"]))
{setlocale(LC_ALL, 'nl_NL');
 foreach($_SESSION["product_cart"] as $keys => $values)
 {
	 $totalsnew =  number_format($values["product_quantity"] * $values["product_price"], 2);
  
 $output .= '<tr><td>'.$values["product_name"].'</td><td>'.$values["product_quantity"].'</td><td align="right">'.$currency .''.number_format($values["product_price"], 2, ",", ".").'</td><td align="right">'.$currency .' '. number_format($totalsnew, 2, ",", ".").'</td><td><a name="delete" class="btn btn-danger btn-xs delete" id="'. $values["custkey"].'" title="'.$remove.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
  
   $cop_cart_details.='<tr><td>'.$values["product_name"].'</td><td>'.$values["product_quantity"].'</td><td align="right">'.$currency .' '.number_format($values["product_price"], 2, ",", ".").'</td><td align="right">'.$currency .' '. number_format($totalsnew, 2, ",", ".").'</td></tr>';
  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
  $total_item = $total_item + 1;
 }
 
 $output .= '<tr class="oo_notshow"><td colspan="3" align="right">'.$product_total.'</td><td align="right" id="cart_cost_now">'.$currency .''.number_format($total_price, 2, ",", ".").'</td><td></td></tr>';
  $oo_cakrt='<div class="row text_totalamount"><div class="col-md-6 col-xs-6 col-sm-6 txt_right" >'.$product_total.'</div><div class="col-md-6 col-xs-6 col-sm-6 txt_right">'.$currency .' '.number_format($total_price, 2, ",", ".").'</div></div>';

$discount=$mysqli->query("Select `discount_percentage` from discount where `discount_id`=1")->fetch_object()->discount_percentage;
if($_SESSION['newdiscounttype']=='no'){	
$newdiscount = $_SESSION['newdiscount'];
				$discount_amount_now=0;
				$kart_tc= $total_price;
				$discount_amount_now=($kart_tc * ($newdiscount / 100));       
 			    $discount_amount_now1="- ".$currency." ".  number_format($discount_amount_now, 2, ",", ".");
                 $discount_amt=number_format($discount_amount_now, 2);		
} else {	
	$newdiscount = $discount;
}
  
$cart_delivery_charge_now=0; 
 // Set postcode options ,  free from, delivery charge
 if($_SESSION['pick_or_del']=='delivery'){ // if is delivery
    $freefrom =  $_SESSION['postcode_free_from'];
	$postcodeid  =  $_SESSION['curntpostcode_id'];   
    $cart_delivery_charge_now=  $_SESSION['postcode_deli_chrg'];
 	 
 } 
 else {	 
 }
        // Cacluate Discount on total price
        $discount_amount_now=0;
        $kart_tc= $total_price;
        $discount_amount_now=($kart_tc * ($newdiscount / 100));
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
 	$plasticcharge = '<tr class="plastic-cahrge"><td>'.$plastic_charge.'</td><td align="right" id="cart_discount_now" class="">'.$currency .' '. number_format($rowplastic['charge'], 2, ",", ".").'<input type="hidden" value="'.number_format($rowplastic['charge'], 2).'" class="plastic_charge"></td></tr>';
	
 }
   $cart_FinalBill2pay_now=0;
         $cart_FinalBill2pay_now=($total_price+$cart_delivery_charge_now+$rowplastic['charge'])-$discount_amount_now;
         $cart_FinalBill_amt4d=$cart_FinalBill2pay_now;     
 
 ////} // if type is delivery
 ////else{
	 
	 /// $cart_FinalBill2pay_now=0;
      ///   $cart_FinalBill2pay_now=$total_price-$discount_amount_now;
       ////  $cart_FinalBill_amt4d=$cart_FinalBill2pay_now;
 ///}

 
  
 
 
 
if($newdiscount=='0'){
$cop_cart_details.='<tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">'.currency.' '.number_format($total_price, 2).'</td></tr>'.$delivery_chargenew.''.$plasticcharge.'<tr id="cart_discount_now"></tr><tr><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">'.$currency.''.number_format($cart_FinalBill2pay_now, 2, ",", ".").'</td></tr>';setlocale(LC_ALL,NULL);
		 } else { 
			$cop_cart_details.='<tr><td colspan="3" class="subtotal">'.$product_subtotal.'</td><td align="right" id="cart_cost_now" class="subtotal_amt">'.currency.' '.number_format($total_price, 2).'</td></tr>'.$delivery_chargenew.'<tr>'.$plasticcharge.'<td colspan="3">'.$discount_percentage.' ('.$newdiscount.'%)</td><td align="right" id="cart_discount_now">'.$discount_amount_now1.'</td></tr><tr><td colspan="3" class="finaltotal">'.$finaltotal.'</td><td align="right" id="cart_FinalBill2pay_now" class="finaltotal_amt">'.$currency.''.number_format($cart_FinalBill2pay_now, 2, ",", ".").'</td></tr>';setlocale(LC_ALL,NULL);
  
		 }  
       
}
else
{
 $output .= '<tr><td colspan="5" align="center">'.$empty_cart.'</td></tr>';
}
$output .= '</table></div>';
$cop_cart_details.='</table></div>';
if($_SESSION['newdiscounttype']=='no'){
$newdiscount = $_SESSION['newdiscount'];
} else {
	
	$newdiscount = $discount;
}
			
if($newdiscount=='0'){
	$discount="";
} else {
$discount=($current_lang=="en")?"You receive $newdiscount% Discount. It is calculated on the checkout page.":"U ontvangt $newdiscount% Discount. Het wordt op afrekenpagina berekend.";
}		
		
$q123="SELECT `gt_1`,`gt_2`,`gt_3`,`gt_4`,`gt_5`,`gt_6` FROM `giftitem` where '".number_format($total_price, 2)."' BETWEEN `gt_min_odr_amt` AND `gt_max_odr_amt`";

 $result=$mysqli->query($q123);
 
 $gift_choice_dropdown='';
 while($row=$result->fetch_assoc()){
 
 if(!empty($row['gt_1'])){$gift_choice_dropdown.='<option value="'.$row['gt_1'].'">'.$row['gt_1'].'</option>';}
 if(!empty($row['gt_2'])){$gift_choice_dropdown.='<option value="'.$row['gt_2'].'">'.$row['gt_2'].'</option>';}
 if(!empty($row['gt_3'])){$gift_choice_dropdown.='<option value="'.$row['gt_3'].'">'.$row['gt_3'].'</option>';}
 if(!empty($row['gt_4'])){$gift_choice_dropdown.='<option value="'.$row['gt_4'].'">'.$row['gt_4'].'</option>';}
 if(!empty($row['gt_5'])){$gift_choice_dropdown.='<option value="'.$row['gt_5'].'">'.$row['gt_5'].'</option>';}
 if(!empty($row['gt_6'])){$gift_choice_dropdown.='<option value="'.$row['gt_6'].'">'.$row['gt_6'].'</option>';}
 
 }
$data = array(
 'cart_details'  => $output,
 'total_price'  => $currency .''.number_format($total_price, 2, ",", "."),
 'total_price_4checkoutBtn'  => number_format($total_price, 2),
 'total_item'  => $total_item,
 'discount' => $discount,
	'totaltosho'=>$oo_cakrt
); 
$_SESSION["itemincart"]=$total_item;
$_SESSION["total_price_4checkoutBtn"]=number_format($cart_FinalBill2pay_now1, 2);
setlocale(LC_ALL, NULL);
$_SESSION["cop_cart_details"]=$cop_cart_details;
///$_SESSION["gift_choice_dropdown"]=$gift_choice_dropdown;

$data1=array(
    'cart_details' => $cop_cart_details,
    'total_price'  => number_format($total_price, 2),
    'discount' => $discount_amt,   
    'delivery_charge'=>$delivery_crg_amt,
    'finalbill'=> number_format($cart_FinalBill_amt4d,2),
);
$_SESSION["cart_details_for_odrtbl"]=$data1;

echo json_encode($data);
    }
    
  
    if($action=='dish_attrib_popup'){
       $current_lang=$_POST['current_lang'];
	  $product_attrib=$_POST['product_attrib'];
		$currency = '+€ ';
	// check variable orde	
	  $var_query = "SELECT  *  FROM `variable-orde`";
	  $var_query_res = $mysqli->query($var_query);
	  if ($var_query_res->num_rows > 0) {
		 $row1 = $var_query_res->fetch_assoc();
		  $varorder = $row1['varialbe_order'];
		  $array=array_map('intval', explode(',', $varorder));
                $array = implode("','",$array);
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

   
	
   
if($action == 'adddiscount_new'){
	$_SESSION['newdiscount'] = $_POST["discount"];
	$_SESSION['newdiscounttype'] = $_POST["disc_type_auto"];
	$_SESSION['pick_or_del'] = $_POST["pick_or_del"];
	if($_POST["pick_or_del"]=='delivery'){
		  $query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $_POST['usr_zipcode']."' AND `postcode_status`='Active'");
        
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
             }}
	} else { 
		unset($_SESSION["ispostcodeset"]);
		unset($_SESSION["curntpostcode_id"]);
		unset($_SESSION["curntpostcode"]);
		unset($_SESSION["postcode_min_amt"]);
		unset($_SESSION["postcode_deli_chrg"]);
		unset($_SESSION["postcode_free_from"]);
	} 
}	
	

  
if($action == 'adddiscount_new2'){	
 
	$_SESSION['newdiscounttype'] = $_POST["disc_type_auto"];
	$_SESSION['pick_or_del'] = $_POST["pick_or_del"];
	

	if($_POST["disc_type_auto"]=="no"){
		$_SESSION['newdiscount'] = $_POST["discount"];
	}
	
	if($_POST["pick_or_del"]=='delivery'){
	$query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $_POST['usr_zipcode']."' AND `postcode_status`='Active'");        
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
             }}	 
	}
	else{
		unset($_SESSION["ispostcodeset"]);
		unset($_SESSION["curntpostcode_id"]);
		unset($_SESSION["curntpostcode"]);
		unset($_SESSION["postcode_min_amt"]);
		unset($_SESSION["postcode_deli_chrg"]);
		unset($_SESSION["postcode_free_from"]);
	}

}			
	
/*	
    
if($action == 'addtokart'){
	 
   $custmdataid=rand(1, 999).date("hmi");
  if(isset($_SESSION["product_cart"])) {
   $is_available = 0;
   foreach($_SESSION["product_cart"] as $keys => $values)
   {
	   
    if($_SESSION["product_cart"][$keys]['product_id'] == $_POST["product_id"] && $_SESSION["product_cart"][$keys]['product_name'] == $_POST["product_name"])    {
	 
     $is_available++;
     $_SESSION["product_cart"][$keys]['product_quantity'] = $_SESSION["product_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
    }
   }
   if($is_available == 0)   {
        $item_array = array(
		 'product_id'               =>     $_POST["product_id"],  
		 'product_name'             =>     $_POST["product_name"],  
		 'product_price'            =>     $_POST["product_price"],  
		 'product_quantity'         =>     $_POST["product_quantity"],
		 'custkey'                  =>      $custmdataid
		);
	  
	  $_SESSION["product_cart"][] = $item_array;
	   ///print_r($_SESSION["product_cart"]);
   }
  }
  else  {
    $item_array = array(
    'product_id'               =>     $_POST["product_id"],  
    'product_name'             =>     $_POST["product_name"],  
    'product_price'            =>    $_POST["product_price"],  
    'product_quantity'         =>     $_POST["product_quantity"],
    'custkey'                  =>      $custmdataid
   );
   $_SESSION["product_cart"][] = $item_array;
	 
  }
 
}

	*/
	

if($action == 'addtokart'){

    $custmdataid=rand(1, 9999).date("hmi");
  if(isset($_SESSION["product_cart"]))
  {
   $is_available = 0;
   foreach($_SESSION["product_cart"] as $keys => $values)
   {
      if($_SESSION["product_cart"][$keys]['product_id'] == $_POST["product_id"] && $_SESSION["product_cart"][$keys]['product_name'] == $_POST["product_name"])
    {
     $is_available++;
     $_SESSION["product_cart"][$keys]['product_quantity'] = $_SESSION["product_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
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
    $_SESSION["product_cart"][] = $item_array;
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
   $_SESSION["product_cart"][] = $item_array;
  }
 
}	

if($_POST["action"] == 'remove') {
   foreach($_SESSION["product_cart"] as $keys => $values)
  {
   if($values["custkey"] == $_POST["product_id"])
   {
    unset($_SESSION["product_cart"][$keys]);
   }
  }
 }

if($_POST["action"] == 'empty') {
  unset($_SESSION["product_cart"]);
 }
    
}
