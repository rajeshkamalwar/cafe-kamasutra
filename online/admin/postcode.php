<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
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
                        Postcode
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Postcode</li>
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
                                    <h3 class="box-title">About Postcode</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>We always try to deliver order as quickly as possible. So we ask for postcode at the time of order.</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.About section -->
                    </div>
                    <p id="del_notimsg"></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-6">
                                            <h3 class="box-title">Available Postcode</h3>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button> 
                                                <a href="bluk.php" class="btn btn-primary"><i  class="fa fa-plus"></i> Bulk Upload</a>                                               
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>
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
                            <form method="post"> 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add New Postcode</h4>

                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="add_notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="postcode name">Postcode </label>
                                            <input type="text" class="form-control" id="postcode_name_new" name="postcode_name_new" placeholder="For example: 1011" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes price">Neighborhood Name</label>
                                            <input type="text" class="form-control" id="postcode_neighborhood_name_new" name="postcode_neighborhood_name_new" placeholder="For example: Amsterdam – Nieuwmarkt/Lastage" required>
                                        </div>
                                        
                                     <div class="form-group">
                                            <label for="attributes price">Minimum Amount</label>
                                            <input type="text" class="form-control pricefun" id="postcode_minimum_amt_new" name="postcode_minimum_amt_new"  value="0" placeholder="For example: 12.00" required>
                                        </div>
										<div class="form-group">
                                            <label for="attributes price">Free From</label>
                                            <input type="text" class="form-control pricefun" id="postcode_free_from_new" name="postcode_free_from_new" placeholder="example: 22.00" required>
                                        </div>
<div class="field_wrapper">
            <!--<div class="col-md-4"> 
                                            <label for="attributes price">Min Amount</label>
                                            <input type="text" class="form-control" id="min_amt[]" name="min_amt[]" placeholder="example: 2.00">
                                        </div>
	   <div class="col-md-4">
                                            <label for="attributes price">Max amount</label>
                                            <input type="text" class="form-control" id="max_amt[]" name="max_amt[]" placeholder="example: 2.00">
                                        </div> -->
            <div class="col-md-4">
                                            <label for="attributes price">Delivery Charges</label>
                                            <input type="text" class="form-control pricefun" id="postcode_deliv_chrg_new" name="postcode_deliv_chrg_new" placeholder="example: 2.00" required>
                                        </div>
                                        
        <!--<a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" style="width: 5%;" /></a>-->
   
