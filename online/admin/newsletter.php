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
   <script>
      $(document).ready(function () { $("#newslettertext").cleditor(); });
	  $(document).ready(function () { $("#restra_holi_nl").cleditor(); });

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
                        <li class="">Menu</li><li class="active">Send Newsletter</li>
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
                                    <h3 class="box-title">Send Newsletter</h3>

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
                            <label class="pull-right">Promation User mail</label>
                                    <input type="radio" class="pull-right" value="1" id="pro_mail" name="pro_mail">
                                   <label class="pull-right">Register User mail</label>
                                    <input type="radio" class="pull-right" value="2" id="reg_users" name="pro_mail">
											
									 <label class="pull-right">Import User mail</label>
                                    <input type="radio" class="pull-right" value="3" id="imp_users" name="pro_mail">	
											
									<label class="pull-right">Reservation User</label>
                                    <input type="radio" class="pull-right" value="4" id="res_users" name="pro_mail">		
                                            <div class="form-group">
                                            
                                            <div class="row">


<div class="col-md-12 col-sm-12">


  
													<label>Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject"  placeholder="Enter subect"></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
													<label>Message </label>
                                                    <textarea class="form-control" rows="2" id="newslettertext" name="newslettertext"  placeholder="Message"></textarea>
                                                </div>
                                                
                                            </div>
                                        </div>
                                             <div class="form-group">
                                            
                                           
                                        </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_time_update"><i  class="fa fa-save"></i> Create</button>
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

<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
  
//  $('.sidebar-menu li').click(function(){
//    $('.sidebar-menu li').removeClass("active");
//    $(this).addClass("active");
//});

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

                function load() {
                    url = b_url + 'newsletter_action.php';
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
				
		  function final_addtocart(subject_m,message_m) {
                    url = b_url + 'newsletter_action.php';
                    var action = 'saveinadata';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {subject_m: subject_m, message_m: message_m, action: action},
                        dataType: "html",
                        success: function (data)
                        {  
							 
                                
							  load();
							
                        }
                    });
                }		
				
          
				
				
				
                $(function () {
                    load();
                });
                $(document).on('click', '#set_time_update', function () {

                     var newslettertext=$('#newslettertext').val();
                     var subject=$('#subject').val()
                     var radio=$("input[type='radio'][name='pro_mail']:checked").val();
                    
                    
                      if (radio=='1') {
                         
                         //send mail to all promotion users// 

                                                     
                            $.ajax
                            ({ 
                                url: 'promotion_email.php',
                                data: {
                                     action:'pro_mail',
                                     subject:subject,
                                    newslettertext:newslettertext
                                    
                                },
                                type: 'post',
                               success: function (data)
                                {
                               
									
									
								final_addtocart(subject,newslettertext);   	
                                  
                                $('input[name="pro_mail"]').prop('checked', false);
                                $('input[name="subject"]').val('');
                                 $('#newslettertext').empty();
                                    $('#del_notimsg').html('');
                                    $('#del_notimsg').html(data);
                                    $("#del_notimsg").fadeIn(1000);
                                    setTimeout(function () {
                                        $('#del_notimsg').delay(3000).fadeOut('1000')
                                    }, 1000);

                                    return false;
                                }
                            });




                            }


                             else if (radio=='2') {
                        
                         //send mail to all promotion users// 

                                                     
                            $.ajax
                            ({ 
                                url: 'promotion_email.php',
                                data: {
                                     action:'reg_users',
                                     subject:subject,
                                    newslettertext:newslettertext
                                    
                                },
                                type: 'post',
                               success: function (data)
                                {
                                  
                                    final_addtocart(subject,newslettertext);   
                                $('input[name="pro_mail"]').prop('checked', false);
                                $('input[name="subject"]').val('');
                                  $('#newslettertext').empty();
                                    $('#del_notimsg').html('');
                                    $('#del_notimsg').html(data);
                                    $("#del_notimsg").fadeIn(1000);
                                    setTimeout(function () {
                                        $('#del_notimsg').delay(3000).fadeOut('1000')
                                    }, 1000);

                                    return false;
                                }
                            });




                            }
					
					 else if (radio=='3') {
                        
                         //send mail to all promotion users// 

                                                     
                            $.ajax
                            ({ 
                                url: 'promotion_email.php',
                                data: {
                                     action:'imp_users',
                                     subject:subject,
                                    newslettertext:newslettertext
                                    
                                },
                                type: 'post',
                               success: function (data)
                                {
                                  
                                     final_addtocart(subject,newslettertext);    
                                $('input[name="pro_mail"]').prop('checked', false);
                                $('input[name="subject"]').val('');
                                   $('#newslettertext').empty();
									
                                    $('#del_notimsg').html('');
                                    $('#del_notimsg').html(data);
                                    $("#del_notimsg").fadeIn(1000);
                                    setTimeout(function () {
                                        $('#del_notimsg').delay(3000).fadeOut('1000')
                                    }, 1000);

                                    return false;
                                }
                            });




                            }
                            
                          else if (radio=='4') {
                        
                         //send mail to all promotion users// 

                                                     
                            $.ajax
                            ({ 
                                url: 'promotion_email.php',
                                data: {
                                     action:'res_users',
                                     subject:subject,
                                    newslettertext:newslettertext
                                    
                                },
                                type: 'post',
                               success: function (data)
                                {
                               final_addtocart(subject,newslettertext);   
                                  
                                $('input[name="pro_mail"]').prop('checked', false);
                                $('input[name="subject"]').val('');
                                   $('#newslettertext').empty();
                                    $('#del_notimsg').html('');
                                    $('#del_notimsg').html(data);
                                    $("#del_notimsg").fadeIn(1000);
                                    setTimeout(function () {
                                        $('#del_notimsg').delay(3000).fadeOut('1000')
                                    }, 1000);

                                    return false;
                                }
                            });




                            }
                            

                            else{
								alert("Please choose 1 option");
              				 
								 
                  /*  var action = 'update';
                    url = b_url + 'newsletter_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                             subject:subject,
                            newslettertext:newslettertext
							
                        },
                        dataType: "html",
                        success: function (data)
                        {
							
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    }); */
                    }
                });
                $(document).on('click', '#delete_record', function () {
                    var id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(id);
                });
                  $(document).on('click', '#del_rec', function () {
                    var id = $("#dele_hidden").val(); //console.log(id);
                    url = b_url + 'newsletter_action.php';  //console.log(url);  console.log();
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