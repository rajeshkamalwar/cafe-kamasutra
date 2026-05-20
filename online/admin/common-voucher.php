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
	  } else {
		  $("#extraamt").hide();
        $("#extra").show();
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
                                    <h3 class="box-title">Send Coupon for register Customer</h3>
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
										
												 <div class="col-md-12 col-sm-12">
													<label>Delivery Option</label><br/>
													<select name="delivery_type" id="delivery_type" class="form-control" >
														<option value="default">Select Delivery type</option>
														<option value="pickup">Pick up</option>
														<option value="delivery">Delivery</option>
													 </select>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
													<label>Korting</label><br/>
													send this customer a promotional code for one<br/>
                                                    <input type="radio" id="discount" name="discount" class="chargeoptionnew" value="fixamount">fixed amount discount<br/>
	 												<input type="radio" id="discount" name="discount" class="chargeoptionnew" value="percentage">percentage discount<br/>
                                                </div>
												<div class="col-md-12 col-sm-12" id="extra" style="display:none;">
													<label>Percentage Amount</label>
													<input type="text" name="percentageamt" id="percentageamt" class="form-control">
												</div>
												<div class="col-md-12 col-sm-12" id="extraamt" style="display:none;">
													<label>Fixed Amount</label>
													<input type="text" name="fex_amt" id="fex_amt" class="form-control">
												</div>
                                                <div class="col-md-12 col-sm-12">
													<label>Valid Days</label>
													<input type="text" id="validdays" name="validdays"  class="form-control" placeholder="Ex: 5 days" required>
                                                </div>
												 <div class="col-md-12 col-sm-12">
													<label>Message</label>
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1;?>"></textarea>
                                                </div>
                                               
                                               <!-- <div class="col-md-12 col-sm-12">
													<label>Mail Text</label>
													<textarea name="mailtext" id="mailtext"></textarea>
												</div>
                                            </div>
                                        </div>-->
                                             <div class="form-group">
                                        </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_coupon_update"><i  class="fa fa-save"></i> Send</button>
                                            </div>
                                            <br/><br/>
                                        </form>
                                    </div>
                                </div>
								 <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
								<table class="table table-hover" id="list_data">
                                        </table>
									 </div>
								</div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-1"></div>
                    </div><!-- /.row -->
    <!-- Delete Modal -->
                <div class="modal modal-danger fade" id="modal-delete">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Coupon</h4>
                               
                            </div>
							 <form role="form">
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete this User. This operation can not be undo.</p>
                                <input type="hidden" value="" id="dele_hidden">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
                                <button type="button" id="del_rec" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
                                
                            </div>
								 </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Delete Modal -->
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
      <b>Version</b> 1.0.0
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
                    url = b_url + 'common-voucher_action.php';
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
function clear() {

                    $('#days').val('');
                    $('#fex_amt').val('');
                    $('#percentageamt').val('');
                    $('#validdays').val('');
                       $('input[name="discount"]').prop('checked', false);
                }
                   function load() {
                    url = b_url + 'common-voucher_action.php';
                    var action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }
                
                $(function () {
                    load();
                });
                
                $(document).on('click', '#set_coupon_update', function () {
                   if ($("#days").val() == "") {
                        alert("Please provide Number of days!");
                        $("#days").focus();
                        return false;
                    }
					if($('input[type=radio][name=discount]:checked').length == 0)
    				  {
         				alert("Please select Discount type");
        				 return false;
     				  }
					if ($("#validdays").val() == "") {
                        alert("Please provide Valid days!");
                        $("#validdays").focus();
                        return false;
                    }
					var discount = $("input[name='discount']:checked").val(); 
      if(discount=='fixamount'){
		  if ($("#fex_amt").val() == "") {
                        alert("Please provide Fix amount!");
                        $("#fex_amt").focus();
                        return false;
                    }
	  } else { 
		  if ($("#percentageamt").val() == "") {
                        alert("Please provide Percentage amount!");
                        $("#percentageamt").focus();
                        return false;
                    }
	  }
					if ($("#delivery_type").val() == "default") {
                        alert("Select Delivery type");
                        $("#delivery_type").focus();
                        return false;
                    }
                     var days=0;
                     
                     var fex_amt=$('#fex_amt').val();
					 var percentageamt=$('#percentageamt').val();
					 var validdays=$('#validdays').val();
					var restra_holi_en=$('#restra_holi_en').val();
					var delivery_type = $('#delivery_type').val();
                    var action = 'coupun_update';
                    url = b_url + 'common-voucher_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                             days:days,
                            discount:discount,
							fixamt:fex_amt,
							percentageamt:percentageamt,
							validdays:validdays,
							delivery_type:delivery_type,
							restra_holi_en:restra_holi_en
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
							load();
							clear();
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                    
                });
				  $(document).on('click', '#delete_record', function () {
                    var id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(id);
                });
                  $(document).on('click', '#del_rec', function () {
                    var id = $("#dele_hidden").val(); //console.log(id);
                    url = b_url + 'common-voucher_action.php';  //console.log(url);  console.log();
                    var action = 'delete';
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action, id: id},
                        dataType: "html",
                        success: function (data)
                        {
                            $("#del_close").click();
                            load();
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });

                });

                
                          
        
            </script>
    </body>
</html>