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
                        Dishes
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Dishes</li>
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
                                    <h3 class="box-title">About Dishes</h3>

                                    <div class="box-tools pull-right">
										<a href="videoupload.php"><button class="btn btn-primary">Upload Video</button></a>
										<a href="iconupload.php"><button class="btn btn-primary">Upload Icon</button></a>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about dishes or what we can do in this section.</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-8">
                                            <h3 class="box-title">Available Dishes</h3>
                                        </div>
                                        <div class="col-lg-4 ">

                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
                                                <button  id="vari_div" type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
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
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->


                <!-- Add Modal -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add New Dish</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Dish Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" class="form-control" id="dish_name_new_en" name="dish_name_new_en" placeholder="Dish name in <?= lang1; ?>" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" class="form-control" id="dish_name_new_nl" name="dish_name_new_nl" placeholder="Dish name in <?= lang2; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Dish Description</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_add_en" name="dish_description_add_en"  placeholder="Dish description in <?= lang1; ?>"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="dish_description_add_nl" name="dish_description_add_nl"  placeholder="Dish description in <?= lang2; ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">                                       <div class="form-group">
                                                    <label for="attributes price">Price</label>
                                                    <input type="text" class="form-control" id="dish_price_new" name="dish_price_new" placeholder="Price" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Dish Type</label>

                                                    <select class="form-control" id="dish_type_new" name="dish_type_new">
                                                        <option selected value="1">Simple Dish</option>
                                                        <option value="2">Custom Dish</option></select>
                                                </div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">


                                                <div class="form-group">
                                                    <label for="attributes price">Dish Category</label>
                                                    <div class="chkbox-div form-control">
                                                        <?php $checkbox_name = "cat_list_chk_new[]";
                                                        get_all_category_chkbox($mysqli, $checkbox_name); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group " id="varib_div">
                                                    <label for="attributes price">Options / variables</label>
                                                    <div class="chkbox-div form-control" id="varible_div">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Tax %</label>
                                                    <input type="text" class="form-control" id="tax_percent_new" name="tax_percent_new" placeholder="Tax % " value="9" >
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
												<div class="form-group">
												<label for="attributes price">Icon</label>
												<?php $edit_query121 = "SELECT * from `media` ";
                                          $query_result121 = $mysqli->query($edit_query121); 
										  while($row1221=$query_result121->fetch_array()){
                                    ?>
                                 <input type="checkbox" name="icon[]" id="icon" value="<?php echo $row1221['id']; ?>"><img src="<?php echo $row1221['icon']; ?>" style="height:20px; widh:20px; ">
											<?php } ?>
											</div>
											</div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Product Image</label>
                                                    <input type="file" class="form-control" id="image" name="image" >
                                                </div>
                                            </div>
											 <div class="col-md-6 col-sm-12">
												<div class="form-group">
												<label for="attributes price">Product Video</label>
													<select class="form-control" name="video" id="video" >
														<option value="default">Select Video</option>
												<?php $edit_video = "SELECT * from `video` ";
                                          $query_video = $mysqli->query($edit_video); 
										  while($row_video=$query_video->fetch_array()){
                                    ?>
														<option value="<?php echo $row_video['id']; ?>"><?php echo $row_video['video']; ?></option>
											<?php } ?>
													</select>
											</div>
											</div>
										<div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="attributes price">Discount</label>
                                                    <input type="text" value="0" class="form-control" id="dish_discount" name="dish_discount" placeholder="Discount ">
                                                </div>
                                            </div>	
										<div class="weekDays-selector">
			   <label for="attributes price">Discount days</label><br>
  <input type="checkbox" id="weekday-mon" value="Monday" name="weekdays[]">
  <label for="weekday-mon">M</label>
  <input type="checkbox" id="weekday-tue" value="Tuesday" name="weekdays[]">
  <label for="weekday-tue">T</label>
  <input type="checkbox" id="weekday-wed" value="Wednesday" name="weekdays[]">
  <label for="weekday-wed">W</label>
  <input type="checkbox" id="weekday-thu" value="Thursday" name="weekdays[]">
  <label for="weekday-thu">T</label>
  <input type="checkbox" id="weekday-fri" value="Friday" name="weekdays[]">
  <label for="weekday-fri">F</label>
  <input type="checkbox" id="weekday-sat" value="Saturday" name="weekdays[]">
  <label for="weekday-sat">S</label>
  <input type="checkbox" id="weekday-sun" value="Sunday" name="weekdays[]" ""="">
  <label for="weekday-sun">S</label>
