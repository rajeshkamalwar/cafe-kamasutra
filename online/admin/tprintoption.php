<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
$queryp="SELECT * From printsetting where id = '1'";
        $query_resultp = $mysqli->query($queryp);
        $rowp=$query_resultp->fetch_array();

        $logo_query="select * from adm_set where adm_set_name='print_url'";
        $logo_url= $mysqli->query($logo_query)->fetch_object()->adm_set_vlu;
         $ot_id = $_GET['dataid'];
		$edit_query = "UPDATE `tbl_orders` SET `comment_status`='1' WHERE `ot_id`='" . $ot_id . "'";
       $edit_gift_query_result11 = $mysqli->query($edit_query);
        $query="SELECT a.*, b.* From tbl_user a INNER JOIN tbl_orders b on a.usr_id = b.ot_UserId and b.ot_id = '".$ot_id."'";
        $query_result = $mysqli->query($query);
        $row=$query_result->fetch_array();
		$usr_emailid = $row['usr_emailid'];
		$usr_order_phone = $row['usr_order_phone'];
		$ot_odrnote =$row['ot_odrnote'];
		//$ot_pick_del =$row['ot_pick_del'];
		$usr_first_name = $row['usr_first_name'];
		$usr_last_name = $row['usr_last_name'];
		$usr_company = $row['usr_company'];
		$usr_streetaddress1 = $row['usr_streetaddress1'];
		$usr_streetaddress2 = $row['usr_streetaddress2'];
		$usr_zipcode = $row['usr_zipcode'];
		$usr_zipcode2letter = $row['usr_zipcode2letter'];
		$usr_order_city = $row['usr_order_city'];
if($row['ot_pick_del']!='pickup'){
	if($row['qrcode']!=''){
        $qrcodenew = '<img src="https://restaurantkamasutra.nl/online/'.$row['qrcode'].'" style="height: auto;max-width: 50px;">';
	} else { 
		$qrcodenew = '';
	}
} else { 
	$qrcodenew = '';
}
        $current_lang="en_not";
         if ($current_lang == "en") {
                $or_orderno = "Order Number:";
                $or_date = "Date:"; 
                $or_total = "Total:";
			    $or_dt = "ORDER DETAIL";
			    $or_best = "Ordered on: ";
			    $or_for = "Order for:";
                $or_paymethod = "Payment Method:";
                $paymentmethod_cash = "Cash";
                $twoline_msg = "Order Details";
                $cust_dtls_title = "INFO";
                $or_email = 'Email';
			  $pickuptime="Pick up Time";
				$deliverytime="Delivery Time : ";
                $or_tele = 'Telephone';
                $or_free_item = 'Also Free';
                $or_Pickup_Delivery = 'Pick up / Delivery : ';
			    $or_notes = 'Order notes : ';
                $bill_addr = 'Billing Address';
			 $deliveryee = 'Delivery';
			  $pickupee = 'Pickup';
			 $cutleryyes = 'Yes';
			 $Cutlery = 'Cutlery';
                $footer_msg='<center style="font-size: 12px;color: #000;"><b>Thank you for your order.<br/>Eat tasty!</b></center>';
			 $payment_txt1='Cash';
            } else {
                $or_orderno = "Ordernummer:";
                $or_date = "";
                $or_total = "Totaal:";
			 $or_dt = "BESTELLING";
			 $or_best = "Besteld op: ";
			 $or_for = "Order Voor:";
			 $cutleryyes = 'Ja';
			 $Cutlery = 'Bestek';
                $or_paymethod = "Betaaldmethode:";
                $paymentmethod_cash = "Contant";
                $twoline_msg = "Bestel Details";
                $cust_dtls_title = "INFO";
                $or_email = 'E-mail';
                $or_tele = 'Telefoon';
                $or_free_item = 'Gratis Item';
                $or_Pickup_Delivery = "Afhalen / Bezorgen: ";
			    $or_notes = "Bestelnotities:";
                $bill_addr = 'KLANTGEGGEVENS';
			 $pickuptime="afhaaltijd : ";
				$deliverytime="Bezorgtijd : ";
			 $deliveryee = 'Bezorgen';
			  $pickupee = 'Afhalen';
                $footer_msg='<center style="font-size: 12px;color: #000;"><b>Bedankt voor uw bestelling.<br/>Eet smakelijk!.</b></center>';
			 $payment_txt1='Cash';
            }
            
        $freeitem='';
        if (isset($row['ot_giftitem']) && !empty($row['ot_giftitem']) && ($row['ot_giftitem'] !='no free item')) 
        { 
            $freeitem='<tr style="padding:5px 0px; dispaly:block;"><td><b style="font-weight: 540; letter-spacing: 2px;">'.$or_free_item.':</b> '.$row['ot_giftitem'].'</td></tr>'; 
        }
        $data111=$row['ot_OrderDate'];
