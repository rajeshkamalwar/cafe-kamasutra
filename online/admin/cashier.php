<?php session_start();?>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
		 <script src="jquery.min.js"></script>
		 <title> Online Order </title>
    <link rel="stylesheet" href="custom-new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    </head>
	<script>
	 $(function() {
   $("input[name='pick_or_del']").click(function() {
     if ($("#chkYes").is(":checked")) {
       $("#dvPinNo").show();
     } else {
       $("#dvPinNo").hide();
     }
   });
 });
		$(function() {
   $("input[name='discounttype']").click(function() {
     if ($("#yes").is(":checked")) {
       $("#dvPinNo12").hide();
     } else {
       $("#dvPinNo12").show();
     }
   });
 });
		
		
	</script>
<script>
$(document).ready(function(){

   $("#usr_zipcode").keyup(function(){

      var postcode = $(this).val().trim();
      if(postcode != ''){

         $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {postcode: postcode},
            success: function(response){
      
                $('#postcode_response').html(response);

             }
         });
      }else{
         $("#postcode_response").html("");
      }

    });

 });
</script>
<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
	
/*	
if(!isset($_SESSION['current_pick'])){
	
	$query12 = $mysqli->query("SELECT * FROM `deliveryinfo` where id=1 ");
		$row12 = $query12->fetch_array();
$query = $mysqli->query("SELECT * FROM `minorder` where id=1 ");
		$row = $query->fetch_array();
		 $_SESSION['min_amt']=$row['min_amt'];
         $_SESSION['deli_chrg']=$row['deli_chrg'];
         $_SESSION['free_from']=$row['free_from'];
         $_SESSION['current_pick']=$row12['pickup'];

} else {
	$pickup = $_SESSION['current_pick'];
	$query12 = $mysqli->query("SELECT * FROM `deliveryinfo` where id=1 ");
		$row12 = $query12->fetch_array();
	if($row12['pickup']==$pickup){
		$_SESSION['current_pick'] = $_SESSION['current_pick'];
	}else { 
		if($row12['pickup']=='pickup'){
		unset($_SESSION["shopping_cart"]);
		unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
		$_SESSION['current_pick'] = $row12['pickup'];
		} elseif($row12['pickup']=='delivery') { 
		unset($_SESSION['min_amt']);
        unset($_SESSION['deli_chrg']);
        unset($_SESSION['free_from']);
        unset($_SESSION['current_pick']);
		unset($_SESSION["shopping_cart"]);
		$_SESSION['current_pick'] = $row12['pickup'];
		}
	}
}
*/	 
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="en";}
           $current_lang = $_SESSION['current_lang'];
            define('UTF8_ENABLED', '');
            ?>
            <script>
                b_url1 = 'https://restaurantkamasutra.nl/online/admin';
                currency = '<?php echo currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
            </script>
           <input type="hidden" id="current_lang" value="<?php echo $current_lang; ?>">
            <input type="hidden" id="current_postcodeis" value="<?php
            if (isset($_SESSION['curntpostcode_id'])) {
                echo $_SESSION['curntpostcode_id'];
            } else {
                echo "notset";
            }
            ?>">
            <input type="hidden" id="current_productprice" value="" >
            <input type="hidden" id="current_productname" value="" >
            <input type="hidden" id="current_productid" value="" >
           <?php
            $PostcodePopupTitle = $PostcodePopupP1 = $btntext = $PostcodePageURLtxt=$option_l=$yourorder_l=$urpostcode_l=$minamt_L=$DeliveryCharge_L= '';
            if ($current_lang == "en") {
				$yourorder_l="Your order";
                $PostcodePopupTitle = 'Enter Postcode';
                $PostcodePopupP1 = 'Enter the four digits of your postcode :';
                $btntext = "To Order!";
                $PostcodePageURLtxt = "View our delivery area here";
				$option_l="Option(s)";
				$PostcodePageURL = "https://restaurantkamasutra.nl/online/en/information/";
				$urpostcode_l="Your postal code :";
				$minamt_L="Minimum amount : ";
				$DeliveryCharge_L="Delivery Charge :";
				$Deliverypreferto ="Prefer to :";
				$pickup = "Pick up";
				$deiveryup =  "delivery";
				$Deliveryprefer="Delivery information :";
				$todadis = "Today's Discount";
				
            } else {
				$yourorder_l="Uw bestelling";
                $PostcodePopupTitle = 'Voer Postcode';
                $PostcodePopupP1 = 'Vul de vier cijfers van uw postcode in :';
                $btntext = "Bestellen!";
                $PostcodePageURLtxt = "Bekijk hier ons bezorggebied";
				$option_l="Optie(s)";
				$PostcodePageURL = "https://restaurantkamasutra.nl/online/informatie/";
				$urpostcode_l="Je post code :";
				$minamt_L= "Minimal order : ";
				$DeliveryCharge_L="Bezorgkosten :";
				$Deliverypreferto ="Liever :";
				$pickup = "afhalen";
				$deiveryup =  "bezorgen";
				$Deliveryprefer="Bezorginformatie :";
			    $todadis = "Vandaag's Aanbieding";
            }
 
            ?>
<!DOCTYPE html>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
	  <!-- options popup -->
            <div id="myModalNew1" class="modal fade" tabindex="-1">
			<input type="hidden" class="pricedish" value="">
				<input type="hidden" class="newpriadd" value="0.00">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