</div>	
											</div>
	 <div class="plastick-selector col-md-6 col-sm-12 row">  <label for="attributes price">Plastic Charge</label><br>
	  	<input type="text" value="" class="form-control" id="plastic_charg1" name="plastic_charg1">
	</div>									
											
										
										
                                    </div>
                                    <!-- /.box-body -->
									<div id="loader1" style="display: none; color:red ">
					Please wait image uploading to server....
				</div>
                                </div>
								 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="add_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input name="__submit__" type="submit" value="Upload"/>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Add Modal -->

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
                             <form id="formedit" action="ajaxeditupload.php" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Dish's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                     <p id="editnotimsg"></p>
                                    <div class="box-body" id="edit_dish_data">
                                    </div>
                                    <!-- /.box-body -->
									 <div id="loader" style="display: none;color:red ">
					Please wait image uploading to server....
				</div>
                                </div>
								
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="edit_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="submit" name="submit" id="edit_dish_submit" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Status Change Modal -->
                <div class="modal fade" id="modal-change_status">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change Dish's Status</h4>
                                <form method="post" action="">
                            </div>
                            <div class="modal-body">
                                <p id="status_notimsg"></p>
                                <div class="box-body" id="return_string1">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="change_status_btn" id="change_status_btn" class="btn btn-info btn-danger pull-right">Submit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Status Change Modal -->

                <!-- Delete Modal -->
                <div class="modal modal-danger fade" id="modal-delete">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Dish</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete item. This operation can not be undo.</p>
                                <input type="hidden" value="" id="dele_hidden">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
                                <button type="button" id="del_rec" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
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
                                <h4 class="modal-title">Remove Image</h4>
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
                                    <h4 class="modal-title">View Image</h4>
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
	               if ($("#dish_name_edit_en").val() == "") {
                        alert("Please provide dish name1!");
                        $("#dish_name_edit_en").focus();
                        return false;
                    }
                    if ($("#dish_name_edit_nl").val() == "") {
                        alert("Please provide dish name2!");
                        $("#dish_name_edit_nl").focus();
                        return false;
                    }
					  var dish_typ = $("#dish_type_edit option:selected").val();
					  if (dish_typ == 2) {
						  var countByName= $('input[name="varib_list_chk_edit[]"]:checked').length; 
						  if(countByName == 0){
							  alert("Please select at least one option / variable.");
                            return false;
						  }
					  }
					var countByName11= $('input[name="cat_list_chk_edit[]"]:checked').length; 
	  
                   if(countByName11 == 0){
							  alert("Please select at least one dish Category.");
                            return false;
						  }
                   
 
  $.ajax({
         url: "ajaxeditupload.php",
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
 load();
$('#loader').hide();
			 
                            $('#editnotimsg').html('');
                            $('#editnotimsg').html(data);
                             clear();
                            $("#editnotimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#editnotimsg').delay(3000).fadeOut('1000')
                            }, 1000); 
   }							
    });
 }));
});
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
	 e.preventDefault();
	 if ($("#dish_name_new_en").val() == "") {
                        alert("Please provide dish name!");
                        $("#dish_name_new_en").focus();
                        return false;
                    }
                    if ($("#dish_name_new_nl").val() == "") {
                        alert("Please provide dish name!");
                        $("#dish_name_new_nl").focus();
                        return false;
                    }
					  if ($("#dish_price_new").val() == "") {
                        alert("Please provide dish price!");
                        $("#dish_price_new").focus();
                        return false;
                    }
					
    var dish_typ = $("#dish_type_new option:selected").val();
					  if (dish_typ == 2) {
						  var countByName= $('input[name="var_list_chk[]"]:checked').length; 
						  if(countByName == 0){
							  alert("Please select at least one option / variable.");
                            return false;
						  }
					  }
					var countByName11= $('input[name="cat_list_chk_new[]"]:checked').length; 
                   if(countByName11 == 0){
							  alert("Please select at least one dish Category.");
                            return false;
						  }
 
  $.ajax({
         url: "ajaxupload.php",
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
	   console.log(data);
   load();
$('#loader1').hide();
                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                         ///   clear();
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
                    url = b_url + 'dish_action.php';
                    var dish_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {dish_action: dish_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {

                    $('#dish_name_new_en').val('');
                    $('#dish_name_new_nl').val('');
                    $('#dish_description_add_en').val('');
                    $('#dish_description_add_nl').val('');
                    $('#dish_price_new').val('');
                    $('#tax_percent_new').val('9');                    
                    $('input[name="cat_list_chk_new"]').prop('checked', false);
                    $("#dish_type_new").prop('selectedIndex', 0);
                    $('input[name="var_list_chk"]').prop('checked', false);
                    $('#varib_div').hide();
                }

                $(function () {
                    load();
                });

                $("#dish_type_new").on('change', function () {
                    if (this.value == '1') {
                         $('input[name="var_list_chk"]').prop('checked', false);
                        $('#varib_div').hide();
                    }
                    if (this.value == '2') {
                        $('#varib_div').show();
                    }
                });
                $("#dish_type_edit").on('change', function () {
                    
                    if (this.value == '1') {
                         $('input[name="varib_list_chk_edit"]').prop('checked', false);
                        $('#varib_div_edit').attr('display','none');
                    }
                    if (this.value == '2') {
                        ('#varib_div_edit').attr('display','block');
                    }
                });
                

                $(document).on('click', '#vari_div', function () {
                    $('#varib_div').hide();
                    clear();

                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                    var dish_action = 'add_load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_action: dish_action
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#varible_div').html();
                            $('#varible_div').html(data);
                        }
                    });
                });
                $(document).on('click', '#refersh', function () {
                    load();
                });
                
            

                $(document).on('click', '#view_record', function () {
                                    var dish_id = $(this).attr("dataid");
                                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                                    var dish_action = 'view';
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {
                                            dish_id: dish_id,
                                            dish_action: dish_action,
                                        },
                                        dataType: "html",
                                        success: function (data)
                                        {
                                            $('#view_dish_data').html('');
                                            $('#view_dish_data').html(data);
                                        }
                                    });
                                });
				
				 $(document).on('click', '#view_image', function () {
                                    var dish_id = $(this).attr("dataid");
                                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                                    var dish_action = 'viewimage';
                                    $.ajax({
                                        type: "POST",
                                        url: url,
                                        data: {
                                            dish_id: dish_id,
                                            dish_action: dish_action,
                                        },
                                        dataType: "html",
                                        success: function (data)
                                        {
                                            $('#view_img_data').html('');
                                            $('#view_img_data').html(data);
                                        }
                                    });
                                });