$data123 = $row["ot_time"];
$datatime111=$row['del_time'];
 $pickuptimedel22 = $row['ot_pick_del'];
        if($row['ot_pick_del']=='pickup'){ $ottime = $pickuptime; } else { $ottime = $deliverytime; }

       $print_bill='';
		$payment_txt='';
                if($row['alldata']!=''){
					$alldata =  $row['alldata'];
				} else { 
					$alldata =  $row['ot_order_details'];
				}
if($row['couponcode']==''){
	$couponshow = '';
}else { 
	$couponshow = '<tr ><td colspan="3">'.$row['couponcode'].'</td><td align="right">'. $row['couponcharge'] . '</td></tr>';
	}
		//if($row['ot_paymentoption']=='COD'){$payment_txt=$payment_txt1;}else{$payment_txt=$row['ot_paymentoption'];}
      if($row['ot_paymentoption']=='COD'){ $ot_paymentoption= 'CASH'; } elseif($row['ot_paymentoption']=='creditcard'){ $ot_paymentoption= 'Master Card'; } elseif($row['ot_paymentoption']=='paypalec'){ $ot_paymentoption= 'Paypal'; } else { $ot_paymentoption= $row['ot_paymentoption']; }  
		$oder_str_for_print = str_replace('class="table table-bordered table-striped"', 'style="width: 90%!important; font-size:15px; "', str_replace('<th width="15%">', '<th style="width:auto;  padding:0px 10px;">', str_replace('<th width="20%">', '<th style="width:auto;  padding:0px 10px;">', str_replace('<th width="10%">', '<th style="width:auto;">', str_replace('<th width="45%">', '<th style="width:auto; text-align:left;">', $alldata)))));
		setlocale(LC_ALL, 'nl_NL');
		$aa11=$row['ot_TotalAmount'];
$aa = str_replace(".",",",$aa11);
$aa222=$row['cutlerycharges'];
$aa22 = str_replace(".",",",$aa222);
setlocale(LC_ALL, NULL);
if($row['cutlery']=='yes'){
$cutrleryline = '<div style="font-size:15px; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; display: flex; justify-content: space-between; width: 86%;"><b>'.$Cutlery.' :</b> ' . $cutleryyes . '</div><br/>';
	$cuttrshow = '<tr ><td colspan="3">Cutlery charge</td><td align="right">'. currency . " " . $aa22 . '</td></tr>';
}
?>
<!DOCTYPE html>
<html>
    <head>
		
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
        <style>
		@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');

@font-face {
    font-family: 'calibari';
    src: url('https://restaurantkamasutra.nl/online/admin/Calibri.woff') format('woff');
	font-weight:normal;
}



div#order_table.table-responsive table {width:90% !important;}
div#order_table.table-responsive table tr {vertical-align:top;}
body.skin-blue { font-family: calibari /*'Open Sans', sans-serif*/;}
		td.finaltotal, 	td#cart_FinalBill2pay_now {font-weight: 700;}
		div#order_table.table-responsive {font-size:15px !important; width: 90%;}
		#order_table.table-responsive td {    text-align: left !important;}
		div#order_table.table-responsive th:first-child, div#order_table.table-responsive td:first-child {width:20% !important;}
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent !important;
            }
            .btn-social-icon > :first-child {
                font-size: 15px !important;
            }