<div class="modal-header modal-header1"><p class="popupheading"><?php echo $option_l;?></p><button type="button" class="close" data-dismiss="modal" id="modal3" aria-hidden="true">×</button>
	<div class="maintitle"><h4></h4><div class="pricepop"><span></span>
		<input type="hidden" class="pricedish" value=""></div></div>					
	<input type="hidden" class="newpriadd" value="0.00">
						</div>   
                        <div class="modal-body">
                             
                            <p><?php //echo $PostcodePopupP1;                     ?><?php //popup1($mysqli, $current_lang);                                                ?></p>
                            <form method="post" id="pc_form2" name="pc_form2" >
                            </form>

                        </div>
						 <div class="modal-footer">
               <div class="select_main_quty">                 
                  <!--<div class="col-md-9"><a class="reset_variations">Reset</a></div>  -->
				   <div class="col-md-9 quantity-row"><span>Quantity</span>
                    <input type="number" id="quantity" class="form-group" min="1" max="" name="quantity" value="1" size="4" pattern="[1-9]*" inputmode="numeric">
                    </div>
                    
                    <div class="col-md-3"></div><div class="col-md-9" id="tcfs"></div>
                    <input type="hidden" name="tcfs33" id="tcfs33" />
                    <input type="hidden"   class="variable_prices" value="" />
                        <input type="hidden" name="required" id="required-attr"  value="0" />
                           <div class="submit-btn"><div class="warchoose"  style="display:none;">Maak uw keuze</div>
                           <input type="button" name="submit" id="attrib_add_to_cart" class="btn btn-primary pull-right" value="Add" /></div></div><!--modal-footer-->
                         </div>

                    </div>
                </div>
            </div>
            <!-- //.options popup -->
        <div class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Cashier
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Cashier</li>
                    </ol>
                </section>
				  <section class="content">

                    <p id="del_notimsg"></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-12">
                                            <h3 class="box-title"> </h3>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
								
								<!---------------------Mobile Cart & Categoris------------------------->
									<a href="javascript:void(0);" class="icon dish_cat_icon  fix_menu_mob" ><i class="fa fa-cutlery"></i></a>
        <a href="javascript:void(0);" class="icon cart_icon fix_menu_mob2" ><i class="fa fa-shopping-cart"></i></a>
								
								
                                    <div class="col-sm-12">
									
                                       <ul class="nav nav-tabs">
                                         <li class="active"><a href="#tab1" data-toggle="tab">Customer Information</a></li>
                                         <li><a href="#tab2" class = "btnNext" data-toggle="tab">Categories</a></li>
                                       </ul>
										<form method="POST" action="admincheckout.php" class="registration-form">

<div class="tab-content">
    <div class="tab-pane active" id="tab1">
			<div class="row"  style="margin-top: 16px;">
		<div class="form-group col-sm-12">
			<label for="pick_or_del"><h4>Delivery Type  </h4> </label>
           <input type="radio" id="chkNo" name="pick_or_del"  checked value="pickup">Pick Up
           <input type="radio" id="chkYes" name="pick_or_del" value="delivery" >Delivery		
			
         </div>
					
		</div>
		<div class="row">
		<div class="form-group col-sm-6">
			<label for="discounttype"><h4>Discount Automatic</h4> </label>
           <input type="radio" id="yes" name="discounttype" checked class="discounttype" value="yes">Yes
           <input type="radio" id="no" name="discounttype" class="discounttype" value="no" >No		
         </div>
		</div>
		<div class="row" id="dvPinNo12" style="display:none;">
		<div class="form-group col-sm-6"  >
          <label for="discount">Discount Charge </label>
           <input type="text"  class="form-control" id="discount" name="discount"  >
         </div>
		</div>
		 <input type="hidden" name="paymenttype_hidden" class="chose_opt"  value="COD">
	 
		
		<div id="dvPinNo" style="display:none;">
			
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_zipcode">Postcode </label>
           <input type="text" class="form-control" id="usr_zipcode" name="usr_zipcode"   >
			<div id="postcode_response" ></div>
         </div>
		</div>
				<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_streetaddress1">Street </label>
           <input type="text" class="form-control" id="usr_streetaddress1" name="usr_streetaddress1"   >
         </div>
		</div>
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_order_city">Place </label>
           <input type="text" class="form-control" id="usr_order_city" name="usr_order_city"   >
         </div>
		</div>
		
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="remarks">Remarks</label>
           <input type="text" class="form-control" id="remarks" name="remarks"   >
         </div>
		</div>
				
		</div>
		
	<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_first_name">First Name </label>
           <input type="text" class="form-control" id="usr_first_name" name="usr_first_name"   >
         </div>
		</div>
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_last_name">Last Name </label>
           <input type="text" class="form-control" id="usr_last_name" name="usr_last_name"   >
         </div>
		</div>
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_company">Company Name </label>
           <input type="text" class="form-control" id="usr_company" name="usr_company"   >
         </div>
		</div>
		<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_order_phone">Telephone  </label>
           <input type="number" class="form-control" id="usr_order_phone" name="usr_order_phone"   >
         </div>
		</div>
			<div class="row">
		<div class="form-group col-sm-6">
          <label for="usr_emailid">Email Address </label>
           <input type="text" class="form-control" id="usr_emailid" name="usr_emailid"   >
         </div>
		</div>
		<div class="row">
		<div class="form-group col-sm-6" id="AddPassport">
          <label for="cust_freeitem">Gift Item </label>
           <input type="text"  class="form-control" id="cust_freeitem" name="cust_freeitem"  >
         </div>
		</div>
		<div class="row">
		 <div class="form-group col-sm-6">
         <a class="btn btn-primary btnNext" >Next</a>
		</div>
	</div>
    </div>
   <div class="tab-pane" id="tab2">
   
  <div class="row online-order-page cashier-page display-flex">
               <div class="col-md-3 sidebarleft">
                    <div class="pm-widget" id="sticky1">
                        <div class="product_main_category">
                           <h6 class="main-heading">Menu <span class="mob_close_btn">X</span></h6>
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
						
					 echo '<div class="dropdown-row"><button class="dropdown-btn"  type="button">'.$sup_cat_name.' <i class="fa fa-caret-down"></i></button>';						
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
								
                        </div>
                    </div>
              
					<script>
					
 	$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 350) {
        $(".rkfix5").addClass("fix3k");
    } else {
        $(".rkfix5").removeClass("fix3k");
    }
});


