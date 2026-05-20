<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
    <link rel="stylesheet" href="theme_assets/jquery.cleditor.css" />
    <script src="theme_assets/jquery.min.js"></script>
    <script src="theme_assets/jquery.cleditor.min.js"></script>
  <script type="text/javascript">
        $(document).ready(function () { $("#restra_holi_en").cleditor(); });
		        $(document).ready(function () { $("#restra_holi_nl").cleditor(); });

  $(function(){
    $(".chargeoptionnew").click(function(){
      if($(this).val() === "fixamount"){
        $("#extraamt").show();
		$("#extra").hide();
		$("#freedishamt").hide();
	  } else if($(this).val() === "percentage") {
		  $("#extraamt").hide();
       	  $("#extra").show();
		  $("#freedishamt").hide();
	  } else { 
		$("#extraamt").hide();
        $("#extra").hide();	
		$("#freedishamt").show();
			}
    });
  });
</script>	
    <script>
$(document).ready(function(){
   $("#days").keyup(function(){
      var days = $(this).val().trim();
      if(days != ''){
         $.ajax({
            url: 'countcustomers.php',
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
        <style>
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
                      Newsletter
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Lost Customer</li>
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
                                    <h3 class="box-title">Send Coupon for Lost Customer</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Newsletter</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.About section -->
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <form name="timeset_form" >
                                            <div class="form-group">
                                            <div class="row">
	<?php $list_code = $mysqli->query("Select * From `lostcustomercoupon` where id = '1' ");
        $result_row = $list_code->fetch_array();?>
                                                <div class="col-md-12 col-sm-12">
													<label>Korting</label><br/>
													send this customer a promotional code for one<br/>
                                                    <input type="radio" id="discount" name="discount" class="chargeoptionnew" value="fixamount" <?php if($result_row['discount']=='fixamount'){?> checked <?php } ?>>fixed amount discount<br/>
	 												<input type="radio" id="discount" name="discount" class="chargeoptionnew" value="percentage" <?php if($result_row['discount']=='percentage'){?> checked <?php } ?>>percentage discount<br/>
													<input type="radio" id="discount" name="discount" class="chargeoptionnew" value="freedish" <?php if($result_row['discount']=='freedish'){?> checked <?php } ?>>Free Dish<br/>
                                                </div>
												
												<div class="col-md-12 col-sm-12" id="extra" <?php if($result_row['discount']!='percentage'){?> style="display:none;" <?php } ?>>
													<label>Percentage Amount</label>
													<input type="text" name="percentageamt" id="percentageamt" value="<?php echo $result_row['per_amount']; ?>" class="form-control">
												</div>
												<div class="col-md-12 col-sm-12" id="extraamt" <?php if($result_row['discount']!='fixamount'){?> style="display:none;" <?php } ?> >
													<label>Fixed Amount</label>
													<input type="text" name="fex_amt" id="fex_amt" value="<?php echo $result_row['fix_amount']; ?>" class="form-control">
												</div>
												<div class="col-md-12 col-sm-12" id="freedishamt" <?php if($result_row['discount']!='freedish'){?> style="display:none;" <?php } ?> >
													<label>Free Dish</label>
													<input type="text" name="freedishname" id="freedishname" value="<?php echo $result_row['freedishname']; ?>" class="form-control">
												</div>
                                                <div class="col-md-12 col-sm-12">
													<label>Valid Days</label>
													<input type="text" id="validdays" name="validdays"  class="form-control" placeholder="Ex: 5 days" value="<?php echo $result_row['validdays']; ?>">
                                                </div>
                                                 <div class="col-md-12 col-sm-12">
													<label>Message in english</label>
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1;?>"><?php echo $result_row['restra_holi_en']; ?></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
													<label>Message in dutch</label>
                                                    <textarea class="form-control" rows="2" id="restra_holi_nl" name="restra_holi_nl"  placeholder="Message in <?= lang2;?>"><?php echo $result_row['restra_holi_nl']; ?></textarea>
                                                </div>
												  <div class="col-md-12 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">Status</label>
                                                        
                  <select class="form-control" name="status" id="status">
					  <option <?php if($result_row['status']=='Active'){?>selected <?php } ?>>Active</option>
					   <option <?php if($result_row['status']=='Inactive'){?>selected <?php } ?>>Inactive</option>
															</select>
                
                                                    </div>
                                                </div>
												 </div></div>
                                             <div class="form-group">
                                        
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_coupon_update"><i  class="fa fa-save"></i>Submit</button>
                                            </div>
                                            </div><br/><br/>
								  </form>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-1"></div>
                    </div><!-- /.row -->
   </div> </div>
                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->


<style>
  #alert_popover
  {
   display:block;
   position:fixed;
   top:60px;
   left:550px;
  }
  
  .alert_default
  {
   color: #333333;
   background-color: #f2f2f2;
   border-color: #cccccc;
  }
  </style> 
 <div id="alert_popover">
   
     <div class="content12">
      
     </div>
    
   </div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>
  <script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
$(document).ready(function(){
 setInterval(function(){
  load_last_notification();
 }, 5000);
 function load_last_notification()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('.content12').html(data);
	 
   }
  })
 }
});
</script>
<!-- Bootstrap 3.3.7 -->
<script src="theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="theme_assets/bower_components/raphael/raphael.min.js"></script>
<script src="theme_assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="theme_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="theme_assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="theme_assets/bower_components/moment/min/moment.min.js"></script>
<script src="theme_assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="theme_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="theme_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="theme_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="theme_assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="theme_assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme_assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme_assets/dist/js/demo.js"></script>
<script src="theme_assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">
      $(document).on('click', '#print_record', function () {
                    url = b_url + 'online_orders_actions.php';
                    var gift_action = 'print';
                    var ot_id = $(this).attr("dataid");
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action: gift_action,
                            ot_id: ot_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            document.body.innerHTML = data;
                            setTimeout(function () {
                                window.print();
                                location.reload();
                            }, 500);
                        }
                    });
                });

            </script>
            <script type="text/javascript">

                  
                $(document).on('click', '#set_coupon_update', function () {

                     var restra_holi_nl=$('#restra_holi_nl').val();
					var restra_holi_en=$('#restra_holi_en').val();
                     var discount = $("input[name='discount']:checked").val(); 
                     var fex_amt=$('#fex_amt').val();
					  var freedishname=$('#freedishname').val();
					 var percentageamt=$('#percentageamt').val();
					 var validdays=$('#validdays').val();
					var status = $('#status').val();
                    var action = 'coupun_update';
                    url = b_url + 'mailformat_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            restra_holi_en:restra_holi_en,
							restra_holi_nl:restra_holi_nl,
                            discount:discount,
							fixamt:fex_amt,
							percentageamt:percentageamt,
							validdays:validdays,
							freedishname:freedishname,
							status:status
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
							 location.reload();
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                    
                });
				  
                
                          
        
            </script>
    </body>
</html>