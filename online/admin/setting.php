<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';


  $query = "Select * From `adm_set`";
        $result_query = $mysqli->query($query);
//        $row = $result_query->fetch_assoc();
        $data1=array();
        while ($row = $result_query->fetch_assoc()) {
          $data1[$row['adm_set_name']] = $row['adm_set_vlu'];
        }
       

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
        <style>
            a:hover,a:focus{font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
                            font-weight: 400;font-size:14px;
                            text-decoration: none;
                            outline: none;
            }
            .vertical-tab{
                display: table;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
                font-weight: 400;font-size:14px;width:100%;
                /*    border-right: 8px solid #3c8dbc;*/
            }
            .vertical-tab .nav-tabs{
                display: table-cell;
                min-width: 28%;
                border-bottom: none;
                border-right: 8px solid #3c8dbc;
            }
            .vertical-tab .nav-tabs li{
                float: none;
                vertical-align: top;
            }
            .vertical-tab .nav-tabs li a{
                display: block;
                padding: 16px;
                margin-right: 0;
                /*font-size: 16px;*/
                font-weight: 600;
                color: #fff;
                /*text-transform: uppercase;*/
                background: #1a2226;
                border: none;
                border-radius: 0;
                position: relative;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
                font-weight: 400;font-size:14px;
            }
            .vertical-tab .nav-tabs li a:hover,
            .vertical-tab .nav-tabs li.active a{
                background: #3c8dbc;
                border: none;
                color: #fff;
            }
            .vertical-tab .nav-tabs li.active a:after{
                content: "";
                width: 20px;
                height: 20px;
                background: linear-gradient(225deg,#3c8dbc 49%, transparent 50%);
                position: absolute;
                top: 50%;
                right: -16px;
                transform: translateY(-50%) rotate(45deg);
            }
            .vertical-tab .tab-content{
                display: table-cell;
                padding: 15px 20px;
                font-size: 15px;
                color: #272e38;
                letter-spacing: 1px;
                line-height: 25px;
                text-align: justify;
                vertical-align: top;
                width:75%;
            }
            .vertical-tab .tab-content h3{
                padding-bottom: 10px;
                margin: 0 0 10px 0;
                font-weight: 600;
                color: #3c8dbc;
                text-transform: uppercase;
                border-bottom: 1px solid #3c8dbc;

                font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
                font-weight: 600;font-size:22px;
            }

            .tab-pane ul
            {list-style: none;padding:0px;}
            .tab-pane ul li{background-color: #ecf0f5;
                            margin-bottom: 5px;
                            padding: 5px 10px;text-transform:capitalize !important;}

            .tab-pane ul li {}
            @media only screen and (max-width: 479px){
                .vertical-tab{
                    border-right: none;
                    border-bottom: 8px solid #3c8dbc;
                }
                .vertical-tab .nav-tabs{
                    display: block;
                    margin: 0 -10px;
                    border-right: none;
                }
                .vertical-tab .nav-tabs li{ margin-bottom: 10px; }
                .vertical-tab .nav-tabs li:last-child{ margin-bottom: 0; }
                .vertical-tab .nav-tabs li a{ padding: 10px; }
                .vertical-tab .nav-tabs li.active a:after{ display: none; }
                .vertical-tab .tab-content{
                    display: block;
                    padding: 15px 0;
                }
                .vertical-tab .tab-content h3{ font-size: 18px; }
            }
        </style>
    </head>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	<script>
	
	$(function() {
   	
    $('#print_type11').change(function(){
        if($('#print_type').val() == 'Custom') {
            $('#row_dim').show(); 
			$('#row_dim12').show();
        } else {
            $('#row_dim').hide(); 
			$('#row_dim12').hide();
        } 
    });
});
</script>
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
                        Setting
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Setting</li>
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
                                    <h3 class="box-title">About Setting</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some Common Setting </p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="welcmtxt_notimsg"></p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!--              <h3 class="box-title">Bootstrap WYSIHTML5
                                                    <small>Simple and fast</small>
                                                  </h3>-->
                                    <!-- tools box -->
                                    <!--              <div class="pull-right box-tools">
                                                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                      <i class="fa fa-minus"></i></button>
                                                    <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                                                            title="Remove">
                                                      <i class="fa fa-times"></i></button>
                                                  </div>-->
                                    <!-- /. tools -->
                                </div>
                                <!-- /.box-header -->
                                  <div class="box-body pad">



                                    <div class="row">
                                        <div class="col-md-12">
                                            <p id="notimsg"></p>
                                        </div><div class="col-md-12"></div>
                                        <div class="col-md-12">
                                            <div class="vertical-tab" role="tabpanel">
                                                <ul class="nav nav-tabs" role="tablist">
  <li id="tabid_" role="headsettings" class="active"><a href="#tabid_12" aria-controls="home1" role="tab" data-toggle="tab">Head settings</a></li>													
													
                                                    <li id="tabid_" role="print" class=""><a href="#tabid_7" aria-controls="home" role="tab" data-toggle="tab">Print Setting</a></li>
                                                    <li id="tabid_" role="presentation" class=""><a href="#tabid_1" aria-controls="home" role="tab" data-toggle="tab">Bill Print Logo</a></li>
                                                    <li id="tabid_" role="presentation" class=""><a href="#tabid_2" aria-controls="home" role="tab" data-toggle="tab">Mail Setting</a></li>
                                                    <li id="tabid_" role="presentation" class=""><a href="#tabid_3" aria-controls="home" role="tab" data-toggle="tab">Theme template </a></li>
                                                    <li id="tabid_" role="presentation" class=""><a href="#tabid_4" aria-controls="home" role="tab" data-toggle="tab">Online Payment</a></li>
                                                    <li id="tabid_" role="presentation" class=""><a href="#tabid_5" aria-controls="home" role="tab" data-toggle="tab">Restaurant Details</a></li>
													<li id="tabid_" role="presentation" class=""><a href="#tabid_6" aria-controls="home" role="tab" data-toggle="tab">Merchant Setting</a></li>
													<li id="tabid_" role="presentation" class=""><a href="#tabid_8" aria-controls="home" role="tab" data-toggle="tab">GPS Setting</a></li>
													<li id="tabid_" role="presentation" class=""><a href="#tabid_9" aria-controls="home" role="tab" data-toggle="tab">Payment Setting</a></li>
													<li id="tabid_" role="presentation" class=""><a href="#tabid_10" aria-controls="home" role="tab" data-toggle="tab">Delete Code</a></li>
													<li id="tabid_" role="presentation" class=""><a href="#tabid_11" aria-controls="QR" role="tab" data-toggle="tab">QR Code</a></li>
                                                </ul>

                                                <div class="tab-content tabs">
													
												 <div role="tabpanel" class="tab-pane fade in active" id="tabid_12">
                                                        <h3>Logo</h3>													 
													 <?php
													 $data1=array();
													     $query = "Select * From `head_settings`";
																$result_query = $mysqli->query($query);									
																while ($row = $result_query->fetch_assoc()) {							 
																	$data1[$row['settings_name']] = $row['sett_data'];
																}										
													 ?>
													   <p id="editnotimsg"  style="display:none;">Updates Done</p>
                                                         <form id="formedit" action="settings_update.php" method="post" >
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Logo</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                    <input type="file" class="form-control" id="image" name="image"  value="">
                                                                    </div>
                                                                </div>
															 
																   <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Meta title</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="meta_head" name="meta_head" value="<?php echo $data1['meta-title'];?>">
                                                                    </div>
                                                                </div>
																  <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Meta Description </label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="meta_head_des" name="meta_head_des" value="<?php echo $data1['meta_des'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="submit" name="submit" id="headsettings" class="btn btn-primary" value="Save" />
                                                        </form>
													 
													 
													 <form id="formedit1" action="settings_update1.php" method="post" >
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Fav icon</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                    <input type="file" class="form-control" id="image" name="image"  value="">
                                                                    </div>
                                                                </div>															  
                                                            </div>
                                                            <input type="submit" name="submit" id="headsettings1" class="btn btn-primary" value="Save" />
                                                        </form>												 
													 
                                                    </div>	
													
													
                                                    <div role="tabpanel" class="tab-pane fade in " id="tabid_1">
                                                        <h3>Bill Print Logo</h3>

                                                        <p>This logo will be used at bill which are going to print using thermal printer.</p>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">

                                                                        <label for="">Logo URL</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="logo_url" name="logo_url" placeholder="Full to logo image">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="button" name="submit" id="update_logoURL" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade in" id="tabid_2">
                                                        <h3>Mail Setting</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">From Email Address</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email address...">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Additional Email(1) </label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="additional_email" name="additional_email" placeholder="like -  abc@xyz.com">
                                                                    </div>
                                                                </div>
																</div>
																<div class="form-group">
																<div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Additional Email(2) </label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="additional_email2" name="additional_email2" placeholder="like -  abc@xyz.com">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="update_email" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade in" id="tabid_3">
                                                        <h3>Color Theme</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <!--<div class="col-md-3 col-sm-12">
                                                                        <input type="radio" id="blue" name="colschm" value="blue"> Blue
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <input type="radio" id="yellow" name="colschm" value="yellow"> Yellow
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <input type="radio" id="red" name="colschm" value="red"> Orange
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <input type="radio" id="green" name="colschm" value="green"> Green
                                                                    </div>-->
																		<?php $edit_query66 = "SELECT * from `adm_set` where adm_set_name='tempalte_type' ";
       $query_result66 = $mysqli->query($edit_query66); 
																	        $row1266=$query_result66->fetch_array();
?>
																	<div class="col-md-12 col-sm-12">
																		<p>Select your template</p>
																	<select class="form-control" id="tempalte_type" name="tempalte_type">
																			<option>Select Template</option>
																			<option <?php if($row1266['adm_set_vlu']=='TemplateA'){?>selected <?php } ?> >TemplateA</option>
																			<option <?php if($row1266['adm_set_vlu']=='TemplateB'){?>selected <?php } ?>>TemplateB</option>
																			<option <?php if($row1266['adm_set_vlu']=='TemplateC'){?>selected <?php } ?>>TemplateC</option>
																			
																			
																		</select>
																	</div>
                                                                </div>
                                                            </div>

                                                            <input type="button" name="submit" id="selectthemecolor" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade in" id="tabid_4">
                                                        <h3>Online Payment</h3>

                                                        <p>You can stop online payment system any time from here. This'll enable test bank on checkout page.</p>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="checkbox" id="testbnk" name="testbnk" value="yes"> Yes, I want to start test bank.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="update_testbank" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
                                                     <div role="tabpanel" class="tab-pane fade in" id="tabid_5">
                                                        <h3>Restaurant Details</h3>

                                                        <p>These details will be used in mails and order printout and many other places.</p>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Restaurant Title</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_title" name="rest_title" placeholder="Ex: Bla Bla Restaurant">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Restaurant Address</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_addrss" name="rest_addrss" placeholder="Restaurant address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Restaurant Post Code</label></div>
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_postcode" name="rest_postcode" placeholder="Ex: 1012"><span id="rest_postcode_errmsg"></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12">
                                                                        <label for="">Two letters of postcode</label></div>
                                                                    <div class="col-md-2 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_postcode_two" name="rest_postcode_two" maxlength="2" placeholder="Ex: AA"><span id="rest_postcode_two_errmsg"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">City</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_city" name="rest_city" placeholder="Ex: Amsterdam">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Contact number</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_cont" name="rest_cont" placeholder="Ex: 020-6123456">
                                                                    </div>
                                                                </div>
                                                            </div>

															    <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Email Address</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_email" name="rest_email" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
															   <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Website Link</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_weblink" name="rest_weblink" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
																   <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Contact 2</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_contact2" name="rest_contact2" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
															   <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Extra Info</label></div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="rest_info" name="rest_info" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="update_rest_details" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
													<div role="tabpanel" class="tab-pane fade in" id="tabid_6">
                                                        <h3>Merchant Setting</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Merchant Key</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="Merchant_Key" name="Merchant_Key" placeholder="Merchant Key...">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Merchant ID </label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="Merchant_ID" name="Merchant_ID" placeholder="Merchant ID...">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="merchant_setting" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
													<div role="tabpanel" class="tab-pane fade in" id="tabid_7">
                                                        <h3>Print Setting</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Print Type</label>
                                                                    </div>
																	<?php $edit_query = "SELECT * from `printsetting` where id='1' ";
       $query_result = $mysqli->query($edit_query); 
																	        $row12=$query_result->fetch_array();
?>
                                                                    <div class="col-md-9 col-sm-12">
																		<select class="form-control" id="print_type" name="print_type">
																			<option>Select Print Type</option>
																			<option <?php if($row12['print_type']=='Letter') { ?>selected <?php } ?> >Letter</option>
																			<option <?php if($row12['print_type']=='A3') { ?>selected <?php } ?> >A3</option>
																			<option <?php if($row12['print_type']=='A4') { ?>selected <?php } ?> >A4</option>
																			<option <?php if($row12['print_type']=='A5') { ?>selected <?php } ?> >A5</option>
																			<option <?php if($row12['print_type']=='Custom') { ?>selected <?php } ?> >Custom</option>
																			<option <?php if($row12['print_type']=='Reciept') { ?>selected <?php } ?> >Reciept</option>
																			
																		</select>
                                                                    </div>
																</div>
															</div>
															<div class="form-group" id="row_dim" style="display:none;" >
																	<div class="row">
																	<div class="col-md-3 col-sm-12">
                                                                        <label for="">Height</label>
                                                                    </div>
																	<div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="height" name="height" placeholder="Height..." value="<?php echo $row12['height']; ?>">
                                                                    </div>
																	</div>
															</div>
															<div class="form-group" id="row_dim12" style="display:none;" >
																	<div class="row">
																	<div class="col-md-3 col-sm-12">
                                                                        <label for="">Width</label>
                                                                    </div>
																	<div class="col-md-9 col-sm-12">
                                                                        <input type="text" class="form-control" id="width" name="width" placeholder="Width..." value="<?php echo $row12['width']; ?>">
                                                                    </div>
																	</div>
															</div>
                                                               
                                                           
                                                            <input type="button" name="submit" id="printtype" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
													
													<div role="tabpanel" class="tab-pane fade in " id="tabid_8">
                                                        <h3>GPS Setting</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">GPS Type</label>
                                                                    </div>
									<?php $edit_query121 = "SELECT * from `adm_set` where adm_set_name='gps_type' ";
                                          $query_result121 = $mysqli->query($edit_query121); 
										  $row1221=$query_result121->fetch_array();
                                    ?>
                                                                    <div class="col-md-9 col-sm-12">
																		<select class="form-control" id="gps_type" name="print_type">
																			<option>Select GPS Type</option>
																			<option <?php if($row1221['adm_set_vlu']=='Mail') { ?>selected <?php } ?> >Mail</option>
																			<option <?php if($row1221['adm_set_vlu']=='SMS') { ?>selected <?php } ?> >SMS</option>
										
																			
																		</select>
                                                                    </div>
																</div>
															</div>
															
                                                            <input type="button" name="submit" id="gpstype" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
													
													<div role="tabpanel" class="tab-pane fade in " id="tabid_9">
                                                        <h3>Payment Setting</h3>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <label for="">Payment Option</label>
                                                                    </div>
									<?php $edit_query13 = "SELECT * from `adm_set` where adm_set_name='ideal' ";
                                          $query_result13 = $mysqli->query($edit_query13); 
										  $row13=$query_result13->fetch_array();
																	
										  $edit_query14 = "SELECT * from `adm_set` where adm_set_name='mastercard' ";
                                          $query_result14 = $mysqli->query($edit_query14); 
										  $row14=$query_result14->fetch_array();			
																	
										  $edit_query15 = "SELECT * from `adm_set` where adm_set_name='paypal' ";
                                          $query_result15 = $mysqli->query($edit_query15); 
										  $row15=$query_result15->fetch_array();
																	
																	
										$edit_query16 = "SELECT * from `adm_set` where adm_set_name='cash' ";
                                          $query_result16 = $mysqli->query($edit_query16); 
										  $row16=$query_result16->fetch_array();
																	
										$edit_query17 = "SELECT * from `adm_set` where adm_set_name='pin' ";
                                          $query_result17 = $mysqli->query($edit_query17); 
										  $row17=$query_result17->fetch_array();								
                                    ?>
                                                                   <div class="col-md-2 col-sm-12">
                                                                        <input type="checkbox" id="ideal" <?php if($row13['adm_set_vlu']=='1'){?> checked <?php } ?> name="ideal" value="1"> iDeal
                                                                    </div>
																	<div class="col-md-3 col-sm-12">
                                                                        <input type="checkbox"  <?php if($row14['adm_set_vlu']=='1'){?> checked <?php } ?> id="mastercard" name="mastercard" value="1"> Master Card
                                                                    </div>
																	<div class="col-md-2 col-sm-12">
                                                                        <input type="checkbox"  <?php if($row15['adm_set_vlu']=='1'){?> checked <?php } ?> id="paypal" name="paypal" value="1"> Paypal
                                                                    </div>
																	<div class="col-md-2 col-sm-12">
                                                                        <input type="checkbox"  <?php if($row16['adm_set_vlu']=='1'){?> checked <?php } ?> id="cash" name="cash" value="1"> Cash
                                                                    </div>
																	<div class="col-md-2 col-sm-12">
                                                                        <input type="checkbox"  <?php if($row17['adm_set_vlu']=='1'){?> checked <?php } ?> id="pin" name="pin" value="1"> PIN
                                                                    </div>
																</div>
															</div>
															
                                                            <input type="button" name="submit" id="paymentoption" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
													<div role="tabpanel" class="tab-pane fade in" id="tabid_10">
                                                        <h3>Delete Code</h3>
                                                        
                                                        <form>
                                                            
															 <div class="form-group">
																 
                                                                <div class="row">
																	<div class="col-md-3 col-sm-12">
                                                                        <label for="">Delete Code</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="number" id="delcode" name="delcode"placeholder="like -  12345"> 
                                                                    </div>
                                                                </div>
                                                            </div>
															<div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="checkbox" id="delcheck" name="delcheck" value="yes"> Check for code Enable
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="update_delcode" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
														<div role="tabpanel" class="tab-pane fade in" id="tabid_11">
                                                        <h3>QR Code</h3>
                                                        
                                                        <form>
                                                            
															
															<div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-9 col-sm-12">
                                                                        <input type="checkbox" id="qrcheck" name="qrcheck" value="yes"> Check for code Enable
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" name="submit" id="update_qrcode" class="btn btn-primary" value="Save" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



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
$(document).ready(function () {
  $("#rest_postcode_two").keypress(function (e) {
     if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
        $("#rest_postcode_two_errmsg").html("Alphabates Only").show().fadeOut("slow");
        return false;
    }
   });
   $("#rest_postcode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#rest_postcode_errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
        
});
                function load() {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {setting_action: setting_action},
                        dataType: "json",
                        success: function (data)
                        {
                            //console.log(data);                    
                            $('#logo_url').val(data["print_url"]);
                            $("#email_address").val(data["email_from_smtp"]);
                            $("#additional_email").val(data["email_from_smtp_pwd"]);
                             $("#additional_email2").val(data["additional_email2"]);
							 $("#delcode").val(data["delcode"]);
							
                            if (data["colschm"] == "yellow") {
                                $("#yellow").prop("checked", true);
                            }
                            if (data["colschm"] == "red") {
                                $("#red").prop("checked", true);
                            }
                            if (data["colschm"] == "blue") {
                                $("#blue").prop("checked", true);
                            }
                            if (data["colschm"] == "green") {
                                $("#green").prop("checked", true);
                            }
                            
                            if(data["testbk"]=="yes"){
                            $('#testbnk').prop("checked",true);
							}
								 if(data["delcheck"]=="yes"){
                            $('#delcheck').prop("checked",true);
                        }
							 if(data["qrcheck"]=="yes"){
                            $('#qrcheck').prop("checked",true);
                        }
                        $("#rest_title").val(data["rest_title"]);
                        $("#rest_addrss").val(data["rest_addrss"]);
                        $("#rest_postcode").val(data["rest_postcode"]);
                        $("#rest_postcode_two").val(data["rest_postcode_two"]);
                        $("#rest_city").val(data["rest_city"]);
                        $("#rest_cont").val(data["rest_cont"]);
							$("#Merchant_Key").val(data["Merchant_Key"]);
                        $("#Merchant_ID").val(data["Merchant_ID"]);
							
							$("#rest_email").val(data["rest_email"]);
							$("#rest_weblink").val(data["rest_weblink"]);
							$("#rest_contact2").val(data["rest_contact2"]);
							$("#rest_info").val(data["rest_info"]);
							
                        }
                    });
                }

                $(function () {
                    load();
                });
