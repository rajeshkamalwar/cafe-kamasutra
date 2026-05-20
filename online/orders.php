<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:online-order.php");
} else {
include 'admin/db.php';
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
$current_lang = $_SESSION['current_lang'];
?>
<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	   <meta http-equiv="refresh" content="1200;url=fresh1.php" />
		<title> Online Order </title>
		<script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="jquery.redirect.js"></script>
		<style>
             .form-group {
             margin-bottom: 10px !important;
               }
         </style>
    </head>
    <body class="checkout_page2">
    <?php include 'public_header.php'; 
		if($current_lang=='dutch'){
			$ypuroredr = 'Uw bestelling';
			$deliveryee = 'Bezorgen';
  			 $pickupee = 'Afhalen';
			$or_paymethod = "Betaaldmethode:";
			 $or_total = "Totaal:";
			$viewdetails = "Details Bekijken";
			$reorder = "Opnieuw bestellen";
			$pickup = "afhalen";
			$deiveryup =  "bezorgen";
			$DeliveryInformationSection = "Bezorg Informatie";
                    $DeliveryToday = "Bezorging Time";
                    $serve_till = "wij bezorgen tot met ";
                    $pick_till = "U kunt ophalen tot";
                    $serve_from = "We zullen opnieuw leveren ";
                    $close4theday = "Wij zijn op dit moment gesloten.";
                    $weekoff = "We zijn vandaag gesloten.";
                    $serve_start_from = "Wij zullen dienen van";
			$Deliveryprefer="Wilt u laten bezorgen of zelf afhalen ?";

		} else { 
			$ypuroredr = 'Your Orders';
			$deliveryee = 'Delivery';
    		$pickupee = 'Pickup';
			$or_paymethod = "Payment Method:";
			 $or_total = "Total:";
			 $viewdetails = "View Details";
			$reorder = "Reorder";
			$pickup = "Pick up";
			$deiveryup =  "delivery";
			$Deliveryprefer="Would you like to delivered or pick it up yourself ?";

		}		
		?> 
        <div class="container checkoutpage rkgfi5 orders22">
            <?php
include 'css_file.php'; ?>
            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/newonline'; ?>';
               currency = '€ ';
                current_lang = '<?php echo $current_lang; ?>';
               /// cop_cart_details_js = '';
            </script>
			<h2><?php echo $ypuroredr ;?></h2>
                   <div class="row">					   
                        <div class="col-md-12 table-main555444">
							<?php 
							$cno = 0;
							$queryorder = $mysqli->query("select * from tbl_orders where regisid = '".$_SESSION['username']."' ORDER BY norderid DESC ");
 
								  while($roworders = $queryorder->fetch_array()){
 $addbutton = '<a class="pinbtn gfgfhhf" class="ordermodal" href="#myModalNew'.$roworders['ot_id'].'" data-target="#myModalNew'.$roworders['ot_id'].'" data-toggle="modal"> '.$reorder.' </a>';							
								$cno++;
									  $data111 = $roworders['ot_OrderDate'];
									  if($roworders['ot_pick_del'] == 'delivery' || $roworders['ot_pick_del'] == 'both'){
										  $ot_pick_del = $deliveryee;
									  }
                                      else{
										  $ot_pick_del = $pickupee;
									  }
									  if ($roworders['ot_paymentoption'] == 'COD'){
    $ot_paymentoption = 'CASH';
}
elseif ($roworders['ot_paymentoption'] == 'creditcard'){
    $ot_paymentoption = 'Master Card';
}
elseif ($roworders['ot_paymentoption'] == 'paypalec'){
    $ot_paymentoption = 'Paypal';
}
else{
    $ot_paymentoption = $roworders['ot_paymentoption'];
}
 setlocale(LC_ALL, 'nl_NL');
$aa = $roworders['ot_TotalAmount'];
							?> 
							<table class="container orderstable orderstable-info">
								<tr>
								<td><a data-toggle="collapse" data-target="#demo<?php echo $cno; ?>" class="accordion-toggle hendmouse">#<?php echo $roworders['ot_id'];?></a> | <?php echo date_format(new DateTime($data111), "M d, Y"); ?> |  <?php echo date_format(new DateTime($roworders["ot_time"]), "H:i");?></td>
									<td><?php echo $or_paymethod;?> <?php echo $ot_paymentoption;?></td>
									<td><?php echo $ot_pick_del;?></td>
									<td><?php echo $or_total;?> €<?php echo  number_format($aa, 2, ",", ".");?></td>
									<td>
										<?php if(!isset($_SESSION['current_pick'])){
								 echo $addbutton; 
							} else {
								if($_SESSION['current_pick']=='both'){?>
										<?php echo $addbutton; ?>
										<?php } else { ?>
										<a class="ordermodal" href="reorder.php?otid=<?php echo $roworders['ot_id'];?> "><?php echo $reorder;?></a>
			<?php } } ?>					
								</td>
									<td data-toggle="collapse" data-target="#demo<?php echo $cno; ?>" class="accordion-toggle hendmouse" ><a class="viewdeatils"><?php echo $viewdetails;?></a></td>
								</tr>
								 <tr class="detailstab">            
                <td colspan="6" class="hiddenRow">
                    <div class="accordian-body collapse" id="demo<?php echo $cno; ?>"   style="height:0;overflow:hidden;">
						<?php echo $roworders['alldata'];?>
					</div>
					</td>
									</tr>
							</table>
							<div id="myModalNew<?php echo $roworders['ot_id'];?>" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
					<?php  if (isset($_SESSION['res_close']) && $_SESSION['res_close']==1){ ?>
							  <div class="modal-body">
								  <p>Closed</p>
								  <button type="button" class="close" data-dismiss="modal" id="myModalNew<?php echo $roworders['ot_id'];?>" aria-hidden="true">×</button>
								</div>
							<?php }
						else{
						?>	
                        <div class="modal-body">
							<?php if (isset($_SESSION['res_msg'])){ echo $_SESSION['res_msg'];  } ?>	
                            <p class="popupheading"><?= $Deliveryprefer; ?><button type="button" class="close" data-dismiss="modal" id="modal2" aria-hidden="true">×</button></p>
                            <?php if(isset($_SESSION['curntpostcode'])){ ?>
							<a href="https://restaurantkamasutra.nl/online/setorderpick.php?action=delivery&otid=<?php echo $roworders['ot_id'];?>" class="btn btn-primary" id="select_en_delivery" data-id="deiveryup"><?php echo $deiveryup; ?> </a>
							<?php } else {?>
							<button onclick="myFunction12()" class="btn btn-primary"><?php echo $deiveryup; $_SESSION['curntpostcode'];?></button>
							<?php } ?>
							<a href="https://restaurantkamasutra.nl/online/setorderpick.php?action=pickup&otid=<?php echo $roworders['ot_id'];?>" class="btn btn-primary" id="select_en_delivery" data-id="pickup"><?php echo $pickup; ?> </a>

							<div id="myDIV" <?php if($_SESSION['current_pick']!="delivery"){ ?>style="display:none;" <?php } ?> >		</br>								
	<p><?= $PostcodePopupP1; ?><?php //popup1($mysqli, $current_lang);                                                ?></p>
                            <form method="post" id="pc_form" name="pc_form">
                                <input type="text" id="chk_postcode" class="form-group" placeholder="1234" pattern="\d{4}" maxlength="4" >&nbsp;<span id="chk_postcode_errmsg"></span>
                                <p><input type="button" class="btn btn-primary" name="pc_submit" id="pc_suit" value="<?= $btntext; ?>"</input></p><span id="post_err"></span>
                            </form>
						  <p><a href="<?= $PostcodePageURL; ?>" target="_blank"><?= $PostcodePageURLtxt; ?></a></p>
							</div>	
							
                        </div>
						<?php } ?>
                    </div>
                </div>
            </div>
					   
							<?php }
					   ?>
					 
					   <div id="myModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form>
                            <div class="modal-body">
	
                                <input type="button" id="popup1btn" data-dismiss="modal" class="btn btn-primary pull-right" value="Ok" /><br/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                        </div>
		           </div>
        </div>
	</body>
<?php include 'public_footer.php'; ?>
</html>
		  <?php } ?>