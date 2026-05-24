 
<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';

/*
// 2 hours in seconds
$inactive = 72000; 
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours

session_start();

if (isset($_SESSION['product_cart']) && (time() - $_SESSION['product_cart'] > $inactive)) {
    // last request was more than 2 hours ago
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['product_cart'] = time(); // Update session
// $now = time();
*/
?>
<html>
		<meta http-equiv="refresh" content="12000" />
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
		 <script src="jquery.min.js"></script>
		 <title> Online Order </title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="tablecss.css">		
	
<style>
	 
</style>
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
 
<?php
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="en";}
           $current_lang = $_SESSION['current_lang'];
           $currentselected = $_SESSION['currentselected'] ?? '';
            define('UTF8_ENABLED', '');
            ?>
            <script>
                b_url1 = '<?php echo online_base_url; ?>';
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
     
            if ($current_lang == "en") {
				   $currency = '€';
				$quan_l='Quantity';$clear_l='Clear Selection';$add_btn_l='Add';
				 $option_l="Option(s)";
					$attrreq_war = 'Make your choice';
					$yourorder_l="Table Number";
				
            } else {
			 $currency = '€';
					$quan_l='Aantal stuks';$clear_l='Duidelijke selectie';$add_btn_l='Toevoegen';
				 $option_l="Optie(s)";
				$attrreq_war = 'Maak uw keuze';
					$yourorder_l="Uw bestelling";
            }
 
 ?>
<!DOCTYPE html>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
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
                    <h1>Book Table <small></small></h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Cashier</li>
                    </ol>
                </section>
				  <section class="content">
                    <div class="row">
                        <div class="col-xs-8 dishes-box" style="padding-right: 0px;">
                            <div class="box">								
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">								
								<div class="table-booking">
								<ul class="table-list" >
								 <?php
								 
									$today = date('Y-m-d');
 		 $table1=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 1");
 		 $table1record1 = $table1->num_rows; 					 
		 $table2=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 2");
	     $table2record2 = $table2->num_rows; 
		 $table3=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 3");
		 $table3record3 = $table3->num_rows;
	     $table4=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 4");
	     $table4record4 = $table4->num_rows;
		 $table5=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 5");
		 $table5record5 = $table5->num_rows;
		 $table6=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 6");
		 $table6record6 = $table6->num_rows;
		 $table7=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 7");
		 $table7record7 = $table7->num_rows;
		 $table8=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 8");
		 $table8record8 = $table8->num_rows;
		 $table9=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND table_no = 9");
		 $table9record9 = $table9->num_rows;
	     $table10=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND  table_no = 10");
		 $table10record10 = $table10->num_rows;		
		 $table11=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND  table_no = 11");
		 $table11record11 = $table11->num_rows;		
	$table12=$mysqli->query("SELECT  `table_no` FROM `table_booked` WHERE DATE(date_time) = '$today' AND  table_no = 12");
		$table12record12 = $table12->num_rows;	
					 
				$active1 = $active2 = $active3 = $active4 = $active5 = $active6 = $active7 = $active8 = $active9 = $active10 = $active11 = $active12 = '';
				if(!empty($table1record1)) { $active1 = 'activetable2 bookedther';}								
						if(!empty($table2record2)) { $active2 = 'activetable2 bookedther'; }
						if(!empty($table3record3)) { $active3 = 'activetable2 bookedther'; }
						if(!empty($table4record4)) { $active4 = 'activetable2 bookedther'; }
						if(!empty($table5record5)) { $active5 = 'activetable2 bookedther'; }
						if(!empty($table6record6)) { $active6 = 'activetable2 bookedther'; }
						if(!empty($table7record7)) { $active7 = 'activetable2 bookedther'; }
						if(!empty($table8record8)) { $active8 = 'activetable2 bookedther'; }
						if(!empty($table9record9)) { $active9 = 'activetable2 bookedther'; }
						if(!empty($table10record10)) { $active10 = 'activetable2 bookedther'; }	
										if(!empty($table11record11)) { $active11 = 'activetable2 bookedther'; }	
										if(!empty($table12record12)) { $active12 = 'activetable2 bookedther'; }	
									 
									?>
								<li class="table1 <?php echo $active1; ?>"> <input type="hidden" class="table-number" id="" value="1">
									<span>1</span><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>	
								<li class="table2 <?php echo $active2; ?>"><input type="hidden" class="table-number" id="" value="2"><span>2</span><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
								<li class="table3 <?php echo $active3; ?>"><input type="hidden" class="table-number" id="" value="3"><span>3</span><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
								<li class="table4 <?php echo $active4; ?>"><span>4</span><input type="hidden" class="table-number" id="" value="4"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
								<li class="table5 <?php echo $active5; ?>"><span>5</span><input type="hidden" class="table-number" id="" value="5"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div>	</li>
								<li class="table6 <?php echo $active6; ?>"><span>6</span><input type="hidden" class="table-number" id="" value="6"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1">	</div></li>
								<li class="table7 <?php echo $active7; ?>"><span>7</span><input type="hidden" class="table-number" id="" value="7"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
								<li class="table8 <?php echo $active8; ?>"><span>8</span><input type="hidden" class="table-number" id="" value="8"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
								<li class="table9 <?php echo $active9; ?>"><span>9</span><input type="hidden" class="table-number" id="" value="9"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div>	</li>
								<li class="table10 <?php echo $active10; ?>"><span>10</span><input type="hidden" class="table-number" id="" value="10"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>	
									
<li class="table11 <?php echo $active11; ?>"><span>11</span><input type="hidden" class="table-number" id="" value="11"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>
									
									<li class="table12 <?php echo $active12; ?>"><span>12</span><input type="hidden" class="table-number" id="" value="12"><div class="tablimg"><img src="table-icon2.png" class="table-icon2"><img src="table-icon1.png" class="table-icon1"></div></li>

								</ul>
		  <input type="hidden" value="<?php echo $currentselected; ?>" id="currentselected">
								</div>	
								
								<!---------------------Mobile Cart & Categoris------------------------->
									<a href="javascript:void(0);" class="icon dish_cat_icon  fix_menu_mob"  id="opencartt"><span class="cartnum cartnum1">0</span><span class="cartnum cartnum2">0</span><span class="cartnum cartnum3">0</span><span class="cartnum cartnum4">0</span><span class="cartnum cartnum5">0</span><span class="cartnum cartnum6 ">0</span><span class="cartnum cartnum7">0</span><span class="cartnum cartnum8 ">0</span><span class="cartnum cartnum9">0</span><span class="cartnum cartnum10">0</span><span class="cartnum cartnum11">0</span><span class="cartnum cartnum12">0</span>&#128722;</a>
        
						</div>	
							</div>


