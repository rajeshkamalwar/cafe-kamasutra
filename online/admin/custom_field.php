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

.auto-approve-checkbox {
    margin-left: 22px;
    color: red;
    font-size: 15px;
}

.auto-approve-checkbox #auto-approve {
position:absolute;
left:5px;
   
}

.container {
    width: 978px;
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
                      Custom Field For Reservation Form
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Custom Field</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Custom Field Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Custom Field Module</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        

                    <div class="row">
                       
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
       
    <div class="box-body table-responsive no-padding">

               <div class="container">
				   <form name="timeset_form" id="timeset_form">

				 <div class="row">
                                                <div class="col-md-6 col-sm-12">  
											<div class="form-group">
                                            <label for="attributes price">Custom Field Name</label>
                                            <input type="text" id="cfs" name="cfs" class="cfs" checked="">
											
                                        </div>
												  </div></div>
				<div class="row">
                            <div class="col-md-12 col-sm-12">                                       
                            
							
							<div class="form-group">
                            <label for="attributes price">Status</label>
                            <select id="status" name="status"> 
							<option value="1">Active</option>
							<option value="0">Inactive</option>
							</select>
                            </div>
                            </div>
                            </div>
                            <div class="pull-right">
                            <input type="submit" class="btn btn-primary" id="submit" value="update">
                                            </div>
					      	<?php 
								$chk_in_odrdis_tab = "SELECT * FROM `res_custom_field`";      
									 $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
								   $email_result1=mysqli_fetch_assoc($chk_in_odrdis_tab_result);
								   $fieldname = $email_result1['field_name'];
								echo 'Current field is : <b>' .$fieldname.'</b>';
								?>
                                            <br><br>
</form> 		   
                
</div>               

	 
		
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
 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea'});tinymce.init({ selector:'#footer'});</script>
					
<script>
$(document).ready(function (e) {
 $("#timeset_form").on('submit',(function(e) {
	 e.preventDefault();
	               if ($("#cfs").val() == "") {
                        alert("Please provide fied name!");
                        $("#cfs").focus();
                        return false;
                    }
                
	
                
  $.ajax({
         url: "ajax_custom_field.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
	
    //$("#preview").fadeOut();
	   $('#loader').show();
		 
    $("#err").fadeOut();
   },
   success: function(data) {
	 console.log(data);
 
	  $('#cfs').val();
   }							
    });
 }));
});
</script>
					
    </body>
</html>