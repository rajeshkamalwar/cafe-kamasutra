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
  <style>
      input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
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
                      Coupon Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Coupon Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send Coupon Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about coupon expire Module</p>

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
										 
                                        <form id="coupon_expire_form" action="" method="post">
                                 
                                            <div class="form-group">
                                            
                                            <div class="row">

                                          

                                                    <div class="col-md-12 col-sm-12">
                                                    <div class="msg" style="display:none;"></div>
                                                   
													                           <label>Enter Coupon Expiry</label>
                                                    <input type="number" class="form-control" id="expire" name="expire" placeholder="Enter Coupon Expiry (in days)">

                                                   <?php  

                                                    $sql = "select * from promotion_discount_code_tbl";
                                                         $result = mysqli_query($mysqli,$sql);
                                                         $row=mysqli_fetch_assoc($result);
                                                         $expire_in_days=$row['expire_in_days'];
                                                        if(!empty($expire_in_days) && isset($expire_in_days)){

                                                        
                                                         ?>
                                                        
                                                    <h4 id="t">You set <b><?php echo $expire_in_days; ?></b> days for coupon codes!. </h4>

                                                    <?php }?>
                                                </div>

                                            </div>
                                        </div>
                                            
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" onclick="save_redeem(this)" id="
                                                "><i  class="fa fa-save"></i> Update Now</button>
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
 

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>


<script>


$(document).ready(function(){

 setInterval(function(){
  $('.msg').hide();


 }, 8000);

});
function save_redeem(that){
 
   if ($("#expire").val() == "") {
        alert("Coupon Expiry is required!");
            $("#expire").focus();
            return false;
        }
                

var str = $("form#coupon_expire_form").serializeArray();
$.ajax({  
    type: "POST",  
    url: "ajax_expire.php",  
    data: str,  
    success: function(data) { 
           $("form#coupon_expire_form").trigger("reset");
      $(".msg").show().html(data);
      $("#t").load(location.href + " #t");

 
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