<div class="pro-cat-sec">
	
	<div class="search-row">
	<form method="GET" class='navbar__search'>
	<div class="search-wrapper">	
    <input type='search' name='navbar__searchField' id="navbar__searchField" class="search-box" placeholder='Search Dishes'>
	<button type="button" id="emptyserch" style="display:none;">X</button>
		</div>	
   <!-- <button type="button" id="searchkeyword">Search</button>-->
	<div class="lists"></div>
</form>	
	<div class="custom-product"><a class="cusdishid">Custom Product</a></div>
		
	</div>	
                                      <!-- <ul class="nav nav-tabs table-nav">
                                                      <li class="active"><a href="#tab1" data-toggle="tab">Categories</a></li>
                                       </ul>-->
										<div class="categ-form">
<div class="tab-content table-content">    
   <div class="tab-pane tab-bok" id="tab1"  style="display:block;">
   <div class="table-product-category">
			 
                        <div class="product_main_category">
                           <ul class="main_category">
 <?php
						
				 	
									 
						 $all_cats = array();						  
						  // Get categories order
                           $main_cat = $mysqli->query("SELECT *   FROM `tmenu_order`");
                           $roww = $main_cat->fetch_assoc();
                           $cat_name = $roww['cat_sort_order'];									 
							$getcategores = $mysqli->query("SELECT * FROM `tcategories` ");		 
			                while ($row_cat = $getcategores->fetch_assoc()){							  							 
									$all_cats[] =  $row_cat['cat_id'];								 
					       }							 			 
                           $maincat=explode(',',$cat_name);    
							$arrunq = [];		 
							$result_diff = array_merge($maincat,$all_cats);	
							 $arrunq = array_unique($result_diff);	 
									 
				// Get if super categories is enable					 
					 $sup_cat_qury = $mysqli->query("SELECT *   FROM `tsupercategories`");     
					if( $sup_cat_qury->num_rows>0){										 
					   $sup_cat_order = $mysqli->query("SELECT *   FROM `tsupercategory_order`  ");   
						  $roww_sup_ord = $sup_cat_order->fetch_assoc();
                           $sup_cat_order_arry = $roww_sup_ord['sup_cat_order'];				 
							
				  $array=array_map('intval', explode(',', $sup_cat_order_arry));
                $array = implode("','",$array);						
					$sup_cat_qury = $mysqli->query("SELECT *   FROM `tsupercategories`  ORDER BY FIELD(`supcat_id`,'" . $array . "')");                
					 while ($row_cat_sup = $sup_cat_qury->fetch_assoc()){ 
                           $sup_catname = $row_cat_sup['supcat_id'];
						  if($current_lang=="dutch"){ $sup_cat_name =  $row_cat_sup['supcat_name_nl'];   } 
						  else { $sup_cat_name =  $row_cat_sup['supcat_name_en']; }
						
					 echo '<button class="dropdown-btn">'.$sup_cat_name.' <i class="fa fa-caret-down"></i></button>';						
					  echo '<div class="dropdown-container"  style="display:none;">';						  
					  $get_customername = $mysqli->query("SELECT * FROM tcategories where  sub_cat_id = '".$sup_catname."'");                 
						    while ($row_cat = $get_customername->fetch_assoc()){	
								$catneme23 = '';
								 if ($current_lang == "en") {	$catneme23 = $row_cat['cat_name_en'];
									 }
								else { $catneme23 = $row_cat['cat_name_nl']; }							
                              $catneme2 = str_replace(' ', '', $catneme23);	
							$catneme3 = 	substr($catneme2, 0, 6);
                           echo '<li><a href="'.$catneme3.'"  class="vertical-tab">'.$catneme23.'</a></li>';
                          } 						 
						  echo '</div>';						  
					  } // if super categoires is enable
					}  								 
					else{  						
						 // loaad categorires witthout super categoire  				
						  // print categoires with order
                          foreach ($arrunq as $key => $value) {         
                            $get_customername = $mysqli->query("SELECT * FROM tcategories where cat_id  = '" . $value . "'");			  
							$row_nav_cat = $get_customername ? $get_customername->fetch_assoc() : null;
							if (!$row_nav_cat) { continue; }
							   if($current_lang=="dutch") { 	$catneme23 = $row_nav_cat['cat_name_nl'];}
								else {	$catneme23 = $row_nav_cat['cat_name_en'];  }                           
                              $catneme2 = str_replace(' ', '-', $catneme23);
                             echo '<li><a  href="#'.$catneme2.'">'.$catneme23.'</a></li>';
                          }                                
						 }	
									 
						 
						 ?>
                        </div>
				
			
  </div>
	   
	   
	  <div class="border-top-sec1">
		  <div class="table-side-ck ipad-table number" >
<div class="sidebar8888" id="sidepad">
<div class="rkfix550">
<h6><?= $yourorder_l ?> <span id="tablename"><?php echo $currentselected; ?></span></h6>
 					 
 </div>
 </div>
 </div>
		  <input type="hidden" value="<?php echo $currentselected; ?>" id="currentselected">
		  <div class="form-group col-sm-12  productrow">
			  <h2 class="pphh">Products</h2> 
			  <div id="btnContainer">
<button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>				  
  <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
  