.hiddenRow {
    padding: 0 !important;
}
@media print { 
                 body  { overflow:visible; 
                    font-family: 'Open Sans', sans-serif; /*'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;*/
                  }
				  div, table, tr, td, th, ol, ul {overflow:visible;}
				  div#order_table.table-responsive table tr {vertical-align:top;}
				   div#order_table.table-responsive table td.finaltotal {font-weight:bold;}
				   div#order_table.table-responsive table td#cart_FinalBill2pay_now {font-weight:bold;}
				  
				  
				  
                @page {
                    size: 80mm 200mm;   /* auto is the initial value */
                    margin: 0;  /* this affects the margin in the printer settings */
					 font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
                }
                #printcontent, #printcontent * {
                    /*max-width:300px !important;*/
                    /* width:300px !important; */
                    visibility: visible;
                }
				
				
                #section-to-print {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
			
            }
        </style>
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
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
                        Print
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">order</li>
                    </ol>
                </section>
                <!-- Inner content -->
                <section class="content">
                    <div class="row">
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Print Option</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Here you can see all details about orders you received.</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-8">
                                            <h3 class="box-title">Print Option</h3>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
									<button type="button" id="<?php echo $rowp['print_type']; ?>" class="btn btn-social-icon btn-warning" value="<?php echo $rowp['print_type']; ?>"><i class="fa fa-print"></i></button>
									<input type="hidden" name="width" id="width" value="<?php echo $rowp['width']; ?>">
									<input type="hidden" name="height" value="<?php echo $rowp['height']; ?>">
								<div class="col-sm-12" id="dvContents" >
									<?php
									  if($pickuptimedel22=='both'){ $ot_pick_del11 = $deliveryee; } else if($pickuptimedel22=='delivery'){ $ot_pick_del11 = $deliveryee; } else { $ot_pick_del11 = $pickupee; }

								$print_bill = '
<div class="print_content" style="width:100% !important;padding: 5px 10px;font-size:12px;">
<div><center><img src="'.$logo_url.'" class="img-responsive" width="150" height="80" style="display: block;max-width: 100%;height: auto;"/></center><br/></div>
 <div class="col-md-6 col-sm-6">
                            <p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff; margin-right:20px; text-align: center; margin-bottom: 10px; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;" ><b>'.$bill_addr.'</b></p>
                             <div class="comm" style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; ">'.$usr_first_name . '</div>
							 <div class="comm" style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; ">' . $usr_company . '</div>
							 <div class="comm" style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; ">' . $usr_streetaddress1 . ' </div>
							 
							 <div class="comm" style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; ">' . $usr_zipcode . ' ' . $usr_zipcode2letter. ' ' . $usr_order_city.'</div>
							 
                        </div>
						<table style="word-wrap:break-word;white-space:pre-line;border:0px solid #000;font-size:16px;width:100%;">
                               <tr><td style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;display: flex; justify-content: center; "><b style="font-size:16px;">' . $or_email . '</b>:<span style="font-size:15px;"> ' . $usr_emailid . '</span></td></tr>
                                <tr><td style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize; display: flex; justify-content: center;"><b style="font-size:16px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;">' . $or_tele . '</b>:<span style="font-size:15px;"> ' . $usr_order_phone . '</span></td></tr>
								
                               
                            </table> 
						
						<div class="col-md-6 col-sm-6 " style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
						'.$qrcodenew.'
						</div>
						  

<div class="col-md-12 col-sm-12 table-responsive ">

