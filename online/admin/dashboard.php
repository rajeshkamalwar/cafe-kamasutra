<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome <?= $name ?></title>
<?php include 'header.php'; ?>
</head>

<body class="hold-transition <?= theme_skin ?> sidebar-mini">
	<audio autoplay>
  <source src="notify.ogg" type="audio/mpeg">
</audio>
<div class="wrapper">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
<!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!--// left-fixed -navigation-->
</div>
<!-- header-starts --><?php include 'top-strip-menu.php'; ?><!--// header-starts -->


<!-- main content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Dashboard
<small></small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>
   
<!-- Main content -->
<section class="content">
<div class="container">
            <div class="row">
                <div class="col-sm-7 rk_tg">
                    <div class="row contentdash" >
                    </div>
                </div>
                <div class="col-sm-4 rkg_tp">
                	<div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                        <i class="fa fa-calendar"></i>
                        
                        <h3 class="box-title">Calendar</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                        <!-- button with a dropdown -->
                        
                        <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                        </div>
                        <!-- /. tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.box-body -->
                        
                        </div>
					<form name="timeset_form" id="timeset_form">
                                            <div class="row">
												  <p id="del_notimsg"></p>
												
                                                <div class="col-md-12 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">Status</label>
                                                        
                  <select class="form-control" name="status" id="status">
					  <option>Active</option>
					   <option>Inactive</option>
															</select>
                
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1;?>"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_nl" name="restra_holi_nl"  placeholder="Message in <?= lang2;?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_time_update"><i  class="fa fa-save"></i> Update</button>
                                            </div>
                                            <br/><br/>
                                        </form>
                 </div>
            </div>
</div>



<!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>

<!--// main content -->

<footer class="main-footer">
<div class="pull-right hidden-xs">
<b>Version</b> 3.0.0
</div>
<strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
reserved.
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="theme_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>

	
$(document).ready(function(){
//load_last_notification();
setInterval(function(){
	 
load_last_notification();
}, 300);

function load_last_notification()
{
$.ajax({
url:"dashboardorder.php",
method:"POST",
success:function(data)
{
	
$('.contentdash').html(data);

}
})
}

});
</script>
<script>
$.widget.bridge('uibutton', $.ui.button);

// $('.sidebar-menu li').click(function(){
// $('.sidebar-menu li').removeClass("active");
// $(this).addClass("active");
//});

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
                function load() {
                    url = b_url + 'day_action.php';
                    var action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action},
                        dataType: "html",
                        success: function (data)
                        {
                            console.log(data);
                            $('#timeset_form').html(data);
                        }
                    });
                }
                
                $(function () {
                    load();
                });
                
                $(document).on('click', '#set_time_update', function () {
                    var status=$('#status').val();
                    var restra_holi_en=$('#restra_holi_en').val();
                    var restra_holi_nl=$('#restra_holi_nl').val();
                    var action = 'update';
                    url = b_url + 'day_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            status:status,
                            restra_holi_en:restra_holi_en,
                            restra_holi_nl:restra_holi_nl,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                           // load();
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                    
                });
                
                
        $(document).on('click', '.printorderbtn2', function () {
			   var thiss = $(this);
		 	 var showresultof = $(this).attr('data-dataid');			 
                var action = 'printorders';			 
                   $.ajax({
                        type: "POST",
                       url: "all_order_action_print.php",
                         data: {showresultof: showresultof, action: action },
                        dataType: "html",
                        success: function (data1)
                        {
							   // $('#userInfo').html(data1);
							 //  var printContent = document.getElementById('userInfo');
								 var WinPrint = window.open('', '', 'width=900,height=650');
								 WinPrint.document.write(data1);
								 WinPrint.document.close();
								 WinPrint.focus();
								 WinPrint.print();
								 WinPrint.close();	     
                        }
                    });	 
	  });	                    
        
            </script>


</body>
</html>
