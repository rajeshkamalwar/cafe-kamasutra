<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
include 'function.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
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
            .chkbox-div{width:100%; height: 65px; overflow-y: scroll}
            .chkbox-div .checkbox{margin-top: 0px !important;margin-bottom: 5px !important; }
        </style>
		<style>
	.showbutton {
  position: absolute;
 transform: translate(45%, -191%);
  -ms-transform: translate(-50%, -50%);
  
  background-color: gray;
color: white;
  font-size: 16px;
  padding: 12px 16px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}
			.showbutton12 {
  position: absolute;
 transform: translate(158%, -191%);
  -ms-transform: translate(-50%, -50%);
  
  background-color: gray;
color: white;
  font-size: 16px;
  padding: 12px 16px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
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
                        Video
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Video</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                     <p id="del_notimsg"></p>
										 <div class="col-sm-12">
                                       <div class="bgColor">
										   <h3>Upload Video</h3>
										    <p id="notimsg"></p>
<form id="form" action="videoupload_action.php" method="post" enctype="multipart/form-data">
<div class="col-sm-3">
<input id="uploadImage" type="file" class="form-control" id="video" name="video" />
	</div>
	<div class="col-sm-3">
<input type="text" name="name" class="form-control" id="name" Placeholder="Video Title"/>
	</div>
	<div class="col-sm-3">
<input class="btn btn-success" type="submit" name="submit" value="Upload">
	</div>
	<div id="loader1" style="display: none; color:red ">
					Please wait video uploading to server....
				</div>
	</form>
</div>
	
</div>
                                   
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
									 <h3 style="margin-left: 19px;">View Videos</h3>
                                    <div class="col-sm-12">
                                        <table class="table table-hover" id="list_data">

                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->

                <!-- View Modal -->
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">View Dish's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->

                                    <div class="box-body" id="view_dish_data">

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"  data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.View Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                             <form id="formedit" action="videoupload_action.php" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Video Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                     <p id="editnotimsg"></p>
                                    <div class="box-body" id="edit_dish_data">
                                    </div>
                                    <!-- /.box-body -->
									 <div id="loader" style="display: none;color:red ">
					Please wait video uploading to server....
				</div>
                                </div>
								
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="edit_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="submit" name="submit"  class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Status Change Modal -->
               
                <!-- Delete Modal -->
                <div class="modal modal-danger fade" id="modal-delete">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Video</h4>
                               
                            </div>
							 <form role="form">
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete item. This operation can not be undo.</p>
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
<div class="modal modal-danger fade" id="modal-imagedlt">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Remove Video</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete image. This operation can not be undo.</p>
                                <input type="hidden" value="" id="dele_hidden">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default " id="del_imgclose" data-dismiss="modal">Close</button>
                                <button type="button" id="del_image" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
				
				<!-- /.View-image -->
				  <div class="modal fade" id="modal-viewimage">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">View Video</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body" id="view_img_data">

                                    </div>
                                </div>
                               
                            
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>

            <!--// main content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function (e) {
 $("#formedit").on('submit',(function(e) {
	 e.preventDefault();
     $.ajax({
         url: "videoupload_action.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
	   $('#loader').show();
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data) {
    load();
$('#loader').hide();
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            clear();
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);  
   }							
    });
 }));
});
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "videoupload_action.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
	   $('#loader1').show();
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data) {
    load();
$('#loader1').hide();
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            clear();
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);  
   }							
    });
 }));
});
</script>
<?php include 'footer.php'; ?>

            <script type="text/javascript">

                function load() {
                    url = b_url + 'videoupload_action.php';
                    var video_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {video_action: video_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {
                    $('#name').val('');
                    $('#video').val('');
                }

                $(function () {
                    load();
                });

               
                $(document).on('click', '#refersh', function () {
                    load();
                });
                
				 
                $(document).on('click','#edit_record',function(){
                    var video_id = $(this).attr("dataid");
                    var video_action = 'edit_load_record';
                    url = b_url + 'videoupload_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            video_id: video_id,
                            video_action: video_action,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#edit_dish_data').html('');
                            $('#edit_dish_data').html(data);
                        }
                }); 
            });
             
               
              
                $(document).on('click', '#delete_record', function () {
                    var video_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(video_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var video_id = $("#dele_hidden").val(); 
					//alert(video_id);
                    var video_action = 'delete';
                    url = b_url + 'videoupload_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            video_id: video_id,
                            video_action: video_action,
                        },
                        dataType: "html",
                        success: function (data)
                        {

                            load();
                            $("#del_close").click();
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