</div>
                                    </div>
                                    <!-- /.box-body -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="add_postcode" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Add Modal -->             

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Postcode</h4>

                            </div>
							<form role="form">
                            <div class="modal-body">
                                <p id="edit_notimsg"></p>
                                <div class="box-body" id="edit_postcode_data">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="update_rec" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
								 </div>
                                </form>
                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Status Change Modal -->
                <div class="modal fade" id="modal-stateChange">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change Postcode's Status</h4>
                               </div>
							<form method="post" >
                            <div class="modal-body">
                                <p id="status_notimsg"></p>
                                <div class="box-body" id="return_string1">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="changestatusbtn" id="changestatusbtn" class="btn btn-info btn-danger pull-right">Submit</button>
                               </div>
							</form>
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
                                <h4 class="modal-title">Delete Postcode</h4>
                                </div>
							<form role="form">
                            
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete this postcode. This operation can not be undo.</p>
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
            </div>
            <!--// main content -->
            <?php include 'footer.php'; ?>
 
            <script type="text/javascript">
		$(document).on('change, keyup',  "input.pricefun", function (event) {
		  
			var currentInput = $(this).val();
			var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
			$(this).val(fixedInput);
			
		});		
				
				
				
                function load() {
                    url = b_url + 'postcode_action.php';
                    var postcode_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {

                    $('#postcode_name_new').val('');
                    $('#postcode_neighborhood_name_new').val('');
                    $('#postcode_minimum_amt_new').val('');
                    $('#postcode_deliv_chrg_new').val('');
                    $('#postcode_free_from_new').val('');
                   	$('#min_amt').val('')
					$('#max_amt').val('')

                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_postcode', function () {
                    if ($("#postcode_name_new").val() == "") {
                        alert("Please provide postcode!");
                        $("#postcode_name_new").focus();
                        return false;
                    }
                    if ($("#postcode_neighborhood_name_new").val() == "") {
                     ///   alert("Please provide neighborhood name!");
                        ///$("#postcode_neighborhood_name_new").focus();
                       // return false;
                    }
                    if ($("#postcode_minimum_amt_new").val() == "") {
                        alert("Please provide minimum order amount!");
                        $("#postcode_minimum_amt_new").focus();
                        return false;
                    }
				
					var max_amt = [];
					$('input[name="max_amt[]"]').each( function() {
						max_amt.push(this.value);
					});
					var min_amt = [];
					$('input[name="min_amt[]"]').each( function() {
						min_amt.push(this.value);
					});
				
					var postcode_deliv_chrg_new  = $('#postcode_deliv_chrg_new').val();
					 
					
                    var postcode_action = 'add_postcode';
                    var postcode_name_new = $("#postcode_name_new").val();
                    var postcode_neighborhood_name_new = $("#postcode_neighborhood_name_new").val();
                    var postcode_minimum_amt_new = $("#postcode_minimum_amt_new").val();
                    var postcode_free_from_new = $("#postcode_free_from_new").val();
					
				 
			 
					
                    url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_action: postcode_action,
                            postcode_name_new: postcode_name_new,
                            postcode_neighborhood_name_new: postcode_neighborhood_name_new,
                            postcode_minimum_amt_new: postcode_minimum_amt_new,
                            postcode_deliv_chrg_new: postcode_deliv_chrg_new,
                            postcode_free_from_new: postcode_free_from_new,
							 
						},
                       /// dataType: "html",
                        success: function (data)
                        {
                            ///load();
   console.log(url);
                            console.log(data);

                            $('#add_notimsg').html('');
                            $('#add_notimsg').html(data);
                          ///  clear();
                            $("#add_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#add_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });

                });

                $(document).on('click', '#edit_record', function () {
                    var postcode_id = $(this).attr("dataid");
                    url = b_url + 'postcode_action.php';
                    var postcode_action = 'get_data4edit';
                    
                    
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_id: postcode_id,
                            postcode_action: postcode_action
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            $('#edit_postcode_data').html('');
                            $('#edit_postcode_data').html(data);
                        }
                    });

                });
                $(document).on('click', '#update_rec', function () {
                    
                    if ($("#postcode_name_edit").val() == "") {
                        alert("Please provide postcode!");
                        $("#postcode_name_edit").focus();
                        return false;
                    }
                    if ($("#postcode_neighborhood_name_edit").val() == "") {
                     ///   alert("Please provide neighborhood name!");
                     ///   $("#postcode_neighborhood_name_edit").focus();
                      ///  return false;
                    }
                    if ($("#postcode_minimum_amt_edit").val() == "") {
                        alert("Please provide minimum order amount!");
                        $("#postcode_minimum_amt_edit").focus();
                        return false;
                    }
					var delpostid = [];
					$('input[name="delpostid[]"]').each( function() {
						delpostid.push(this.value);
					});
				////	var max_amt_edit = [];
					///$('input[name="max_amt_edit[]"]').each( function() {
					///	max_amt_edit.push(this.value);
					///});
					///var min_amt_edit = [];
				///	$('input[name="min_amt_edit[]"]').each( function() {
					////	min_amt_edit.push(this.value);
					///});
					
					///var postcode_deliv_chrg_new_edit = [];
					////$('input[name="postcode_deliv_chrg_new_edit[]"]').each( function() {
					///	postcode_deliv_chrg_new_edit.push(this.value);
					///});
						
                    var postcode_id = $("#postcode_id").val();   //console.log(id);
                    var postcode_action = 'edit_postcode';
					
                    var postcode_name_edit = $("#postcode_name_edit").val();
                    var postcode_neighborhood_name_edit = $("#postcode_neighborhood_name_edit").val();
                    var postcode_minimum_amt_edit = $("#postcode_minimum_amt_edit").val();
					var postcode_free_from_new_edit = $("#postcode_free_from_new_edit").val();
				    var postcode_deliv_chrg_new = $("#postcode_deliv_chrg_new2").val();
					
				 
					
                       url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                    // console.log(url);
				//alert(delpostid);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_action: postcode_action,
                            postcode_id: postcode_id,
                            postcode_name_edit: postcode_name_edit,
                            postcode_neighborhood_name_edit: postcode_neighborhood_name_edit,
                            postcode_minimum_amt_edit: postcode_minimum_amt_edit,
                         ///   postcode_deliv_chrg_new_edit: postcode_deliv_chrg_new_edit,
                            postcode_free_from_new_edit: postcode_free_from_new_edit,
						///	min_amt_edit:min_amt_edit,
							///max_amt_edit:max_amt_edit,
							delpostid:delpostid,
							postcode_deliv_chrg_new:postcode_deliv_chrg_new,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();

                            //console.log(data);

                            $('#edit_notimsg').html('');
                            $('#edit_notimsg').html(data);
                            clear();
                            $("#edit_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#edit_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });

                });

                $(document).on('click', '#change_record', function () {
                    var postcode_id = $(this).attr("dataid");   //console.log(id);
                    var postcode_action = 'change_postcode_status_get';
                    url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_id: postcode_id, postcode_action: postcode_action},
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#return_string1').html('');
                            $('#return_string1').html(data);
                        }
                    });
                });
                $(document).on('click', '#changestatusbtn', function () {
                    var postcode_id = $("#postcode_id").val();
                    var selected_value = $("#currentstatus option:selected").text();
                    var postcode_action = 'postcode_status_set';
                    url = b_url + 'postcode_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action, selected_value: selected_value, postcode_id: postcode_id},
                        dataType: "html",
                        success: function (data)
                        {
                            load();

                            //console.log(data);

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
                    var postcode_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(postcode_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var postcode_id = $("#dele_hidden").val(); //console.log(id);
                    url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                    var postcode_action = 'delete';
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action, postcode_id: postcode_id},
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
$(document).on('click', '#del_delrec', function () {
var postcodedel_id = $(this).attr("dataid"); 
                    url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                    var postcode_action = 'deletedelcharge';
                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action, postcodedel_id: postcodedel_id},
                        dataType: "html",
                        success: function (data)
                        {
                            $("#del_close").click();
                           load();
							 $("#delpostcode" + postcodedel_id).remove();
                            
                        }
                    });

                });
            </script>
    </body>
</html>