</script>
					
    </div>
	   <div class="col-md-6 middle-products"> 
	  <div class="products">  
		<li class="product-category product"> 
	  
		<?php
$query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where  `discount` != 0  AND `discountdays` !='none'");
	if( $query_postdel11->num_rows>0){	 ?>
	
<li class="product-category product"> 
<h3 id="today-discount" class="sub_ca_name"><?php echo $todadis; ?></h3>						
<?php
	 $today = date('l'); 
	 	$disids = [];
			$disids2 = [];
	$query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount`  ");
	if( $query_postdel11->num_rows>0){
   	  while($row2 = $query_postdel11->fetch_assoc()){
	     $disids[] = $row2['dish_id'];
	 }
	}
 foreach($disids as $disidssingle){								
	$query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ". $disidssingle."  "); 
   		$row3 = $query_postdel11->fetch_assoc();
		  $discountdays = $row3['discountdays'];	  
		 $dd = explode(",",$discountdays);	   
	 		if (in_array($today, $dd)){ 
			 $disids2[] =  $row3['dish_id'];
          	}
	}
foreach($disids2 as $single){ 	 
$query_postdel11 = $mysqli->query("SELECT * FROM  `dish` where `dish_id` = ". $single."  AND dish_status = 'Active'"); 
 while($row2 = $query_postdel11->fetch_assoc()){ 
	 $query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ".$single."  ");	 
   		$discount = $query_postdel11->fetch_assoc();
		 $dicountamtt2 = $discount['discount'];
	     $dicountamtt=($row2["dish_price"] * ($dicountamtt2 / 100));
         $dis2 = $row2["dish_price"]-number_format($dicountamtt,2);	  
	 $dicountamtt2=$row2["dish_price"]-$dicountamtt;		 
if($query_postdel11->num_rows > 0 && $dicountamtt!=0)	{		 
?>	
	
<div class="product_cart"><div class="product_detailss">
<h3><?php 
	if ($current_lang == "en"){ echo $row2['dish_name_en']; } else { echo $row2['dish_name_nl'];  }	 ?></h3>
<div class="prod-descreption"><p>  </p> 
<?php
							if (strlen($row2['icon']) > 0) {	
								echo '<div class="alrgy-row">';
							$icon_query = "SELECT  *  FROM `media`  WHERE   `id` IN(".$row2['icon'].")";	
							$icon_query_result = $mysqli->query($icon_query);									
								 while($roww_icon = $icon_query_result->fetch_assoc()){
									echo '<img src="'.$roww_icon['icon'].'" height="30" width="30"> ';
								 }
								echo '</div>';
							} 
					?>	
	</div>	
</div>
	
	<?php
			 if($row2['thumbnail']!=''){
							echo '<div class="dish-img"><a data-toggle="modal" data-target="#modal-viewimage" id="view_image" dataid="' . $roww_4['dish_id'] . '"><img src="https://restaurantkamasutra.nl/online/'.$row2['thumbnail'].'"  data-full="https://restaurantkamasutra.nl/online/'.$row2['product_image'].'"   width="89"></div>
</a>';							}
	?>	
 <div class="addtocart_price">
<span class="price"><span class="amount"><span class="currencySymbol">€</span>
	<del><?php echo number_format($row2['dish_price'], 2, ",", "."); ?></del> 	 
	 </span><br> 
	 <span class="price"><span class="amount"><span class="currencySymbol">€</span>
	<?php echo   number_format($dis2, 2, ",", "."); ?></span>
	 </span> </span><br>
<div class="add_to_cartbutn">
<input type="hidden" name="quantity" id="quantity<?php echo $row2["dish_id"]; ?>" class="form-control" value="1">
<input type="hidden" name="hidden_name" id="name<?php echo $row2["dish_id"]; ?>" value="<?php echo $row2["dish_name_en"]; ?>">
<input type="hidden" name="hidden_price" id="price<?php echo $row2["dish_id"]; ?>" value="<?php echo number_format($dicountamtt2,2); ?>">
<input type="hidden" name="hidden_dish_type" id="dish_type<?php echo $row2["dish_id"]; ?>" value="<?php echo $row2["dish_type"]; ?>">    
<input type="hidden" name="hidden_dish_attrib" id="dish_attrib<?php echo $row2["dish_id"]; ?>" value="<?php echo $row2["dish_attrib"]; ?>"> 
		<input type="hidden" name="plastc_box" id="pl_price<?php echo $row2["dish_id"]; ?>" value="<?php echo $row2["bag_charge"]; ?>" />	
 
	<a class="addbtn add_to_cart  disbleornot" name="add_to_cart" id="<?php echo $row2["dish_id"]; ?>" href="javascript:void(0)">  </a>	
 
	 </div> </div> </div>
<?php	}
 } // whiile loop
 } // foreach
} //						
?>
		  <?php
  // al dishes without discount
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
                    echo '<li class="product-category product">';
                    echo '<h3 id="'.$cat_name2.'" class="sub_ca_name">'.$cat_name.' <p>'.$product_desc.'</p></h3>';                 
                 $dish_order = $mysqli->query("SELECT * FROM dish_order where do_cat_id  = '" . $value . "'");  
                 $roww_3 = $dish_order->fetch_assoc();
                 $disharangs = $roww_3['do_dish_sort_order'];
                $array=array_map('intval', explode(',', $disharangs));
				 $array2=array_map('intval', explode(',', $disharangs));
                $array = implode("','",$array);							
$print_dish = "SELECT  *  FROM `dish`  WHERE `categry_id` ='" . $value . "' AND dish_status = 'Active'   ORDER BY FIELD(`dish_id`,'" . $array . "')";								  
			  $query_result2 = $mysqli->query($print_dish);				  
				if ($query_result2->num_rows > 0) {      
                   $query_result = $mysqli->query($print_dish);				 
				}		
				 else{
					 /// $print_dish2 = "SELECT  *  FROM `dish`  WHERE `categry_id`  like '%" . $value . "%'"; 
					  ///$query_result = $mysqli->query($print_dish2);					 
				 }			  
							  
				 $all_varar = [];
				   $all_var_qury = "SELECT  *  FROM `dish`  WHERE `categry_id`   like '%" . $value . "%' AND dish_status = 'Active'";    
				   $allvarget = $mysqli->query($all_var_qury); 
					 while ($row1 = $allvarget->fetch_assoc()) {
						 $all_varar[] = $row1['dish_id'];
					 }		
							  
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
									echo '<img src="'.$roww_icon['icon'].'" height="30" width="30"> ';
								 }
								echo '</div>';								
							}?>								
                       </div><!--descript-->							
                  </div>
					<?php
				  if($roww_4['thumbnail']!=''){
							echo '<div class="dish-img"><a data-toggle="modal" data-target="#modal-viewimage" id="view_image" dataid="' . $roww_4['dish_id'] . '"><img src="https://restaurantkamasutra.nl/online/'.$roww_4['thumbnail'].'"  data-full="https://restaurantkamasutra.nl/online/'.$roww_4['product_image'].'"   width="89"></div>
</a>';							}
 $query_postdel11 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ".$roww_4['dish_id']."  ");	 
   		$discount = $query_postdel11->fetch_assoc();
		 $dicountamtt2 = $discount['discount'];
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
 <span class="price currencySymbol"><?php echo $currency; ?><?php echo  number_format($roww_4["dish_price"], 2, ",", ".") ; 
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
 		
<a class="addbtn add_to_cart" name="add_to_cart" id="<?php echo $roww_4["dish_id"]; ?>" href="javascript:void(0)">  </a>
 
	 </div>           </div>          
        </div>
               <?php } // mai dish loop
						  }	
							  
							  
	 $result23=array_diff($all_varar,$array2);			  
			if($result23){
		/*		foreach($result23 as $result23_sing){
		 $print_dish2 = "SELECT  *  FROM `dish`  WHERE    dish_id ='".$result23_sing."' "; 
				$query_result = $mysqli->query($print_dish2);
	while($roww_4 = $query_result->fetch_assoc()){ ?>
                <div class="product_cart">				 
                        <div class="product_detailss">
                        <h3><?php if ($current_lang == "en"){ echo $roww_4['dish_name_en'];  } else {echo $roww_4['dish_name_nl'];   }					  
		?></h3>
                        <div class="prod-descreption">
                        <p><?php if ($current_lang == "en") {echo $roww_4['dish_desc_en'];  } else { echo $roww_4['dish_desc_nl'];  }
							?></p>							
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
							echo '<div class="dish-img"><a data-toggle="modal" data-target="#modal-viewimage" id="view_image" dataid="' . $roww_4['dish_id'] . '"><img src="https://restaurantkamasutra.nl/online/'.$roww_4['thumbnail'].'"  data-full="https://restaurantkamasutra.nl/online/'.$roww_4['product_image'].'"   width="89"></div>
</a>';							}
 $query_postdel112 = $mysqli->query("SELECT * FROM `dish_discount` where `dish_id` = ".$roww_4['dish_id']."   ");	 
   		$discount = $query_postdel112->fetch_assoc();												  
												  
		 $discountdays = $discount['discountdays'];	  
		 $dd = explode(",",$discountdays);	   
	 		if (in_array($today, $dd)){ 
			 $disids2 =  $roww_4['dish_id'];
				///  echo $disids2;
          	}	
		 $dicountamtt2 = $discount['discount'];
	     $dicountamtt=($roww_4["dish_price"] * ($dicountamtt2 / 100));
         $dis2 = $roww_4["dish_price"]-number_format($dicountamtt,2);	  
	 $dicountamtt2=$roww_4["dish_price"]-$dicountamtt;		 
if (in_array($today, $dd)){ ?>
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
 <span class="price currencySymbol"><?php echo $currency; ?><?php echo  number_format($roww_4["dish_price"], 2, ",", ".") ; ?></span>	 
        <div class="add_to_cartbutn">
        <input type="hidden" name="quantity" id="quantity<?php echo $roww_4["dish_id"]; ?>" class="form-control" value="1" />
        <input type="hidden" name="hidden_name" id="name<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_name_en"]; ?>" />
        <input type="hidden" name="hidden_price" id="price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_price"]; ?>" />			
 <?php } ?> 			
        <input type="hidden" name="hidden_dish_type" id="dish_type<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_type"]; ?>" /> 
<input type="hidden" name="hidden_dish_attrib" id="dish_attrib<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_attrib"]; ?>" />
			  <input type="hidden" name="plastc_box" id="pl_price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["bag_charge"]; ?>" />
 		
<a class="addbtn add_to_cart" name="add_to_cart" id="<?php echo $roww_4["dish_id"]; ?>" href="javascript:void(0)">  </a>
 
	 </div>           </div>          
        </div>
               <?php } } 
			*/
			}							  
							  
               echo '<li>';
                   }   ?>

          </div>			  
				 

   </div>
	 
		  <div class="col-md-3 pm-sidebar-right">
                     <div class="pm-widget" id="sticky">
                         <h6  class="main-heading"><?= $yourorder_l ?><span class="mob_close_btn2"  style="display:none;">X</span></h6>
						 
                        <div class="widget_shopping_cart_content">
                            <!-- start product list -->  
                       
                                <nav class="navbar navbar-default" role="navigation">
                                    <div class="container-fluid">
                                        <div id="navbar-cart" class="navbar-collapse collapse">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a id="cart-popover" class="btn" data-placement="bottom" title=" <?php echo ($current_lang == "en") ? "Shopping Cart" : "Winkelwagen" ?>">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        <span class="badge"></span>
                                                        <span class="total_price"><?php echo currency; ?> 0.00</span>
														
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </nav>
                                <!--<div id="popover_content_wrapper" style="display: none">-->
                                <div id="popover_content_wrapper" >
								
				
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
									<label class="pop9652" for="postcode name"><h4>Payment Option</h4> </label>
            <input type="radio" id="cod" name="paymenttype" checked="checked" class="chosepayopt" value="COD">Cash
           <input type="radio" id="pin" name="paymenttype" value="pin"  class="chosepayopt">Pin 
                                    <div align="right">
									<input type="hidden" name="ppfr" id="total_pricejyo" value="€0.00">	
										<button type="submit" name="submit" id="submitbutton" class="submitbutton btn btn-primary">checkout</button>
                                        
                                    </div>
									
                                </div>
                           
							
                            <!-- end product list -->
                           <div id="discount_msg">
                            </div>
                        </div>
                    </div>
					
					
					
					
                </div>
		  </div>
	
	
		


		
		  
	   </div>
	    <a class="btn btn-primary btnPrevious" >Previous</a>
        <a class="btn btn-primary btnNext" >Next</a>		
    </div>
	<div class="tab-pane" id="tab3"   style="display:none;">
		<div class="row"  style="margin-top: 16px;">
		<div class="form-group col-sm-6">
			
			 <?= $_SESSION["cop_cart_details"]; ?>
			</div>
		</div>
	</div>
   
                                    </div>
									 </form>	
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->

             

                <!-- Inner content -->
         
                            </div>
					    </section>
                        </div><!-- /.modal-content -->
	  <script>
					
					$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 350) {
        $(".rkfix5").addClass("fix3k");
    } else {
        $(".rkfix5").removeClass("fix3k");
    }
});


</script>
		  <script>
		  $(document).ready(function () {
            
            window.onscroll = function() {scrollFunction()};
var newWindowWidth = $(window).width();
			 if (newWindowWidth < 991) {

		$(document).on('click', '.dish_cat_icon', function () {
			$('#sidebar').removeClass("cart_icon_y");
			$('#sidebar1').toggleClass("dish_cat_icon_y");
		});	
		
		$(document).on('click', '.cart_icon', function () {	
			$('#sidebar1').removeClass("dish_cat_icon_y");
			$('#sidebar').toggleClass("cart_icon_y");
		});	
		$(document).on('click', '#sidebar1 a', function () {	
				
			$('.dish_cat_icon').click().true;
		});}
		
	});
	</script>
<script>
$("#no").click(function(){
 if($(this).is(":checked")) {
   //alert($(this).val()); 
	 	var discount = $('#discount').val();
   }
});
</script>
            <!--// main content -->
<script>
		$('.submitbutton').click(function(){
			var pick_or_del = $("input[name='pick_or_del']:checked").val();
			var discounttype = $("input[name='discounttype']:checked").val();
			  
if(discounttype=='no'){
	var discount = $("input[name=discount]").val();
		 
if (discount == "") {
      alert("Please enter discount in the form");
      $("input[name=discount]").focus();
      return false;
    }
}
if(pick_or_del=='delivery'){
	var usr_zipcode = $("input[name=usr_zipcode]").val();
if (usr_zipcode == "") {
      alert("Please enter postcode in the form");
      $("input[name=usr_zipcode]").focus();
      return false;
    }
		var poid = $("input[name=poid]").val();
if (poid == "notavailable") {
      alert("Please enter correct postcode in the form");
      $("input[name=poid]").focus();
      return false;
    }
	var usr_streetaddress1 = $("input[name=usr_streetaddress1]").val();
  /* if (usr_streetaddress1 == "") {
      alert("Please enter street in the form");
      $("input[name=usr_streetaddress1]").focus();
      return false;
    }*/
	var usr_order_city = $("input[name=usr_order_city]").val();
   /* if (usr_order_city == "") {
      alert("Please enter your place in the form");
      $("input[name=usr_order_city]").focus();
      return false;
    }*/
	
}
	var usr_first_name = $("input[name=usr_first_name]").val();
    if (usr_first_name == "") {
      alert("Please enter name in the form");
      $("input[name=usr_first_name]").focus();
      return false;
    }
			var total_pricejyoa = $("input[name=ppfr]").val();
				//alert(total_pricejyoa);
				if (total_pricejyoa == "€0.00") {
      alert("Please Add some order");
     
      return false;
    }
		
			var usr_order_phone = $("input[name=usr_order_phone]").val();
   /* if (usr_order_phone == "") {
      alert("Please enter number in the form");
      $("input[name=usr_order_phone]").focus();
      return false;
    }*/
			var usr_emailid = $("input[name=usr_emailid]").val();
    /*if (usr_emailid == "") {
      alert("Please enter emailid in the form");
      $("input[name=usr_emailid]").focus();
      return false;
    }*/
		$('.nav-tabs > .active').next('li').find('a').trigger('click');	
});

	// this is order button
			$('.btnNext').click(function(){
			var pick_or_del = $("input[name='pick_or_del']:checked").val();
			var discounttype = $("input[name='discounttype']:checked").val();
if(discounttype=='no'){
	var discount = $("input[name=discount]").val();
if (discount == "") {
      alert("Please enter discount in the form");
      $("input[name=discount]").focus();
      return false;
    }
}
if(pick_or_del=='delivery'){
	var usr_zipcode = $("input[name=usr_zipcode]").val();
if (usr_zipcode == "") {
      alert("Please enter postcode in the form");
      $("input[name=usr_zipcode]").focus();
      return false;
    }
var poid = $("input[name=poid]").val();
if (poid == "notavailable") {
      alert("Please enter correct postcode in the form");
      $("input[name=poid]").focus();
      return false;
    }
	var usr_streetaddress1 = $("input[name=usr_streetaddress1]").val();
    if (usr_streetaddress1 == "") {
      alert("Please enter street in the form");
      $("input[name=usr_streetaddress1]").focus();
      return false;
    } 
	var usr_order_city = $("input[name=usr_order_city]").val();
     if (usr_order_city == "") {
      alert("Please enter your place in the form");
      $("input[name=usr_order_city]").focus();
      return false;
    } 
	
}
	var usr_first_name = $("input[name=usr_first_name]").val();
    if (usr_first_name == "") {
      alert("Please enter name in the form");
      $("input[name=usr_first_name]").focus();
      return false;
    }
		var usr_first_name = $("input[name=usr_last_name]").val();
    if (usr_first_name == "") {
      alert("Please enter name in the form");
      $("input[name=usr_last_name]").focus();
      return false;
    }			
	 var usr_order_phone = $("input[name=usr_order_phone]").val();
    if (usr_order_phone == "") {
      alert("Please enter number in the form");
      $("input[name=usr_order_phone]").focus();
      return false;
    } 
			var usr_emailid = $("input[name=usr_emailid]").val();
     if (usr_emailid == "") {
      alert("Please enter emailid in the form");
      $("input[name=usr_emailid]").focus();
      return false;
    } 
	 var pick_or_del	=	$('input[name="pick_or_del"]').filter(':checked').val();  	
     var discount = $('#discount').val();
	 var disc_type_auto	=	$('input[name="discounttype"]').filter(':checked').val();	
	  var action = "adddiscount_new2";
	  var current_lang = $('#current_lang').val();
				
		var usr_zipcode = $('#usr_zipcode').val();
			 
  $.ajax({
           url: "casier_action.php",
           method: "POST",
          		 data: {discount:discount,action: action,disc_type_auto:disc_type_auto,pick_or_del:pick_or_del,usr_zipcode:usr_zipcode,},
                 success: function (data){	
				 
               }
                      
		}); 
 ///}
  $('.nav-tabs > .active').next('li').find('a').trigger('click');					
				
	
			
});
	
	
  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
	</script>
			<style>.oo_notshow{display:none;}</style>
			<script>

$(document).ready(function(){
 /* $("#discount").keyup(function(){
  var discount = $('#discount').val();
var disc_type_auto	=	$('input[name="discounttype"]').filter(':checked').val();
 var pick_or_del	=	$('input[name="pick_or_del"]').filter(':checked').val();
 
  var action = "adddiscount_new";
  var current_lang = $('#current_lang').val();
  $.ajax({
           url: "casier_action.php",
           method: "POST",
           data: {discount: discount, action: action,disc_type_auto:disc_type_auto,pick_or_del:pick_or_del},
                            success: function (data)
                            {
								var discountnew = "You receive ". concat(discount) . concat("% Discount. It is calculated on the checkout page.");
								if(discount>0){
								$("#discount_msg").html(discountnew);
								} else { 
									$("#discount_msg").html('');
								}
                                load_cart_data();
                                if (current_lang == "en") {
                                    $('#myModalNew1').modal('hide');
                                } else {
                                    $('#myModalNew1').modal('hide');
                                }
                            }
                        });
  });*/
});
</script>
        <script>
           

			
			
			var newWindowWidth = $(window).width();
			 if (newWindowWidth > 992) {
				 
					$(document).on('click', '.dish_cat_icon', function () {
						$('html, body').animate({
							'scrollTop' : $(".product_main_category").position().top
						});    
					});
					$(document).on('click', '.cart_icon', function () {
						$('html, body').animate({
							'scrollTop' : $("#sticky").position().top
						});    
					});
			 }
            $(document).ready(function () {
                $("#check_out_cart").hide();
				 $("#check_out_pick").hide();
                $('#clear_cart').hide();
                $('.pro_tbl_head').hide();
                

                
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
							//$('#tcfs').html(totalcostnow);
               
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
                       if(is_required==1 && thsval=='default'){
                            $(this).parents('.select_main').find('.required_pass').val(1);
                        } 
					else{
						    ///  thisis.parents('.select_main').find('.required_pass').val(0);}
					}
				 
                });

                $('#cart-popover').popover({
                    html: true,
                    container: 'body',
                    content: function () {
                        return $('#popover_content_wrapper').html();
                    }
                });


// Gift And Discount Msg below cart
                function giftanddismsg() {
                    var count_of_item = $('.badge').html();
                    if (count_of_item >= "1") {
                        //console.log('check for msg');
                        var action = "checkgiftitem";
                        var cart_cost_now = document.getElementById('cart_cost_now').innerText;
                        //console.log(cart_cost_now);
                        cart_cost_now = cart_cost_now.substring(2, cart_cost_now.length);
                       // console.log(cart_cost_now);
                        $.ajax({
                            url: "casier_action.php",
                            method: "POST",
                            data: {action: action, cart_cost_now: cart_cost_now},
                            dataType: "html",
                            success: function (data)
                            {
                                //console.log(data);                    
                                $('#display_item').html(data);
                            }
                        });

                    } else {
                        //   console.log('no item in cart');
                        $('#display_item').html('');
                    }
                }
//Fetch Shopping Cart Details
                load_cart_data();
                function load_cart_data()
                {
                    var action = "loadcartdata";
                    $.ajax({
                        url: "casier_action.php",
                        method: "POST",
                        data: {action: action, },
                        dataType: "json",
                        success: function (data)
                        {
							console.log(data);
                            $('#cart_details').html('');
                            $('.total_price').text('');
                            $('.badge').text('');
                            $('#cart_details').html(data.cart_details);
							$('#cantacloj').html(data.totaltosho);
                            $('.total_price').text(data.total_price);
							
							$('#total_pricejyo').val(data.total_price);
                            $('.badge').text(data.total_item);
                            var total_price_4checkoutBtn = data.total_price_4checkoutBtn;
                            if (typeof (postcode_min_amt) != "undefined" && postcode_min_amt !== null) {//console.log("HELLO");
                                 if (parseFloat(parseFloat(total_price_4checkoutBtn.replace(',', '')).toFixed(2)) >= parseFloat(parseFloat(postcode_min_amt).toFixed(2))) {//console.log("HELLO123");
                                    $("#check_out_cart").hide();
                                    $("#check_out_cart").show();
                                } else {
                                    $("#check_out_cart").hide();
                                }
                            }else {//console.log("HELLO111");
                                    $("#check_out_cart").hide();
                                }
                            var min_amt = '<?php echo $_SESSION['min_amt']; ?>';
							if (typeof (min_amt) != "undefined" && min_amt !== null) {//console.log("HELLO");
                                 if (parseFloat(parseFloat(total_price_4checkoutBtn.replace(',', '')).toFixed(2)) >= parseFloat(parseFloat(min_amt).toFixed(2))) {//console.log("HELLO123");
                                    $("#check_out_pick").hide();
                                    $("#check_out_pick").show();
                                } else {
                                    $("#check_out_pick").hide();
                                }
                            }else {//console.log("HELLO111");
                                    $("#check_out_pick").hide();
                                }
                            if(total_price_4checkoutBtn>0){
                                $("#discount_msg").html('');
                                $("#discount_msg").html(data.discount);
                            }else{$("#discount_msg").html('');}
                             if(data.total_item>0){$('#clear_cart').show();$('.pro_tbl_head').show();}else{$('#clear_cart').hide();$('.pro_tbl_head').hide();}
                        },
                        complete: function (data) {
                            giftanddismsg();
							var col_l=$('.products li h3').css( "background-color");
							$(".cart_icon").css("background-color", col_l).fadeIn(100);   
     						setTimeout(function(){
      							$(".cart_icon").css("background-color", "#333").fadeIn(100);
    						},500); 
                        }
                    });
                }

                function finalcostforsingleitem(selected_attri_cost, product_price) {
                  var tc = parseFloat(selected_attri_cost) + parseFloat(product_price);
                    return tc;
                  }
                $(document).on('click', '.add_to_cart', function () {
					  var product_name = $('#name' + product_id + '').val();
					var product_price = $('#price' + product_id + '').val();
                    var product_id = $(this).attr("id");
                    var discount = $('#discount').val();
					var usr_zipcode = $('#usr_zipcode').val();
					var discounttype = $("input[name='discounttype']:checked").val();
					var pick_or_del = $("input[name='pick_or_del']:checked").val();
                    var product_type = $('#dish_type' + product_id).val();
                    var product_attrib = $('#dish_attrib' + product_id).val();
                    var product_name = $('#name' + product_id + '').val();
                    var product_price = $('#price' + product_id + '').val();
                    product_price = product_price.toString().replace(",", ".");
                    var product_quantity = $('#quantity' + product_id).val();
                    $("#current_productprice").val('');
                    $("#current_productname").val('');
                    $("#current_productid").val('');
                    $("#current_productprice").val(product_price);
                    $("#current_productname").val(product_name);
                    $("#current_productid").val(product_id);
					
                    if (product_type == "2") {
                        url = 'casier_action.php';  //console.log(url);return false;
                        var action = "dish_attrib_popup";
                        var current_lang = $('#current_lang').val();
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                action: action, product_id: product_id, current_lang: current_lang,product_attrib:product_attrib,
                            },
                            dataType: "html",
                            success: function (data1)
                            {
                                $("#pc_form2").html(data1);
                                $('#myModalNew1').modal('show');

								 $('#myModalNew1').find('.maintitle h4').html(product_name);
						  $('#myModalNew1').find('.pricepop span').html('€ '+product_price);
						  $('#myModalNew1').find('.pricedish').val(product_price);
								  $('#myModalNew1').find('.newpriadd').val(0);
                                var totalcostnow=0;
                                totalcostnow=product_price;
                          
								/* $( ".attriblok" ).each(function() {
                                var selected_attri_cost=$(this).find(':selected').data('lok');
                                totalcostnow=finalcostforsingleitem(selected_attri_cost, totalcostnow);
                        }); 
                                   $('#tcfs').html(totalcostnow);*/
								$('#tcfs33').val(parseFloat(totalcostnow).toFixed(2));
								  var sum1 = parseFloat(totalcostnow).toFixed(2);
								  var sum2 = sum1.toString().replace(/\./g, ',');
								$('#tcfs').html('€ '+sum2);
								$('#tcfsbase').val(parseFloat(totalcostnow).toFixed(2));
								 $('#myModalNew1').find('.variable_prices').val(product_price);
								
                            },
                       });
                    } else {
                        final_addtocart(product_id, product_name, product_price, product_quantity,  pick_or_del, usr_zipcode);
                    }
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
            if(lenght_total >= choose_limit){
                thisis.parents('.select_main').find('input').not(":checked").attr("disabled",true);
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

				
//Remove Item from cart
                $(document).on('click', '.delete', function () {
                    var product_id = $(this).attr("id");
                    var current_lang = $('#current_lang').val();
                    var action = 'remove';
                    var delmsg_lok='';
                    if(current_lang=="en"){
						delmsg_lok="Are you sure you want to remove this product?";}else{delmsg_lok="Weet u zeker dat u dit product wilt verwijderen?"}
                    
                   /// if (confirm(delmsg_lok))
                   //// {
                        $.ajax({
                            url: "casier_action.php",
                            method: "POST",
                            data: {product_id: product_id, action: action},
                            success: function ()
                            {
                                load_cart_data();
                                $('#cart-popover').popover('hide');
                                if (current_lang == "en") {
                                  ///  alert("Item has been removed from Cart");
                                } else {
                                   /// alert("Item is verwijderd uit winkelwagen");
                                }

                            }
                        })
                   /// } else
                   /// {
                      ///  return false;
                   /// }
                });

                $(document).on('click', '#clear_cart', function () {
                    var action = 'empty';
                    var current_lang = $('#current_lang').val();
                    var currency =
                            $.ajax({
                                url: "casier_action.php",
                                method: "POST",
                                data: {action: action},
                                success: function ()
                                {
                                    load_cart_data();
                                    $('#cart-popover').popover('hide');
                                    if (current_lang == "en") {
                                        alert("Your Cart has been clear");
                                    } else {
                                        alert("Je winkelwagen is duidelijk");
                                    }
                                }
                            });
                });
  function final_addtocart(product_id, product_name, product_price, product_quantity, pick_or_del, usr_zipcode) {
                    var action = "addtokart";
                    var current_lang = $('#current_lang').val();
                    if (product_quantity > 0 )
                    {
						if(product_price != ""){
                        $.ajax({
                            url: "casier_action.php",
                            method: "POST",
                                                       data: {product_id: product_id, product_name: product_name, product_price: product_price, product_quantity: product_quantity, pick_or_del:pick_or_del,usr_zipcode:usr_zipcode,action: action},
                            success: function (data)
                            {
							 	console.log(data);
                            load_cart_data();
                                if (current_lang == "en") {
                                    $('#myModalNew1').modal('hide');
                                } else {
                                    $('#myModalNew1').modal('hide');
                                }
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








                $('#ur_postcodesec').hide();
                var showornot = $('#showpostpopupornot').val();
                var current_postcodeis = $('#current_postcodeis').val();



                if (current_postcodeis == 'notset') {
                    $('#ur_postcodesec').hide();
                    $('.pinbtn').show();
                  ////  $('.addbtn').hide();
                } else {
                    $('#ur_postcodesec').show();
                    $('.pinbtn').hide();
                    $('.addbtn').show();
                }

                $('.btn1').click(function (e) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $(href).modal('toggle');
                });
                $('#myModal').on('hidden.bs.modal', function () {
                    var showornot = $('#showpostpopupornot').val();
                    if (showornot == "yes") {
                        $('#chk_postcode').val('');
                        $('#post_err').html('');
                        $('#myModalNew').modal('show');

                    }
                });
                $('#myModalNew').on('shown.bs.modal', function () {
                    $("#chk_postcode").focus();
                });

                $(document).on('click', '#close_postcode', function () {
                    url = 'casier_action.php';  //console.log(url);return false;
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




                    url = 'casier_action.php';  //console.log(url);return false;
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
                                // console.log('PASS HO GYA');           
                                window.location.reload(true);
                            }

                        }
                    });
                });


                $(document).on('click', '#lang_en_btn', function () {
                    url = 'casier_action.php';  //console.log(url);return false;
                    var action = 'change_web_lang';
                });


            });
			
$(document).keypress(function(e) {
  if ($("#myModal").hasClass('in') && (e.keycode == 13 || e.which == 13)) {
    $("#popup1btn").click();
  }
});

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
			
	$(document).on('click', '.dish_cat_icon', function () {
			$('.sidebarleft').toggleClass("dish_cat_icon_y");
		});

		$(document).on('click', '.cart_icon', function () {
		$('.sidebarleft').removeClass("dish_cat_icon_y");
			$('.pm-sidebar-right').toggleClass("cart_icon_y");
		});		
			
			
			
    $(document).on('click','.mob_close_btn',function(){
        $('.sidebarleft').removeClass("dish_cat_icon_y");
    });
    $(document).on('click','.mob_close_btn2',function(){
        $('.pm-sidebar-right').removeClass("cart_icon_y");
    });
			
			
	  $(document).on('click','.modal button.close',function(){
        $('#myModalNew').fadeOut();
    });			
			
			
			
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
			
		
   $(function() { // document ready
	   if ($('#sticky').length) { // make sure "#sticky" element exists
		var el = $('#sticky');
		var stickyTop = $('#sticky').offset().top; // returns number
		var stickyHeight = $('#sticky').height();
		$(window).scroll(function() { // scroll event
			var limit = $('.main-footer').offset().top - stickyHeight - 20;
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
			var limit1 = $('.main-footer').offset().top - sticky1Height - 20;
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
			
	$(document).on('change, keyup',  "input#usr_order_phone", function (event) {		  
			var currentInput = $(this).val();
			var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
			$(this).val(fixedInput);
			
		});		
			
			
	 $(document).on("change", ".chosepayopt", function (event) {   
					   var vals = $(this).val();				
					   $('.chose_opt').val(vals);	 
				   	 	 
			});		
			
            </script>

            <?php include 'footer.php'; ?>
         
    </body>
</html>

 