//to add single white space in dish discription so if admin not want to provide it then there is no issue				
				$(document).on('click','#vari_div',function(){
    $('#dish_description_add_en').val(' ');
    $('#dish_description_add_nl').val(' ');
});

                $(document).on('click','#edit_record',function(){
                    var dish_id = $(this).attr("dataid");
                    var dish_action = 'edit_load_record';

                    url = b_url + 'dish_action.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_id: dish_id,
                            dish_action: dish_action,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#edit_dish_data').html('');
                            $('#edit_dish_data').html(data);
                        }
                }); 
            });
             
                $(document).on('click', '#change_status', function () {
                    var dish_id = $(this).attr("dataid");   //console.log(id);
                    var dish_action = 'get_status';
                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_action: dish_action,
                            dish_id: dish_id
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#return_string1').html('');
                            $('#return_string1').html(data);
                        }
                    });
                });
                $(document).on('click', '#change_status_btn', function () {
                    var dish_id = $("#mso").val();
                    var dish_action = 'change_status';
                    var selected_value = $("#currentstatus option:selected").text();
                    url = b_url + 'dish_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_action: dish_action,
                            dish_id: dish_id,
                            selected_value: selected_value
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#status_notimsg').html('');
                            $('#status_notimsg').html(data);
                            $("#status_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#status_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });
                
                $(document).on('click', '#delete_record', function () {
                    var dish_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(dish_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var dish_id = $("#dele_hidden").val(); //console.log(id);
                    var dish_action = 'delete';
                    url = b_url + 'dish_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_id: dish_id,
                            dish_action: dish_action
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
$(document).on('click', '#del_image', function () {
                    var dish_id = $("#dele_hidden").val(); //console.log(id);
                    var dish_action = 'deleteimage';
                    url = b_url + 'dish_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            dish_id: dish_id,
                            dish_action: dish_action
                        },
                        dataType: "html",
                        success: function (data)
                        {

                            
                            load();
                            $("#del_imgclose").click();
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

