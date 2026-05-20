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
                        Categories
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Categories</li>
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
                                    <h3 class="box-title">About Categories</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about categories.</p>

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
                                            <h3 class="box-title">Available Categories</h3>
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
                                        <table class="table table-hover" id="cat_list">
                                            
                                         
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
                                    <h4 class="modal-title">Add New Category</h4>

                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <div class="box-body">
                                        <p id="notimsg"></p>
										<div class="form-group">
                                            <label for="category name">Super Category Name</label>
                                           <div class="row"> 
                                              
                                            <div class="col-md-12 col-sm-12">
                                                <select class="form-control" id="supcat_name_new_ln2" name="supcat_name_new_ln2"   >
													<option>Select One</option>
													<?php $dupesql = "SELECT * FROM `supercategories`";
        $duperaw = $mysqli->query($dupesql);
        while($duperaw_row = $duperaw->fetch_assoc()){ ?>
													<option value="<?php echo $duperaw_row['supcat_id']; ?>"><?php echo $duperaw_row['supcat_name_en']; ?></option>
													<?php } ?>
												</select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category name">Category Name</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_new_ln1" name="category_name_new_ln1" placeholder="Category name in  <?= lang1;?>" required >
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input type="text" class="form-control" id="cat_name_new_ln2" name="category_name_new_ln2" placeholder="Category name in <?= lang2;?>"  >
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Category Description</label>
                                           <div class="row"> 
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_add_ln1" name="category_description_add_ln1"  placeholder="Category description in  <?= lang1;?>">&nbsp;&nbsp;</textarea>
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                   <textarea class="form-control" rows="3" id="cat_description_add_ln2" name="category_description_add_ln2"  placeholder="Category description in  <?= lang2;?>">&nbsp;&nbsp;</textarea>
                                               </div>
                                           </div>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                   <input type="button" name="submit" id="add_cat_form" class="btn btn-primary" value="Submit" />
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
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">View Category Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body" id="view_attri_data">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

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
                                <h4 class="modal-title">Edit Category's Details</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p id="edit_notimsg"></p>
                                <div class="box-body" id="edit_cat_data">

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
                                <h4 class="modal-title">Change Category's Status</h4>
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
                                <h4 class="modal-title">Delete Category</h4>
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
             function load() {
                    url = b_url + 'categories_action.php';
                    var cat_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {cat_action:cat_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#cat_list').html('');
                            $('#cat_list').html(data);
                        }
                    });
                }

                function clear() {

                    $('#attributes_name_new_ln1').val('');
                    $('#attributes_name_new_ln2').val('');
                    $('#attributes_description_add_ln1').val('');
                    $('#attributes_description_add_ln2').val('');
                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });
                
                $(document).on('click', '#add_cat_form', function () {

                    if ($("#cat_name_new_ln1").val() == "") {
                        alert("Please provide category name!");
                        $("#cat_name_new_ln1").focus();
                        return false;
                    }
                    
                    if ($("#cat_description_add_ln1").val() == "") {
                        alert("Please provide category description!");
                        $("#cat_description_add_ln1").focus();
                        return false;
                    }
                    
                    

                    url = b_url + 'categories_action.php';  //console.log(url);  console.log();
                    var cat_action = 'add';
					var supcat_name_new_ln2 = $('#supcat_name_new_ln2').val();
                    var cat_name_new_ln1 = $('#cat_name_new_ln1').val();
                    var cat_name_new_ln2 = $('#cat_name_new_ln2').val();
                    var cat_description_add_ln1 = $('#cat_description_add_ln1').val();
                    var cat_description_add_ln2 = $('#cat_description_add_ln2').val();
                    

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
							supcat_name_new_ln2: supcat_name_new_ln2,
                            cat_name_new_ln1: cat_name_new_ln1,
                            cat_name_new_ln2: cat_name_new_ln2,
                            cat_description_add_ln1: cat_description_add_ln1,
                            cat_description_add_ln2: cat_description_add_ln2
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            load();

                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            clear();
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);

                        }
                    });
                });
                
                $(document).on('click','#view_record',function(){
                    var cat_id = $(this).attr("dataid");
                    var cat_action = 'view';
                    url = b_url + 'categories_action.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
                            cat_id: cat_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#view_attri_data').html('');
                            $('#view_attri_data').html(data);
                        }
                }); 
            });

                $(document).on('click','#edit_record',function(){
                    var cat_id = $(this).attr("dataid");
                    var cat_action = 'edit_load_record';
                    url = b_url + 'categories_action.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
                            cat_id: cat_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#edit_cat_data').html('');
                            $('#edit_cat_data').html(data);
                        }
                }); 
            });
            
            
                $(document).on('click', '#update_rec', function () {

                    if ($("#cat_name_edit_ln1").val() == "") {
                        alert("Please provide category name!");
                        $("#cat_name_edit_ln1").focus();
                        return false;
                    }
                    if ($("#category_description_edit_ln1").val() == "") {
                        $("#category_description_edit_ln1").val(" ");
                    }
                    

                    url = b_url + 'categories_action.php';
                    var cat_action = 'edit';
                    var cat_id = $('#categories_id').val();
                    var cat_name_edit_ln1 = $('#cat_name_edit_ln1').val();
				    var supcat_name_edit_ln2 = $('#supcat_name_edit_ln2 :selected').val();
                    var cat_name_edit_ln2 = $('#cat_name_edit_ln2').val();
                    var cat_description_edit_ln1 = $('#cat_description_edit_ln1').val();
                    var cat_description_edit_ln2 = $('#cat_description_edit_ln2').val();
                 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
                            cat_id: cat_id,
                            cat_name_edit_ln1: cat_name_edit_ln1,
							supcat_name_edit_ln2 : supcat_name_edit_ln2,
                            cat_name_edit_ln2: cat_name_edit_ln2,
                            cat_description_edit_ln1: cat_description_edit_ln1,
                            cat_description_edit_ln2: cat_description_edit_ln2
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
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
                    var cat_id = $(this).attr("dataid");   //console.log(id);
                    var cat_action = 'get_status_cat';
                    url = b_url + 'categories_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
                            cat_id: cat_id
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#return_string1').html('');
                            $('#return_string1').html(data);
                        }
                    });
                });
                
                $(document).on('click', '#change_status_btn', function () {
                    var cat_id = $("#mso").val();
                    var cat_action = 'change_status';
                    var selected_value = $("#currentstatus option:selected").text();
                    url = b_url + 'categories_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_action: cat_action,
                            cat_id: cat_id,
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
                    var cat_id = $("#dele_hidden").val(); //console.log(id);
                    var cat_action = 'delete';
                    url = b_url + 'categories_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            cat_id: cat_id,
                            cat_action: cat_action
                        },
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