$(document).on('click', '#merchant_setting', function () {
                    if ($("#Merchant_Key").val() == "") {
                        alert("Can not be blank!");
                        $("#Merchant_Key").focus();
                        return false;
                    } if ($("#Merchant_ID").val() == "") {
                        alert("Can not be blank!");
                        $("#Merchant_ID").focus();
                        return false;
                    }
                    
                    url = b_url + 'setting_action.php';
                    var setting_action = 'merchant_setting';
                    var Merchant_Key = $('#Merchant_Key').val();
                    var Merchant_ID = $('#Merchant_ID').val();
                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            Merchant_Key: Merchant_Key,
                            Merchant_ID: Merchant_ID,
                            
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            $('#Merchant_ID').html('');
                            $('#Merchant_Key').html('');
                            
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
			   
			   
 $("#formedit").on('submit',(function(e) {
	 e.preventDefault();
				  $.ajax({
						 url: "settings_update.php",
				   type: "POST",
				   data:  new FormData(this),
				   contentType: false,
						 cache: false,
				   processData:false,
				   beforeSend : function()
				   {
				   },
				   success: function(data) {
					/// console.log(data);				 
				       $("#editnotimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#editnotimsg').delay(3000).fadeOut('1000')
                            }, 1000); 
					  
   }							
    });
 }));			   
 $("#formedit1").on('submit',(function(e) {
	 e.preventDefault();
				  $.ajax({
						 url: "settings_update1.php",
				   type: "POST",
				   data:  new FormData(this),
				   contentType: false,
						 cache: false,
				   processData:false,
				   beforeSend : function()
				   {
				   },
				   success: function(data) {
					/// console.log(data);				 
				       $("#editnotimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#editnotimsg').delay(3000).fadeOut('1000')
                            }, 1000); 
					  
   }							
    });
 }));			   
			   
					   
			   
			   
			   
			   $(document).on('click', '#printtype', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'print_setting';
                    var print_type = $('#print_type').val();
                    var width = $('#width').val();
				   var height = $('#height').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            print_type: print_type,
							width: width,
                            height: height
                        },
                        dataType: "html",
                        success: function (data)
                        {
							window.location.reload();
                            $('#print_type').html('');
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
                $(document).on('click', '#update_logoURL', function () {
                    if ($("#logo_url").val() == "") {
                        alert("Can not be blank!");
                        $("#logo_url").focus();
                        return false;
                    }
                    url = b_url + 'setting_action.php';
                    var setting_action = 'edit_logo';
                    var logo_url = $('#logo_url').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            logo_url: logo_url,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            load();
                            $('#logo_url').html('');
                            $('#logo_url').val(data["adm_set_vlu"]);
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });
              
    
                $(document).on('click', '#update_rest_details', function () {
                    
                    if ($("#rest_title").val() == "") {alert("Can not be blank!");$("#rest_title").focus();return false;}
                    if ($("#rest_addrss").val() == "") {alert("Can not be blank!");$("#rest_addrss").focus();return false;}
                    if ($("#rest_postcode").val() == "") {alert("Can not be blank!");$("#rest_postcode").focus();return false;}
                    if ($("#rest_postcode_two").val() == "") {alert("Can not be blank!");$("#rest_postcode_two").focus();return false;}
                    if ($("#rest_city").val() == "") {alert("Can not be blank!");$("#rest_city").focus();return false;}
                    if ($("#rest_cont").val() == "") {alert("Can not be blank!");$("#rest_cont").focus();return false;}
                    
                    url = b_url + 'setting_action.php';
                    var setting_action = 'update_rest';
                    var rest_title = $('#rest_title').val();
                    var rest_addrss = $('#rest_addrss').val();
                    var rest_postcode = $('#rest_postcode').val();
                    var rest_postcode_two = $('#rest_postcode_two').val();
                    var rest_city = $('#rest_city').val();
                    var rest_cont = $('#rest_cont').val();
					
					  var rest_email = $('#rest_email').val();
					 var rest_weblink = $('#rest_weblink').val();
					 var rest_contact2 = $('#rest_contact2').val();
					 var rest_info = $('#rest_info').val();
					
					
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            rest_title: rest_title,
                            rest_addrss:rest_addrss,
                            rest_postcode:rest_postcode,
                            rest_postcode_two:rest_postcode_two,
                            rest_city:rest_city,
                            rest_cont:rest_cont,
							
							 rest_email:rest_email,
							 rest_weblink:rest_weblink,
							 rest_contact2:rest_contact2,
							 rest_info:rest_info
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            load();
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });

                $(document).on('click', '#update_email', function () {
                    if ($("#email_address").val() == "") {
                        alert("Can not be blank!");
                        $("#email_address").focus();
                        return false;
                    } if ($("#additional_email").val() == "") {
                        alert("Can not be blank!");
                        $("#additional_email").focus();
                        return false;
                    }
                    
                    url = b_url + 'setting_action.php';
                    var setting_action = 'edit_smtp';
                    var email_address = $('#email_address').val();
                    var additional_email = $('#additional_email').val();
                    var additional_email2 = $('#additional_email2').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            email_address: email_address,
                            additional_email: additional_email,
                            additional_email2:additional_email2
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            $('#email_address').html('');
                            $('#additional_email').html('');
                            
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });

                $(document).on('click', '#selectthemecolor', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'colscm';
                    var colschm = $("input[name='colschm']:checked").val();
					var tempalte_type = $('#tempalte_type').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            colschm: colschm,
							tempalte_type:tempalte_type
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {

                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
                
                 $(document).on('click', '#update_testbank', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'testbk';
                    var tstbk='';
                    if($('#testbnk').prop("checked") == true){tstbk="yes";}else{tstbk="no";}
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            tstbk: tstbk,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
               $(document).on('click', '#gpstype', function () {
                    
                    
                    url = b_url + 'setting_action.php';
                    var setting_action = 'gps_type';
                    var gps_type = $('#gps_type').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            gps_type: gps_type,
							
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
			    $(document).on('click', '#paymentoption', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'paymentop';
                    var ideal = $("input[name='ideal']:checked").val();
                    var mastercard = $("input[name='mastercard']:checked").val();
                    var paypal = $("input[name='paypal']:checked").val();
					var cash = $("input[name='cash']:checked").val();
					var pin = $("input[name='pin']:checked").val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            ideal: ideal,
							mastercard: mastercard,
							paypal: paypal,
							cash: cash,
							pin: pin
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {

                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
			   $(document).on('click', '#update_delcode', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'updatcode';
                    var delcheck = $("input[name='delcheck']:checked").val();
                    var delcode = $('#delcode').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            delcheck: delcheck,
							delcode: delcode,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {

                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
			   $(document).on('click', '#update_qrcode', function () {
                    url = b_url + 'setting_action.php';
                    var setting_action = 'updatqrcode';
                    var qrcheck = $("input[name='qrcheck']:checked").val();
                    //var delcode = $('#delcode').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            setting_action: setting_action,
                            qrcheck: qrcheck,
							
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {

                                $('#notimsg').delay(3000).fadeOut('1000');
                                load();
                            }, 1000);
                        }
                    });
                });
            </script>
    </body>
</html>

