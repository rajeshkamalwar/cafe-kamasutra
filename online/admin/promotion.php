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
 #promotn_modul54 .form-control {    margin-bottom: 10px;}
  span.p-req {
    color: red;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 50px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 2px 12px 7px 12px;
    border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}	  
  </style>
  
  
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
        


        <div id="promotn_modul54" class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Promotion Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Promotion Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send Promotion Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Promotion Module</p>

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
										 <p class="pro-text" style="text-align:center;padding: 12px;line-height: 1.7;">Dear Geust,<br>Thank you for your visit. We hope you had delicious food and enjoy the service.We hope to give us the opportunity to welcome you again. if you can provide your E-mail address or Facebook Id, we will send you a discount coupon code for your next visit.</p>
                                        <form id="promotion_form" action="" method="post">
                                 
                                            <div class="form-group">
                                            
                                            <div class="row">

                                          

                                                    <div class="col-md-12 col-sm-12">
                                                    <div class="msg" style="display:none;"></div>
                                                    <div class="msg2" style="display:none;"></div>
														<label>Name <span class="p-req">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name">



                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <label>Email Address <span class="p-req">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Email Address">


                                                
                                                </div>
                                                  <div class="col-md-12 col-sm-12">
                                                    <label>Facebook Id</label>
                                                    <input type="text" class="form-control" id="facebook_id" name="facebook_id"  placeholder="Enter facebook id">


                                                
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                   
                                                    <input type="checkbox" class="" id="allow" name="allow"> <label>Would you allow us to Tag you on Facebook?</label>


                                                
                                                </div>

                                                
                                               
                                                
                                            </div>
                                        </div>
                                            
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" onclick="save_promotion(this)" id="
                                                "><i  class="fa fa-save"></i> Save</button>
                                            </div>
                                            <br/><br/>
                                        </form>
                                    </div>


                                </div>

                                <br>
                                <br>
							 <div class="box-body table-responsive no-padding" id="refresh">

                                    
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

  <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button> 
 <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>  
  <script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>


$(document).ready(function(){

 setInterval(function(){
  load_last_notification();
  $('.msg').hide();
  $('.pop_msg').hide();

 }, 12000);

setInterval(function(){

  $('.msg2').hide();
  $('.msg3').hide();
 

 }, 9000);


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

// $(document).ready(function(){

//     $("input[name='discount']").on('keyup', function() {
//       var discount= $(this).val();
//       $(this).val(discount+'%');
//     });
// });

function save_promotion(that){
 
   if ($("#name").val() == "") {
        alert("Name is required!");
            $("#name").focus();
            return false;
        }
    if ($("#email").val() == "") {
        alert("Email Address is required!");
        $("#email").focus();
        return false;
   }

            

var str = $("form#promotion_form").serializeArray();
$.ajax({  
    type: "POST",  
    url: "ajax_insert.php",  
    data: str,  
    success: function(data) { 
    	   $("form#promotion_form").trigger("reset");
      $(".msg").show().html(data);
      $("#refresh").load(location.href + " #refresh");

 
    }
});


}

function close_model(th){

    $("#refresh").load(location.href + " #refresh");
}


function redeem_code(that,id) {
// alert($("#discount").val());

  var code=$(that).parent().parent().find("input[name=code]").val();
  var user_id=$(that).parent().parent().find("input[name=id]").val();
  var discount=$(that).parent().parent().find("input[name=discount]").val();
  var dish=$(that).parent().parent().find("input[name=dish]").val();
  var name=$(that).parent().parent().find("input[name=names]").val();
  var email=$(that).parent().parent().find("input[name=email]").val();
  var expire_time='<?php echo date('Y-m-d H:i:s', strtotime('+10 day', strtotime(date('Y-m-d H:i:s'))));?>';
          
if (discount!="" && dish!="") {
        alert("Atleast one field is required!");
          return false;
        }else if(discount=="" && dish==""){
        
          alert("Atleast one field is required!");
           return false;
        }  


$.ajax({  
    type: "POST",  
    url: "ajax_redeem.php",  
    data: { "code": code, "user_id": user_id, "discount": discount,"dish": dish,"expire_time": expire_time,'name':name,'email':email },
    success: function(data) { 
 
    
         $(".pop_msg").show().html('<div class="alert alert-success" role="alert">Discount Coupon code is generated and mail send to your registered email address!</div>');
        var discount=$(that).parent().parent().find("input[name=discount]").val('');
        var dish=$(that).parent().parent().find("input[name=dish]").val('');
    }
});



    }

   function delete_pro(t,id) {
   	var del_id=id;
   if(del_id){
		if(confirm("Are you sure you want to delete this?"))
		{
	  $.ajax({  
	    type: "POST",  
	    url: "ajax_delete.php",  
	    data: { "id": del_id },
	    success: function(data) { 
	 
	        $(".msg").hide();
	         $(".msg2").show().html('<div class="alert alert-danger" role="alert">Data deleted successfully</div>');
	          $("#refresh").load(location.href + " #refresh"); 
	    }
	});


	    }
   }

  }

   function reminder(tz,id) {
    var id=id;
   if(id){

    $.ajax({  
      type: "POST",  
      url: "ajax_reminder.php",  
      data: { "id": id },
      success: function(data) { 
   
          $(".msg3").hide();

           $(".msg3").show().html('<div class="alert alert-info" role="alert">Reminder mail sent</div>');
    
      }
  });


      }
   

  }
 function view_data(tt,id) {

    var id =id;
   if(id){

    $.ajax
    ({ 
        url: 'pro_inner_data.php',
        data: {"id": id},
        type: 'post',
        success: function(result)
        {

      $("#demo-"+id).empty();
         $("#demo-"+id).html(result); 
         
        }
    });
 }
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