</div>
			  
  <div class="products">
	  <?php
  // al dishes without discount
                $ordercount = [];
                $stop = 0;
                // Get man dish orders
                 $dish_order = $mysqli->query("SELECT * FROM tmenu_order");
                       while($roww_5 = $dish_order->fetch_assoc()){
                            if (isset($roww_5['do_cat_id'])) {
                                $ordercount[] = $roww_5['do_cat_id'];
                            }
                        }
                $disordertotal = count($ordercount);
                // Get menu order
                       $main_cat = $mysqli->query("SELECT *   FROM `tmenu_order`");
                         $roww = $main_cat->fetch_assoc();
                           $cat_name = $roww['cat_sort_order'];
                           $maincat=explode(',',$cat_name);      
									
                          foreach ($arrunq as $key => $value) {
                            $get_customername = $mysqli->query("SELECT * FROM tcategories where cat_id  = '" . $value . "'");
                			 $roww_cat = $get_customername->fetch_assoc();
							if (!$roww_cat) { continue; }
                       
						if ($current_lang == "en"){   $cat_name = $roww_cat['cat_name_en'];	$product_desc = $roww_cat['cat_desc_en']; } else {   $cat_name = $roww_cat['cat_name_nl']; 	$product_desc = $roww_cat['cat_desc_nl']; }		  
                $cat_name2 =    str_replace(' ', '', $cat_name);
							  
					$FileName = str_replace("'", "", $cat_name2);
							 	$FileName2 = 	substr($FileName, 0, 6);
                    echo '<li class="product-category product"  id="'.$FileName2.'">';
                ///    echo '<h3  class="sub_ca_name">'.$cat_name.' <p>'.$product_desc.'</p></h3>';                 
                 $dish_order = $mysqli->query("SELECT * FROM tmenu_order where cat_sort_order  = '" . $value . "'");  
                 $roww_3 = $dish_order->fetch_assoc();
                 $disharangs = $roww_3 ? $roww_3['do_dish_sort_order'] : '';
                $array=array_map('intval', explode(',', $disharangs));
				 $array2=array_map('intval', explode(',', $disharangs));
                $array = implode("','",$array);							
$print_dish = "SELECT  *  FROM `tdish`  WHERE `categry_id` like'" . $value . "'   ";							  
			  $query_result2 = $mysqli->query($print_dish);				  
				if ($query_result2->num_rows > 0) {      
                   $query_result = $mysqli->query($print_dish);				 
				}		
				 else{
					 /// $print_dish2 = "SELECT  *  FROM `dish`  WHERE `categry_id`  like '%" . $value . "%'"; 
					  ///$query_result = $mysqli->query($print_dish2);					 
				 }			  
							  
				 $all_varar = [];
				   $all_var_qury = "SELECT  *  FROM `tdish`  WHERE `categry_id`   like '%" . $value . "%'";    
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
                      <?php if($roww_4['dish_type']==2){ ?>    <div class="prod-descreption">							
                        <p><?php  if($current_lang=='dutch') {echo 	$roww_4['dish_desc_nl']; } else {  echo 	$roww_4['dish_desc_en'];} ?></p>					 </div><!--descript-->	<?php } ?>						
                  </div>
		
			
 <div class="addtocart_price">
 <span class="price currencySymbol"><?php echo $currency; ?><?php echo  number_format($roww_4["dish_price"], 2, ",", "."); ?></span>	 
<div class="add_to_cartbutn">
<input type="hidden" name="quantity" id="quantity<?php echo $roww_4["dish_id"]; ?>" class="form-control" value="1" />
<input type="hidden" name="hidden_name" id="name<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_name_en"]; ?>" />
<input type="hidden" name="hidden_price" id="price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_price"]; ?>" />		 <input type="hidden" name="hidden_dish_type" id="dish_type<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_type"]; ?>" /> 
<input type="hidden" name="hidden_dish_attrib" id="dish_attrib<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["dish_attrib"] ?? ''; ?>" />
<input type="hidden" name="plastc_box" id="pl_price<?php echo $roww_4["dish_id"]; ?>" value="<?php echo $roww_4["bag_charge"] ?? '0.00'; ?>" />
<a class="addbtn add_to_cart" name="add_to_cart" id="<?php echo $roww_4["dish_id"]; ?>" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
</div>    
	</div>          
        </div>
               <?php } // mai dish loop
						  }			  
	 					  
							  
               echo '</li>';
                   }   ?>
   </div>		</div>                   </div>
					
		 </div>
		  </div>
	<!--sidebar-closed-->
		  
	   </div>

	</div>
						</div>
 <!--sidebar-started-->
		  	  <div class="form-group col-sm-4 table-side-ck" >
<div class="col-md-5 pm-sidebar right" id="sidebar">
	<button type="button"  id="closecart"  style="display:none;">X</button>
					 <div class="pm-widget" id="sticky">
