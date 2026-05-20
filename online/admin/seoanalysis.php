<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
setlocale(LC_ALL, 'nl_NL');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome </title>
        <?php include 'header.php'; ?>
        <style>
            *{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}
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
                font-size: 14px !important;
            }
            .hiddenRow {
                padding: 0 !important;
            }@media print {
                /*  body * {
                    visibility: hidden;
                  }
                */
                @page {
                    size: auto;   /* auto is the initial value */
                    margin: 0;  /* this affects the margin in the printer settings */
                }
                #printcontent, #printcontent * {
                    /*max-width:300px !important;*/
                    width:300px !important;
                    visibility: visible;
                }
                #section-to-print {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
			div#dvContents .col-sm-2 {
    display: inline-block;
    border: 1px solid#4f4fa4!important;
    width: 19%;
    margin-right: 1%;
    height: auto;
				margin-bottom: 40px !important;
				text-align: center !important;
				margin-bottom: 20px;
}
			div#dvContents .col-sm-2 h4 {
    height: 44px;
    font-size: 17px;
}@media only screen and (max-width: 767px) {div#dvContents .col-sm-2 {
    width: 100%;
			}}
			
			@media screen and (min-width: 768px) and (max-width: 991px) { 
   div#dvContents .col-sm-2 {
    width: 32%;
			}
}
        </style>
    </head>
    <body class="hold-transition  <?= theme_skin ?> sidebar-mini">
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
                        Order
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="">Menu</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <!-- Attributes action --><?php //include 'attributes_actions.php';                                 ?><!-- Attributes action -->
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">About Order Details</h3>

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
                                            <h3 class="box-title">Orders Details <button type="button" id="print" class="btn btn-social-icon btn-warning" value="print"><i class="fa fa-print"></i></button></h3>
                                        </div>
                                        <div class="col-lg-4 ">

                                            <div class="pull-right">
                                                <div class="checkbox" style="float:left;"><label><input type="hidden" id="show_all_order" name="show_all_order"> Show Details</label></div>&nbsp;&nbsp;
