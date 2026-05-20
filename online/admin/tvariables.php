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
        <link rel="stylesheet" href="../../plugins/iCheck/all.css">
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
                        Variables
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Variables</li>
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
                                    <h3 class="box-title">About Variables</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Variable are some options that lets you offer a set of variations on a product, with control over prices for each variation. They can be used for a product like a pizza, where you can offer a large, medium & small for size and in different taste link features tomatoes, garlic, oregano, and extra virgin olive oil.</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-8">
                                            <h3 class="box-title">Available Variables</h3>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
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

                <?php
                $avilable_attributes = "Select * from `tattribute` where attrib_status='Active'";
                $avilable_attributes_result = $mysqli->query($avilable_attributes);
                $attrib_list = '';
                if ($avilable_attributes_result->num_rows == 0) {
                    $attrib_list = '<div class="col-md-4 col-sm-12"><p>No attribut found!</p></div>';
                } else {
                    while ($attrib = $avilable_attributes_result->fetch_assoc()) {
                        $attrib_list .= '<div class="col-md-4 col-sm-12">
                                         <div class = "checkbox">
                                        <label>
                                               <input type = "checkbox" id="' . $attrib['attrib_name_en'] . '-' . $attrib['attrib_id'] . '" name = "cat_list_chk" value = "' . $attrib['attrib_id'] . '"/>' . $attrib['attrib_name_en'] . '
                                        </label>
                                        </div>
                                        </div>';
                    }
                }
                ?>
                <!-- Add Modal -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Variable</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <!--<p>One fine body&hellip;</p>-->
                                <p id="notimsg"></p>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="variable name">Variable name</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_new_en" name="variable_name_new_en" placeholder="Variable name in <?= lang1; ?>" >
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_new_nl" name="variable_name_new_nl" placeholder="Variable name in <?= lang2; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable name">Select Attributes</label>
                                        <div class="row">
                                            <?php
                                            echo $attrib_list;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable description">Variable description</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_new_en" name="variable_description_new_en"  placeholder="Variable description in <?= lang1; ?>"></textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_new_nl" name="variable_description_new_nl"  placeholder="Variable description in <?= lang2; ?>"></textarea>
                                            </div>
                                        </div>


                                    </div>
									
	<div class="form-group">
                                        <label for="variable description">Variable Type</label>
                                        <div class="row">
                                          <div class="col-md-4 col-sm-12"><input type="checkbox" id="choosemethod" name="choosemethod" value="1" class="choosetype1">Checkbox  </div>
                                           <div class="col-md-4 col-sm-12"><input type="checkbox" id="choosemethod" name="choosemethod" value="2" class="choosetype1">Select Option<br>  </div>
						</div>
	 <div class="form-group">  <label for="variable description">Required</label>	
		 <input type="checkbox" id="is_required" name="is_required" class="is_required" value="0">No-required  <input type="checkbox" id="is_required" name="is_required" value="1" class="is_required">Required </div>
		
		
 <div class="form-group">
                                        <label for="variable description">Limit Type</label>
                                        <div class="row">
                                          <div class="col-md-3 col-sm-12"><input type="checkbox" id="dishchoosetype" name="dishchoosetype" value="1" class="choosetype">Single</div>
                                           <div class="col-md-3 col-sm-12"><input type="checkbox" id="dishchoosetype" name="dishchoosetype" value="2" class="choosetype">Limit 2 </div>
										 <div class="col-md-3 col-sm-12"><input type="checkbox" id="dishchoosetype" name="dishchoosetype" value="3" class="choosetype">Limit 3 </div>
										 <div class="col-md-3 col-sm-12"><input type="checkbox" id="dishchoosetype" name="dishchoosetype" value="4" class="choosetype">Multiple Choice</div>
										</div>
										

                                    </div>
                                    </div>								
									
									
									
									
									
								 
                                </div>
                                <!-- /.box-body -->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add_varib_form" ><i class="fa fa-plus"></i> Add</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Add Modal -->
                <!-- View Modal -->
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">View Variable Details</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <!--<p>One fine body&hellip;</p>-->
                                <p id="notimsg"></p>
                                <div class="box-body" id="view_varib_data">
                                    <div class="form-group">
                                        <label for="variable name">Variable name</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_view_en" name="variable_name_view_en" placeholder="Variable name in <?= lang1; ?>" >
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="variable_name_view_nl" name="variable_name_view_nl" placeholder="Variable name in <?= lang2; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable name">Select Attributes</label>
                                        <div class="row">
                                            <?php
                                            echo $attrib_list;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variable description">Variable description</label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_view_en" name="variable_description_view_en"  placeholder="Variable description in <?= lang1; ?>"></textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <textarea class="form-control" rows="3" id="variable_description_view_nl" name="variable_description_view_nl"  placeholder="Variable description in <?= lang2; ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
									 <div class="form-group">
                                        <label for="variable description">Variable Choose Method</label>
										<div class="row">
                                          <div class="col-md-4 col-sm-12">
                                                <input type="checkbox" id="choosemethod" name="choosemethod" value="1">Chosoe 1
                                            </div>
                                           <div class="col-md-4 col-sm-12">
                                                <input type="checkbox" id="choosemethod" name="choosemethod" value="2">
											   Chosoe 2
                                            </div>
											<div class="col-md-4 col-sm-12">
                                                <input type="checkbox" id="choosemethod" name="choosemethod" value="3">
											   Chosoe 3
                                            </div>
										 
										</div>


                                    </div>
                                </div>
                                <!-- /.box-body -->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.View Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Variable's Details</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <div class="box-body">
                                    <p id="edit_notimsg"></p>
                                    <div class="box-body" id="edit_vari_data">

                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="update_rec" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                </form>
                            </div>
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
                                <h4 class="modal-title">Change Variable's Status</h4>
                                <form method="post" >
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
                                <h4 class="modal-title">Delete Variable</h4>
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

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>

            <script type="text/javascript">

	 $(document).on("click", 'input.choosetype', function (event) {
		  $(this).parent('.col-md-3').parent('.row').find('.col-md-3 input').not(this).prop('checked', false);			
	 });
		
	 $(document).on("click", 'input.choosetype1', function (event) {
		  $(this).parent('.col-md-4').parent('.row').find('.col-md-4 input').not(this).prop('checked', false);			
	 });
						
	 $(document).on("click", 'input.choosemethod', function (event) {
		  $(this).parent('.col-md-4').parent('.row').find('.col-md-4 input').not(this).prop('checked', false);			
	 });
		
	 $(document).on("click", 'input.dishchoosetype', function (event) {
		  $(this).parent('.col-md-3').parent('.row').find('.col-md-3 input').not(this).prop('checked', false);			
	 });
		 $(document).on("click", 'input.is_required', function (event) {
			   $(this).parent('.form-group').find('input').not(this).prop('checked', false);			
	 });
							
       
	function load() {
                    url = b_url + 'tvariables_actions.php';
                    var variables_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {variables_action: variables_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear()
                {
                    $('#variable_name_new_en').val('');
                    $('#variable_name_new_nl').val('');
                    $('#variable_description_new_en').val('');
                    $('#variable_description_new_nl').val('');
                    $('input[name="cat_list_chk"]').prop('checked', false);
                    $('input[name="var_list_chk"]').prop('checked', false);
                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_varib_form', function () {

                    if ($("#variable_name_new_en").val() == "") {
                        alert("Please provide variable name!");
                        $("#variable_name_new_en").focus();
                        return false;
                    }
                    if ($("#variable_name_new_nl").val() == "") {
                        alert("Please provide varibale name!");
                        $("#variable_name_new_nl").focus();
                        return false;
                    }
                  /*  if ($("#variable_description_new_en").val() == "") {
                        alert("Please provide variable description!");
                        $("#variable_description_new_en").focus();
                        return false;
                    }
                    if ($("#variable_description_new_nl").val() == "") {
                        alert("Please provide variable description!");
                        $("#variable_description_new_nl").focus();
                        return false;
                    }*/
                    var favorite = [];
                    $.each($("input[name='cat_list_chk']:checked"), function () {
                        favorite.push($(this).val());
                    });
                    if (favorite.length === 0) {
                        alert("Please select at least one attribute.");
                        return false;
                    }

                    

                    url = b_url + 'tvariables_actions.php';  //console.log(url);  console.log();
                    var variables_action = 'add';
                    var variable_name_new_en = $('#variable_name_new_en').val();
                    var variable_name_new_nl = $('#variable_name_new_nl').val();
                    var variable_description_new_en = $('#variable_description_new_en').val();
                    var variable_description_new_nl = $('#variable_description_new_nl').val();
                    var variable_attrib_new = favorite.join(",");
					
					
					var choosemethod = $("input[name='choosemethod']:checked").val();
				    var is_required = $("input[name='is_required']:checked").val();
					 var dishchoosetype = $("input[name='dishchoosetype']:checked").val();
 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            variable_name_new_en: variable_name_new_en,
                            variable_name_new_nl: variable_name_new_nl,
                            variable_description_new_nl: variable_description_new_nl,
                            variable_description_new_en: variable_description_new_en,
                            variable_attrib_new: variable_attrib_new,
							choosemethod:choosemethod,
							is_required:is_required,
							dishchoosetype:dishchoosetype
                        },
                        dataType: "html",
                        success: function (data)
                        {   console.log(data);
                            load();

                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            clear();
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000');
                            }, 1000);

                        }
                    });
                });
                
                $(document).on('click', '#view_record', function () {
                    var varib_id = $(this).attr("dataid");
                    url = b_url + 'tvariables_actions.php';  //console.log(url);  console.log();
                    var variables_action = 'view';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            varib_id: varib_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#view_varib_data').html('');
                            $('#view_varib_data').html(data);
                        }
                    });
                });
                
                $(document).on('click','#edit_record',function(){
                    var varib_id = $(this).attr("dataid");
                    var variables_action = 'edit_load_record';
                    url = b_url + 'tvariables_actions.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            varib_id: varib_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#edit_vari_data').html('');
                            $('#edit_vari_data').html(data);
                        }
                }); 
            });
            
                $(document).on('click', '#update_rec', function () {

                    if ($("#variable_name_edit_en").val() == "") {
                        alert("Please provide variable name!");
                        $("#variable_name_edit_en").focus();
                        return false;
                    }
                    if ($("#variable_name_edit_nl").val() == "") {
                        alert("Please provide varibale name!");
                        $("#variable_name_edit_nl").focus();
                        return false;
                    }
          
                    var edit_favorite = [];
                    $.each($("input[name='cat_list_chk_edit']:checked"), function () {
                        edit_favorite.push($(this).val());
                    });
                    if (edit_favorite.length === 0) {
                        alert("Please select at least one attribute.");
                        return false;
                    }
var choosemethod = $(this).closest('.modal-footer').closest('.modal-content').find("input[name='choosemethod']:checked").val();
						var is_required = $(this).closest('.modal-footer').closest('.modal-content').find("input[name='is_required']:checked").val();

					
					
                    url = b_url + 'tvariables_actions.php';
                    var variables_action = 'edit';
                    var varib_id = $('#varib_id').val();
                    var variable_name_edit_en = $('#variable_name_edit_en').val();
                    var variable_name_edit_nl = $('#variable_name_edit_nl').val();
                    var variable_description_edit_en = $('#variable_description_edit_en').val();
                    var variable_description_edit_nl = $('#variable_description_edit_nl').val();
					 var dishchoosetype = $(this).closest('.modal-footer').closest('.modal-content').find("input[name='dishchoosetype']:checked").val();
					
                    var variable_attrib_edit = edit_favorite.join(",");
			 
				 
					
				 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            varib_id: varib_id,
                            variable_name_edit_en: variable_name_edit_en,
                            variable_name_edit_nl: variable_name_edit_nl,
                            variable_description_edit_en: variable_description_edit_en,
                            variable_description_edit_nl: variable_description_edit_nl,
                            variable_attrib_edit:variable_attrib_edit,
							choosemethod:choosemethod,
							is_required:is_required,
							dishchoosetype:dishchoosetype
                        },
                        dataType: "html",
                        success: function (data)
                        {   
                            load();

                            $('#edit_notimsg').html('');
                            $('#edit_notimsg').html(data);
                            
                            $("#edit_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#edit_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);

                        }
                    });
                });
                
                 $(document).on('click', '#change_record', function () {
                    var varib_id = $(this).attr("dataid");   //console.log(id);
                    var variables_action = 'get_status';
                    url = b_url + 'tvariables_actions.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            varib_id: varib_id
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
                    var varib_id = $("#mso").val();
                    var variables_action = 'change_status';
                    var selected_value = $("#currentstatus option:selected").text();
                    url = b_url + 'tvariables_actions.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            variables_action: variables_action,
                            varib_id: varib_id,
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
                    var cat_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(cat_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var varib_id = $("#dele_hidden").val(); //console.log(id);
                    var variables_action = 'delete';
                    url = b_url + 'tvariables_actions.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            varib_id: varib_id,
                            variables_action: variables_action
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