<h6><?= $yourorder_l ?> <span id="tablename"><?php echo $currentselected; ?></span><span class="mob_close_btn2">X</span></h6>
						 
                        <div class="widget_shopping_cart_content">
                            <!-- start product list -->  
                       
                                <div id="popover_content_wrapper" >
								 
								<div class="cart1 disblecart" id="cart1">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
								    <div class="dislive"></div>
									<div class="discountres"></div>
		 	<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
			 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
			 <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_1'])) { echo  $_SESSION['table_msg_1']; } ?></div></div>
								 
								<div class="cart2 disblecart" id="cart2">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
									<div class="dislive"></div>
									<div class="discountres"></div>
								<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
										 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
			 					<div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_2'])) { echo  $_SESSION['table_msg_2']; } ?></div></div>
								 
									<div class="cart3 disblecart" id="cart3">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
									 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
				 <div class="display-content">
                                       <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_3'])) { echo  $_SESSION['table_msg_3']; } ?></div></div><!--.display-content-->
									</div>	
									<div class="cart4 disblecart" id="cart4">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
											 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
								 <div class="display-content">
                                        <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_4'])) { echo  $_SESSION['table_msg_4']; } ?></div></div><!--.display-content-->
									</div>
									<div class="cart5 disblecart" id="cart5">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
									 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
									 <div class="display-content">
                                       <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_5'])) { echo  $_SESSION['table_msg_5']; } ?></div></div><!--.display-content-->
									</div>	
									<div class="cart6 disblecart" id="cart6">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										<div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
									 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
	 <div class="display-content">
                                         <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_6'])) { echo  $_SESSION['table_msg_6']; } ?></div></div><!--.display-content-->
									</div>	
									<div class="cart7 disblecart" id="cart7">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
									<div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
	 <div class="display-content">
                                         <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_7'])) { echo  $_SESSION['table_msg_7']; } ?></div></div><!--.display-content-->
									</div>	
									<div class="cart8 disblecart" id="cart8">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
									<div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
	 <div class="display-content">
                                               <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_8'])) { echo  $_SESSION['table_msg_8']; } ?></div></div><!--.display-content-->
									</div>
									<div class="cart9 disblecart" id="cart9">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>
									<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>	 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
										
 <div class="display-content">
                       <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_9'])) { echo  $_SESSION['table_msg_9']; } ?></div></div><!--.display-content-->
									</div>	
									<div class="cart10 disblecart" id="cart10">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
	 	<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
		 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
									  <div class="display-content">
                                        <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_10'])) { echo  $_SESSION['table_msg_10']; } ?></div></div><!--.display-content-->
									</div>	
							<div class="cart11 disblecart" id="cart11">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
 	<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>
	 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
									  <div class="display-content">
                                        <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_11'])) { echo  $_SESSION['table_msg_11']; } ?></div></div><!--.display-content-->
									</div>
							<div class="cart12 disblecart" id="cart12">
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
										 <div class="dislive"></div>
									<div class="discountres"></div>	
		                               	<div class="removdis"  style="display:none;">Remove discount: <div class="discountremove" >X</div></div>	 <div class="text_totalamount"><div class="table-discount"><a  class="discoutid">Discount</a></div></div>
									  <div class="display-content">
                                        <div class="message-wrap dn"><?php  if(isset($_SESSION['table_msg_12'])) { echo  $_SESSION['table_msg_12']; } ?></div></div><!--.display-content-->
									</div>
                                   
					
        
									<div class="custom-sec"  style="display:none">
										<div class="msg-part">
							               <form  method="post" name="form" action="">	
                                             <textarea name="message" class="form-control" id="message"></textarea>                    
                                             <button type="button" class="btn btn-success" id="save">Save</button>					
										   </form>											
							            </div>
									</div>
						<div class="buttons111">
								  <div class="col-md-6" style="margin-bottom: 10px;">
 <button type="button" id="Reciept" class="btn btn-social-icon btn-warning" value="Reciept"><i class="fa fa-comment"></i></button>
	<!--  <button type="button" id="editmsg" class="btn btn-social-icon btn-warning" value="editmsg"><i class="fa fa-pencil-square-o"></i></button>-->
								  </div>
								  <div class="col-md-6 txt-right" style="margin-bottom: 10px; text-align: right;">
									  <!--<a href="tprintoption.php?dataid='.$row['id'].'" class="btn btn-social-icon btn-warning"><i class="fa fa-print"></i></a> -->
									<button type="button" id="printorder" class="btn btn-social-icon btn-warning" value="Reciept"><i class="fa fa-print"></i></button>		
								  </div> </div>
								</div>
										
                                    <div id="popover_content_wrapper" >
								 
                                    <span id="cart_details"></span>
									<div id="cantacloj"></div>
									     <label class="pop9652" for="postcode name"><h4>Payment Option</h4> </label>
                                         <input type="radio" id="cod" name="paymenttype" checked value="cash">Cash
                                         <input type="radio" id="pin" name="paymenttype" value="pin" >Pin	
			                             <input type="radio" id="card" name="paymenttype" value="card" >Card
										
                                    <div  class="order-row">										
									<p id="close_postcode" class="close_postcode reset">reset</p>										
   								     <input type="hidden" name="ppfr" id="total_pricejyo" value="€0.00">	
									<button type="button" name="button" id="submitbutton" class="submitbutton btn btn-primary">checkout</button>
                                    </div>									
                                </div>									
                               </div>
                            </div>
							
                            <!-- end product list -->
                           <div id="discount_msg"></div>
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
<div class="customdish rkcust66" id="customdishpop"  style="display:none;">
	<div class="customdiscon">
		<h3>Enter Product Name</h3>
		
		<button id="closedisc"  type="button">X</button>
	
	
	<div class="lists">

<li class="product-category table-cat product"  id="customprodiv">
	<div class="product_cart table-cart">
						 <div class="product_detailss pro-box">
                     				<input type="text"  id="cdishname" placeholder="Dish Name">
			<input type="text"  id="cdishprice" placeholder="Dish Price">				
                    </div>
                     <div class="addtocart_price table-price">
                       <!--<span class="price"><span class="amount"><span class="currencySymbol">€</span>80.50</span></span>--> 
                       <div class="add_to_cartbutn">
                       <input type="hidden" name="quantity" id="quantity555" class="form-control quantitycus" value="1">
             <input type="hidden" name="hidden_name" class="cusname" id="name555" value="">
             <input type="hidden" name="hidden_price" class="cusprice" id="price555" value="">
             <input type="hidden" name="hidden_dish_type" id="dish_type555" value="1">    
             <input type="hidden" name="hidden_dish_attrib" id="dish_attrib555" value="">    
<a class="add_to_cart" name="add_to_cart" id="555" href="javascript:void(0)"><i class="fa fa-plus"></i></a> </div>
                    </div>  
                 </div></li></div>
	
	</div><!--custom - shop -->
</div>	
		
<div class="discoutpop" id="discountpop"  style="display:none;">
	<div class="discon">
		<h3>Enter discount values (in % or fixed amount)</h3>
		<div class="disinputs"><input type="text"  id="disamt" placeholder="Percentage Discount">
		<input type="text"  id="fixamt" placeholder="Fixed Discount">	
		<button id="fixeddis"  type="button">Apply Discount</button>
		<button id="closedis"  type="button">X</button></div>
	</div>
		</div>		
		
<input type="hidden" value="0" id="cartimpty1">
<input type="hidden" value="0" id="cartimpty2">
<input type="hidden" value="0" id="cartimpty3">
<input type="hidden" value="0" id="cartimpty4">
<input type="hidden" value="0" id="cartimpty5">
<input type="hidden" value="0" id="cartimpty6">
<input type="hidden" value="0" id="cartimpty7">
<input type="hidden" value="0" id="cartimpty8">
<input type="hidden" value="0" id="cartimpty9">
<input type="hidden" value="0" id="cartimpty10">
<input type="hidden" value="0" id="cartimpty11">
<input type="hidden" value="0" id="cartimpty12">


<input type="hidden" value="555" id="randomcode">
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
		

            <!--// main content -->
 
			<style>.oo_notshow{display:none;}</style>
			<script>