<!--                                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>-->
                                                <p id="printcontent"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
								<?php 
								///$additional_query="";
								///$selectmonth = "";
								///$selectyear = "";
								///$selectdate = "";
								//$selectdate2= "";
								//$totalamt = "";
								//$totalamt1 = "";
								//$totalamt2 = "";
								//$totalamt3 = "";
								//$tipamttotal = 0;
								//$tipamttotal2 = 0;
									if(isset($_POST['submit'])){										
										$m = $_POST['month'];
										$y = $_POST['year'];
										$selectmonth = $m;
										$selectyear = $y;
										if($m=='default' and $y!='default'){
											$additional_query = "AND `ot_OrderDate` like '" . date($y) . "%' ";
										}
										else 
										{
											 $additional_query = "AND `ot_OrderDate` like '" . date($y.'-'.$m) . "%' ";													}
										
									}
									
                                     if(isset($_POST['submitdate'])){
										 $var = $_POST['date'];
										 $var2 = $_POST['sdate'];
										 $selectdate = $var;
										 $selectdate2 = $var2;
										$date = str_replace('/', '-', $var);
										$date2 = str_replace('/', '-', $var2);
										$d = date('Y-m-d 23:00:00', strtotime($date));
										 $d2 = date('Y-m-d 00:00:00', strtotime($date2));
											 $additional_query = "AND `ot_OrderDate` >= '$d2' AND `ot_OrderDate`<= '$d' ";
										}
         $list_gift_query = "Select * From `tbl_orders` where ot_trx_status='Success' ".$additional_query."  ORDER BY `ot_UserId` desc";
									$query_result66 = $mysqli->query($list_gift_query); 
									$count = $query_result66->num_rows;
									while($row11 = $query_result66->fetch_assoc()){
								  $totalamt = $totalamt + $row11['ot_TotalAmount'];
									}
								
		 			
								
								 $list_gift_query11 = "Select * From `tbl_orders` where ot_trx_status='Success' and ot_paymentoption != 'COD' and ot_paymentoption != 'pin' ".$additional_query." ORDER BY `ot_UserId` desc";
									$query_result6611 = $mysqli->query($list_gift_query11); 
									$count11 = $query_result6611->num_rows;
									while($row111 = $query_result6611->fetch_assoc()){
								  $totalamt1 = $totalamt1 + $row111['ot_TotalAmount'];
									}
									 $list_gift_query12 = "Select * From `tbl_orders` where ot_trx_status='Success' and ot_paymentoption = 'COD' ".$additional_query." ORDER BY `ot_UserId` desc";
									$query_result6612 = $mysqli->query($list_gift_query12); 
									$count12 = $query_result6612->num_rows;
									while($row112 = $query_result6612->fetch_assoc()){
								  $totalamt2 = $totalamt2 + $row112['ot_TotalAmount'];
									}

								 $list_gift_query13 = "Select * From `tbl_orders` where ot_trx_status='Success' and ot_paymentoption = 'PIN' ".$additional_query." ORDER BY `ot_UserId` desc";
									$query_result6613 = $mysqli->query($list_gift_query13); 
									$count13 = $query_result6613->num_rows;
									while($row113 = $query_result6613->fetch_assoc()){
								  $totalamt3 = $totalamt3 + $row113['ot_TotalAmount'];
									}
								
								$tipamt = "Select * From `tbl_orders` where ot_trx_status='Success' ".$additional_query."  ORDER BY `ot_UserId` desc";
									$query_result66 = $mysqli->query($list_gift_query); 
									$count = $query_result66->num_rows;
								$tipamttotal = 0;
									while($row11 = $query_result66->fetch_assoc()){
										if($row11['tip_amt']==NULL || empty($row11['tip_amt'])){
										}
										else{
											 $addition  = floatval($row11['tip_amt']);
											///echo floatval($row11['tip_amt']);
											$tipamttotal2 = $tipamttotal2+1;
											  $tipamttotal = $tipamttotal + floatval($row11['tip_amt']);
											///echo $tipamttotal;
										}											
								
									}	
								
								
								$pasltcikbagqu = "Select * From `tbl_orders` where ot_trx_status='Success' ".$additional_query." AND 			total_plstc_bg>0 ";
								
							
									 $query_result66 = $mysqli->query($pasltcikbagqu); 
							
								 
								$tipamttotal3 = 0;
									while($row11 = $query_result66->fetch_assoc()){
									 	 
								 
										 
											$tipamttotal3 = $tipamttotal3+1;
											  $tipamttotal4 = $tipamttotal4 + $row11['total_plstc_bg'];
										 
								 }			
									 
								
				// Cash tip								
			$tipamt_1 = "Select  SUM(tip_amt)  From `tbl_orders` where    ot_paymentoption = 'COD'  and ot_trx_status='Success' ".$additional_query."  ORDER BY `ot_UserId` desc";
			 	$query_result66_1 = $mysqli->query($tipamt_1); 
				$row11_1 = $query_result66_1->fetch_array()[0];				  								
								 
						$tipamt_1_1 = "Select  SUM(tip_amt)  From `tbl_orders` where    ot_paymentoption != 'COD'  and ot_trx_status='Success' ".$additional_query."  ORDER BY `ot_UserId` desc";
			 	$query_result66_1_1 = $mysqli->query($tipamt_1_1); 
				$row11_1_1 = $query_result66_1_1->fetch_array()[0];					

									?>
                                <div class="box-body table-responsive no-padding">
									  

									<form method="POST">
									<div class="col-sm-12">
                                     <div class="col-sm-4">
									  <select name="year" class="form-control" >
										  <option value="default">Filter By Year</option>
										  <?php
										  $cyear = date("Y");
										  for ($x = 2020; $x <= $cyear+1; $x++) {

										  ?>
										  <option <?php if($selectyear==$x){?>selected <?php } ?> ><?php echo $x; ?></option>
										  <?php } ?>
									  </select>
									
									 </div>
										<div class="col-sm-4">
									  <select name="month" class="form-control" >
										 <option value="default">Filter By Month</option>
										 <option <?php if($selectmonth=='01'){?>selected <?php } ?> value="01">January</option>
                                         <option <?php if($selectmonth=='02'){?>selected <?php } ?> value="02">February</option>
										 <option <?php if($selectmonth=='03'){?>selected <?php } ?> value="03">March</option>
										 <option <?php if($selectmonth=='04'){?>selected <?php } ?> value="04">April</option>
										 <option <?php if($selectmonth=='05'){?>selected <?php } ?> value="05">May</option>
										 <option <?php if($selectmonth=='06'){?>selected <?php } ?> value="06">June</option>
  										 <option <?php if($selectmonth=='07'){?>selected <?php } ?> value="07">July</option>
										 <option <?php if($selectmonth=='08'){?>selected <?php } ?> value="08">August</option>
										<option <?php if($selectmonth=='09'){?>selected <?php } ?> value="09">September</option>
										<option <?php if($selectmonth=='10'){?>selected <?php } ?> value="10">October</option>
										<option <?php if($selectmonth=='11'){?>selected <?php } ?> value="11">November</option>
										<option <?php if($selectmonth=='12'){?>selected <?php } ?> value="12">December</option>
									  </select>
									 </div>
									
									 <div class="col-sm-4">
											<input type="submit" name="submit" value="Search" class="btn btn-primary">
									 </div>
									</div>
										<br>
										<div class="col-sm-12" style="margin-top: 15px;">
										<div class="col-sm-3">
												<h4>Filter By Date</h4>
											</div>
										</div>
										<div class="col-sm-12" style="margin-top: 15px;">
											
											<div class="col-sm-4">
												<label>Start Date</label> 
									  <input type="date" class="form-control" name="sdate" value="<?php echo $selectdate2;?>" >
									 </div>
											 <div class="col-sm-4">
												 <label>End Date</label>
									  <input type="date" class="form-control" name="date" value="<?php echo $selectdate;?>" >
									 </div>
											<div class="col-sm-4" style="margin-top: 20px;">
											<input type="submit" name="submitdate" value="Search" class="btn btn-primary">
									 </div>
										</div>
									</form>
									
                                    <div class="col-sm-12" style="margin-top: 35px;" id="dvContents">
										<h2>Sales Report </h2>
										<div class="frm-dt" style="margin-bottom:10px;text-align: center;font-weight: bold;">
											
											<?php echo ($selectdate2);?><br> <?php echo ($selectdate); ?>
											<?php echo $m;?> <?php echo $y; ?>
											
										
										</div>
										
                                     <div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
										 <h4>Total Order</h4>
										 <p><?php echo $count;?></p>
										<h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo  str_replace('.',',',$totalamt) ?></p>
										
									 </div>
										<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									    <h4>Order ( Online Payment )</h4>
										 <p><?php echo $count11;?></p>
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php   
											echo str_replace('.',',',number_format((float)$totalamt1,2));
											?></p>
									 </div>
										<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Order ( Cash Payment )</h4>
										 <p><?php echo $count12;?></p>
										<h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo  str_replace('.',',',number_format((float)$totalamt2,2)); ?></p>	
									 </div>
										<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Order ( Pin Payment )</h4>
										 <p><?php echo $count13;?></p>
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo  str_replace('.',',',number_format((float)$totalamt3,2)); ?></p>	
									 </div>
								<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Total Tip Amount</h4>
										 <p><?php echo $tipamttotal2;?></p>
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo str_replace('.',',',number_format((float)$tipamttotal,2)); ?></p>	
									 </div>	
										
									 <div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Total Tip (Cash)</h4>
									 
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo str_replace('.',',',number_format((float)$row11_1,2)); ?></p>	
									 </div>	
										
											<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Total Tip (online)</h4>
									 
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php echo str_replace('.',',',number_format((float)$row11_1_1,2)); ?></p>	
									 </div>	
											<div class="col-sm-2" style="border: solid #4f4fa4; text-align: center;">
									   <h4>Total Plastic Box Amount</h4>
										 <p><?php echo $tipamttotal3;?></p>
										 <h5>Total Amount:</h5> <p><?php echo currency . ' '; ?> <?php   
	echo number_format( $tipamttotal4 , 2, ",", ".");  ?></p>	
									 </div>	
                            </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->

            
            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
 <script type="text/javascript">
    $(function () {
    $("#print").click(function () {
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
  </script>
    </body>
</html>