<p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff; margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$cust_dtls_title.'</b></p> 


      <div style="font-size:16px; display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">'.$or_orderno.'</b> #'.$ot_id.'</div>
      
	  <div style="font-size:16px; display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase; letter-spacing: 2px; line-height: 23px;">'.$or_best.'</b>'.$or_date.' </b>'.date_format(new DateTime($data111), "d/m/Y").' om '.date_format(new DateTime($data123), "H:i").'</div>
	 	 
		  <div style="font-size:16px !important; display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b style="font-weight: 540; text-transform: uppercase !important; letter-spacing: 2px; line-height: 23px;">'.$ottime.'</b> '.$datatime111.'</div>

<p style="font-weight: 500 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;    display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; margin-bottom: 0px; text-align: center;">' . $freeitem . '</p> 
		  

 <div style="font-size:16px !important; font-weight:500; letter-spacing: 1px; display: flex; justify-content: space-between; width: 86%; text-transform: uppercase !important; font-family: Calibri, Arial, sans-serif; text-transform: capitalize;"><b class="testp" style="font-weight: 540 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;" >'.$or_total.'</b> '.currency . " " . $aa.'</div>
     <div style="font-size:16px; font-weight:500; display: flex; letter-spacing: 1px; justify-content: space-between; text-transform: uppercase !important; width: 86%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">'.$or_paymethod.'</b> '.$ot_paymentoption.'</div><div><br/></div>
    
	<div style="font-size:16px; font-weight:500; display: flex; letter-spacing: 1px; justify-content: space-between; text-transform: uppercase !important; width: 86%; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;"><b style="font-weight: 540 !important; text-transform: uppercase;  letter-spacing: 2px;">'.$or_for.'</b> '.$ot_pick_del11.' </div>

<br><div style="font-size:16px; font-family: Calibri, Arial, sans-serif;text-align: center;justify-content: space-between; width: 86%;"><b style="font-size:16px;  letter-spacing: 2px; font-weight: 540; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase !important;">'.$or_notes.'</b> <br><p class="text align:center"> '.$ot_odrnote.'</div>

<p style="font-weight: 500 !important; text-transform: uppercase; font-size: 15px !important; letter-spacing: 2px;    display: flex; justify-content: space-between; width: 86%; font-family: Calibri, Arial, sans-serif; margin-bottom: 0px;">'.$cutrleryline.'</p>


 <div><br/></div>

	                   </div>                
                        <div class="col-md-12 col-sm-12 mail_prt">
						<p style="font-size: 18px; margin-block-start: 0px; padding:5px; margin-block-end: 0px;background:black; color:#fff;margin-right:20px; text-align: center; font-family: Calibri, Arial, sans-serif; text-transform: uppercase;"><b>'.$or_dt.'</b></p>
                            '.$oder_str_for_print.' 
							
                        </div> 
                     
                       <div class="col-md-12 col-sm-12">'.$footer_msg.'</div></div>';
       
       echo $print_bill;
									?>
                                       
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->
                </section>
                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Status Of Order</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="edit_notimsg"></p><br/><br/>
                                    <div class="box-body" id="edit_gift_control">
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="edit_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="edit_gift_form" class="btn btn-primary" value="Update" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->
            </div>
            <!--// main content -->
            <?php include 'footer.php'; ?>
						<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
$(function () {
    $("#A4").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {@page {size: A4;margin: 0;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
$(function () {
    $("#A3").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {@page {size: A3;margin: 0;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
$(function () {
    $("#A5").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {@page {size: A5;margin: 0;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
$(function () {
    $("#Custom").click(function () {
        var contents = $("#dvContents").html();
		var width = $('#width').val();
		var height = $('#height').val();
		
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {@page {margin: 0;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
	$(function () {
    $("#Reciept").click(function () {
		//alert("dhjghgjh");
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {body {font-family:Open Sans; tr {vertical-align:top;} td.finaltotal, td#cart_FinalBill2pay_now{font-weight: 700;}} @page {size: 80mm 200mm; margin:0px 0px 0px 0px;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
$(function () {
    $("#Letter").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<style>@media print {@page {size: letter;margin: 0;}}</style>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
</script>
    </body>
</html>