$(document).ready(function(){
  $("#discount").keyup(function(){
  var discount = $('#discount').val();
  var action = "addtokart";
  var current_lang = $('#current_lang').val();
  $.ajax({
           url: "table_action.php",
           method: "POST",
           data: {discount: discount, action: action},
                            success: function (data)
                            {
								//var discountnew = "You receive ". concat(discount) . concat("% Discount. It is calculated on the checkout page.");
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
  });
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
                
    $(document).on('click','.mob_close_btn',function(){
        $('#sidebar1').removeClass("dish_cat_icon_y");
    });
    $(document).on('click','.mob_close_btn2',function(){
        $('#sidebar').removeClass("cart_icon_y");
    });
                
   
      
                $('#cart-popover').popover({
                    html: true,
                    container: 'body',
                    content: function () {
                        return $('#popover_content_wrapper').html();
                    }
                });


 
//Fetch Shopping Cart Details
                load_cart_data();
				
                function load_cart_data()
                {
					 
					var currentselected = $('#currentselected').val();
					var action = "loadcartdata";
                    $.ajax({
                        url: "table_action.php",
                        method: "POST",
                        data: {action: action,
							 'currentselected' : currentselected, },
                        dataType: "json",
                        success: function (data){				        	
						 console.log(data);
						      $('#total_pricejyo').val(data.total_price1);                            
                            $('.cart'+currentselected+'  .discountres').css({"opacity": "1", "height": "auto"});
                            $('.cart'+currentselected+'  .discountres').html(data.afterdis);
                            $('.cart'+currentselected+' #cart_details').html(data.cart_details);  
							$('.cart'+currentselected+' .message-wrap').html(data.message); 
							$('.cart'+currentselected+' .message-wrap').html(data.message); 
                          
 								 $('.cartnum').fadeOut(0); 
    							 $('.cartnum'+currentselected).fadeIn();
								 $('.cartnum'+currentselected).html('');
								 $('.cartnum'+currentselected).html(data.total_item);	
                        },
                         complete: function (data) {
                          
							var col_l=$('.products li h3').css( "background-color");
							$(".cart_icon").css("background-color", col_l).fadeIn(100);   
     						setTimeout(function(){
      							$(".cart_icon").css("background-color", "#333").fadeIn(100);
    						},500); 
                        }
                    });
						var currentselected = $('#currentselected').val();
						 $('.table-list li.table'+currentselected).trigger('click');		
                }

                function finalcostforsingleitem(selected_attri_cost, product_price) {
                  var tc = parseFloat(selected_attri_cost) + parseFloat(product_price);
                    return tc;
                  }
				
				
                $(document).on('click', '.add_to_cart', function () {
					
					
					var currentselected = $('#currentselected').val();
					
					if(currentselected==''){
						return false;
					}
					
					  var prodes = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').parent('.product-category.product').find('.sub_ca_name p').html();
	   
        var prodes_id = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').parent('.product-category.product').find('.sub_ca_name').attr('id');
        
                    if(prodes_id=='menu'){
                        var prodes = $(this).parent('.add_to_cartbutn').parent('.addtocart_price').parent('.product_cart').find('.prod-descreption').find('.clr').html();
                    }
					
					
						
                    var product_id = $(this).attr("id");
                  ///  var discount = $('#discount').val();
				
				///	var discounttype = $("input[name='discounttype']:checked").val();
					///var pick_or_del = $("input[name='pick_or_del']:checked").val();
                    var product_type = $('#dish_type' + product_id).val();
                    var product_attrib = $('#dish_attrib' + product_id).val();
                    var product_name = $('#name' + product_id + '').val();
                    var product_price = $('#price' + product_id + '').val();
                  
                    var product_quantity = $('#quantity' + product_id).val();
                    $("#current_productprice").val('');
                    $("#current_productname").val('');
                    $("#current_productid").val('');
                    $("#current_productprice").val(product_price);
                    $("#current_productname").val(product_name);
                    $("#current_productid").val(product_id);
                    if (product_type == "2") {
					 
						
                        url = b_url1 + 'admin/table_action.php';  //console.log(url);return false;
                        var action = "dish_attrib_popup";
                        var current_lang = $('#current_lang').val();
						 $('#quantity').val('1');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                action: action,currentselected:currentselected, product_id: product_id, current_lang: current_lang,product_attrib:product_attrib,
                            },
                            dataType: "html",
                            success: function (data1)
                            {
								console.log(data1);
							   $("#pc_form2").html(data1);
                               $('#myModalNew1').modal('show');
                                
                          $('#myModalNew1').find('.maintitle h4').html(product_name);
                          $('#myModalNew1').find('.pricepop span').html('€ '+product_price);
                          $('#myModalNew1').find('.pricedish').val(product_price);
                          $('#myModalNew1').find('.pro_pop_info').html(prodes);
						 $('#myModalNew1').find('.pro_pop_info').html(prodes);		
						 
								
								
                                var totalcostnow=0;
                                totalcostnow=product_price;
                                
                                  $('#tcfs33').val(parseFloat(totalcostnow).toFixed(2));
                                  var sum1 = parseFloat(totalcostnow).toFixed(2);
                                  var sum2 = sum1.toString().replace(/\./g, ',');
                                $('#tcfs').html('€'+sum2);
                                $('#tcfsbase').val(parseFloat(totalcostnow).toFixed(2));
                    			  $('#myModalNew1').find('.variable_prices').val(product_price);
								$('.warchoose').fadeOut(100);
									$('#customdishpop').fadeOut(100);
                            },
                       });
                    } else {
                        final_addtocart(currentselected,product_id, product_name, product_price, product_quantity);
				$('#customdishpop').fadeOut(100);
                    }
					//$('.discountres').fadeOut(100);
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
				
                $(document).on('click', '#attrib_add_to_cart', function () {
                    var product_name = $("#current_productname").val();
					var currentselected = $('#currentselected').val();
					
					var discount = $('#discount').val();
					var discounttype = $("input[name='discounttype']:checked").val();
					
                    var product_name_str=product_name;               
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
                    var singleitemcost_ic = $("#tcfs33").val();
                    var product_quantity = $("#quantity").val();
					
                    var product_price12 = $('#current_productprice').val();
					var product_price = singleitemcost_ic;
					var product_price11 = $('#price' + product_id + '').val();
				
                    final_addtocart(currentselected,product_id, product_name, product_price, product_quantity);
			 
                });
				
		
			$(document).on('click', '.updateminusqty', function () {
					var currentselected = $('#currentselected').val();
	               var product_id = $(this).attr("id");
						
                   var check_crrent_quty=  $(this).parent().find('.check_crrent_quty').val();
                    var current_lang = $('#current_lang').val();
                    var action = 'updateminusqty';
                         $.ajax({
                            url: "table_action.php",
                            method: "POST",
                            data: {
								product_id: product_id, 
								action: action,  check_crrent_quty:check_crrent_quty,
						 'currentselected' : currentselected,
							},
                               success: function ()
                            {
								$('.cart'+currentselected+' .removdis').html('');  
                               load_cart_data();
                            }
                        });
                });	
				
$(document).on('click', '.updateqty', function () {
				//$('.updateqty').live('click', function() {
	
	var currentselected = $('#currentselected').val();
	 
	               var product_id = $(this).attr("id");
						
                  var check_crrent_quty=  $(this).parent().find('.check_crrent_quty').val();
                    var current_lang = $('#current_lang').val();
                    var action = 'updateqty';
                         $.ajax({
                            url: "table_action.php",
                            method: "POST",
                            data: {
								product_id: product_id, 
								action: action, check_crrent_quty:check_crrent_quty,
						 'currentselected' : currentselected,
							},
                               success: function ()
                            {
							$('.cart'+currentselected+' .removdis').html('');  
                                load_cart_data();
                            }
                        });
                });	

												
																		
												
//Remove Item from cart
                $(document).on('click', '.delete', function () {
					var currentselected = $('#currentselected').val();
                    var product_id = $(this).attr("id");
                    var current_lang = $('#current_lang').val();
                    var action = 'remove';
                    var delmsg_lok='';
                   // if(current_lang=="en"){
						//delmsg_lok="Are you sure you want to remove this product?";}else{delmsg_lok="Weet u zeker dat u dit product wilt verwijderen?"}
                    
                   // if (confirm(delmsg_lok))
                   // {
                        $.ajax({
                            url: "table_action.php",
                            method: "POST",
                            data: {product_id: product_id, action: action,currentselected:currentselected},
                            success: function ()
                            {
							 
                                load_cart_data();
                                $('#cart-popover').popover('hide');
                               // if (current_lang == "en") {
                                 //   alert("Item has been removed from Cart");
                               // } else {
                               //     alert("Item is verwijderd uit winkelwagen");
                              //  }
								$('li.table'+currentselected).removeClass('activetable2');
								  

                            }
                        })
                 //   } else
                   // {
                   //     return false;
                   // }
                });

                $(document).on('click', '#clear_cart', function () {
                    var action = 'empty';
                    var current_lang = $('#current_lang').val();
                    var currency =
                            $.ajax({
                                url: "table_action.php",
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
  function final_addtocart(currentselected,product_id, product_name, product_price, product_quantity) {
	 
                    var action = "addtokart";
                    var current_lang = $('#current_lang').val();
	  				//var currentselected = $('#currentselected').val();
                    if (product_quantity > 0 ){
						 
						if(product_price != ""){						 
                        $.ajax({
                            url: "table_action.php",
                            method: "POST",
                            data: {currentselected:currentselected, product_id: product_id, product_name: product_name, product_price: product_price, product_quantity: product_quantity,action: action},
                            success: function (data)
                            {
							///	console.log(data);
							 
                           load_cart_data();
                                if (current_lang == "en") {
                                    $('#myModalNew1').modal('hide');
                                } else {
                                    $('#myModalNew1').modal('hide');
                                }
								 $('li.table'+currentselected).addClass('activetable2');
								$('#cdishname').val('');
								$('#cdishprice').val('');
						
								 $('#customprodiv  .add_to_cart').attr("id","");
									$('.cusname').attr('id',   'name' + '');
								   $('.customdiscon .quantitycus').attr('id',   'quantity' + '');
								  $('.customdiscon .cusprice').attr('id',   'price' + '');
 								 
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
 

               /// var chk_postcode = document.getElementById("chk_postcode");
               /// chk_postcode.addEventListener("keydown", function (e) {
					
                  ///  if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                     ///   $("#pc_suit").click();
                 ///   }
               /// });
				
           $('.dropdown').click(function (e) {
                    $(this).toggleClass('open');
                });
 


 }); 
			
$(document).keypress(function(e) {
  if ($("#myModal").hasClass('in') && (e.keycode == 13 || e.which == 13)) {
    $("#popup1btn").click();
  }
});
    </script>

            <?php include 'footer.php'; ?>
         <script>
		jQuery('.vertical-tab').on('click', function(e) {
			  e.preventDefault();  
			  var attr = $(this).attr('href');  
			 //replace all single quotes
				var myStr = attr.replace(/'/g, '');
			/// console.log(myStr);
			  // Make the correct tab active, and mark all other tabs as non-active.
			  jQuery(this).addClass('is-active').siblings().removeClass('is-active');  
			  // Make the right content visible, hide all other content.
			 ///  jQuery(myStr).show().siblings().hide();
			///console.log(attr);
		 jQuery("#"+attr).show().siblings().hide();
			});	 

$(document).on('click', '.table-list li', function () {
	var thiss = $(this);
	var clicktable =  $(thiss).find('.table-number').val();
	
	var currentval = $('#currentselected').val();
	var functioncall = 0;
		$('#currentselected').val(clicktable);

	  $('.table-list li').removeClass('activetable');
	$(thiss).addClass('activetable');
					var action = "loadcartdata2";
                    $.ajax({
                        url: "table_action.php",
                        method: "POST",
                        data: {action: action,
							 'currentselected' : clicktable,functioncall:functioncall },
                        dataType: "json",
                        success: function (data)
                        {
							 console.log(data);
							
						  $('.cart'+clicktable+' #cart_details').html('');
						  $('.cart'+clicktable+' #cart_details').html(data.cart_details);
                          $('.cart'+clicktable+'  .discountres').css({"opacity": "1", "height": "auto"});
                          $('.cart'+clicktable+'  .discountres').html(data.afterdis);
							$('.cart'+clicktable+' .message-wrap').html(data.message); 
							if(data.checkemptynot==1) {   $('li.table'+clicktable).addClass('activetable2');}
							else {   $('li.table'+clicktable).removeClass('activetable2');}
			
								 $('.cartnum').fadeOut(0); 
    							 $('.cartnum'+clicktable).fadeIn();
								 $('.cartnum'+clicktable).html('');
								 $('.cartnum'+clicktable).html(data.total_item);

						if(data.discounton==1) {  
							$('.cart'+clicktable+'  .text_totalamount').fadeOut(0);
							$('.cart'+clicktable+'  .removdis').fadeIn(0);
						}
							else{
									$('.cart'+clicktable+'  .text_totalamount').fadeIn(0);
							       $('.cart'+clicktable+'  .removdis').fadeOut(0);
							}
								 
					 } 
							 
	});
	
				var currentval = $('#currentselected').val();
	            $('#sidepad span#tablename').html('');
			 $('#sidepad span#tablename').html(currentval);	
	 			
	          $('#sidebar span#tablename').html('');
			 $('#sidebar span#tablename').html(currentval);	
	
$('.pro-cat-sec').fadeIn(100);
	$('.disblecart').fadeOut(100);
	$('#cart'+clicktable).fadeIn();
	
 
		 
});	
 $(document).on('click', '.cusdishid', function () {	
		  		$('#customdishpop').fadeIn(100);
		var radomid = Math.floor((Math.random() * 1000) + 1);
	$('#randomcode').val(radomid);
	$('#customprodiv').fadeIn(100);
		   });
	
			// Add discount 
  $(document).on('click', '#closedisc', function () {	
		  		$('#customdishpop').fadeOut(100);
		   });			 
				
  $(document).on('click', '.discoutid', function () {	
		  		$('#discountpop').fadeIn(100);
		   });
	
			// Add discount 
  $(document).on('click', '#closedis', function () {	
		  		$('#discountpop').fadeOut(100);
		   });			 
				//$("#fixeddis").live("click", function(){
			         $(document).on('click', '#fixeddis', function () {
					    var action = "adddiscount";
                        var discountamt = $('#disamt').val();
					    var discountffix = $('#fixamt').val();
					      if(discountamt=='' && discountffix==''){
					   			alert('Fill  1');
						   return false;
					   }
					    if(discountamt!= '' && discountffix!= ''){
							alert('Fill  only 1');
							return false;
						}

					    var currentselected = $('#currentselected').val();
					               $.ajax({
                                url: "table_action.php",
                                method: "POST",
							   dataType: "json",
                               data: {discountamt:discountamt,discountffix:discountffix,action: action,currentselected:currentselected},
                                success: function (data)
                                {
			//console.log(data.discounthtml);
									 $('.cart'+currentselected+' .discountres').html('');	
                                       $('#afterdiscount').val(data.priceafterdiscount);	                                       
                                       $('#discountprice').val(data.discountamt);	
                                     $('.cart'+currentselected+' .discountres').html(data.discounthtml);									
									 $('.cart'+currentselected+'  .discountres').css({"opacity": "1", "height": "auto"});
								     $('.cart'+currentselected+' #cantacloj').fadeOut();
                                   $('#discountpop').fadeOut(100);
									$('#disamt').val('');
									$('#fixamt').val('');
									 $('.text_totalamount').fadeOut(100);
									 $('.removdis').fadeIn(100);
                                }
                            });
                });		

			 
$(document).on('click', '.discountremove', function () {
 
				var currentval = $('#currentselected').val();
                    url = 'table_action.php';  //console.log(url);return false;
                    var action = 'removediscount';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
							  'currentselected' : currentval,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
							
							  
						 	$('.cart'+currentval+' .total_price').text('');
							$('.cart'+currentval+' .dislive').html(''); 
						 	$('.cart'+currentval+' #cantacloj').html('');
						    $('.cart'+currentval+' .dislive').html('');
                      	    $('.cart'+currentval+' #cantacloj').fadeIn(100);
							$('.cart'+currentval+' #cantacloj').html(data1);
 							$('.cart'+currentval+'  .disc-inforhide').fadeOut(100);;
   						    $('.cart'+currentval+' .removdis').fadeOut(100); 
						    $('.cart'+currentval+' .text_totalamount').fadeIn(100);
                        }
                    });

                });
</script>
<script>
	 $(document).ready(function() {
        $('#Reciept').click(function() {
                $('.custom-sec').slideToggle("fast");
        });
    });
</script>
<script>
$(document).ready(function(){
    $("#save").click(function(){
        //$(".custom-sec").addClass("dvh");
	 
        
    });
});
</script>		
<script>
	
            $(document).on("click", "#save", function () {
				$('.custom-sec').fadeIn(100);
					var currentval = $('#currentselected').val();
                var message = $('#message').val();
                          if (message == "") {
                    $("#error_message").html("Please enter message");
                    return false;
                } else {
                    $("#error_message").html("");
                }
				
                $.ajax({
                    type: "POST",
                    url: "comment_action.php",
                    data: {message: message,currentval:currentval},
                   // cache: false,
                    success: function (data) {
						console.log(data);
						$('.cart'+currentval+' .message-wrap').html(data);
                      ///  $("#message").val("");
						$('.custom-sec').fadeOut(100);
                    }
                });
            });
        </script>
<script>	
	/* Reset cart */
$(document).on('click', '#close_postcode', function () {
				var currentval = $('#currentselected').val();
                    url = 'table_action.php';  //console.log(url);return false;
                    var action = 'removepostcode';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
							  'currentselected' : currentval,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
							 $('.cart'+currentval+' #cart_details').html('');
							 $('.cart'+currentval+' .total_price').text('');
							$('.cart'+currentval+' .dislive').html(''); 
							 $('.cart'+currentval+' #cantacloj').html('');
						   $('.cart'+currentval+' .discountres').html('');
                      	  $('li.table'+currentval).removeClass('activetable2');
								  $('li.table'+currentval).removeClass('activetable');
							 $('.cart'+currentval+' .removdis').fadeOut(100);
							 $('.cart'+currentval+' .message-wrap').html('');
							
                        }
                    });

                });
//  Order Checkoit	
 $(document).on('click', '#submitbutton', function () {
				var currentval = $('#currentselected').val();
			 var paymentmethod = $('input[name="paymenttype"]:checked').val();
	 
                    url = 'table_action.php';  //console.log(url);return false;
                    var action = 'saveorder';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
							  'currentselected' : currentval,
							'paymentmethod':paymentmethod,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
						  console.log(data1);
						  $('.cart'+currentval+' #cart_details').html('');
						  $('.cart'+currentval+' .total_price').text('');
						  $('.cart'+currentval+' .dislive').html(''); 
						  $('.cart'+currentval+' .discountres').html('');
						  $('.cart'+currentval+' #cantacloj').html('');
						  $('.cart'+currentval+' .dislive').html('');
						  $('.cart'+currentval+' .message-wrap').html('');
                      	  $('li.table'+currentval).removeClass('activetable2');
						  $('li.table'+currentval).removeClass('activetable');
						  $('.cart'+currentval+' .removdis').fadeOut(100);
			 
                        }
                    });

                });	
	 
	$(document).on('click', '#printorder', function () {
				var currentval = $('#currentselected').val();
                  var url = 'table_action.php';  //console.log(url);return false;
                    var action = 'tableorder_print';
	  $.ajax({
                        type: "POST",
  				 
                        url: url,
                        data: {
                            action: action,
							  'currentselected' : currentval,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
						 
							    printWindow = window.open('');
								printWindow.document.write(data1);
								printWindow.print();
				 
                        }
                    }); 

                });
	
// Edit MSG
	 $(document).on('click', '.mob_close_btn2', function () {
			 $('#sidebar').fadeOut(100);
		 $('#sidebar').removeClass('opencart');
   });	
	 $(document).on('click', '#opencartt', function () {
			$('#sidebar').addClass('opencart');
   });	
	 $(document).on('click', '#editmsg', function () {
				var currentval = $('#currentselected').val();
			 var curremtmsg = $('.cart'+currentval+' .message-wrap.dn').html();
		  var trimStr = $.trim(curremtmsg);
	 
       $('#message').val(trimStr);
		 $('.row.custom-sec').slideDown(100);
   });

</script>
<script>
jQuery(document).ready(function(){
  // Show the first tab and hide the rest
$('.main_category-table li:first-child').addClass('active');
$('.product-category').hide();
$('.product-category:first').show();

// Click function
$('.main_category-table li').click(function(){
  $('.main_category-table li').removeClass('active');
  $(this).addClass('active');
  $('.product-category').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
//** custom product add

	  $("#cdishname").on("keyup", function() {
		 radomid = $('#randomcode').val();
    var value = $(this).val();
		   $('.cusname').val(value);
		    $('.cusname').attr('id',   'name' + '' + radomid);
		   $('.customdiscon .add_to_cart').attr('id', radomid);
		   $('.customdiscon .quantitycus').attr('id',   'quantity' + '' + radomid);
    
  });
   	  $("#cdishprice").on("keyup", function() {
		    radomid = $('#randomcode').val();
    var value = $(this).val();
		   $('.cusprice').val(value);
		    $('.cusprice').attr('id',   'price' + '' + radomid);
		   
    
  });	
	
$("#navbar__searchField").on("keyup", function() {
				  var value = $('#navbar__searchField').val();
	
				if(value!=''){
				$('#emptyserch').fadeIn(100);	
//.toLowerCase();
                  var url = 'table_action.php';  //console.log(url);return false;
                    var action = 'search_and_ad';
	  $.ajax({
                        type: "POST",
  				 
                        url: url,
                        data: {
                            action: action,
							  'valuesearch' : value,
                        },
                        dataType: "html",
                        success: function (data1)
                        {
						 
							 //console.log(data1);
							$('.navbar__search .lists').empty();
							
				 		$('.navbar__search .lists').append(data1);
							
                        }
		  
                    });
				}else{
				$('.lists').empty();
				}

                });
	$("#emptyserch").on("click", function() {
		$('.lists').empty();
		  $('#navbar__searchField').val('');
		$(this).fadeOut(100);
	});	

});		
</script>
<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.Color = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.Color = color;
}

// Get the element with id="defaultOpen" and click on it
///document.getElementById("defaultOpen").click();
</script>
<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("product_cart");

// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "47%";
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
<script>
$("a.vertical-tab").click(function(){
      $("a.vertical-tab").css("background-color", "#333");
    $(this).css("background-color", "#3c8dbc");
});	
</script>	
<script>
	/**
 * Clearable text inputs
 */
$(".clearable").each(function() {
  
  const $inp = $(this).find("input:search"),
      $cle = $(this).find(".clearable__clear");

  $inp.on("input", function(){
    $cle.toggle(!!this.value);
  });
  
  $cle.on("touchstart click", function(e) {
    e.preventDefault();
    $inp.val("").trigger("input");
  });
  
});
</script>
<script>
	$(document).ready(function () {
  //called when key is pressed in textbox
  $("#cdishprice").keypress(function (e) {if (e.which == 44   || e.which == 46   ||  (e.which > 47 &&  e.which <= 58) ) {
    }
	  else{
		     return false;
	  }
   });
		
	  $(".disinputs input").keypress(function (e) {if (e.which == 44   || e.which == 46   ||  (e.which > 47 &&  e.which <= 58) ) {
    }
	  else{
		     return false;
	  }
   });
		
setInterval(function(){
  checktimelimit()
    	 },4500); 	
var tablearr = ["1","2","3","4","5","6","7","8","9","10","11","12"];	
	
var checkorders = [];  
function checktimelimit(){
       var action = "checkbooked_tables";
             $.ajax({
                    url: "table_action.php",
                    type: "POST",
                    data: {action: action,
						},   
				  dataType: "json",
                    success: function (data){
						  checkorders = data.booked;
						 $('.table-list li').removeClass('activetable2');
						/// $('.table-list li').removeClass('activetable');
						 for (let i = 0; i < tablearr.length; i++) {     
							 if(checkorders.includes(tablearr[i])) {
								 
								 $('li.table'+tablearr[i]).addClass('activetable2');
							    $('li.table'+tablearr[i]).addClass('activetable');
							 }
							 else{	  }
						 }
                    }  
                });
}			
		
		
	   $(document).on('click','.dropdown-btn',function(){
	    $('.dropdown-container').slideUp(100);
		  $(this).next().slideDown(100);
		 
	 });	
		
		
});
</script>	

	

    </body>
</html>
