<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
 date_default_timezone_set("Asia/Calcutta");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
     <link rel="stylesheet" href="theme_assets/jquery.cleditor.css" />
    <script src="theme_assets/jquery.min.js"></script>
    <script src="theme_assets/jquery.cleditor.min.js"></script>
  
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
                      Redeem Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Redeem Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send Redeem Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Redeem Module</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        

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
										 
                                        <form id="redeem_form" action="" method="post">
                                 
                                            <div class="form-group">
                                            
                                            <div class="row">

                                          

                                                    <div class="col-md-12 col-sm-12">
                                                    <div class="msgss" style="display:none;"></div>
                                                   
													                           <label>Enter Coupon Code</label>
                                                    <input type="text" class="form-control" id="code" name="code" minlength="6" maxlength="6" placeholder="Enter Coupon code">



                                                </div>

                                            </div>
                                        </div>
                                            
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" onclick="save_redeem(this)" id="
                                                "><i  class="fa fa-save"></i> Redeem Now</button>
                                            </div>
                                            <br/><br/>
                                        </form>
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
 
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>

   
   
  <script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>


function save_redeem(that,id) {
// alert($("#discount").val());

var code=$("input[name=code]").val();

if (code == "") {
        alert("Coupon field is required!");
            $("input[name=code]").focus();
            return false;
 } 

  
$.ajax({  
    type: "POST",  
    url: "ajax_redeemed_code.php",  
    data: { "code": code},
    success: function(data) { 
 
        var json = $.parseJSON(data);

         if(json.e_sucess){
       		  $(".msgss").show().html('<div class="alert alert-success" role="alert">'+json.e_sucess+'</div>');
  			}else{
 				$(".msgss").show().html('<div class="alert alert-danger" role="alert">'+json.e_msg+'</div>');
  			}
    

    }
});



    }
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

    </body>
</html>